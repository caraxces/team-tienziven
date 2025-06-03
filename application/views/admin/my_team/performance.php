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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="staff_id"><?php echo _l('performance_select_staff'); ?></label>
                                                    <select name="staff_id" id="staff_id" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                        <?php foreach ($staff_members as $staff) { ?>
                                                        <option value="<?php echo $staff['staffid']; ?>" <?php if ($staff_id == $staff['staffid']) { echo 'selected'; } ?>><?php echo $staff['firstname'] . ' ' . $staff['lastname']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
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
                                            <div class="col-md-4 custom-date-picker" style="display: none;">
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
                                                <?php if (has_permission('my_team', '', 'view') || is_admin()) { ?>
                                                <a href="<?php echo admin_url('my_team/performance_charts/' . $staff_id); ?>" class="btn btn-info"><?php echo _l('detailed_charts'); ?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- User Dashboard -->
                        <div class="row">
                            <div class="col-md-12" id="staff_performance_container">
                                <?php 
                                $this->load->model('staff_model');
                                $this->load->model('departments_model');
                                
                                // Hiển thị bảng điều khiển cho nhân viên được chọn
                                $this->load->view('admin/my_team/user_dashboard_group', [
                                    'user_id' => $staff_id,
                                    'performance' => $performance
                                ]); 
                                ?>
                            </div>
                        </div>
                        
                        <!-- Department Performance -->
                        <?php if (is_admin() || has_permission('my_team', '', 'view')) { ?>
                        <hr class="hr-panel-heading hr-10" />
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-muted mtop0"><?php echo _l('performance_department_overview'); ?></h4>
                            </div>
                        </div>
                        
                        <div class="row mtop15">
                            <?php 
                            // Tính toán thống kê phòng ban
                            $this->load->model('departments_model');
                            $departments = $this->departments_model->get();
                            
                            foreach ($departments as $department) {
                                // Đếm số nhân viên trong phòng ban
                                $this->db->where('departmentid', $department['departmentid']);
                                $staff_count = $this->db->count_all_results(db_prefix() . 'staff');
                                
                                // Tính số dự án, công việc và phiếu hỗ trợ
                                $projects_count = 0;
                                $tasks_count = 0;
                                $tickets_count = 0;
                                
                                $department_staff = $this->staff_model->get('', ['active' => 1, 'departmentid' => $department['departmentid']]);
                                
                                foreach ($department_staff as $s) {
                                    // Dự án
                                    $this->db->where('id IN (SELECT project_id FROM ' . db_prefix() . 'project_members WHERE staff_id = ' . $s['staffid'] . ')');
                                    $projects_count += $this->db->count_all_results(db_prefix() . 'projects');
                                    
                                    // Công việc
                                    $this->db->where('id IN (SELECT taskid FROM ' . db_prefix() . 'task_assigned WHERE staffid = ' . $s['staffid'] . ')');
                                    $tasks_count += $this->db->count_all_results(db_prefix() . 'tasks');
                                    
                                    // Phiếu hỗ trợ
                                    $this->db->where('assigned', $s['staffid']);
                                    $tickets_count += $this->db->count_all_results(db_prefix() . 'tickets');
                                }
                                
                                // Chỉ hiển thị phòng ban có dữ liệu
                                if ($staff_count > 0) {
                            ?>
                            <div class="col-md-4">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="text-center"><?php echo $department['name']; ?></h4>
                                        <hr class="hr-panel-heading-dashboard">
                                        <div class="row text-center">
                                            <div class="col-md-4 col-xs-4 border-right">
                                                <h3 class="bold"><?php echo $staff_count; ?></h3>
                                                <span class="text-primary"><?php echo _l('staff_stats_total'); ?></span>
                                            </div>
                                            <div class="col-md-4 col-xs-4 border-right">
                                                <h3 class="bold"><?php echo $projects_count; ?></h3>
                                                <span class="text-info"><?php echo _l('projects'); ?></span>
                                            </div>
                                            <div class="col-md-4 col-xs-4">
                                                <h3 class="bold"><?php echo $tasks_count; ?></h3>
                                                <span class="text-success"><?php echo _l('tasks'); ?></span>
                                            </div>
                                        </div>
                                        <hr class="hr-panel-heading-dashboard">
                                        <div class="text-center">
                                            <a href="<?php echo admin_url('departments/department/' . $department['departmentid']); ?>" class="btn btn-info"><?php echo _l('general_view'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                }
                            }
                            ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script>
// Load JS files
var performance_js_file = site_url + 'application/views/admin/my_team/assets/js/performance_dashboard.js';
$.getScript(performance_js_file);

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
<?php $this->load->view('admin/my_team/performance_js_init'); ?> 