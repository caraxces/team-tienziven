<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="no-margin"><?php echo _l('approval_details'); ?></h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="<?php echo admin_url('my_team/approvals/' . $approval->type); ?>" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> <?php echo _l('back_to_approvals'); ?>
                                </a>
                                <?php if ($approval->status == 1 && $can_approve) { ?>
                                <a href="<?php echo admin_url('my_team/change_approval_status/' . $approval->id . '/2'); ?>" class="btn btn-success approve-btn">
                                    <i class="fa fa-check"></i> <?php echo _l('approve'); ?>
                                </a>
                                <a href="<?php echo admin_url('my_team/change_approval_status/' . $approval->id . '/3'); ?>" class="btn btn-danger reject-btn">
                                    <i class="fa fa-times"></i> <?php echo _l('reject'); ?>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <div class="row">
                            <div class="col-md-8">
                                <h5><?php echo $approval->subject; ?></h5>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><?php echo _l('description'); ?></h5>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo $approval->description ? $approval->description : _l('no_description_provided'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><?php echo _l('approval_info'); ?></h5>
                                    </div>
                                    <div class="panel-body">
                                        <p><strong><?php echo _l('type'); ?>:</strong> 
                                            <?php 
                                            $type_text = '';
                                            switch ($approval->type) {
                                                case 'attendance':
                                                    $type_text = _l('attendance');
                                                    break;
                                                case 'leave':
                                                    $type_text = _l('leave_request');
                                                    break;
                                                case 'payment_request':
                                                    $type_text = _l('payment_request');
                                                    break;
                                                default:
                                                    $type_text = $approval->type;
                                                    break;
                                            }
                                            echo $type_text;
                                            ?>
                                        </p>
                                        <p><strong><?php echo _l('requester'); ?>:</strong> <?php echo $approval->staff_name; ?></p>
                                        <p><strong><?php echo _l('approver'); ?>:</strong> <?php echo $approval->approver_name; ?></p>
                                        <p><strong><?php echo _l('date'); ?>:</strong> <?php echo _d($approval->date); ?></p>
                                        <p><strong><?php echo _l('date_requested'); ?>:</strong> <?php echo _dt($approval->datecreated); ?></p>
                                        <?php if ($approval->status != 1) { ?>
                                        <p><strong><?php echo _l('date_approved'); ?>:</strong> <?php echo _dt($approval->date_approved); ?></p>
                                        <?php } ?>
                                        <p><strong><?php echo _l('status'); ?>:</strong> 
                                            <?php
                                            $status_badge = '';
                                            if ($approval->status == 1) {
                                                $status_badge = 'warning';
                                                $status_text = _l('pending');
                                            } elseif ($approval->status == 2) {
                                                $status_badge = 'success';
                                                $status_text = _l('approved');
                                            } else {
                                                $status_badge = 'danger';
                                                $status_text = _l('rejected');
                                            }
                                            ?>
                                            <span class="label label-<?php echo $status_badge; ?> approval-badge">
                                                <?php echo $status_text; ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
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
    // Confirmation for approval/rejection
    $('.approve-btn, .reject-btn').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        if(confirm(app.lang.confirm_action_prompt)) {
            window.location.href = url;
        }
    });
});
</script>
</body>
</html> 