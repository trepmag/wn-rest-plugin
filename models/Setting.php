<?php namespace Trepmag\Rest\Models;

use Model;

/**
 * Settings Model
 */
class Setting extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'trepmag_rest_settings';

    public $settingsFields = 'fields.yaml';

    protected function getPrefixAttribute($value)
    {
        // Ensure it always ends with a slash
        return rtrim($this->get('prefix'), '/') . '/';
    }
}
