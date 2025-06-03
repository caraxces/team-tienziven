<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('team_performance'); ?></h4>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Filter -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <?php echo form_open(admin_url('my_team/performance'), ['method' => 'get', 'id' => 'filter-form']); ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="period"><?php echo _l('period_datepicker'); ?></label>
                                                    <select name="period" id="period" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                        <option value="this_month"><?php echo _l('this_month'); ?></option>
                                                        <option value="last_month"><?php echo _l('last_month'); ?></option>
                                                        <option value="this_year"><?php echo _l('this_year'); ?></option>
                                                        <option value="last_year"><?php echo _l('last_year'); ?></option>
                                                        <option value="custom"><?php echo _l('period_datepicker_custom'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 custom-date-picker" style="display: none;">
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
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- User Dashboard -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                $this->load->model('staff_model');
                                $this->load->model('departments_model');
                                
                                // Hiển thị bảng điều khiển cho nhân viên đăng nhập
                                $this->load->view('my_team/performance/user_dashboard_group', [
                                    'user_id' => $staff_id,
                                    'performance' => $performance
                                ]); 
                                ?>
                            </div>
                        </div>
                        
                        <!-- Recommendations -->
                        <hr class="hr-panel-heading hr-10" />
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-muted mtop0"><?php echo _l('recommendations'); ?></h4>
                            </div>
                        </div>
                        
                        <div class="row mtop15">
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <ul class="recommendations-list">
                                            <?php
                                            // Đề xuất dựa trên dữ liệu hiệu suất
                                            $recommendations = [];
                                            
                                            // Kiểm tra tỷ lệ hoàn thành công việc
                                            if (isset($performance['tasks']['completion_rate']) && $performance['tasks']['completion_rate'] < 70) {
                                                $recommendations[] = _l('recommendation_improve_task_completion');
                                            }
                                            
                                            // Kiểm tra tỷ lệ hoàn thành dự án
                                            if (isset($performance['projects']['completion_rate']) && $performance['projects']['completion_rate'] < 70) {
                                                $recommendations[] = _l('recommendation_improve_project_completion');
                                            }
                                            
                                            // Kiểm tra tỷ lệ phản hồi phiếu hỗ trợ
                                            if (isset($performance['tickets']['response_rate']) && $performance['tickets']['response_rate'] < 70) {
                                                $recommendations[] = _l('recommendation_improve_ticket_response');
                                            }
                                            
                                            // Kiểm tra tỷ lệ đi làm
                                            if (isset($performance['attendance']['attendance_rate']) && $performance['attendance']['attendance_rate'] < 80) {
                                                $recommendations[] = _l('recommendation_improve_attendance');
                                            }
                                            
                                            // Kiểm tra số giờ làm việc
                                            if (isset($performance['timesheet']['total_hours']) && $performance['timesheet']['total_hours'] < 40) {
                                                $recommendations[] = _l('recommendation_improve_work_hours');
                                            }
                                            
                                            if (empty($recommendations)) {
                                                echo '<li class="text-success"><i class="fa fa-check-circle"></i> ' . _l('recommendation_good_performance') . '</li>';
                                            } else {
                                                foreach ($recommendations as $recommendation) {
                                                    echo '<li><i class="fa fa-lightbulb-o text-warning"></i> ' . $recommendation . '</li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Training Resources -->
                        <hr class="hr-panel-heading hr-10" />
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-muted mtop0"><?php echo _l('training_resources'); ?></h4>
                            </div>
                        </div>
                        
                        <div class="row mtop15">
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="training-resource">
                                                    <h4><i class="fa fa-tasks text-primary"></i> <?php echo _l('task_management'); ?></h4>
                                                    <p><?php echo _l('training_task_management_desc'); ?></p>
                                                    <a href="#" class="btn btn-primary btn-xs"><?php echo _l('learn_more'); ?></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="training-resource">
                                                    <h4><i class="fa fa-area-chart text-info"></i> <?php echo _l('project_management'); ?></h4>
                                                    <p><?php echo _l('training_project_management_desc'); ?></p>
                                                    <a href="#" class="btn btn-info btn-xs"><?php echo _l('learn_more'); ?></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="training-resource">
                                                    <h4><i class="fa fa-ticket text-success"></i> <?php echo _l('ticket_management'); ?></h4>
                                                    <p><?php echo _l('training_ticket_management_desc'); ?></p>
                                                    <a href="#" class="btn btn-success btn-xs"><?php echo _l('learn_more'); ?></a>
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
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script>
$(function() {
    // Period changes
    $('#period').on('change', function() {
        var value = $(this).val();
        if (value == 'custom') {
            $('.custom-date-picker').show();
        } else {
            $('.custom-date-picker').hide();
        }
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
    });
    
    $('input.date-range-picker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    
    // Initialize filter values from URL
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('period')) {
        $('#period').val(urlParams.get('period')).selectpicker('refresh');
        if (urlParams.get('period') == 'custom') {
            $('.custom-date-picker').show();
        }
    }
    if (urlParams.has('date_from') && urlParams.has('date_to')) {
        var dateFrom = moment(urlParams.get('date_from'), 'YYYY-MM-DD').format('DD/MM/YYYY');
        var dateTo = moment(urlParams.get('date_to'), 'YYYY-MM-DD').format('DD/MM/YYYY');
        $('#date_range').val(dateFrom + ' - ' + dateTo);
    }
});
</script>

<style>
.recommendations-list {
    padding-left: 20px;
}
.recommendations-list li {
    list-style: none;
    margin-bottom: 10px;
    padding: 5px 0;
}
.recommendations-list li i {
    margin-right: 8px;
}
.training-resource {
    padding: 15px;
    border: 1px solid #eee;
    border-radius: 5px;
    margin-bottom: 15px;
    min-height: 150px;
}
.training-resource h4 {
    margin-top: 0;
}
.training-resource i {
    margin-right: 5px;
}
</style> 