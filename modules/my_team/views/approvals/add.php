<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading" />
                        
                        <?php echo form_open_multipart(admin_url('my_team/approval/' . (isset($approval) ? $approval->id : '')), ['id' => 'approval-form']); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject"><?php echo _l('general_subject'); ?></label>
                                    <input type="text" class="form-control" name="subject" id="subject" value="<?php echo (isset($approval) ? $approval->subject : ''); ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="approval_type"><?php echo _l('approval_type'); ?></label>
                                    <select name="approval_type" id="approval_type" class="selectpicker" data-width="100%" required>
                                        <option value="general" <?php if (isset($approval) && $approval->approval_type == 'general') { echo 'selected'; } ?>><?php echo _l('approval_type_general'); ?></option>
                                        <option value="leave" <?php if (isset($approval) && $approval->approval_type == 'leave') { echo 'selected'; } ?>><?php echo _l('approval_type_leave'); ?></option>
                                        <option value="financial" <?php if (isset($approval) && $approval->approval_type == 'financial') { echo 'selected'; } ?>><?php echo _l('approval_type_financial'); ?></option>
                                        <option value="attendance" <?php if (isset($approval) && $approval->approval_type == 'attendance') { echo 'selected'; } ?>><?php echo _l('approval_type_attendance'); ?></option>
                                    </select>
                                </div>
                                
                                <!-- <div class="form-group">
                                    <label for="department_id"><?php echo _l('general_department'); ?></label>
                                    <select name="department_id" id="department_id" class="selectpicker" data-width="100%" required>
                                        <?php foreach ($departments as $department) { ?>
                                        <option value="<?php echo $department['departmentid']; ?>" <?php if (isset($approval) && $approval->department_id == $department['departmentid']) { echo 'selected'; } ?>><?php echo $department['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div> -->
                                
                                <div class="form-group">
                                    <label for="amount"><?php echo _l('general_amount'); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><?php echo $base_currency->symbol; ?></span>
                                        <input type="number" class="form-control" name="amount" id="amount" value="<?php echo (isset($approval) ? $approval->amount : '0.00'); ?>" step="0.01">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="attachment"><?php echo _l('general_attachment'); ?></label>
                                    <input type="file" name="attachment" id="attachment" class="form-control">
                                    <?php if (isset($approval) && $approval->attachment) { ?>
                                    <div class="mtop5">
                                        <a href="<?php echo site_url('admin/my_team/download_attachment/' . $approval->id); ?>" class="text-info">
                                            <i class="fa fa-paperclip"></i> <?php echo _l('approval_download_attachment'); ?>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <!-- Dynamic fields based on approval type -->
                                <div id="leave-fields" class="approval-type-fields" style="display: none;">
                                    <div class="form-group">
                                        <label for="leave_type"><?php echo _l('leave_type'); ?></label>
                                        <select name="leave_type" id="leave_type" class="selectpicker" data-width="100%">
                                            <?php foreach ($leave_types as $type) { ?>
                                            <option value="<?php echo $type; ?>" <?php if (isset($json_data) && isset($json_data['leave_type']) && $json_data['leave_type'] == $type) { echo 'selected'; } ?>><?php echo _l('leave_type_' . $type); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="days"><?php echo _l('leave_days'); ?></label>
                                        <input type="number" class="form-control" name="days" id="days" value="<?php echo (isset($json_data) && isset($json_data['days']) ? $json_data['days'] : '1'); ?>" min="0.5" step="0.5">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="leave_date_range"><?php echo _l('general_date'); ?></label>
                                        <div class="input-group date-range-picker">
                                            <input type="text" name="leave_date_range" id="leave_date_range" class="form-control date-range-picker" autocomplete="off" value="<?php echo (isset($approval) && $approval->date_from && $approval->date_to ? _d($approval->date_from) . ' - ' . _d($approval->date_to) : ''); ?>">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="financial-fields" class="approval-type-fields" style="display: none;">
                                    <div class="form-group">
                                        <label for="financial_type"><?php echo _l('general_type'); ?></label>
                                        <select name="financial_type" id="financial_type" class="selectpicker" data-width="100%">
                                            <option value="expense" <?php if (isset($json_data) && isset($json_data['type']) && $json_data['type'] == 'expense') { echo 'selected'; } ?>><?php echo _l('expenses'); ?></option>
                                            <option value="reimbursement" <?php if (isset($json_data) && isset($json_data['type']) && $json_data['type'] == 'reimbursement') { echo 'selected'; } ?>><?php echo _l('reimbursement'); ?></option>
                                            <option value="advance" <?php if (isset($json_data) && isset($json_data['type']) && $json_data['type'] == 'advance') { echo 'selected'; } ?>><?php echo _l('advance'); ?></option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="category"><?php echo _l('financial_category'); ?></label>
                                        <input type="text" class="form-control" name="category" id="category" value="<?php echo (isset($json_data) && isset($json_data['category']) ? $json_data['category'] : ''); ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="financial_date"><?php echo _l('general_date'); ?></label>
                                        <div class="input-group date">
                                            <input type="text" name="financial_date" id="financial_date" class="form-control datepicker" autocomplete="off" value="<?php echo (isset($approval) && $approval->date_from ? _d($approval->date_from) : _d(date('Y-m-d'))); ?>">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="attendance-fields" class="approval-type-fields" style="display: none;">
                                    <div class="form-group">
                                        <label for="attendance_date"><?php echo _l('attendance_date'); ?></label>
                                        <div class="input-group date">
                                            <input type="text" name="date" id="attendance_date" class="form-control datepicker" autocomplete="off" value="<?php echo (isset($json_data) && isset($json_data['date']) ? _d($json_data['date']) : _d(date('Y-m-d'))); ?>">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="attendance_status"><?php echo _l('attendance_status'); ?></label>
                                        <select name="attendance_status" id="attendance_status" class="selectpicker" data-width="100%">
                                            <option value="present" <?php if (isset($json_data) && isset($json_data['status']) && $json_data['status'] == 'present') { echo 'selected'; } ?>><?php echo _l('attendance_status_present'); ?></option>
                                            <option value="absent" <?php if (isset($json_data) && isset($json_data['status']) && $json_data['status'] == 'absent') { echo 'selected'; } ?>><?php echo _l('attendance_status_absent'); ?></option>
                                            <option value="late" <?php if (isset($json_data) && isset($json_data['status']) && $json_data['status'] == 'late') { echo 'selected'; } ?>><?php echo _l('attendance_status_late'); ?></option>
                                            <option value="half_day" <?php if (isset($json_data) && isset($json_data['status']) && $json_data['status'] == 'half_day') { echo 'selected'; } ?>><?php echo _l('attendance_status_half_day'); ?></option>
                                        </select>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="clock_in"><?php echo _l('attendance_clock_in'); ?></label>
                                                <input type="text" class="form-control timepicker" name="clock_in" id="clock_in" value="<?php echo (isset($json_data) && isset($json_data['clock_in']) ? $json_data['clock_in'] : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="clock_out"><?php echo _l('attendance_clock_out'); ?></label>
                                                <input type="text" class="form-control timepicker" name="clock_out" id="clock_out" value="<?php echo (isset($json_data) && isset($json_data['clock_out']) ? $json_data['clock_out'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="work_hours"><?php echo _l('attendance_work_hours'); ?></label>
                                                <input type="number" class="form-control" name="work_hours" id="work_hours" value="<?php echo (isset($json_data) && isset($json_data['work_hours']) ? $json_data['work_hours'] : '8'); ?>" step="0.5" min="0">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="overtime_hours"><?php echo _l('attendance_overtime_hours'); ?></label>
                                                <input type="number" class="form-control" name="overtime_hours" id="overtime_hours" value="<?php echo (isset($json_data) && isset($json_data['overtime_hours']) ? $json_data['overtime_hours'] : '0'); ?>" step="0.5" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="description"><?php echo _l('general_description'); ?></label>
                                    <textarea name="description" id="description" class="form-control" rows="8"><?php echo (isset($approval) ? $approval->description : ''); ?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="hr-panel-heading" />
                                <button type="submit" class="btn btn-primary pull-right"><?php echo _l('general_submit'); ?></button>
                                <a href="<?php echo admin_url('my_team/approvals'); ?>" class="btn btn-default pull-right mright5"><?php echo _l('general_back'); ?></a>
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
    // Initialize date pickers
    init_datepicker();
    
    // Initialize time pickers
    $('.timepicker').datetimepicker({
        datepicker: false,
        format: 'H:i',
        step: 15
    });
    
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
        
        // Set hidden fields for date range
        if ($(this).attr('id') === 'leave_date_range') {
            $('input[name="date_from"]').val(picker.startDate.format('YYYY-MM-DD'));
            $('input[name="date_to"]').val(picker.endDate.format('YYYY-MM-DD'));
            
            // Calculate days
            var start = picker.startDate;
            var end = picker.endDate;
            var days = 0;
            
            while (start <= end) {
                // Skip weekends if needed
                if (start.day() !== 0 && start.day() !== 6) {
                    days++;
                }
                start = start.clone().add(1, 'd');
            }
            
            $('#days').val(days);
        }
    });
    
    $('input.date-range-picker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    
    // Show/hide fields based on approval type
    function toggleApprovalTypeFields() {
        var selectedType = $('#approval_type').val();
        $('.approval-type-fields').hide();
        
        switch (selectedType) {
            case 'leave':
                $('#leave-fields').show();
                break;
            case 'financial':
                $('#financial-fields').show();
                break;
            case 'attendance':
                $('#attendance-fields').show();
                break;
        }
    }
    
    // Initial toggle
    toggleApprovalTypeFields();
    
    // On change approval type
    $('#approval_type').on('change', function() {
        toggleApprovalTypeFields();
    });
    
    // Calculate work hours when clock in/out changes
    function calculateWorkHours() {
        var clockIn = $('#clock_in').val();
        var clockOut = $('#clock_out').val();
        
        if (clockIn && clockOut) {
            // Parse times
            var inParts = clockIn.split(':');
            var outParts = clockOut.split(':');
            
            var inHour = parseInt(inParts[0]);
            var inMinute = parseInt(inParts[1]);
            var outHour = parseInt(outParts[0]);
            var outMinute = parseInt(outParts[1]);
            
            // Calculate hours
            var hours = outHour - inHour;
            var minutes = outMinute - inMinute;
            
            if (minutes < 0) {
                hours--;
                minutes += 60;
            }
            
            var totalHours = hours + (minutes / 60);
            
            // Update work hours
            $('#work_hours').val(totalHours.toFixed(1));
        }
    }
    
    $('#clock_in, #clock_out').on('change', function() {
        calculateWorkHours();
    });
    
    // Form validation
    $('#approval-form').on('submit', function(e) {
        var selectedType = $('#approval_type').val();
        
        // Validate based on approval type
        if (selectedType === 'leave') {
            if (!$('#leave_type').val()) {
                alert(app.lang.leave_type + ' ' + app.lang.is_required);
                e.preventDefault();
                return false;
            }
            
            if (!$('#days').val() || $('#days').val() <= 0) {
                alert(app.lang.leave_days + ' ' + app.lang.is_required);
                e.preventDefault();
                return false;
            }
            
            if (!$('#leave_date_range').val()) {
                alert(app.lang.general_date + ' ' + app.lang.is_required);
                e.preventDefault();
                return false;
            }
        } else if (selectedType === 'financial') {
            if (!$('#amount').val() || $('#amount').val() <= 0) {
                alert(app.lang.general_amount + ' ' + app.lang.is_required);
                e.preventDefault();
                return false;
            }
            
            if (!$('#financial_date').val()) {
                alert(app.lang.general_date + ' ' + app.lang.is_required);
                e.preventDefault();
                return false;
            }
        } else if (selectedType === 'attendance') {
            if (!$('#attendance_date').val()) {
                alert(app.lang.attendance_date + ' ' + app.lang.is_required);
                e.preventDefault();
                return false;
            }
        }
        
        return true;
    });
});
</script> 