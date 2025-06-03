<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="_buttons">
                            <a href="<?php echo admin_url('my_team/approval'); ?>" class="btn btn-primary pull-left display-block">
                                <i class="fa fa-plus"></i> <?php echo _l('approval_add'); ?>
                            </a>
                            <?php if (staff_can('view', 'my_team')) { ?>
                            <a href="<?php echo admin_url('my_team/report'); ?>" class="btn btn-info pull-left display-block mright5">
                                <i class="fa fa-area-chart"></i> <?php echo _l('approval_report'); ?>
                            </a>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Stats Widget -->
                        <div class="row text-center">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box" style="min-height: 60px;">
                                    <span class="info-box-icon bg-yellow" style="height: 60px; line-height: 60px; width: 60px; font-size: 24px;">
                                        <i class="fa fa-hourglass-half"></i>
                                    </span>
                                    <div class="info-box-content" style="margin-left: 60px; padding-top: 5px;">
                                        <span class="info-box-text"><?php echo _l('approval_status_pending'); ?></span>
                                        <span class="info-box-number"><?php echo $total_pending; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box" style="min-height: 60px;">
                                    <span class="info-box-icon bg-green" style="height: 60px; line-height: 60px; width: 60px; font-size: 24px;">
                                        <i class="fa fa-check-circle"></i>
                                    </span>
                                    <div class="info-box-content" style="margin-left: 60px; padding-top: 5px;">
                                        <span class="info-box-text"><?php echo _l('approval_status_approved'); ?></span>
                                        <span class="info-box-number"><?php echo $total_approved; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box" style="min-height: 60px;">
                                    <span class="info-box-icon bg-red" style="height: 60px; line-height: 60px; width: 60px; font-size: 24px;">
                                        <i class="fa fa-times-circle"></i>
                                    </span>
                                    <div class="info-box-content" style="margin-left: 60px; padding-top: 5px;">
                                        <span class="info-box-text"><?php echo _l('approval_status_rejected'); ?></span>
                                        <span class="info-box-number"><?php echo $total_rejected; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box" style="min-height: 60px;">
                                    <span class="info-box-icon bg-gray" style="height: 60px; line-height: 60px; width: 60px; font-size: 24px;">
                                        <i class="fa fa-ban"></i>
                                    </span>
                                    <div class="info-box-content" style="margin-left: 60px; padding-top: 5px;">
                                        <span class="info-box-text"><?php echo _l('approval_status_cancelled'); ?></span>
                                        <span class="info-box-number"><?php echo $total_cancelled; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="hr-panel-heading" />
                        
                        <!-- Filter -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <?php echo form_open(admin_url('my_team/approvals'), ['method' => 'get', 'id' => 'filter-form']); ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="approval_type"><?php echo _l('approval_type'); ?></label>
                                                    <select name="approval_type" id="approval_type" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                        <option value=""><?php echo _l('dropdown_non_selected_tex'); ?></option>
                                                        <option value="general"><?php echo _l('approval_type_general'); ?></option>
                                                        <option value="leave"><?php echo _l('approval_type_leave'); ?></option>
                                                        <option value="financial"><?php echo _l('approval_type_financial'); ?></option>
                                                        <option value="attendance"><?php echo _l('approval_type_attendance'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="status"><?php echo _l('approval_status'); ?></label>
                                                    <select name="status" id="status" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                        <option value=""><?php echo _l('dropdown_non_selected_tex'); ?></option>
                                                        <option value="0"><?php echo _l('approval_status_pending'); ?></option>
                                                        <option value="1"><?php echo _l('approval_status_approved'); ?></option>
                                                        <option value="2"><?php echo _l('approval_status_rejected'); ?></option>
                                                        <option value="3"><?php echo _l('approval_status_cancelled'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="department_id"><?php echo _l('department'); ?></label>
                                                    <select name="department_id" id="department_id" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                        <option value=""><?php echo _l('dropdown_non_selected_tex'); ?></option>
                                                        <?php if (!empty($departments)) { ?>
                                                            <?php foreach ($departments as $department) { ?>
                                                            <option value="<?php echo $department['departmentid']; ?>"><?php echo $department['name']; ?></option>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <option value="" disabled><?php echo _l('no_departments_available'); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="date_range"><?php echo _l('approval_date'); ?></label>
                                                    <div class="input-group date-range-picker">
                                                        <input type="text" name="date_range" id="date_range" class="form-control date-range-picker" autocomplete="off">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary"><?php echo _l('general_search'); ?></button>
                                                <a href="<?php echo admin_url('my_team/approvals'); ?>" class="btn btn-default"><?php echo _l('general_cancel'); ?></a>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Table -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (count($approvals) > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table dt-table" data-order-col="0" data-order-type="desc">
                                        <thead>
                                            <tr>
                                                <th><?php echo _l('id'); ?></th>
                                                <th><?php echo _l('general_subject'); ?></th>
                                                <th><?php echo _l('approval_type'); ?></th>
                                                <th><?php echo _l('general_department'); ?></th>
                                                <th><?php echo _l('approval_status'); ?></th>
                                                <th><?php echo _l('general_amount'); ?></th>
                                                <th><?php echo _l('approval_date'); ?></th>
                                                <th><?php echo _l('general_actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($approvals as $approval) { ?>
                                            <tr>
                                                <td><?php echo $approval['id']; ?></td>
                                                <td>
                                                    <a href="<?php echo admin_url('my_team/view_approval/' . $approval['id']); ?>"><?php echo $approval['subject']; ?></a>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $approval_type = _l('approval_type_' . $approval['approval_type']); 
                                                    $badge_class = 'badge-primary';
                                                    
                                                    switch ($approval['approval_type']) {
                                                        case 'leave':
                                                            $badge_class = 'badge-info';
                                                            break;
                                                        case 'financial':
                                                            $badge_class = 'badge-warning';
                                                            break;
                                                        case 'attendance':
                                                            $badge_class = 'badge-success';
                                                            break;
                                                        default:
                                                            $badge_class = 'badge-primary';
                                                            break;
                                                    }
                                                    ?>
                                                    <span class="badge <?php echo $badge_class; ?>"><?php echo $approval_type; ?></span>
                                                </td>
                                                <td>
                                                    <?php
                                                    $department_name = '';
                                                    foreach ($departments as $department) {
                                                        if ($department['departmentid'] == $approval['department_id']) {
                                                            $department_name = $department['name'];
                                                            break;
                                                        }
                                                    }
                                                    echo $department_name;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    switch ($approval['status']) {
                                                        case 0:
                                                            echo '<span class="label label-warning">' . _l('approval_status_pending') . '</span>';
                                                            break;
                                                        case 1:
                                                            echo '<span class="label label-success">' . _l('approval_status_approved') . '</span>';
                                                            break;
                                                        case 2:
                                                            echo '<span class="label label-danger">' . _l('approval_status_rejected') . '</span>';
                                                            break;
                                                        case 3:
                                                            echo '<span class="label label-default">' . _l('approval_status_cancelled') . '</span>';
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo number_format($approval['amount'], 0, ',', '.') . ' VND'; ?></td>
                                                <td><?php echo date('d/m/Y H:i', strtotime($approval['created_date'])); ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="<?php echo admin_url('my_team/view_approval/' . $approval['id']); ?>" class="btn btn-sm btn-default btn-icon"><i class="fa fa-eye"></i></a>
                                                        
                                                        <?php if ($approval['status'] == 0) { ?>
                                                            <?php if (staff_can('edit', 'my_team') && (is_admin() || get_staff_user_id() != $approval['staff_id'])) { ?>
                                                                <a href="<?php echo admin_url('my_team/approve/' . $approval['id']); ?>" class="btn btn-sm btn-success btn-icon" data-toggle="tooltip" title="<?php echo _l('approval_approve'); ?>"><i class="fa fa-check"></i></a>
                                                                <a href="#" onclick="rejectApproval(<?php echo $approval['id']; ?>); return false;" class="btn btn-sm btn-danger btn-icon" data-toggle="tooltip" title="<?php echo _l('approval_reject'); ?>"><i class="fa fa-times"></i></a>
                                                            <?php } ?>
                                                            
                                                            <?php if (get_staff_user_id() == $approval['staff_id'] || is_admin()) { ?>
                                                                <a href="<?php echo admin_url('my_team/approval/' . $approval['id']); ?>" class="btn btn-sm btn-default btn-icon" data-toggle="tooltip" title="<?php echo _l('general_edit'); ?>"><i class="fa fa-pencil-square-o"></i></a>
                                                                <a href="<?php echo admin_url('my_team/cancel/' . $approval['id']); ?>" class="btn btn-sm btn-default btn-icon" data-toggle="tooltip" title="<?php echo _l('approval_cancel'); ?>" onclick="return confirm('<?php echo _l('approval_cancel_confirm'); ?>');"><i class="fa fa-ban"></i></a>
                                                            <?php } ?>
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
                                    <?php echo _l('approval_no_approvals_found'); ?>
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
                <input type="hidden" name="id" id="approval-id" value="">
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
$(function() {
    // Date range picker
    $('input.date-range-picker').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            applyLabel: app.lang.apply,
            cancelLabel: app.lang.cancel,
            fromLabel: app.lang.from,
            toLabel: app.lang.to,
            customRangeLabel: app.lang.custom,
            daysOfWeek: [app.lang.Sunday_short, app.lang.Monday_short, app.lang.Tuesday_short, app.lang.Wednesday_short, app.lang.Thursday_short, app.lang.Friday_short, app.lang.Saturday_short],
            monthNames: [app.lang.January, app.lang.February, app.lang.March, app.lang.April, app.lang.May, app.lang.June, app.lang.July, app.lang.August, app.lang.September, app.lang.October, app.lang.November, app.lang.December],
            firstDay: app.options.calendar_first_day
        }
    });
    
    $('input.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });
    
    $('input.date-range-picker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    
    // Initialize filter values from URL
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('approval_type')) {
        $('#approval_type').val(urlParams.get('approval_type')).selectpicker('refresh');
    }
    if (urlParams.has('status')) {
        $('#status').val(urlParams.get('status')).selectpicker('refresh');
    }
    if (urlParams.has('department_id')) {
        $('#department_id').val(urlParams.get('department_id')).selectpicker('refresh');
    }
    if (urlParams.has('date_from') && urlParams.has('date_to')) {
        var dateFrom = moment(urlParams.get('date_from'), 'YYYY-MM-DD').format('DD/MM/YYYY');
        var dateTo = moment(urlParams.get('date_to'), 'YYYY-MM-DD').format('DD/MM/YYYY');
        $('#date_range').val(dateFrom + ' - ' + dateTo);
    }
});

function rejectApproval(id) {
    // Set approval ID to modal
    $('#approval-id').val(id);
    // Show modal
    $('#reject-modal').modal('show');
}
</script> 