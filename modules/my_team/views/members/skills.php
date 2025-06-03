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
                                <h4 class="no-margin">
                                    <?php echo _l('staff_skills_for'); ?>: <?php echo $member->firstname . ' ' . $member->lastname; ?>
                                </h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="<?php echo admin_url('my_team/view_member/' . $member->staffid); ?>" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> <?php echo _l('back_to_profile'); ?>
                                </a>
                                <?php if (staff_can('create', 'my_team') || is_admin() || $member->staffid == get_staff_user_id()) { ?>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#skill-modal">
                                    <i class="fa fa-plus"></i> <?php echo _l('add_skill'); ?>
                                </button>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Skills List -->
                        <div class="row mtop15">
                            <div class="col-md-12">
                                <?php if (count($skills) > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="30%"><?php echo _l('skill_name'); ?></th>
                                                <th><?php echo _l('skill_level'); ?></th>
                                                <th width="20%"><?php echo _l('general_created_at'); ?></th>
                                                <th width="15%"><?php echo _l('general_actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($skills as $skill) { ?>
                                            <tr>
                                                <td><?php echo $skill['skill_name']; ?></td>
                                                <td>
                                                    <div class="progress" style="margin-bottom: 0;">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $skill['skill_level'] * 20; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $skill['skill_level'] * 20; ?>%;">
                                                            <?php echo $skill['skill_level']; ?>/5
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo _dt($skill['created_at']); ?></td>
                                                <td>
                                                    <?php if (staff_can('edit', 'my_team') || is_admin() || $member->staffid == get_staff_user_id()) { ?>
                                                    <a href="#" class="btn btn-default btn-icon edit-skill" data-id="<?php echo $skill['id']; ?>" data-name="<?php echo $skill['skill_name']; ?>" data-level="<?php echo $skill['skill_level']; ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <?php } ?>
                                                    <?php if (staff_can('delete', 'my_team') || is_admin() || $member->staffid == get_staff_user_id()) { ?>
                                                    <a href="<?php echo admin_url('my_team/delete_skill/' . $skill['id'] . '/' . $member->staffid); ?>" class="btn btn-danger btn-icon _delete">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } else { ?>
                                <div class="alert alert-info">
                                    <?php echo _l('no_skills_found'); ?>
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

<!-- Modal Add/Edit Skill -->
<div class="modal fade" id="skill-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo _l('add_skill'); ?></h4>
            </div>
            <?php echo form_open(admin_url('my_team/save_skill/' . $member->staffid)); ?>
            <div class="modal-body">
                <?php echo form_hidden('id'); ?>
                <div class="form-group">
                    <label for="skill_name"><?php echo _l('skill_name'); ?></label>
                    <input type="text" class="form-control" id="skill_name" name="skill_name" required>
                </div>
                <div class="form-group">
                    <label for="skill_level"><?php echo _l('skill_level'); ?> (1-5)</label>
                    <select class="form-control" id="skill_level" name="skill_level" required>
                        <option value="1"><?php echo _l('skill_level_1'); ?></option>
                        <option value="2"><?php echo _l('skill_level_2'); ?></option>
                        <option value="3"><?php echo _l('skill_level_3'); ?></option>
                        <option value="4"><?php echo _l('skill_level_4'); ?></option>
                        <option value="5"><?php echo _l('skill_level_5'); ?></option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('general_close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('general_save'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script>
$(function() {
    // Edit skill
    $('.edit-skill').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var name = $(this).data('name');
        var level = $(this).data('level');
        
        // Populate modal
        $('#skill-modal .modal-title').text('<?php echo _l('edit_skill'); ?>');
        $('#skill-modal input[name="id"]').val(id);
        $('#skill-modal input[name="skill_name"]').val(name);
        $('#skill-modal select[name="skill_level"]').val(level);
        $('#skill-modal').modal('show');
    });
    
    // Reset modal on close
    $('#skill-modal').on('hidden.bs.modal', function() {
        $('#skill-modal .modal-title').text('<?php echo _l('add_skill'); ?>');
        $('#skill-modal form')[0].reset();
        $('#skill-modal input[name="id"]').val('');
    });
});
</script> 