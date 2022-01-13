<?php namespace Trepmag\Rest;

use Backend;
use System\Classes\PluginBase;
use Trepmag\Rest\Classes\ApiManager;
use System\Classes\SettingsManager;

/**
 * Rest Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'trepmag.rest::lang.plugin.name',
            'description' => 'trepmag.rest::lang.plugin.description',
            'author'      => 'Saifur Rahman Mohsin',
            'icon'        => 'icon-cloud'
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('create.restcontroller', 'Trepmag\Rest\Console\CreateRestController');
    }

    public function boot()
    {
        // Register all the available API nodes
        $apiManager = ApiManager::instance();
    }

    /**
     * Registers settings controller for this plugin.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'trepmag.rest::lang.settings.name',
                'description' => 'trepmag.rest::lang.settings.description',
                'category'    => SettingsManager::CATEGORY_SYSTEM,
                'icon'        => 'icon-cloud',
                'url'         => Backend::url('trepmag/rest/settings'),
                'order'       => 507,
                'permissions' => ['trepmag.rest.access_settings'],
            ]
        ];
    }
}
