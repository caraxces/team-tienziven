<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Hook này sẽ thêm đường dẫn views của module my_team
 * để CI có thể tìm thấy các view nếu cần
 */
function my_team_add_views_path()
{
    $CI = &get_instance();
    
    // Thêm đường dẫn views cho module my_team
    $module_views_path = FCPATH . 'modules/my_team/views';
    
    if (is_dir($module_views_path)) {
        try {
            $CI->load->add_package_path(FCPATH . 'modules/my_team');
        } catch (Exception $e) {
            log_message('error', 'Không thể thêm package path cho module my_team: ' . $e->getMessage());
        }
    } else {
        // Tạo thư mục views trong module nếu chưa tồn tại
        if (!is_dir(FCPATH . 'modules/my_team')) {
            @mkdir(FCPATH . 'modules/my_team', 0755, true);
        }
        
        if (!is_dir($module_views_path)) {
            @mkdir($module_views_path, 0755, true);
        }
        
        // Tạo file index.html để bảo vệ thư mục
        if (!file_exists($module_views_path . '/index.html')) {
            @file_put_contents($module_views_path . '/index.html', '<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>');
        }
    }
}

// Không kích hoạt menu từ hooks vì đã được thêm vào menu_helper.php
// hooks()->add_action('admin_init', 'my_team_add_menu_items');

/**
 * Hook để thêm menu My Team vào sidebar
 * Không sử dụng nữa vì đã thêm vào menu_helper.php
 */
/*
function my_team_add_menu_items() {
    $CI = &get_instance();
    
    // Thêm menu chính My Team
    $CI->app_menu->add_sidebar_menu_item('my_team', [
        'name'     => _l('my_team'),
        'icon'     => 'fa fa-users',
        'position' => 2, // Vị trí cao hơn (ngay sau Dashboard)
    ]);
    
    // Thêm các menu con
    $CI->app_menu->add_sidebar_children_item('my_team', [
        'slug'     => 'dashboard',
        'name'     => _l('dashboard'),
        'icon'     => 'fa fa-tachometer-alt',
        'href'     => admin_url('my_team'),
        'position' => 1,
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
        'slug'     => 'team_knowledge',
        'name'     => _l('team_knowledge'),
        'icon'     => 'fa fa-book',
        'href'     => admin_url('my_team/knowledge'),
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
*/ 