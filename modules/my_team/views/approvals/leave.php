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
                                    <i class="fa fa-calendar-times-o text-primary"></i> 
                                    <?php echo $title; ?>
                                </h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="<?php echo admin_url('my_team/approval'); ?>" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> <?php echo _l('change_approval_type'); ?>
                                </a>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <?php echo form_open_multipart(admin_url('my_team/approval_leave/' . (isset($approval) ? $approval->id : '')), ['id' => 'leave-approval-form']); ?>
                        <input type="hidden" name="approval_type" value="leave">
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-info-circle"></i> <?php echo _l('leave_approval_information'); ?>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <!-- Chủ đề -->
                                        <div class="form-group">
                                            <label for="subject" class="required">
                                                <i class="fa fa-tag"></i> <?php echo _l('leave_subject'); ?>
                                            </label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   name="subject" 
                                                   id="subject" 
                                                   value="<?php echo (isset($approval) ? $approval->subject : ''); ?>" 
                                                   placeholder="<?php echo _l('leave_subject_placeholder'); ?>"
                                                   required>
                                            <small class="text-muted"><?php echo _l('leave_subject_help'); ?></small>
                                        </div>
                                        
                                        <!-- Loại Out of Office -->
                                        <div class="form-group">
                                            <label for="leave_type" class="required">
                                                <i class="fa fa-list"></i> <?php echo _l('leave_type_selection'); ?>
                                            </label>
                                            <select name="leave_type" id="leave_type" class="selectpicker" data-width="100%" required>
                                                <option value=""><?php echo _l('select_leave_type'); ?></option>
                                                <option value="annual_leave" <?php if (isset($json_data) && isset($json_data['leave_type']) && $json_data['leave_type'] == 'annual_leave') { echo 'selected'; } ?>>
                                                    <?php echo _l('leave_type_annual'); ?>
                                                </option>
                                                <option value="compensatory_leave" <?php if (isset($json_data) && isset($json_data['leave_type']) && $json_data['leave_type'] == 'compensatory_leave') { echo 'selected'; } ?>>
                                                    <?php echo _l('leave_type_compensatory'); ?>
                                                </option>
                                                <option value="remote_work" <?php if (isset($json_data) && isset($json_data['leave_type']) && $json_data['leave_type'] == 'remote_work') { echo 'selected'; } ?>>
                                                    <?php echo _l('leave_type_remote_work'); ?>
                                                </option>
                                                <option value="sick_leave" <?php if (isset($json_data) && isset($json_data['leave_type']) && $json_data['leave_type'] == 'sick_leave') { echo 'selected'; } ?>>
                                                    <?php echo _l('leave_type_sick'); ?>
                                                </option>
                                                <option value="personal_leave" <?php if (isset($json_data) && isset($json_data['leave_type']) && $json_data['leave_type'] == 'personal_leave') { echo 'selected'; } ?>>
                                                    <?php echo _l('leave_type_personal'); ?>
                                                </option>
                                                <option value="other" <?php if (isset($json_data) && isset($json_data['leave_type']) && $json_data['leave_type'] == 'other') { echo 'selected'; } ?>>
                                                    <?php echo _l('leave_type_other'); ?>
                                                </option>
                                            </select>
                                            <small class="text-muted"><?php echo _l('leave_type_help'); ?></small>
                                        </div>
                                        
                                        <!-- Thời gian nghỉ -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="start_date" class="required">
                                                        <i class="fa fa-calendar"></i> <?php echo _l('leave_start_date'); ?>
                                                    </label>
                                                    <div class="input-group date">
                                                        <input type="text" 
                                                               name="start_date" 
                                                               id="start_date" 
                                                               class="form-control datepicker" 
                                                               value="<?php echo (isset($approval) && $approval->date_from ? _d($approval->date_from) : ''); ?>"
                                                               autocomplete="off"
                                                               required>
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="end_date" class="required">
                                                        <i class="fa fa-calendar"></i> <?php echo _l('leave_end_date'); ?>
                                                    </label>
                                                    <div class="input-group date">
                                                        <input type="text" 
                                                               name="end_date" 
                                                               id="end_date" 
                                                               class="form-control datepicker" 
                                                               value="<?php echo (isset($approval) && $approval->date_to ? _d($approval->date_to) : ''); ?>"
                                                               autocomplete="off"
                                                               required>
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Số ngày nghỉ -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="total_days">
                                                        <i class="fa fa-clock-o"></i> <?php echo _l('leave_total_days'); ?>
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="number" 
                                                               class="form-control text-center" 
                                                               name="total_days" 
                                                               id="total_days" 
                                                               value="<?php echo (isset($json_data) && isset($json_data['total_days']) ? $json_data['total_days'] : '1'); ?>" 
                                                               step="0.5" 
                                                               min="0.5"
                                                               readonly>
                                                        <span class="input-group-addon"><?php echo _l('days'); ?></span>
                                                    </div>
                                                    <small class="text-muted"><?php echo _l('leave_total_days_help'); ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="half_day_option">
                                                        <i class="fa fa-clock-o"></i> <?php echo _l('leave_half_day_option'); ?>
                                                    </label>
                                                    <select name="half_day_option" id="half_day_option" class="selectpicker" data-width="100%">
                                                        <option value="full_day"><?php echo _l('leave_full_day'); ?></option>
                                                        <option value="morning_half"><?php echo _l('leave_morning_half'); ?></option>
                                                        <option value="afternoon_half"><?php echo _l('leave_afternoon_half'); ?></option>
                                                    </select>
                                                    <small class="text-muted"><?php echo _l('leave_half_day_help'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Lý do chi tiết -->
                                        <div class="form-group">
                                            <label for="detailed_reason" class="required">
                                                <i class="fa fa-file-text-o"></i> <?php echo _l('leave_detailed_reason'); ?>
                                            </label>
                                            <textarea name="detailed_reason" 
                                                      id="detailed_reason" 
                                                      class="form-control" 
                                                      rows="6"
                                                      placeholder="<?php echo _l('leave_detailed_reason_placeholder'); ?>"
                                                      required><?php echo (isset($approval) ? $approval->description : ''); ?></textarea>
                                            <small class="text-muted"><?php echo _l('leave_detailed_reason_help'); ?></small>
                                        </div>
                                        
                                        <!-- Đính kèm file (nếu có) -->
                                        <div class="form-group">
                                            <label for="supporting_document">
                                                <i class="fa fa-paperclip"></i> <?php echo _l('leave_supporting_document'); ?>
                                                <span class="text-muted">(<?php echo _l('optional'); ?>)</span>
                                            </label>
                                            <input type="file" 
                                                   name="supporting_document" 
                                                   id="supporting_document" 
                                                   class="form-control"
                                                   accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                            
                                            <?php if (isset($approval) && $approval->attachment) { ?>
                                            <div class="mtop10">
                                                <div class="alert alert-info">
                                                    <i class="fa fa-file-o"></i> 
                                                    <strong><?php echo _l('current_attachment'); ?>:</strong>
                                                    <a href="<?php echo admin_url('my_team/download_attachment/' . $approval->id); ?>" 
                                                       class="text-info" target="_blank">
                                                        <?php echo _l('download_current_attachment'); ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            
                                            <small class="text-muted">
                                                <?php echo _l('leave_supporting_document_help'); ?>
                                                <br>
                                                <strong><?php echo _l('accepted_formats'); ?>:</strong> PDF, JPG, PNG, DOC, DOCX (<?php echo _l('max_size'); ?>: 5MB)
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Sidebar thông tin -->
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-cog"></i> <?php echo _l('approval_settings'); ?>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <!-- Phòng ban -->
                                        <div class="form-group">
                                            <label for="department_id">
                                                <i class="fa fa-building"></i> <?php echo _l('department'); ?>
                                                <span class="text-muted">(<?php echo _l('optional'); ?>)</span>
                                            </label>
                                            <select name="department_id" id="department_id" class="selectpicker" data-width="100%">
                                                <option value=""><?php echo _l('select_department'); ?></option>
                                                <?php if (!empty($departments)) { ?>
                                                    <?php foreach ($departments as $department) { ?>
                                                    <option value="<?php echo $department['departmentid']; ?>" 
                                                            <?php if (isset($approval) && $approval->department_id == $department['departmentid']) { echo 'selected'; } ?>>
                                                        <?php echo $department['name']; ?>
                                                    </option>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <option value="" disabled><?php echo _l('no_departments_available'); ?></option>
                                                <?php } ?>
                                            </select>
                                            <small class="text-muted"><?php echo _l('department_help_optional'); ?></small>
                                        </div>
                                        
                                        <!-- Mức độ ưu tiên -->
                                        <div class="form-group">
                                            <label for="priority">
                                                <i class="fa fa-flag"></i> <?php echo _l('priority'); ?>
                                            </label>
                                            <select name="priority" id="priority" class="selectpicker" data-width="100%">
                                                <option value="normal" <?php if (isset($approval) && $approval->priority == 'normal') { echo 'selected'; } ?>>
                                                    <?php echo _l('priority_normal'); ?>
                                                </option>
                                                <option value="high" <?php if (isset($approval) && $approval->priority == 'high') { echo 'selected'; } ?>>
                                                    <?php echo _l('priority_high'); ?>
                                                </option>
                                                <option value="urgent" <?php if (isset($approval) && $approval->priority == 'urgent') { echo 'selected'; } ?>>
                                                    <?php echo _l('priority_urgent'); ?>
                                                </option>
                                            </select>
                                        </div>
                                        
                                        <!-- Người thay thế -->
                                        <div class="form-group">
                                            <label for="replacement_staff">
                                                <i class="fa fa-user"></i> <?php echo _l('leave_replacement_staff'); ?>
                                            </label>
                                            <select name="replacement_staff" id="replacement_staff" class="selectpicker" data-width="100%" data-live-search="true">
                                                <option value=""><?php echo _l('select_replacement_staff'); ?></option>
                                                <?php if (isset($staff_members)) { ?>
                                                    <?php foreach ($staff_members as $staff) { ?>
                                                    <option value="<?php echo $staff['staffid']; ?>" 
                                                            <?php if (isset($json_data) && isset($json_data['replacement_staff']) && $json_data['replacement_staff'] == $staff['staffid']) { echo 'selected'; } ?>>
                                                        <?php echo $staff['firstname'] . ' ' . $staff['lastname']; ?>
                                                    </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <small class="text-muted"><?php echo _l('leave_replacement_staff_help'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Hướng dẫn -->
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-lightbulb-o"></i> <?php echo _l('leave_approval_tips'); ?>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-check text-success"></i> <?php echo _l('tip_clear_leave_reason'); ?></li>
                                            <li><i class="fa fa-check text-success"></i> <?php echo _l('tip_submit_advance'); ?></li>
                                            <li><i class="fa fa-check text-success"></i> <?php echo _l('tip_check_company_policy'); ?></li>
                                            <li><i class="fa fa-check text-success"></i> <?php echo _l('tip_arrange_replacement'); ?></li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <!-- Hiển thị số ngày phép còn lại (nếu có) -->
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-calendar-check-o"></i> <?php echo _l('leave_balance'); ?>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row text-center">
                                            <div class="col-xs-6">
                                                <div class="leave-balance-item">
                                                    <div class="number text-success">15</div>
                                                    <div class="label"><?php echo _l('annual_leave_balance'); ?></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="leave-balance-item">
                                                    <div class="number text-info">3</div>
                                                    <div class="label"><?php echo _l('compensatory_leave_balance'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <small class="text-muted"><?php echo _l('leave_balance_note'); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action buttons -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="hr-panel-heading" />
                                <div class="text-right">
                                    <a href="<?php echo admin_url('my_team/approvals'); ?>" class="btn btn-default mright10">
                                        <i class="fa fa-times"></i> <?php echo _l('cancel'); ?>
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-paper-plane"></i> <?php echo _l('submit_leave_approval'); ?>
                                    </button>
                                </div>
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
    // Debug information
    console.log('Leave form loaded');
    console.log('Moment.js available:', typeof moment !== 'undefined');
    console.log('Current app format:', app.options.date_format || 'Not available');
    
    // Initialize date picker with custom options
    if (typeof init_datepicker === 'function') {
        init_datepicker();
    } else {
        // Fallback datepicker initialization
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });
    }
    
    // Initialize moment.js locale for date parsing
    if (typeof moment !== 'undefined') {
        moment.locale('en');
    }
    
    // Calculate total days when start/end date changes
    function calculateTotalDays() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var halfDayOption = $('#half_day_option').val();
        
        console.log('Calculating days - Start:', startDate, 'End:', endDate, 'Half day:', halfDayOption);
        
        if (startDate && endDate) {
            // Parse dates using the format DD/MM/YYYY
            var start, end;
            
            try {
                if (typeof moment !== 'undefined') {
                    start = moment(startDate, 'DD/MM/YYYY');
                    end = moment(endDate, 'DD/MM/YYYY');
                    
                    if (!start.isValid() || !end.isValid()) {
                        throw new Error('Invalid moment dates');
                    }
                } else {
                    // Fallback to native Date parsing
                    var startParts = startDate.split('/');
                    var endParts = endDate.split('/');
                    
                    if (startParts.length !== 3 || endParts.length !== 3) {
                        throw new Error('Invalid date format');
                    }
                    
                    start = new Date(parseInt(startParts[2]), parseInt(startParts[1]) - 1, parseInt(startParts[0]));
                    end = new Date(parseInt(endParts[2]), parseInt(endParts[1]) - 1, parseInt(endParts[0]));
                    
                    if (isNaN(start.getTime()) || isNaN(end.getTime())) {
                        throw new Error('Invalid dates');
                    }
                }
                
                // Check if end date is before start date
                if (typeof moment !== 'undefined') {
                    if (end.isBefore(start)) {
                        alert('<?php echo _l('end_date_before_start_date'); ?>');
                        $('#end_date').val('').focus();
                        $('#total_days').val('0');
                        return;
                    }
                } else {
                    if (end < start) {
                        alert('<?php echo _l('end_date_before_start_date'); ?>');
                        $('#end_date').val('').focus();
                        $('#total_days').val('0');
                        return;
                    }
                }
                
                var totalDays = 0;
                
                if (typeof moment !== 'undefined') {
                    // Using moment.js
                    var current = start.clone();
                    
                    while (current.isSameOrBefore(end)) {
                        // Skip weekends (Saturday = 6, Sunday = 0)
                        if (current.day() !== 0 && current.day() !== 6) {
                            totalDays++;
                        }
                        current.add(1, 'day');
                    }
                    
                    // Apply half day option only if it's a single day
                    if (start.isSame(end) && (halfDayOption === 'morning_half' || halfDayOption === 'afternoon_half')) {
                        totalDays = 0.5;
                    }
                } else {
                    // Fallback calculation without moment.js
                    var current = new Date(start);
                    
                    while (current <= end) {
                        // Skip weekends (Saturday = 6, Sunday = 0)
                        var dayOfWeek = current.getDay();
                        if (dayOfWeek !== 0 && dayOfWeek !== 6) {
                            totalDays++;
                        }
                        current.setDate(current.getDate() + 1);
                    }
                    
                    // Apply half day option only if it's a single day
                    if (start.getTime() === end.getTime() && (halfDayOption === 'morning_half' || halfDayOption === 'afternoon_half')) {
                        totalDays = 0.5;
                    }
                }
                
                console.log('Total calculated days:', totalDays);
                $('#total_days').val(totalDays);
                
            } catch (error) {
                console.error('Date calculation error:', error);
                $('#total_days').val('1'); // Set default value instead of 0
            }
        } else {
            $('#total_days').val('0');
        }
    }
    
    // Bind events for date calculation with delay
    $('#start_date, #end_date').on('change blur', function() {
        setTimeout(calculateTotalDays, 100);
    });
    
    $('#half_day_option').on('change', function() {
        if ($('#start_date').val() && $('#end_date').val()) {
            setTimeout(calculateTotalDays, 100);
        }
    });
    
    // File validation
    $('#supporting_document').on('change', function() {
        var file = this.files[0];
        if (file) {
            // Check file size (5MB)
            var maxSize = 5 * 1024 * 1024; // 5MB in bytes
            if (file.size > maxSize) {
                alert('<?php echo _l('file_too_large'); ?>');
                $(this).val('');
                return;
            }
            
            // Check file type
            var allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if (allowedTypes.indexOf(file.type) === -1) {
                alert('<?php echo _l('invalid_file_type'); ?>');
                $(this).val('');
                return;
            }
            
            // Show file name
            var fileName = file.name;
            if (fileName.length > 30) {
                fileName = fileName.substring(0, 27) + '...';
            }
            
            // Create preview
            var preview = '<div class="alert alert-success mtop10" id="file-preview">' +
                         '<i class="fa fa-file"></i> <strong><?php echo _l('selected_file'); ?>:</strong> ' + fileName +
                         '</div>';
            
            $('#file-preview').remove();
            $(this).after(preview);
        }
    });
    
    // Form validation
    $('#leave-approval-form').on('submit', function(e) {
        var totalDays = parseFloat($('#total_days').val());
        
        console.log('Form validation - Total days:', totalDays);
        
        if (!$('#start_date').val() || !$('#end_date').val()) {
            alert('<?php echo _l('please_select_valid_dates'); ?>');
            $('#start_date').focus();
            e.preventDefault();
            return false;
        }
        
        if (isNaN(totalDays) || totalDays <= 0) {
            alert('<?php echo _l('please_select_valid_dates'); ?>');
            $('#start_date').focus();
            e.preventDefault();
            return false;
        }
        
        if ($.trim($('#detailed_reason').val()).length < 10) {
            alert('<?php echo _l('reason_too_short'); ?>');
            $('#detailed_reason').focus();
            e.preventDefault();
            return false;
        }
        
        // Show loading
        $(this).find('button[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> <?php echo _l('processing'); ?>');
        
        return true;
    });
    
    // Auto-generate subject based on leave type and dates
    $('#leave_type, #start_date, #end_date').on('change', function() {
        if (!$.trim($('#subject').val())) {
            var leaveType = $('#leave_type option:selected').text();
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            
            if (leaveType && startDate && endDate) {
                var subject = leaveType + ' - ' + startDate;
                if (startDate !== endDate) {
                    subject += ' đến ' + endDate;
                }
                $('#subject').val(subject);
            }
        }
    });
    
    // Show/hide half day option based on selected dates
    $('#start_date, #end_date').on('change', function() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        
        if (startDate && endDate && startDate === endDate) {
            $('#half_day_option').closest('.form-group').show();
        } else {
            $('#half_day_option').closest('.form-group').hide();
            $('#half_day_option').val('full_day').selectpicker('refresh');
        }
    });
    
    // Hide half day option initially
    $('#half_day_option').closest('.form-group').hide();
    
    // Trigger calculation on page load if dates are already filled
    setTimeout(function() {
        if ($('#start_date').val() && $('#end_date').val()) {
            calculateTotalDays();
        }
    }, 500);
});
</script>

<style>
.required:after {
    content: " *";
    color: #e74c3c;
}

.panel-title i {
    margin-right: 8px;
}

.form-group label i {
    margin-right: 5px;
    width: 15px;
    text-align: center;
}

.leave-balance-item {
    padding: 10px 5px;
}

.leave-balance-item .number {
    font-size: 24px;
    font-weight: bold;
    line-height: 1;
}

.leave-balance-item .label {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
}

#file-preview {
    margin-top: 10px;
}

.alert ul {
    margin-bottom: 0;
}

.alert li {
    padding: 2px 0;
}

.text-muted {
    font-weight: normal;
}

.form-group label .text-muted {
    font-size: 12px;
    margin-left: 5px;
}

@media (max-width: 768px) {
    .text-right {
        text-align: center !important;
        margin-top: 15px;
    }
    
    .mright10 {
        margin-right: 0 !important;
        margin-bottom: 10px;
    }
    
    .leave-balance-item {
        margin-bottom: 15px;
    }
}
</style> 