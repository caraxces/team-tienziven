<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * Module Name: My Team
 * Description: Module quản lý nhóm và thành viên, phê duyệt, kiến thức và hiệu suất
 * Version: 1.0.1
 * Requires at least: 2.3.*
 * Author: Tien Ziven
 */

define('MY_TEAM_MODULE_NAME', 'my_team');

hooks()->add_action('admin_init', 'my_team_module_init_menu_items');
hooks()->add_action('admin_init', 'my_team_permissions');
hooks()->add_filter('get_contact_permissions', 'my_team_contact_permissions');
hooks()->add_action('app_admin_head', 'my_team_admin_assets');

// Load helper
$CI = &get_instance();
$CI->load->helper('my_team');

/**
 * Register activation module hook
 */
register_activation_hook(MY_TEAM_MODULE_NAME, 'my_team_module_activation_hook');

/**
 * Register deactivation module hook
 */
register_deactivation_hook(MY_TEAM_MODULE_NAME, 'my_team_module_deactivation_hook');

/**
 * Register language files, must be registered if the module is using languages
 */
register_language_files(MY_TEAM_MODULE_NAME, [MY_TEAM_MODULE_NAME]);

/**
 * Function that will be executed when module is activated
 */
function my_team_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

/**
 * Function that will be executed when module is deactivated
 */
function my_team_module_deactivation_hook()
{
    // Nothing to do here for now
}

/**
 * Hook for adding admin menu items
 */
function my_team_module_init_menu_items()
{
    $CI = &get_instance();

    $CI->app_menu->add_sidebar_menu_item('my_team', [
        'name'     => _l('my_team'),
        'icon'     => 'fa fa-users',
        'position' => 30,
    ]);
    
    $CI->app_menu->add_sidebar_children_item('my_team', [
        'slug'     => 'team_members',
        'name'     => _l('team_members'),
        'icon'     => 'fa fa-user',
        'href'     => admin_url('my_team/members'),
        'position' => 5,
    ]);

    $CI->app_menu->add_sidebar_children_item('my_team', [
        'slug'     => 'team_approvals',
        'name'     => _l('team_approvals'),
        'icon'     => 'fa fa-check-circle',
        'href'     => admin_url('my_team/approvals'),
        'position' => 10,
    ]);

    $CI->app_menu->add_sidebar_children_item('my_team', [
        'slug'     => 'team_training',
        'name'     => _l('team_training'),
        'icon'     => 'fa fa-graduation-cap',
        'href'     => admin_url('my_team/training'),
        'position' => 15,
    ]);

    $CI->app_menu->add_sidebar_children_item('my_team', [
        'slug'     => 'team_performance',
        'name'     => _l('team_performance'),
        'icon'     => 'fa fa-chart-line',
        'href'     => admin_url('my_team/performance'),
        'position' => 20,
    ]);
}

/**
 * Add additional permissions for staff members
 */
function my_team_permissions()
{
    $capabilities = [];

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
        'create' => _l('permission_create'),
        'edit'   => _l('permission_edit'),
        'delete' => _l('permission_delete'),
    ];

    register_staff_capabilities('my_team', $capabilities, _l('my_team'));
}

/**
 * Contact permissions for clients
 */
function my_team_contact_permissions($permissions)
{
    $permissions[] = [
        'id'         => 'my_team',
        'name'       => _l('my_team'),
        'short_name' => 'my_team',
    ];

    return $permissions;
}

/**
 * Tải CSS và JS cho module
 */
function my_team_admin_assets()
{
    $CI = &get_instance();
    $viewuri = $CI->uri->uri_string();
    
    if (strpos($viewuri, 'my_team') !== false) {
        echo '<link href="' . module_dir_url('my_team', 'assets/css/my_team.css') . '?v=' . time() . '" rel="stylesheet" type="text/css" />';
        
        // Tải CSS và JS chỉ cho trang hiệu suất
        if (strpos($viewuri, 'my_team/performance') !== false) {
            echo '<script src="' . module_dir_url('my_team', 'assets/js/performance_dashboard.js') . '?v=' . time() . '"></script>';
        }
        
        // Tải JS chung cho module
        echo '<script src="' . module_dir_url('my_team', 'assets/js/my_team.js') . '?v=' . time() . '"></script>';
    }
} 