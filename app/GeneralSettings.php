<?php

namespace App;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public int $default_pagination;
    public string $footer_message;

    public static function group(): string
    {
        return "general";
    }
}
