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
                        
                        <?php echo form_open(admin_url('my_team/add_attitude_evaluation/' . $staff->staffid)); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <?php echo _l('evaluating_staff_member'); ?>: <strong><?php echo $staff->firstname . ' ' . $staff->lastname; ?></strong>
                                    <br>
                                    <?php echo _l('for_month'); ?>: <strong><?php echo date('F Y'); ?></strong>
                                </div>
                                
                                <div class="form-group">
                                    <label for="rating"><?php echo _l('rating'); ?> *</label>
                                    <div class="rating-container">
                                        <div class="star-rating">
                                            <?php for ($i = 5; $i >= 1; $i--) { ?>
                                                <input type="radio" name="rating" value="<?php echo $i; ?>" id="rating-<?php echo $i; ?>" <?php echo ($i == 5) ? 'checked' : ''; ?>>
                                                <label for="rating-<?php echo $i; ?>"><i class="fa fa-star"></i></label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="evaluation"><?php echo _l('evaluation'); ?> *</label>
                                    <?php echo render_textarea('evaluation', '', '', [], [], '', 'tinymce'); ?>
                                </div>
                                
                                <button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
                                <a href="<?php echo admin_url('my_team/view_member/' . $staff->staffid); ?>" class="btn btn-default pull-left"><?php echo _l('cancel'); ?></a>
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
    appValidateForm($('form'), {
        rating: 'required',
        evaluation: 'required'
    });
});
</script>
<style>
.rating-container {
    margin-bottom: 15px;
}
.star-rating {
    display: flex;
    flex-direction: row-reverse;
    font-size: 24px;
    justify-content: flex-end;
}
.star-rating input {
    display: none;
}
.star-rating label {
    cursor: pointer;
    color: #ccc;
    padding: 0 2px;
}
.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label {
    color: #f8c44c;
}
</style>
</body>
</html> 