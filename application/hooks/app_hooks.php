<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @since  2.3.0
 * Register the app menu items in sidebar menu
 * @return null
 */
function app_init_admin_sidebar_menu_items()
{
    $CI = &get_instance();

    if (!class_exists('app_menu', false)) {
        return;
    }

    if (!function_exists('_l')) {
        return;
    }

    // Kiểm tra xem app_menu đã được khởi tạo chưa
    if (!isset($CI->app_menu) || !is_object($CI->app_menu)) {
        $CI->app_menu = new app_menu();
    }

    $CI->app_menu->add_sidebar_menu_item('dashboard', [
        'name'     => _l('als_dashboard'),
        'href'     => admin_url(),
        'position' => 1,
        'icon'     => 'fa fa-home',
    ]);

    $CI->app_menu->add_sidebar_menu_item('customers', [
        'position' => 10,
        'name'     => _l('clients'),
        'href'     => admin_url('clients'),
        'icon'     => 'fa fa-user-o',
    ]);

    $CI->app_menu->add_sidebar_menu_item('sales', [
        'position' => 15,
        'name'     => _l('als_sales'),
        'icon'     => 'fa fa-balance-scale',
    ]);

        // Menu My Team được định nghĩa trong my_team_hooks.php

    // Rest of menus can be defined below or in separate hook
}

/**
 * @since  2.3.0
 * Init admin menu items
 * @return null
 */
function app_init_admin_sidebar_menu()
{
    $CI = &get_instance();
    $menu = hooks()->apply_filters('admin_sidebar_menu_items', []);
    
    if (!is_array($menu) || count($menu) === 0) {
        return;
    }
    
    $CI->app_menu->add_sidebar_menu_items($menu);
} 