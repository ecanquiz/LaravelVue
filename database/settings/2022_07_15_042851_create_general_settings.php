<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add("general.default_pagination", "10");
        $this->migrator->add("general.footer_message", "Footer message");
    }
}
