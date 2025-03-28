<?php

namespace App\Enums;

enum AttributeType :string
{
    case Text = 'text';
    case Number = 'number';
    case Boolean = 'boolean';
    case Date = 'date';
    case Select = 'select';
}
