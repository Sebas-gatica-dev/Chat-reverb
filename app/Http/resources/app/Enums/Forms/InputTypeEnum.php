<?php

namespace App\Enums\Forms;

enum InputTypeEnum: string 
{
    case Text = 'text';
    case Number = 'number';
    case Toggle = 'toggle';
    case Select = 'select';
    case TextArea = 'textarea';
    case Default = 'default';




    public function getName(): ?string
    {

        return match ($this) {
        self::Text => 'Campo de texto',
        self::Number => 'Campo numerico',
        self::Toggle => 'Selector si o no',
        self::Select => 'Campo select',
        self::TextArea => 'Campo texto extenso',
        self::Default => 'Campo default',

        };
    }


    public function getComponentPreview(): ?string
    {

        return match ($this) {
        self::Text => 'input-text-preview',  
        self::Number => 'input-numeric-preview',
        self::Toggle => 'input-toggle-preview',
        self::Select => 'input-select-preview',
        self::TextArea => 'input-textarea-preview',
        self::Default => 'input-default-preview',

        };
    }
}