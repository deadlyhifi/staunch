<?php
/*
Plugin Name: Staunch
Plugin URI: https://github.com/deadlyhifi/staunch/
Description: Remove update roles from admin users so updates cannot be done on a live system.
Version: 1.0
Author: Tom de Bruin
Author URI: http://deadlyhifi.com

Notes:
Fork of original by Scott Cariss - http://l3rady.com
https://github.com/bigfishdesign/staunch
*/

// Stop direct access
!defined('ABSPATH') and exit;

if (getenv('ENV') != 'development') {
    $staunch = new Staunch();
}

class Staunch
{
    public function __construct()
    {
        define("DISALLOW_FILE_EDIT", TRUE);
        add_action('admin_notices', [$this, 'staunch_updates_admin_notice']);
        add_filter('map_meta_cap', [$this, 'staunch_remove_roles_on_live'], 10, 4);
    }

    public function staunch_remove_roles_on_live($caps, $cap, $user_id, $args)
    {
        if ($cap === "update_core")
        {
            $caps[] = 'do_not_allow';
            return $caps;
        }

        $caps_to_disabled = array(
            'update_plugins',
            'update_themes',
            'install_plugins',
            'install_themes',
            'delete_plugins',
            'delete_themes',
            'edit_plugins',
            'edit_themes'
        );

        if (in_array($cap, $caps_to_disabled)) {
            $caps[] = 'do_not_allow';
        }

        return $caps;
    }

    public function staunch_updates_admin_notice()
    {
        global $pagenow;

        if ('plugins.php' != $pagenow && 'update-core.php' != $pagenow) {
            return;
        }

        echo '<div class="error"><p><strong>For security reasons updates can only be applied from version control master.</strong></p></div>';
    }
}
