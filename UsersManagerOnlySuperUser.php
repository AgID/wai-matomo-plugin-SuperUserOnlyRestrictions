<?php
/**
 * Matomo - free/libre analytics platform
 * Plugin developed for Web Analytics Italia (https://webanalytics.italia.it)
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\UsersManagerOnlySuperUser;

use Piwik\Config;
use Piwik\Piwik;
use Piwik\Plugins\UsersManager\UsersManager;

class UsersManagerOnlySuperUser extends \Piwik\Plugin
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $pluginConfig;

    /**
     * Construct a new LoginFilterIp instance.
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
            'Controller.UsersManager.userSettings' => 'checkUserHasSuperUserAccess',
        ];
    }

    /**
     * Check if user has super user access.
     */
    public function checkUserHasSuperUserAccess()
    {
        if(isset($this->pluginConfig['users_manager_only_super_user_enabled']) && $this->pluginConfig['users_manager_only_super_user_enabled']){
            Piwik::checkUserIsNotAnonymous();
            Piwik::checkUserHasSuperUserAccess();
        }
    }
}
