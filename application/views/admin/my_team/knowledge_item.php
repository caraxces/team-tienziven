<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">
                            <?php echo !$knowledge ? _l('add_new_knowledge_item') : _l('edit_knowledge_item'); ?>
                        </h4>
                        <hr class="hr-panel-heading" />
                        <?php echo form_open_multipart($this->uri->uri_string(), ['id' => 'knowledge-form']); ?>
                        <div class="row">
                            <div class="col-md-8">
                                <?php echo render_input('subject', 'knowledge_subject', isset($knowledge) ? $knowledge->subject : ''); ?>
                                
                                <div class="form-group">
                                    <label for="description" class="control-label"><?php echo _l('knowledge_description'); ?></label>
                                    <?php echo render_textarea('description', '', isset($knowledge) ? $knowledge->description : '', [], [], '', 'tinymce-knowledge'); ?>
                                </div>
                                
                                <?php if (isset($knowledge) && $knowledge->attachment) { ?>
                                <div class="form-group">
                                    <label class="control-label"><?php echo _l('current_attachment'); ?></label>
                                    <div class="mtop10">
                                        <a href="<?php echo admin_url('my_team/download_knowledge_attachment/' . $knowledge->id); ?>" class="btn btn-success pull-left mright5">
                                            <i class="fa fa-cloud-download"></i> <?php echo _l('download'); ?>
                                        </a>
                                        <a href="<?php echo admin_url('my_team/remove_knowledge_attachment/' . $knowledge->id); ?>" class="btn btn-danger _delete pull-left">
                                            <i class="fa fa-remove"></i> <?php echo _l('delete'); ?>
                                        </a>
                                        <div class="clearfix"></div>
                                        <p class="mtop10 text-muted"><?php echo $knowledge->attachment; ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <div class="form-group">
                                    <label for="attachment" class="control-label"><?php echo _l('knowledge_attachment'); ?></label>
                                    <input type="file" name="attachment" class="form-control">
                                    <p class="text-muted mtop10"><?php echo _l('knowledge_attachment_note'); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category_id" class="control-label"><?php echo _l('knowledge_category'); ?></label>
                                    <select name="category_id" id="category_id" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                        <option value=""><?php echo _l('knowledge_none'); ?></option>
                                        <?php foreach ($categories as $category) { ?>
                                        <option value="<?php echo $category['id']; ?>" <?php if (isset($knowledge) && $knowledge->category_id == $category['id']) { echo 'selected'; } ?>><?php echo $category['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="visibility" class="control-label"><?php echo _l('knowledge_article_visibility'); ?></label>
                                    <select name="visibility" id="visibility" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                        <option value="all" <?php if (isset($knowledge) && $knowledge->visibility == 'all') { echo 'selected'; } ?>><?php echo _l('knowledge_article_visibility_all'); ?></option>
                                        <option value="departments" <?php if (isset($knowledge) && $knowledge->visibility == 'departments') { echo 'selected'; } ?>><?php echo _l('knowledge_article_visibility_departments'); ?></option>
                                        <option value="staff" <?php if (isset($knowledge) && $knowledge->visibility == 'staff') { echo 'selected'; } ?>><?php echo _l('knowledge_article_visibility_staff'); ?></option>
                                    </select>
                                </div>
                                
                                <div class="department-visibility" style="display: <?php echo (isset($knowledge) && $knowledge->visibility == 'departments') ? 'block' : 'none'; ?>">
                                    <div class="form-group">
                                        <label for="departments" class="control-label"><?php echo _l('departments'); ?></label>
                                        <select name="departments[]" id="departments" class="selectpicker" multiple data-width="100%" data-live-search="true" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                            <?php foreach ($departments as $department) { ?>
                                            <option value="<?php echo $department['departmentid']; ?>" <?php if (isset($knowledge) && $knowledge->visibility == 'departments' && !empty($knowledge->departments) && in_array($department['departmentid'], unserialize($knowledge->departments))) { echo 'selected'; } ?>><?php echo $department['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="staff-visibility" style="display: <?php echo (isset($knowledge) && $knowledge->visibility == 'staff') ? 'block' : 'none'; ?>">
                                    <div class="form-group">
                                        <label for="staff" class="control-label"><?php echo _l('staff_members'); ?></label>
                                        <select name="staff[]" id="staff" class="selectpicker" multiple data-width="100%" data-live-search="true" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                            <?php foreach ($staff_members as $staff) { ?>
                                            <option value="<?php echo $staff['staffid']; ?>" <?php if (isset($knowledge) && $knowledge->visibility == 'staff' && !empty($knowledge->staff) && in_array($staff['staffid'], unserialize($knowledge->staff))) { echo 'selected'; } ?>><?php echo $staff['firstname'] . ' ' . $staff['lastname']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="hr-panel-heading" />
                                <button type="submit" class="btn btn-primary pull-right"><?php echo _l('submit'); ?></button>
                                <a href="<?php echo admin_url('my_team/knowledge'); ?>" class="btn btn-default pull-right mright5"><?php echo _l('cancel'); ?></a>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
$(function() {
    // Load custom CSS
    var customCSS = document.createElement('link');
    customCSS.rel = 'stylesheet';
    customCSS.type = 'text/css';
    customCSS.href = site_url + 'application/views/admin/my_team/assets/css/my_team.css';
    document.head.appendChild(customCSS);
    
    // Load custom JS
    $.getScript(site_url + 'application/views/admin/my_team/assets/js/my_team.js');
    
    // Initialize TinyMCE
    if (typeof(tinymce) !== 'undefined') {
        init_editor('.tinymce-knowledge');
    }
    
    // Visibility changes
    $('#visibility').on('change', function() {
        var value = $(this).val();
        if (value == 'departments') {
            $('.department-visibility').show();
            $('.staff-visibility').hide();
        } else if (value == 'staff') {
            $('.department-visibility').hide();
            $('.staff-visibility').show();
        } else {
            $('.department-visibility, .staff-visibility').hide();
        }
    });
    
    // Form validation
    appValidateForm($('#knowledge-form'), {
        subject: 'required',
        description: 'required'
    });
});
</script> 