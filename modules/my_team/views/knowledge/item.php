<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">
                            <?php echo isset($item) ? _l('edit_knowledge_item') : _l('add_knowledge_item'); ?>
                        </h4>
                        <hr class="hr-panel-heading" />
                        <?php echo form_open_multipart(admin_url('my_team/knowledge_item/' . (isset($item) ? $item->id : '')), ['id' => 'knowledge-form']); ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="subject" class="control-label"><?php echo _l('general_subject'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" id="subject" name="subject" class="form-control" value="<?php echo isset($item) ? $item->subject : ''; ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="content" class="control-label"><?php echo _l('general_content'); ?></label>
                                    <?php echo render_textarea('content', '', isset($item) ? $item->content : '', [], [], '', 'tinymce'); ?>
                                </div>
                                
                                <div class="form-group">
                                    <label for="attachment" class="control-label"><?php echo _l('general_attachment'); ?></label>
                                    <input type="file" id="attachment" name="attachment" class="form-control">
                                    <?php if (isset($item) && $item->attachment) { ?>
                                    <div class="mtop10">
                                        <i class="fa fa-paperclip"></i> 
                                        <a href="<?php echo admin_url('my_team/download_knowledge_attachment/' . $item->id); ?>">
                                            <?php echo _l('download_current_attachment'); ?>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category_id" class="control-label"><?php echo _l('knowledge_category'); ?></label>
                                    <select name="category_id" id="category_id" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                        <option value=""><?php echo _l('dropdown_non_selected_tex'); ?></option>
                                        <?php foreach ($categories as $category) { ?>
                                        <option value="<?php echo $category['id']; ?>" <?php if (isset($item) && $item->category_id == $category['id']) { echo 'selected'; } ?>><?php echo $category['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="visibility" class="control-label"><?php echo _l('general_visibility'); ?></label>
                                    <select name="visibility" id="visibility" class="selectpicker" data-width="100%">
                                        <option value="all" <?php if (isset($item) && $item->visibility == 'all') { echo 'selected'; } ?>><?php echo _l('knowledge_visibility_all'); ?></option>
                                        <option value="departments" <?php if (isset($item) && $item->visibility == 'departments') { echo 'selected'; } ?>><?php echo _l('knowledge_visibility_departments'); ?></option>
                                        <option value="private" <?php if (isset($item) && $item->visibility == 'private') { echo 'selected'; } ?>><?php echo _l('knowledge_visibility_private'); ?></option>
                                    </select>
                                </div>
                                
                                <div id="departments-select" class="<?php if (!isset($item) || $item->visibility != 'departments') { echo 'hide'; } ?>">
                                    <div class="form-group">
                                        <label for="visible_to_departments" class="control-label"><?php echo _l('visible_to_departments'); ?></label>
                                        <select name="visible_to_departments[]" id="visible_to_departments" class="selectpicker" data-width="100%" multiple data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                            <?php 
                                            $visible_departments = [];
                                            if (isset($item) && $item->visible_to_departments) {
                                                $visible_departments = json_decode($item->visible_to_departments, true);
                                            }
                                            
                                            foreach ($departments as $department) { 
                                            ?>
                                            <option value="<?php echo $department['departmentid']; ?>" <?php if (in_array($department['departmentid'], $visible_departments)) { echo 'selected'; } ?>><?php echo $department['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="allow_comments" class="control-label">
                                        <input type="checkbox" id="allow_comments" name="allow_comments" value="1" <?php if (!isset($item) || $item->allow_comments == 1) { echo 'checked'; } ?>>
                                        <?php echo _l('allow_comments'); ?>
                                    </label>
                                </div>
                                
                                <div class="form-group mtop15">
                                    <button type="submit" class="btn btn-info pull-right"><?php echo _l('general_submit'); ?></button>
                                    <a href="<?php echo admin_url('my_team/knowledge'); ?>" class="btn btn-default pull-left"><?php echo _l('general_cancel'); ?></a>
                                </div>
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
    appValidateForm($('#knowledge-form'), {
        subject: 'required'
    });
    
    // Toggle departments select based on visibility option
    $('#visibility').on('change', function() {
        if ($(this).val() === 'departments') {
            $('#departments-select').removeClass('hide');
        } else {
            $('#departments-select').addClass('hide');
        }
    });
    
    // Initialize tinymce
    if(typeof(tinymce) != 'undefined') {
        init_editor('#content', {height: 300});
    }
});
</script> 