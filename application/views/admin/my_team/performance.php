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
                        
                        <!-- Filter Section -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <?php echo form_open(admin_url('my_team/performance'), ['method' => 'get', 'id' => 'filter-form']); ?>
                                        <div class="row">
                                            <!-- Staff Selection - chỉ hiển thị cho admin và manager -->
                                            <?php if (isset($permission_level) && in_array($permission_level, ['admin', 'manager'])) { ?>
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
                                            <?php } else { ?>
                                            <!-- Staff chỉ thấy tên của mình -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><?php echo _l('performance_viewing_for'); ?></label>
                                                    <p class="form-control-static">
                                                        <?php 
                                                        $current_staff = null;
                                                        foreach ($staff_members as $staff) {
                                                            if ($staff['staffid'] == $staff_id) {
                                                                $current_staff = $staff;
                                                                break;
                                                            }
                                                        }
                                                        echo $current_staff ? $current_staff['firstname'] . ' ' . $current_staff['lastname'] : 'N/A';
                                                        ?>
                                                    </p>
                                                    <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
                                                </div>
                                            </div>
                                            <?php } ?>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="period"><?php echo _l('period_datepicker'); ?></label>
                                                    <select name="period" id="period" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                        <option value="this_month" <?php if($period == 'this_month') echo 'selected'; ?>><?php echo _l('this_month'); ?></option>
                                                        <option value="last_month" <?php if($period == 'last_month') echo 'selected'; ?>><?php echo _l('last_month'); ?></option>
                                                        <option value="this_year" <?php if($period == 'this_year') echo 'selected'; ?>><?php echo _l('this_year'); ?></option>
                                                        <option value="last_year" <?php if($period == 'last_year') echo 'selected'; ?>><?php echo _l('last_year'); ?></option>
                                                        <option value="custom" <?php if($period == 'custom') echo 'selected'; ?>><?php echo _l('period_datepicker_custom'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 custom-date-picker" style="display: <?php echo $period == 'custom' ? 'block' : 'none'; ?>;">
                                                <div class="form-group">
                                                    <label for="date_range"><?php echo _l('approval_date'); ?></label>
                                                    <div class="input-group date-range-picker">
                                                        <input type="text" name="date_range" id="date_range" class="form-control date-range-picker" autocomplete="off" 
                                                               value="<?php echo $period == 'custom' && $date_from && $date_to ? _d($date_from) . ' - ' . _d($date_to) : ''; ?>">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary"><?php echo _l('general_search'); ?></button>
                                                <?php if (isset($permission_level) && in_array($permission_level, ['admin', 'manager'])) { ?>
                                                <button type="button" class="btn btn-info" id="show-detailed-charts" data-staff-id="<?php echo $staff_id; ?>"><?php echo _l('detailed_charts'); ?></button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dashboard Performance - tương tự dashboard admin -->
                        <div class="row">
                            <div class="col-md-12" id="staff_performance_container">
                                <?php 
                                $this->load->model('staff_model');
                                $this->load->model('departments_model');
                                
                                // Hiển thị dashboard performance với widgets tương tự admin
                                $this->load->view('admin/my_team/performance_dashboard_widgets', [
                                    'user_id' => $staff_id,
                                    'performance' => $performance,
                                    'permission_level' => isset($permission_level) ? $permission_level : 'staff',
                                    'date_from' => $date_from,
                                    'date_to' => $date_to
                                ]); 
                                ?>
                            </div>
                        </div>
                        
                        <!-- Department Performance - chỉ hiển thị cho admin và manager -->
                        <?php if (isset($permission_level) && in_array($permission_level, ['admin', 'manager'])) { ?>
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
                            
                            if ($permission_level == 'admin') {
                                // Admin thấy tất cả phòng ban
                                $departments = $this->departments_model->get();
                            } else {
                                // Manager chỉ thấy phòng ban mình quản lý
                                $departments = [];
                                if (isset($managed_departments) && !empty($managed_departments)) {
                                    foreach ($managed_departments as $dept_id) {
                                        $dept = $this->departments_model->get($dept_id);
                                        if ($dept) {
                                            $departments[] = $dept;
                                        }
                                    }
                                }
                            }
                            
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

<!-- Detailed Charts Modal -->
<div class="modal fade" id="detailed-charts-modal" tabindex="-1" role="dialog" aria-labelledby="detailed-charts-modal-label">
    <div class="modal-dialog modal-lg" role="document" style="width: 90%; max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="detailed-charts-modal-label">
                    <i class="fa fa-bar-chart"></i> <?php echo _l('detailed_charts'); ?>
                    <span id="modal-staff-name"></span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Tasks Detailed Chart -->
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <i class="fa fa-tasks text-primary"></i> Chi tiết Công việc
                                </h5>
                            </div>
                            <div class="panel-body">
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="modal-tasks-chart"></canvas>
                                </div>
                                <div class="chart-stats mt-3">
                                    <div class="row text-center">
                                        <div class="col-xs-4">
                                            <div class="stat-item">
                                                <span class="stat-number" id="modal-tasks-total">0</span>
                                                <span class="stat-label">Tổng số</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="stat-item">
                                                <span class="stat-number" id="modal-tasks-completed">0</span>
                                                <span class="stat-label">Hoàn thành</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="stat-item">
                                                <span class="stat-number" id="modal-tasks-rate">0%</span>
                                                <span class="stat-label">Tỷ lệ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Projects Detailed Chart -->
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <i class="fa fa-line-chart text-success"></i> Chi tiết Dự án
                                </h5>
                            </div>
                            <div class="panel-body">
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="modal-projects-chart"></canvas>
                                </div>
                                <div class="chart-stats mt-3">
                                    <div class="row text-center">
                                        <div class="col-xs-4">
                                            <div class="stat-item">
                                                <span class="stat-number" id="modal-projects-total">0</span>
                                                <span class="stat-label">Tổng số</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="stat-item">
                                                <span class="stat-number" id="modal-projects-completed">0</span>
                                                <span class="stat-label">Hoàn thành</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="stat-item">
                                                <span class="stat-number" id="modal-projects-rate">0%</span>
                                                <span class="stat-label">Tỷ lệ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Tickets Detailed Chart -->
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <i class="fa fa-ticket text-warning"></i> Chi tiết Tickets
                                </h5>
                            </div>
                            <div class="panel-body">
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="modal-tickets-chart"></canvas>
                                </div>
                                <div class="chart-stats mt-3">
                                    <div class="row text-center">
                                        <div class="col-xs-4">
                                            <div class="stat-item">
                                                <span class="stat-number" id="modal-tickets-total">0</span>
                                                <span class="stat-label">Tổng số</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="stat-item">
                                                <span class="stat-number" id="modal-tickets-closed">0</span>
                                                <span class="stat-label">Đã đóng</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="stat-item">
                                                <span class="stat-number" id="modal-tickets-rate">0%</span>
                                                <span class="stat-label">Tỷ lệ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Attendance Detailed Chart -->
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <i class="fa fa-calendar text-info"></i> Chi tiết Chuyên cần
                                </h5>
                            </div>
                            <div class="panel-body">
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="modal-attendance-chart"></canvas>
                                </div>
                                <div class="chart-stats mt-3">
                                    <div class="row text-center">
                                        <div class="col-xs-4">
                                            <div class="stat-item">
                                                <span class="stat-number" id="modal-attendance-present">0</span>
                                                <span class="stat-label">Có mặt</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="stat-item">
                                                <span class="stat-number" id="modal-attendance-absent">0</span>
                                                <span class="stat-label">Vắng mặt</span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="stat-item">
                                                <span class="stat-number" id="modal-attendance-rate">0%</span>
                                                <span class="stat-label">Tỷ lệ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Đóng
                </button>
                <button type="button" class="btn btn-primary" id="export-charts">
                    <i class="fa fa-download"></i> Xuất biểu đồ
                </button>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script>
// Load JS files
var performance_js_file = '<?php echo base_url('modules/my_team/assets/js/performance_dashboard.js'); ?>';
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