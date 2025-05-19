<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * Module Name: My Team
 * Description: Team management module for managers to oversee their team members
 * Version: 1.0.0
 * Requires at least: 2.3.*
*/

// Make sure tables are created on module init
require_once(__DIR__ . '/models/My_team_model.php');
$CI = &get_instance();
$my_team_model = new My_team_model();
$my_team_model->create_tables();

// Modificado: Agora o My Team será integrado diretamente como um recurso padrão na view do admin
hooks()->add_action('admin_init', 'my_team_init_default_menu');
hooks()->add_action('admin_init', 'my_team_permissions');
hooks()->add_action('app_admin_head', 'my_team_head_components');
hooks()->add_action('app_admin_footer', 'my_team_footer_components');
hooks()->add_action('after_parse_app_css', 'my_team_init_css');
hooks()->add_action('admin_init', 'my_team_init_tables');

/**
 * Initialize the My Team module as a default feature in the admin interface
 * @return null
 */
function my_team_init_default_menu()
{
    $CI = &get_instance();
    
    // Hiển thị menu chính nếu có ít nhất một trong các quyền sau:
    // 1. Quyền xem my_team
    // 2. Quyền xem team_approvals
    // 3. Là admin
    if (staff_can('view', 'my_team') || staff_can('view', 'team_approvals') || is_admin()) {
        $CI->app_menu->add_sidebar_menu_item('my-team', [
            'name'     => _l('my_team'),
            'href'     => admin_url('my_team'),
            'icon'     => 'fa fa-users',
            'position' => 4, // Position right after dashboard (which is at position 1)
        ]);
        
        // Sub menu items - Quản lý thành viên (chỉ hiển thị khi có quyền my_team view)
        if (staff_can('view', 'my_team') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('my-team', [
                'slug'     => 'my-team-members',
                'name'     => _l('team_members'),
                'href'     => admin_url('my_team'),
                'position' => 5,
            ]);
        }
        
        // Phê duyệt (hiển thị cho tất cả người dùng vì ai cũng có thể tạo/xem yêu cầu của họ)
        $CI->app_menu->add_sidebar_children_item('my-team', [
            'slug'     => 'my-team-approvals',
            'name'     => _l('approvals'),
            'href'     => admin_url('my_team/approvals'),
            'position' => 10,
        ]);
        
        // Knowledge items (hiển thị cho tất cả người dùng)
        $CI->app_menu->add_sidebar_children_item('my-team', [
            'slug'     => 'my-team-knowledge',
            'name'     => _l('knowledge_items'),
            'href'     => admin_url('my_team/knowledge'),
            'position' => 15,
        ]);
        
        // Performance (hiển thị cho tất cả người dùng)
        $CI->app_menu->add_sidebar_children_item('my-team', [
            'slug'     => 'my-team-performance',
            'name'     => _l('performance'),
            'href'     => admin_url('my_team/performance'),
            'position' => 20,
        ]);
    }
}

/**
 * Add module permissions for staff roles
 * @return null
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
    
    // Thêm quyền approvals riêng biệt để phê duyệt các yêu cầu
    $approvals_capabilities = [];
    $approvals_capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
        'approve' => _l('permission_approve'),
    ];
    
    register_staff_capabilities('team_approvals', $approvals_capabilities, _l('team_approvals'));
}

/**
 * Module's CSS
 * @return null
 */
function my_team_init_css()
{
    // Module CSS - Carregado em todas as páginas de admin
    echo '<link href="' . module_dir_url('my_team', 'assets/css/my_team.css') . '?v=' . time() . '"  rel="stylesheet" type="text/css" />';
}

/**
 * Load additional CSS and JavaScript in the admin head
 * @return null
 */
function my_team_head_components()
{
    // Agora carregamos CSS em todas as páginas admin, não apenas nas páginas específicas do My Team
    // Isso garante que o módulo seja tratado como um recurso padrão
    echo '<link href="' . module_dir_url('my_team', 'assets/css/my_team.css') . '?v=' . time() . '"  rel="stylesheet" type="text/css" />';
}

/**
 * Load JavaScript in the admin footer
 * @return null
 */
function my_team_footer_components()
{
    // JavaScript agora é carregado em todas as páginas de admin
    // isso garante que o módulo seja tratado como um recurso padrão
    echo '<script src="' . module_dir_url('my_team', 'assets/js/my_team.js') . '?v=' . time() . '"></script>';
}

/**
 * Initialize module database tables
 * @return null
 */
function my_team_init_tables()
{
    $CI = &get_instance();
    
    // Load the model to create tables
    require_once(__DIR__ . '/models/My_team_model.php');
    $my_team_model = new My_team_model();
    $my_team_model->create_tables();
} 