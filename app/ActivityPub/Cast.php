<?php

namespace App\ActivityPub;

enum Cast: string
{
    case String = 'string';
    case TranslatableString = 'translatable_string';
    case Int = 'int';
    case Float = 'float';
    case Bool = 'bool';
    case Date = 'date';
    case Collection = 'collection';
    case Node = 'node'; // For specific DTO classes
}
