<?php namespace Trepmag\Rest\Controllers;

use Lang;
use Flash;
use BackendMenu;
use ApplicationException;
use Trepmag\Rest\Models\Node;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
use System\Controllers\Settings as SettingsController;

/**
 * Settings Back-end Controller
 */
class Settings extends SettingsController
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Trepmag.Rest', 'settings');
    }

    public function index()
    {
        parent::index();

        // Form Initialization
        $model = $this->formCreateModelObject();
        $this->initForm($model);
        $this->update('Trepmag', 'Rest', 'settings');

        // List Initialization
        return $this->asExtension('ListController')->index();
    }

    public function index_onSave()
    {
        return $this->update_onSave('Trepmag', 'Rest', 'settings');
    }

    protected function createModel($item)
    {
        return \Trepmag\Rest\Models\Setting::instance();
    }

    public function onBulkAction()
    {
        if (($bulkAction = post('action')) &&
            ($checkedIds = post('checked')) &&
            is_array($checkedIds) &&
            count($checkedIds)
        ) {
            foreach ($checkedIds as $nodeId) {
                if (!$node = Node::find($nodeId)) {
                    continue;
                }

                switch ($bulkAction) {
                    // Disables nodes exposed by the system.
                    case 'disable':
                        $node->disable();
                        break;

                    // Enables nodes exposed by the system.
                    case 'enable':
                        $node->enable();
                        break;
                }
            }
        }
        Flash::success(Lang::get("trepmag.rest::lang.settings.{$bulkAction}_success"));
        return $this->listRefresh('manage');
    }
}
