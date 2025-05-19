<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('add_attitude_evaluation'); ?></h4>
                        <hr class="hr-panel-heading" />
                        <?php echo form_open(admin_url('my_team/add_attitude_evaluation/' . $staff_id)); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="staff_name"><?php echo _l('staff_member'); ?></label>
                                    <input type="text" class="form-control" id="staff_name" name="staff_name" value="<?php echo $staff_name; ?>" readonly>
                                    <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
                                    <input type="hidden" name="manager_id" value="<?php echo get_staff_user_id(); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="rating"><?php echo _l('attitude_rating'); ?></label>
                                    <select class="form-control selectpicker" name="rating" id="rating" data-width="100%">
                                        <option value="1">1 - <?php echo _l('attitude_poor'); ?></option>
                                        <option value="2">2 - <?php echo _l('attitude_below_average'); ?></option>
                                        <option value="3">3 - <?php echo _l('attitude_average'); ?></option>
                                        <option value="4">4 - <?php echo _l('attitude_good'); ?></option>
                                        <option value="5">5 - <?php echo _l('attitude_excellent'); ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="evaluation"><?php echo _l('attitude_evaluation'); ?></label>
                                    <textarea class="form-control" name="evaluation" id="evaluation" rows="10" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
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
    $('#evaluation').summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link']]
        ]
    });
});
</script>
</body>
</html> 