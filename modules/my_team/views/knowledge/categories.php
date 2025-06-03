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
                                <h4 class="no-margin"><?php echo _l('knowledge_categories'); ?></h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <?php if (staff_can('create', 'my_team')) { ?>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#category-modal">
                                    <i class="fa fa-plus"></i> <?php echo _l('new_category'); ?>
                                </button>
                                <?php } ?>
                                <a href="<?php echo admin_url('my_team/knowledge'); ?>" class="btn btn-default">
                                    <i class="fa fa-list"></i> <?php echo _l('back_to_knowledge'); ?>
                                </a>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Categories List -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (count($categories) > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table dt-table" data-order-col="0" data-order-type="asc">
                                        <thead>
                                            <tr>
                                                <th><?php echo _l('id'); ?></th>
                                                <th><?php echo _l('knowledge_category_name'); ?></th>
                                                <th><?php echo _l('general_description'); ?></th>
                                                <th><?php echo _l('general_color'); ?></th>
                                                <th><?php echo _l('general_items_count'); ?></th>
                                                <th><?php echo _l('general_created_at'); ?></th>
                                                <th><?php echo _l('general_actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($categories as $category) { ?>
                                            <tr>
                                                <td><?php echo $category['id']; ?></td>
                                                <td><?php echo $category['name']; ?></td>
                                                <td><?php echo $category['description'] ? $category['description'] : '-'; ?></td>
                                                <td>
                                                    <?php if ($category['color']) { ?>
                                                    <span class="label" style="background-color: <?php echo $category['color']; ?>"><?php echo $category['color']; ?></span>
                                                    <?php } else { ?>
                                                    -
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo isset($category['items_count']) ? $category['items_count'] : 0; ?></td>
                                                <td><?php echo _dt($category['created_at']); ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <?php if (staff_can('edit', 'my_team')) { ?>
                                                        <button type="button" class="btn btn-default btn-icon" onclick="edit_category(<?php echo $category['id']; ?>)">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <?php } ?>
                                                        <?php if (staff_can('delete', 'my_team')) { ?>
                                                        <a href="<?php echo admin_url('my_team/delete_knowledge_category/' . $category['id']); ?>" class="btn btn-danger btn-icon _delete">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
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
                                    <?php echo _l('no_categories_found'); ?>
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

<!-- Category Modal -->
<div class="modal fade" id="category-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="category-modal-title"><?php echo _l('new_category'); ?></h4>
            </div>
            <?php echo form_open(admin_url('my_team/knowledge_category'), ['id' => 'category-form']); ?>
            <div class="modal-body">
                <input type="hidden" name="id" id="category-id">
                
                <div class="form-group">
                    <label for="name" class="control-label"><?php echo _l('knowledge_category_name'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="description" class="control-label"><?php echo _l('general_description'); ?></label>
                    <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="color" class="control-label"><?php echo _l('general_color'); ?></label>
                    <div class="input-group colorpicker-input">
                        <input type="text" id="color" name="color" class="form-control" value="#3c8dbc">
                        <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('general_close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('general_submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script>
$(function() {
    appValidateForm($('#category-form'), {
        name: 'required'
    });
    
    // Initialize colorpicker
    $('.colorpicker-input').colorpicker();
});

// Edit category
function edit_category(id) {
    $.ajax({
        url: admin_url + 'my_team/get_knowledge_category/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var category = response.data;
                
                $('#category-id').val(category.id);
                $('#name').val(category.name);
                $('#description').val(category.description);
                
                if (category.color) {
                    $('#color').val(category.color);
                    $('.colorpicker-input').colorpicker('setValue', category.color);
                } else {
                    $('#color').val('#3c8dbc');
                    $('.colorpicker-input').colorpicker('setValue', '#3c8dbc');
                }
                
                $('#category-modal-title').html('<?php echo _l('edit_category'); ?>');
                $('#category-modal').modal('show');
            } else {
                alert_float('danger', response.message || '<?php echo _l('error_loading_data'); ?>');
            }
        },
        error: function() {
            alert_float('danger', '<?php echo _l('error_loading_data'); ?>');
        }
    });
}

// Reset modal on close
$('#category-modal').on('hidden.bs.modal', function() {
    $('#category-form').find('input:not([type="hidden"]), textarea').val('');
    $('#category-id').val('');
    $('#category-modal-title').html('<?php echo _l('new_category'); ?>');
    $('#color').val('#3c8dbc');
    $('.colorpicker-input').colorpicker('setValue', '#3c8dbc');
});
</script> 