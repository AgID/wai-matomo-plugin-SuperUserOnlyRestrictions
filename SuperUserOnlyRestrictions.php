<?php
/**
 * Matomo - free/libre analytics platform
 * Plugin developed for Web Analytics Italia (https://webanalytics.italia.it)
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\SuperUserOnlyRestrictions;

use Piwik\Config;
use Piwik\Piwik;
use Piwik\Plugins\UsersManager\UsersManager;

class SuperUserOnlyRestrictions extends \Piwik\Plugin
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $pluginConfig;

    /**
     * Construct a new SuperUserOnlyRestrictions instance.
     */
    public function __construct() {
        parent::__construct();

        $this->pluginConfig = Config::getInstance()->{$this->pluginName};
    }

    /**
     * Get event handlers.
     *
     * @return array the event handlers
     */
    public function registerEvents()
    {
        return [
            'Controller.UsersManager.userSettings' => 'restrictAccess',
            'Controller.Widgetize.index' => 'restrictAccess',
            'Controller.API.listAllAPI' => 'restrictAccess',
        ];
    }

    /**
     * Restrict access to super users only, if the plugin is enabled.
     */
    public function restrictAccess()
    {
        if(isset($this->pluginConfig['super_user_only_restrictions_enabled']) && $this->pluginConfig['super_user_only_restrictions_enabled']){
            Piwik::checkUserIsNotAnonymous();
            Piwik::checkUserHasSuperUserAccess();
        }
    }
}
