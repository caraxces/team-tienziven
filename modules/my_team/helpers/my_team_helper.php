<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Xử lý tệp đính kèm cho phê duyệt
 * @param  mixed $approval_id    ID của phê duyệt
 * @param  string $index         tên của input
 * @return array/boolean         mảng thông tin tệp hoặc false
 */
function handle_approval_attachments_array($approval_id, $index)
{
    $CI = &get_instance();
    
    // Đảm bảo helper upload đã được load
    $CI->load->helper('upload');
    
    $path = FCPATH . 'uploads/approvals/';
    
    $uploaded_files = [];
    
    // Kiểm tra và tạo thư mục
    if (isset($_FILES[$index])) {
        if ($approval_id) {
            if (!is_dir($path . $approval_id)) {
                mkdir($path . $approval_id, 0755, true);
            }
            $path = $path . $approval_id . '/';
        } else {
            if (!is_dir($path . 'temp')) {
                mkdir($path . 'temp', 0755, true);
            }
            $path = $path . 'temp/';
        }
        
        _file_attachments_index_fix($index);
        
        for ($i = 0; $i < count($_FILES[$index]['name']); $i++) {
            // Kiểm tra coi có tệp không
            if (empty($_FILES[$index]['name'][$i])) {
                continue;
            }
            
            // Lưu tên gốc
            $original_file_name = $_FILES[$index]['name'][$i];
            
            // Mã hóa tên tệp
            $file_name = app_generate_hash() . '.' . get_file_extension($_FILES[$index]['name'][$i]);
            
            // Thử tải lên
            if (move_uploaded_file($_FILES[$index]['tmp_name'][$i], $path . $file_name)) {
                $attachment   = [];
                $attachment[] = [
                    'file_name' => $file_name,
                    'filetype'  => $_FILES[$index]['type'][$i],
                    'original_file_name' => $original_file_name
                ];
                
                $uploaded_files[] = $attachment[0];
            }
        }
    }
    
    if (count($uploaded_files) > 0) {
        return $uploaded_files;
    }
    
    return false;
}

/**
 * Tải xuống tệp đính kèm phê duyệt
 * @param  mixed $approval_id ID của phê duyệt
 * @param  mixed $file_name   tên tệp
 * @return void
 */
function approval_download_attachment($approval_id, $file_name)
{
    $CI = &get_instance();
    $path = FCPATH . 'uploads/approvals/' . $approval_id . '/' . $file_name;
    
    if (file_exists($path)) {
        $CI->load->helper('download');
        
        // Lấy thông tin tệp gốc từ cơ sở dữ liệu
        $CI->db->where('id', $approval_id);
        $approval = $CI->db->get(db_prefix() . 'team_approvals')->row();
        
        if ($approval && $approval->attachment === $file_name) {
            // Lấy tên tệp gốc nếu có
            $original_file_name = $file_name;
            
            // Kiểm tra định dạng tệp
            $mime = get_mime_by_extension($path);
            
            // Tải xuống
            force_download($original_file_name, file_get_contents($path), $mime);
        }
    }
}

/**
 * Xử lý tệp đính kèm cho knowledge item
 * @param  mixed $knowledge_id ID của knowledge item
 * @param  string $index       tên của input
 * @return string/boolean      tên tệp hoặc false
 */
function handle_knowledge_attachment($knowledge_id, $index)
{
    $CI = &get_instance();
    $path = FCPATH . 'uploads/knowledge/';
    
    // Kiểm tra và tạo thư mục
    if (isset($_FILES[$index]) && $_FILES[$index]['name'] != '') {
        if ($knowledge_id) {
            if (!is_dir($path . $knowledge_id)) {
                mkdir($path . $knowledge_id, 0755, true);
            }
            $path = $path . $knowledge_id . '/';
        } else {
            if (!is_dir($path . 'temp')) {
                mkdir($path . 'temp', 0755, true);
            }
            $path = $path . 'temp/';
        }
        
        // Lưu tên gốc
        $original_file_name = $_FILES[$index]['name'];
        
        // Mã hóa tên tệp
        $file_name = app_generate_hash() . '.' . get_file_extension($_FILES[$index]['name']);
        
        // Thử tải lên
        if (move_uploaded_file($_FILES[$index]['tmp_name'], $path . $file_name)) {
            // Nếu là tệp tạm, di chuyển sang thư mục chính khi knowledge item được tạo
            if (!$knowledge_id) {
                $CI->session->set_userdata('knowledge_attachment', $file_name);
                $CI->session->set_userdata('knowledge_attachment_original_name', $original_file_name);
            }
            
            return $file_name;
        }
    }
    
    return false;
}

/**
 * Tải xuống tệp đính kèm knowledge
 * @param  mixed $knowledge_id ID của knowledge item
 * @param  mixed $file_name    tên tệp
 * @return void
 */
function knowledge_download_attachment($knowledge_id, $file_name)
{
    $CI = &get_instance();
    $path = FCPATH . 'uploads/knowledge/' . $knowledge_id . '/' . $file_name;
    
    if (file_exists($path)) {
        $CI->load->helper('download');
        
        // Lấy thông tin tệp gốc từ cơ sở dữ liệu
        $CI->db->where('id', $knowledge_id);
        $knowledge = $CI->db->get(db_prefix() . 'knowledge_items')->row();
        
        if ($knowledge && $knowledge->attachment === $file_name) {
            // Lấy tên tệp gốc nếu có
            $original_file_name = $file_name;
            
            // Kiểm tra định dạng tệp
            $mime = get_mime_by_extension($path);
            
            // Tải xuống
            force_download($original_file_name, file_get_contents($path), $mime);
        }
    }
} 