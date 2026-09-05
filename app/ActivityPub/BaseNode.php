<?php

namespace App\ActivityPub;

use App\ActivityPub\JsonLD\Graph;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class BaseNode
{
    /**
     * Cache schemas statically so resolution only runs once per class.
     */
    protected static array $schemaCache = [];

    protected array $data;

    protected Graph $graph;

    public function __construct(object|array $data, Graph $graph)
    {
        $this->data = (array) $data;
        $this->graph = $graph;
    }

    /**
     * Resolve and memoize the schema for the current class hierarchy.
     */
    protected function schema(): array
    {
        return static::$schemaCache[static::class] ??= $this->resolveSchema();
    }

    /**
     * Automatically discover and aggregate schemas from all used traits.
     */
    protected function resolveSchema(): array
    {
        $schema = [];

        // Discovers all traits used by this class and all parent classes
        foreach (class_uses_recursive(static::class) as $trait) {
            $traitName = class_basename($trait);
            $schemaMethod = 'schema'.$traitName;

            if (method_exists($this, $schemaMethod)) {
                $schema = array_merge($schema, $this->{$schemaMethod}());
            }
        }

        return $schema;
    }

    protected function set(string $uri, mixed $value): self
    {
        // match the expanded JSON-LD structure
        $this->data[$uri] = [(object) ['@value' => $value]];

        return $this;
    }

    protected function resolveValue(object $item)
    {
        if (isset($item->{'@id'})) {
            $node = $this->graph->getNode($item->{'@id'});

            return $node ? TypeFactory::create($node, $this->graph) : RemoteNode::make($item->{'@id'});
        }

        return $item->{'@value'} ?? $item;
    }

    public function __get($key)
    {
        $schemaDefinitions = $this->schema();

        // If not in schema, try a raw collection fallback
        if (! isset($schemaDefinitions[$key])) {
            if (isset($this->data[$key])) {
                return collect($this->data[$key])->map(fn ($val) => $this->resolveValue($val));
            }

            return null;
        }

        $def = $schemaDefinitions[$key];
        $uri = $def['uri'];
        $cast = $def['cast'];
        $rawValues = $this->data[$uri] ?? [];

        if (empty($rawValues) && $cast !== Cast::Collection) {
            return null;
        }

        return match ($cast) {
            Cast::String => $rawValues[0]->{'@value'} ?? (string) $this->resolveValue($rawValues[0]),
            Cast::TranslatableString => $this->castToTranslatableString($rawValues),
            Cast::Int => (int) ($rawValues[0]->{'@value'} ?? 0),
            Cast::Float => (float) ($rawValues[0]->{'@value'} ?? 0.0),
            Cast::Bool => (bool) ($rawValues[0]->{'@value'} ?? false),
            Cast::Date => $this->asDate($rawValues[0]->{'@value'} ?? null),
            Cast::Collection => $this->castToCollection($rawValues, $def['range'] ?? []),
            Cast::Node => $this->castToNode($rawValues[0], $def['range'] ?? []),
            default => $this->resolveValue($rawValues[0]),
        };
    }

    protected function asDate(?string $value): ?Carbon
    {
        return $value ? Carbon::parse($value) : null;
    }

    protected function castToTranslatableString(array $rawValues): TranslatableString
    {
        $translations = [];

        foreach ($rawValues as $value) {
            if (isset($value->{'@value'})) {
                // Simple string value (no language tag)
                $language = '_';
                $translations[$language] = $value->{'@value'};
            } elseif (isset($value->{'@language'}) && isset($value->{'@value'})) {
                // Language-tagged value
                $language = $value->{'@language'};
                $translations[$language] = $value->{'@value'};
            }
        }

        return new TranslatableString($translations);
    }

    protected function isValidType($value, array $allowedRange): bool
    {
        // If range is empty, allow everything
        if (empty($allowedRange)) {
            return true;
        }

        // Check against Allowed Range (Handles both Classes and Primitives like 'string')
        foreach ($allowedRange as $allowed) {
            if (is_object($value) && $value instanceof $allowed) {
                return true;
            }
            if ($allowed === 'string' && is_string($value)) {
                return true;
            }
            if ($allowed === 'int' && is_int($value)) {
                return true;
            }
            if ($allowed === 'float' && is_float($value)) {
                return true;
            }
            if ($allowed === 'bool' && is_bool($value)) {
                return true;
            }
        }

        return false;
    }

    protected function castToCollection(array $values, array $allowedRange): Collection
    {
        return collect($values)->map(function ($item) use ($allowedRange) {
            return $this->castToNode($item, $allowedRange);
        })->filter(); // Remove nulls if validation failed
    }

    protected function castToNode(object $value, array $allowedRange)
    {
        $resolved = $this->resolveValue($value);
        if (! $this->isValidType($resolved, $allowedRange)) {
            return null;
        }

        return $resolved;
    }
}
