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
                                <h4 class="no-margin"><?php echo _l('team_knowledge'); ?></h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <?php if (staff_can('create', 'my_team')) { ?>
                                <a href="<?php echo admin_url('my_team/knowledge_item'); ?>" class="btn btn-info">
                                    <i class="fa fa-plus"></i> <?php echo _l('new_knowledge_item'); ?>
                                </a>
                                <?php if (is_admin()) { ?>
                                <a href="<?php echo admin_url('my_team/knowledge_categories'); ?>" class="btn btn-default">
                                    <i class="fa fa-list"></i> <?php echo _l('manage_categories'); ?>
                                </a>
                                <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Filters -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo form_open(admin_url('my_team/knowledge'), ['method' => 'get', 'id' => 'filter-form']); ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="category_id"><?php echo _l('knowledge_category'); ?></label>
                                            <select name="category_id" id="category_id" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                <option value=""><?php echo _l('dropdown_non_selected_tex'); ?></option>
                                                <?php foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category['id']; ?>" <?php if (isset($_GET['category_id']) && $_GET['category_id'] == $category['id']) { echo 'selected'; } ?>><?php echo $category['name']; ?></option>
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
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-info"><?php echo _l('general_search'); ?></button>
                                                <a href="<?php echo admin_url('my_team/knowledge'); ?>" class="btn btn-default"><?php echo _l('general_reset'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        
                        <!-- Knowledge List -->
                        <div class="row mtop15">
                            <div class="col-md-12">
                                <?php if (count($knowledge_items) > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table dt-table" data-order-col="0" data-order-type="desc">
                                        <thead>
                                            <tr>
                                                <th><?php echo _l('id'); ?></th>
                                                <th><?php echo _l('general_subject'); ?></th>
                                                <th><?php echo _l('knowledge_category'); ?></th>
                                                <th><?php echo _l('general_created_by'); ?></th>
                                                <th><?php echo _l('general_visibility'); ?></th>
                                                <th><?php echo _l('general_created_at'); ?></th>
                                                <th><?php echo _l('general_actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($knowledge_items as $item) { ?>
                                            <tr>
                                                <td><?php echo $item['id']; ?></td>
                                                <td>
                                                    <a href="<?php echo admin_url('my_team/view_knowledge/' . $item['id']); ?>"><?php echo $item['subject']; ?></a>
                                                    <?php if ($item['attachment']) { ?>
                                                    <i class="fa fa-paperclip pull-right" data-toggle="tooltip" title="<?php echo _l('attachment_included'); ?>"></i>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $item['category_name'] ? $item['category_name'] : '-'; ?></td>
                                                <td><?php echo $item['firstname'] . ' ' . $item['lastname']; ?></td>
                                                <td>
                                                    <?php if ($item['visibility'] == 'all') { ?>
                                                    <span class="label label-success"><?php echo _l('knowledge_visibility_all'); ?></span>
                                                    <?php } elseif ($item['visibility'] == 'departments') { ?>
                                                    <span class="label label-info"><?php echo _l('knowledge_visibility_departments'); ?></span>
                                                    <?php } else { ?>
                                                    <span class="label label-default"><?php echo _l('knowledge_visibility_private'); ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo _dt($item['created_at']); ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="<?php echo admin_url('my_team/view_knowledge/' . $item['id']); ?>" class="btn btn-default btn-icon"><i class="fa fa-eye"></i></a>
                                                        <?php if (staff_can('edit', 'my_team') && ($item['created_by'] == get_staff_user_id() || is_admin())) { ?>
                                                        <a href="<?php echo admin_url('my_team/knowledge_item/' . $item['id']); ?>" class="btn btn-default btn-icon"><i class="fa fa-pencil"></i></a>
                                                        <?php } ?>
                                                        <?php if (staff_can('delete', 'my_team') && ($item['created_by'] == get_staff_user_id() || is_admin())) { ?>
                                                        <a href="<?php echo admin_url('my_team/delete_knowledge/' . $item['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } else { ?>
                                <div class="alert alert-info">
                                    <?php echo _l('no_knowledge_items_found'); ?>
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
    // Auto-submit form when category changes
    $('#category_id').on('change', function() {
        $('#filter-form').submit();
    });
});
</script> 