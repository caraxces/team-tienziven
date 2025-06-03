<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('approval_view'); ?> #<?php echo $approval->id; ?></h4>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Status Banner -->
                        <?php
                        $status_class = '';
                        $status_text = '';
                        
                        switch ($approval->status) {
                            case 0:
                                $status_class = 'alert-warning';
                                $status_text = _l('approval_status_pending');
                                break;
                            case 1:
                                $status_class = 'alert-success';
                                $status_text = _l('approval_status_approved');
                                break;
                            case 2:
                                $status_class = 'alert-danger';
                                $status_text = _l('approval_status_rejected');
                                break;
                            case 3:
                                $status_class = 'alert-default';
                                $status_text = _l('approval_status_cancelled');
                                break;
                        }
                        ?>
                        
                        <div class="alert <?php echo $status_class; ?>">
                            <div class="row">
                                <div class="col-md-8">
                                    <strong><?php echo _l('approval_status'); ?>: <?php echo $status_text; ?></strong>
                                </div>
                                <div class="col-md-4 text-right">
                                    <?php if ($approval->status == 0 && (is_admin() || get_staff_user_id() != $approval->staff_id)) { ?>
                                        <a href="<?php echo admin_url('my_team/approve/' . $approval->id); ?>" class="btn btn-success btn-sm" onclick="return confirm('<?php echo _l('approval_approve_confirm'); ?>');"><?php echo _l('approval_approve'); ?></a>
                                        <a href="#" class="btn btn-danger btn-sm" onclick="rejectApproval(); return false;"><?php echo _l('approval_reject'); ?></a>
                                    <?php } ?>
                                    
                                    <?php if ($approval->status == 0 && (get_staff_user_id() == $approval->staff_id || is_admin())) { ?>
                                        <a href="<?php echo admin_url('my_team/approval/' . $approval->id); ?>" class="btn btn-default btn-sm"><?php echo _l('general_edit'); ?></a>
                                        <a href="<?php echo admin_url('my_team/cancel/' . $approval->id); ?>" class="btn btn-default btn-sm" onclick="return confirm('<?php echo _l('approval_cancel_confirm'); ?>');"><?php echo _l('approval_cancel'); ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Details -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Base Information -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><?php echo _l('general_information'); ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="bold"><?php echo _l('id'); ?></td>
                                                    <td><?php echo $approval->id; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bold"><?php echo _l('general_subject'); ?></td>
                                                    <td><?php echo $approval->subject; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bold"><?php echo _l('approval_type'); ?></td>
                                                    <td><?php echo _l('approval_type_' . $approval->approval_type); ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="bold"><?php echo _l('general_department'); ?></td>
                                                    <td>
                                                        <?php 
                                                        $department_name = '';
                                                        if (isset($department)) {
                                                            $department_name = $department->name;
                                                        }
                                                        echo $department_name;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bold"><?php echo _l('general_staff'); ?></td>
                                                    <td>
                                                        <?php 
                                                        $staff_name = '';
                                                        if (isset($staff)) {
                                                            $staff_name = $staff->firstname . ' ' . $staff->lastname;
                                                        }
                                                        echo $staff_name;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bold"><?php echo _l('general_amount'); ?></td>
                                                    <td><?php echo app_format_money($approval->amount, $base_currency); ?></td>
                                                </tr>
                                                <?php if ($approval->date_from) { ?>
                                                <tr>
                                                    <td class="bold"><?php echo _l('approval_date_from'); ?></td>
                                                    <td><?php echo _d($approval->date_from); ?></td>
                                                </tr>
                                                <?php } ?>
                                                <?php if ($approval->date_to) { ?>
                                                <tr>
                                                    <td class="bold"><?php echo _l('approval_date_to'); ?></td>
                                                    <td><?php echo _d($approval->date_to); ?></td>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td class="bold"><?php echo _l('approval_created_date'); ?></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($approval->created_date)); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <!-- Attachment -->
                                <?php if ($approval->attachment) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><?php echo _l('general_attachment'); ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="clearfix">
                                            <a href="<?php echo site_url('admin/my_team/download_attachment/' . $approval->id); ?>" class="btn btn-info">
                                                <i class="fa fa-download"></i> <?php echo _l('approval_download_attachment'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            
                            <div class="col-md-6">
                                <!-- Dynamic Information -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><?php echo _l('details'); ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <?php if ($approval->approval_type == 'leave' && !empty($json_data)) { ?>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('leave_type'); ?></td>
                                                        <td><?php echo isset($json_data['leave_type']) ? _l('leave_type_' . $json_data['leave_type']) : _l('leave_type_annual'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('leave_days'); ?></td>
                                                        <td><?php echo isset($json_data['total_days']) ? $json_data['total_days'] : (isset($json_data['days']) ? $json_data['days'] : '0'); ?> <?php echo _l('days'); ?></td>
                                                    </tr>
                                                <?php } elseif ($approval->approval_type == 'financial' && !empty($json_data)) { ?>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('general_type'); ?></td>
                                                        <td><?php echo isset($json_data['type']) ? _l($json_data['type']) : (isset($json_data['expense_type']) ? $json_data['expense_type'] : _l('financial_general')); ?></td>
                                                    </tr>
                                                    <?php if (isset($json_data['category']) && !empty($json_data['category'])) { ?>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('financial_category'); ?></td>
                                                        <td><?php echo $json_data['category']; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <?php if (isset($json_data['purpose']) && !empty($json_data['purpose'])) { ?>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('financial_purpose'); ?></td>
                                                        <td><?php echo $json_data['purpose']; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                <?php } elseif ($approval->approval_type == 'attendance' && !empty($json_data)) { ?>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('attendance_date'); ?></td>
                                                        <td><?php echo _d($json_data['date']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('attendance_status'); ?></td>
                                                        <td><?php echo _l('attendance_status_' . $json_data['status']); ?></td>
                                                    </tr>
                                                    <?php if (isset($json_data['clock_in']) && !empty($json_data['clock_in'])) { ?>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('attendance_clock_in'); ?></td>
                                                        <td><?php echo $json_data['clock_in']; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <?php if (isset($json_data['clock_out']) && !empty($json_data['clock_out'])) { ?>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('attendance_clock_out'); ?></td>
                                                        <td><?php echo $json_data['clock_out']; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <?php if (isset($json_data['work_hours'])) { ?>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('attendance_work_hours'); ?></td>
                                                        <td><?php echo $json_data['work_hours']; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <?php if (isset($json_data['overtime_hours']) && $json_data['overtime_hours'] > 0) { ?>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('attendance_overtime_hours'); ?></td>
                                                        <td><?php echo $json_data['overtime_hours']; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <!-- Approval Information -->
                                <?php if ($approval->status != 0) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><?php echo _l('approval_information'); ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <?php if ($approval->status == 1) { ?>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('approval_approved_by'); ?></td>
                                                        <td>
                                                            <?php 
                                                            $approver_name = '';
                                                            if (isset($approver)) {
                                                                $approver_name = $approver->firstname . ' ' . $approver->lastname;
                                                            }
                                                            echo $approver_name;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('approval_approved_date'); ?></td>
                                                        <td><?php echo _dt($approval->approved_date); ?></td>
                                                    </tr>
                                                <?php } elseif ($approval->status == 2) { ?>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('approval_rejected_by'); ?></td>
                                                        <td>
                                                            <?php 
                                                            $rejecter_name = '';
                                                            if (isset($rejecter)) {
                                                                $rejecter_name = $rejecter->firstname . ' ' . $rejecter->lastname;
                                                            }
                                                            echo $rejecter_name;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('approval_rejected_date'); ?></td>
                                                        <td><?php echo _dt($approval->rejected_date); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bold"><?php echo _l('approval_rejected_reason'); ?></td>
                                                        <td><?php echo $approval->rejected_reason; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><?php echo _l('general_description'); ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tc-content">
                                            <?php echo $approval->description ? $approval->description : '<p class="text-muted">' . _l('no_description_provided') . '</p>'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="hr-panel-heading" />
                                <a href="<?php echo admin_url('my_team/approvals'); ?>" class="btn btn-default pull-left"><?php echo _l('general_back'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="reject-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo form_open(admin_url('my_team/reject')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo _l('approval_reject'); ?></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="<?php echo $approval->id; ?>">
                <div class="form-group">
                    <label for="reason"><?php echo _l('approval_rejected_reason'); ?></label>
                    <textarea name="reason" id="reason" class="form-control" rows="5" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('general_close'); ?></button>
                <button type="submit" class="btn btn-danger"><?php echo _l('approval_reject'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script>
function rejectApproval() {
    $('#reject-modal').modal('show');
}
</script> 