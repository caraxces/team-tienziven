<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="no-margin">
                                    <?php echo _l('approval_details'); ?>
                                    <?php
                                    $is_unread = false;
                                    if ($can_approve && isset($approval->read_by_approver) && $approval->read_by_approver == 0) {
                                        $is_unread = true;
                                    } elseif (!$can_approve && isset($approval->read_by_staff) && $approval->read_by_staff == 0) {
                                        $is_unread = true;
                                    }
                                    if ($is_unread) {
                                        echo '<span style="color:red;font-size:18px;margin-left:5px;vertical-align:middle;">●</span>';
                                    }
                                    ?>
                                </h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="<?php echo admin_url('my_team/approvals/' . $approval->type); ?>" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> <?php echo _l('back_to_approvals'); ?>
                                </a>
                                <?php if($can_approve && $approval->status == 1){ ?>
                                <div class="btn-group">
                                    <a href="<?php echo admin_url('my_team/change_approval_status/' . $approval->id . '/2'); ?>" class="btn btn-success">
                                        <i class="fa fa-check"></i> <?php echo _l('approve'); ?>
                                    </a>
                                    <a href="<?php echo admin_url('my_team/change_approval_status/' . $approval->id . '/3'); ?>" class="btn btn-danger">
                                        <i class="fa fa-times"></i> <?php echo _l('reject'); ?>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row mtop15">
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('subject'); ?></h5>
                                        <p><?php echo $approval->subject; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('status'); ?></h5>
                                        <?php
                                        $status_class = '';
                                        $status_text = '';
                                        
                                        switch($approval->status){
                                            case 1:
                                                $status_class = 'warning';
                                                $status_text = _l('pending');
                                                break;
                                            case 2:
                                                $status_class = 'success';
                                                $status_text = _l('approved');
                                                break;
                                            case 3:
                                                $status_class = 'danger';
                                                $status_text = _l('rejected');
                                                break;
                                        }
                                        ?>
                                        <span class="label label-<?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                                    </div>
                                </div>
                                
                                <div class="row mtop15">
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('requested_by'); ?></h5>
                                        <p><?php echo $approval->staff_name; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('approver'); ?></h5>
                                        <p><?php echo $approval->approver_name; ?></p>
                                    </div>
                                </div>
                                
                                <div class="row mtop15">
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('date_requested'); ?></h5>
                                        <p><?php echo _dt($approval->datecreated); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if($approval->status != 1){ ?>
                                        <h5 class="bold"><?php echo _l('date_processed'); ?></h5>
                                        <p><?php echo _dt($approval->date_approved); ?></p>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <?php if($approval->type == 'leave'){ ?>
                                <div class="row mtop15">
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('start_date'); ?></h5>
                                        <p><?php echo _d($approval->start_date); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('end_date'); ?></h5>
                                        <p><?php echo _d($approval->end_date); ?></p>
                                    </div>
                                </div>
                                <div class="row mtop15">
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('leave_type'); ?></h5>
                                        <p><?php echo _l($approval->leave_type); ?></p>
                                    </div>
                                </div>
                                <?php } elseif($approval->type == 'attendance'){ ?>
                                <div class="row mtop15">
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('date'); ?></h5>
                                        <p><?php echo _d($approval->date); ?></p>
                                    </div>
                                </div>
                                <div class="row mtop15">
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('start_time'); ?></h5>
                                        <p><?php echo $approval->start_time; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('end_time'); ?></h5>
                                        <p><?php echo $approval->end_time; ?></p>
                                    </div>
                                </div>
                                <?php } elseif($approval->type == 'payment_request'){ ?>
                                <div class="row mtop15">
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('date'); ?></h5>
                                        <p><?php echo _d($approval->date); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('amount'); ?></h5>
                                        <p><?php echo format_money($approval->amount, $base_currency->symbol); ?></p>
                                    </div>
                                </div>
                                <div class="row mtop15">
                                    <div class="col-md-6">
                                        <h5 class="bold"><?php echo _l('payment_method'); ?></h5>
                                        <p><?php echo $approval->payment_method_name; ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <div class="row mtop15">
                                    <div class="col-md-12">
                                        <h5 class="bold"><?php echo _l('description'); ?></h5>
                                        <div class="panel-body">
                                            <?php echo $approval->description ? $approval->description : '<p class="text-muted">' . _l('no_description_provided') . '</p>'; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php if (!empty($approval->data)) { ?>
                                <div class="row mtop15">
                                    <div class="col-md-12">
                                        <h5 class="bold">Thông tin chi tiết</h5>
                                        <ul class="list-group">
                                            <?php foreach ($approval->data as $key => $value) { ?>
                                                <li class="list-group-item">
                                                    <strong><?php echo htmlspecialchars($key); ?>:</strong> <?php echo htmlspecialchars($value); ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <?php if (!empty($approval->attachments)) { ?>
                                <div class="row mtop15">
                                    <div class="col-md-12">
                                        <h5 class="bold">File đính kèm</h5>
                                        <div class="attachments">
                                            <?php foreach ($approval->attachments as $attachment) { ?>
                                                <div class="attachment">
                                                    <a href="<?php echo site_url('uploads/approvals/' . $approval->id . '/' . $attachment['file_name']); ?>" download>
                                                        <i class="fa fa-paperclip"></i> <?php echo $attachment['file_name']; ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
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
</body>
</html> 