<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Xử lý tệp đính kèm cho phê duyệt
 * @param  int    $id         ID phê duyệt
 * @param  string $input_name Tên input file
 * @return array
 */
function handle_approval_attachments_array($id, $input_name)
{
    $CI = &get_instance();
    $path = my_team_get_upload_path_by_type('approval') . $id . '/';
    $uploaded_files = [];
    
    if (isset($_FILES[$input_name]['name']) && !empty($_FILES[$input_name]['name'])) {
        
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        
        $config = [
            'upload_path' => $path,
            'allowed_types' => 'jpg|jpeg|png|pdf|doc|docx|xls|xlsx|zip|rar',
            'max_size' => '20000', // 20MB
            'encrypt_name' => true,
        ];
        
        $CI->load->library('upload', $config);
        
        if ($CI->upload->do_upload($input_name)) {
            $uploaded_files[] = $CI->upload->data();
        }
    }
    
    return $uploaded_files;
}

/**
 * Tải xuống tệp đính kèm phê duyệt
 * @param  int    $id           ID phê duyệt
 * @param  string $file_name    Tên file
 * @return void
 */
function approval_download_attachment($id, $file_name)
{
    $path = my_team_get_upload_path_by_type('approval') . $id . '/' . $file_name;
    
    if (file_exists($path)) {
        $CI = &get_instance();
        $CI->load->helper('download');
        force_download($path, null);
    } else {
        show_404();
    }
}

/**
 * Tải xuống tệp đính kèm kiến thức
 * @param  int    $id           ID kiến thức
 * @param  string $file_name    Tên file
 * @return void
 */
function knowledge_download_attachment($id, $file_name)
{
    $path = my_team_get_upload_path_by_type('knowledge') . $id . '/' . $file_name;
    
    if (file_exists($path)) {
        $CI = &get_instance();
        $CI->load->helper('download');
        force_download($path, null);
    } else {
        show_404();
    }
}

/**
 * Lấy đường dẫn upload theo loại cho module My Team
 * @param  string $type Loại
 * @return string
 */
function my_team_get_upload_path_by_type($type)
{
    $path = '';
    switch ($type) {
        case 'approval':
            $path = FCPATH . 'uploads/approvals/';
            break;
        case 'knowledge':
            $path = FCPATH . 'uploads/knowledge/';
            break;
        default:
            $path = FCPATH . 'uploads/';
            break;
    }
    
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
    
    return $path;
}

/**
 * Get knowledge category by ID
 * @param  mixed $id   category id
 * @return mixed       object or false
 */
function get_knowledge_category($id)
{
    $CI = &get_instance();
    
    if (!class_exists('My_team_model')) {
        $CI->load->model('my_team_model');
    }
    
    return $CI->my_team_model->get_knowledge_category($id);
}

/**
 * Kiểm tra quyền truy cập knowledge
 * @param  integer $knowledge_id ID của bài viết
 * @param  integer $staff_id    ID của nhân viên (để trống nếu là nhân viên hiện tại)
 * @return boolean
 */
function has_knowledge_access($knowledge_id, $staff_id = '')
{
    $CI = &get_instance();
    
    if (!class_exists('My_team_model')) {
        $CI->load->model('my_team_model');
    }
    
    if ($staff_id == '') {
        $staff_id = get_staff_user_id();
    }
    
    // Admin có quyền truy cập tất cả
    if (is_admin($staff_id)) {
        return true;
    }
    
    $knowledge = $CI->my_team_model->get_knowledge_item($knowledge_id);
    
    if (!$knowledge) {
        return false;
    }
    
    // Người tạo có quyền truy cập
    if ($knowledge['created_by'] == $staff_id) {
        return true;
    }
    
    // Kiểm tra phân quyền theo visibility
    switch ($knowledge['visibility']) {
        case 'all':
            return true;
        
        case 'departments':
            // Lấy danh sách phòng ban được phép truy cập
            $allowed_departments = !empty($knowledge['departments']) ? unserialize($knowledge['departments']) : [];
            if (empty($allowed_departments)) {
                return false;
            }
            
            // Lấy phòng ban của nhân viên hiện tại
            $CI->load->model('staff_model');
            $staff = $CI->staff_model->get($staff_id);
            
            if (!$staff) {
                return false;
            }
            
            return in_array($staff->departmentid, $allowed_departments);
        
        case 'staff':
            // Lấy danh sách nhân viên được phép truy cập
            $allowed_staff = !empty($knowledge['staff']) ? unserialize($knowledge['staff']) : [];
            if (empty($allowed_staff)) {
                return false;
            }
            
            return in_array($staff_id, $allowed_staff);
        
        default:
            return false;
    }
}

/**
 * Kiểm tra quyền chỉnh sửa knowledge
 * @param  integer $knowledge_id ID của bài viết
 * @param  integer $staff_id    ID của nhân viên (để trống nếu là nhân viên hiện tại)
 * @return boolean
 */
function has_knowledge_edit_permission($knowledge_id, $staff_id = '')
{
    $CI = &get_instance();
    
    if (!class_exists('My_team_model')) {
        $CI->load->model('my_team_model');
    }
    
    if ($staff_id == '') {
        $staff_id = get_staff_user_id();
    }
    
    // Admin có quyền chỉnh sửa tất cả
    if (is_admin($staff_id)) {
        return true;
    }
    
    // Nhân viên có quyền 'my_team' và 'edit'
    if (has_permission('my_team', $staff_id, 'edit')) {
        return true;
    }
    
    $knowledge = $CI->my_team_model->get_knowledge_item($knowledge_id);
    
    if (!$knowledge) {
        return false;
    }
    
    // Người tạo có quyền chỉnh sửa
    return $knowledge['created_by'] == $staff_id;
}

/**
 * Kiểm tra quyền xóa knowledge
 * @param  integer $knowledge_id ID của bài viết
 * @param  integer $staff_id    ID của nhân viên (để trống nếu là nhân viên hiện tại)
 * @return boolean
 */
function has_knowledge_delete_permission($knowledge_id, $staff_id = '')
{
    $CI = &get_instance();
    
    if (!class_exists('My_team_model')) {
        $CI->load->model('my_team_model');
    }
    
    if ($staff_id == '') {
        $staff_id = get_staff_user_id();
    }
    
    // Admin có quyền xóa tất cả
    if (is_admin($staff_id)) {
        return true;
    }
    
    // Nhân viên có quyền 'my_team' và 'delete'
    if (has_permission('my_team', $staff_id, 'delete')) {
        return true;
    }
    
    $knowledge = $CI->my_team_model->get_knowledge_item($knowledge_id);
    
    if (!$knowledge) {
        return false;
    }
    
    // Người tạo có quyền xóa
    return $knowledge['created_by'] == $staff_id;
} 