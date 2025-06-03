<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="no-margin"><?php echo _l('team_members'); ?></h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <?php if (staff_can('create', 'staff') || is_admin()) { ?>
                                <a href="<?php echo admin_url('staff/member'); ?>" class="btn btn-info">
                                    <i class="fa fa-plus"></i> <?php echo _l('new_staff'); ?>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Filters -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo form_open(admin_url('my_team/members'), ['method' => 'get', 'id' => 'filter-form']); ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="department_id"><?php echo _l('general_department'); ?></label>
                                            <select name="department_id" id="department_id" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                <option value=""><?php echo _l('dropdown_non_selected_tex'); ?></option>
                                                <?php foreach ($departments as $department) { ?>
                                                <option value="<?php echo $department['departmentid']; ?>" <?php if (isset($_GET['department_id']) && $_GET['department_id'] == $department['departmentid']) { echo 'selected'; } ?>><?php echo $department['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="role"><?php echo _l('general_staff_role'); ?></label>
                                            <select name="role" id="role" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                <option value=""><?php echo _l('dropdown_non_selected_tex'); ?></option>
                                                <?php foreach ($roles as $role) { ?>
                                                <option value="<?php echo $role['roleid']; ?>" <?php if (isset($_GET['role']) && $_GET['role'] == $role['roleid']) { echo 'selected'; } ?>><?php echo $role['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="search"><?php echo _l('general_search'); ?></label>
                                            <input type="text" name="search" id="search" class="form-control" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" placeholder="<?php echo _l('general_search_placeholder'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div class="btn-group pull-right">
                                                <button type="submit" class="btn btn-info"><?php echo _l('general_search'); ?></button>
                                                <a href="<?php echo admin_url('my_team/members'); ?>" class="btn btn-default"><?php echo _l('general_reset'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        
                        <!-- Members List -->
                        <div class="row mtop15">
                            <div class="col-md-12">
                                <?php if (count($members) > 0) { ?>
                                <div class="row staff-member-list">
                                    <?php foreach ($members as $member) { ?>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="panel_s">
                                            <div class="panel-body staff-member-card">
                                                <div class="text-center">
                                                    <?php echo staff_profile_image($member['staffid'], ['staff-profile-image-medium']); ?>
                                                    <h4><?php echo $member['firstname'] . ' ' . $member['lastname']; ?></h4>
                                                    
                                                    <?php
                                                    // Hiển thị vai trò
                                                    $role_name = '';
                                                    foreach ($roles as $role) {
                                                        if ($role['roleid'] == $member['role']) {
                                                            $role_name = $role['name'];
                                                            break;
                                                        }
                                                    }
                                                    ?>
                                                    
                                                    <p class="text-muted">
                                                        <?php echo $role_name; ?>
                                                        <?php if ($member['admin']) { ?>
                                                        <span class="label label-info"><?php echo _l('staff_admin_profile'); ?></span>
                                                        <?php } ?>
                                                    </p>
                                                    
                                                    <?php
                                                    // Hiển thị phòng ban
                                                    $department_name = '';
                                                    foreach ($departments as $department) {
                                                        if ($department['departmentid'] == $member['departmentid']) {
                                                            $department_name = $department['name'];
                                                            break;
                                                        }
                                                    }
                                                    ?>
                                                    
                                                    <?php if ($department_name) { ?>
                                                    <p><span class="label label-default"><?php echo $department_name; ?></span></p>
                                                    <?php } ?>
                                                </div>
                                                
                                                <hr class="hr-margin" />
                                                
                                                                                <div class="text-center">
                                    <!-- Hiển thị thông tin liên hệ -->
                                    <a href="mailto:<?php echo $member['email']; ?>" class="btn btn-default btn-sm" title="<?php echo _l('general_send_email'); ?>">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                    
                                    <?php if ($member['phonenumber']) { ?>
                                    <a href="tel:<?php echo $member['phonenumber']; ?>" class="btn btn-default btn-sm" title="<?php echo _l('general_phone'); ?>">
                                        <i class="fa fa-phone"></i>
                                    </a>
                                    <?php } ?>
                                    
                                    <!-- Nút chỉnh sửa - chỉ hiển thị nếu có quyền -->
                                    <?php if (staff_can('edit', 'staff') || is_admin()) { ?>
                                    <a href="<?php echo admin_url('staff/member/' . $member['staffid']); ?>" class="btn btn-primary btn-sm" title="<?php echo _l('edit_staff'); ?>">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <?php } ?>
                                    
                                    <!-- Nút xóa - chỉ hiển thị nếu có quyền và không phải admin -->
                                    <?php if (staff_can('delete', 'staff') && !$member['admin'] && $member['staffid'] != get_staff_user_id()) { ?>
                                    <a href="<?php echo admin_url('staff/delete/' . $member['staffid']); ?>" class="btn btn-danger btn-sm _delete" title="<?php echo _l('delete_staff'); ?>">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                    <?php } ?>
                                    
                                    <?php if ($member['active'] == 0) { ?>
                                    <br><span class="label label-danger mtop5"><?php echo _l('staff_inactive_account'); ?></span>
                                    <?php } ?>
                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } else { ?>
                                <div class="alert alert-info">
                                    <?php echo _l('no_members_found'); ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
$(function() {
    // Auto-submit form when department or role changes
    $('#department_id, #role').on('change', function() {
        $('#filter-form').submit();
    });
});
</script> 