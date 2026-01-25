<?php

namespace App\ActivityPub;

class TranslatableString
{
    protected array $translations = [];

    public function __construct(array $translations = [])
    {
        $this->translations = $translations;
    }

    public function get(string $languageCode): ?string
    {
        return $this->translations[$languageCode] ?? null;
    }

    public function set(string $languageCode, string $value): void
    {
        $this->translations[$languageCode] = $value;
    }

    public function __toString(): string
    {
        return $this->getDefaultLanguageValue() ?? '';
    }

    protected function getDefaultLanguageValue(): ?string
    {
        $defaultLanguage = config('app.locale');
        $fallbackLanguage = config('app.fallback_locale');

        return $this->translations[$defaultLanguage]
            ?? $this->translations[$fallbackLanguage]
            ?? $this->translations['_']
            ?? null;
    }
}
