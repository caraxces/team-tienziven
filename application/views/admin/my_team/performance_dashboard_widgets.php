<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
/**
 * Performance Dashboard Widgets - tương tự admin dashboard
 * Hiển thị widgets performance kết nối với database gốc
 * 
 * @param int $user_id ID của người dùng
 * @param array $performance Dữ liệu hiệu suất từ model
 * @param string $permission_level Cấp độ quyền (admin/manager/staff)
 * @param string $date_from Ngày bắt đầu
 * @param string $date_to Ngày kết thúc
 */

$CI = &get_instance();
$staff = $CI->staff_model->get($user_id);

// Giá trị mặc định cho các biến
$tasks = $performance['tasks'] ?? [];
$projects = $performance['projects'] ?? [];
$tickets = $performance['tickets'] ?? [];
$attendance = $performance['attendance'] ?? [];

// Load các helper và model cần thiết
$CI->load->model('currencies_model');
$CI->load->model('dashboard_model');
$base_currency = $CI->currencies_model->get_base_currency();
?>

<div class="performance-dashboard-container">
    <!-- Header Info -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">
                    <h4 class="no-margin">
                        <?php echo staff_profile_image($user_id, ['staff-profile-image-small', 'mright5'], 'small'); ?>
                        <?php echo $staff->firstname . ' ' . $staff->lastname; ?>
                        <?php if ($staff->admin) { ?>
                        <span class="label label-info mright5"><?php echo _l('staff_admin_profile'); ?></span>
                        <?php } ?>
                        <?php if ($staff->role) { 
                            $role = $CI->roles_model->get($staff->role);
                            if ($role) {
                        ?>
                        <span class="label label-default"><?php echo $role->name; ?></span>
                        <?php } } ?>
                        <small class="text-muted pull-right">
                            Từ: <?php echo _d($date_from) . ' - ' . _d($date_to); ?>
                        </small>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Top Statistics Row - tương tự dashboard widgets -->
    <div class="row" data-container="top-12">
        <!-- Tasks Widget -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel_s dashboard-widget">
                <div class="panel-body">
                    <div class="widget-dragger"></div>
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-tasks"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo _l('tasks'); ?></span>
                            <span class="info-box-number">
                                <?php echo isset($tasks['completed']) ? $tasks['completed'] : 0; ?> / <?php echo isset($tasks['total']) ? $tasks['total'] : 0; ?>
                            </span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" style="width: <?php echo isset($tasks['completion_rate']) ? $tasks['completion_rate'] : 0; ?>%"></div>
                            </div>
                            <span class="progress-description">
                                Tỷ lệ hoàn thành: <?php echo isset($tasks['completion_rate']) ? number_format($tasks['completion_rate'], 2) : 0; ?>%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Projects Widget -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel_s dashboard-widget">
                <div class="panel-body">
                    <div class="widget-dragger"></div>
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-line-chart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo _l('projects'); ?></span>
                            <span class="info-box-number">
                                <?php echo isset($projects['completed']) ? $projects['completed'] : 0; ?> / <?php echo isset($projects['total']) ? $projects['total'] : 0; ?>
                            </span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" style="width: <?php echo isset($projects['completion_rate']) ? $projects['completion_rate'] : 0; ?>%"></div>
                            </div>
                            <span class="progress-description">
                                Tỷ lệ hoàn thành: <?php echo isset($projects['completion_rate']) ? number_format($projects['completion_rate'], 2) : 0; ?>%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tickets Widget -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel_s dashboard-widget">
                <div class="panel-body">
                    <div class="widget-dragger"></div>
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-ticket"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo _l('tickets'); ?></span>
                            <span class="info-box-number">
                                <?php echo isset($tickets['closed']) ? $tickets['closed'] : 0; ?> / <?php echo isset($tickets['total']) ? $tickets['total'] : 0; ?>
                            </span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" style="width: <?php echo isset($tickets['response_rate']) ? $tickets['response_rate'] : 0; ?>%"></div>
                            </div>
                            <span class="progress-description">
                                Tỷ lệ phản hồi: <?php echo isset($tickets['response_rate']) ? number_format($tickets['response_rate'], 2) : 0; ?>%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Attendance Widget -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="panel_s dashboard-widget">
                <div class="panel-body">
                    <div class="widget-dragger"></div>
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-calendar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Chuyên cần</span>
                            <span class="info-box-number">
                                <?php echo isset($attendance['present_days']) ? $attendance['present_days'] : 0; ?> ngày
                            </span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" style="width: <?php echo isset($attendance['attendance_rate']) ? $attendance['attendance_rate'] : 0; ?>%"></div>
                            </div>
                            <span class="progress-description">
                                Tỷ lệ đi làm: <?php echo isset($attendance['attendance_rate']) ? number_format($attendance['attendance_rate'], 2) : 0; ?>%
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row - tương tự dashboard middle containers -->
    <div class="row">
        <!-- Tasks Chart -->
        <div class="col-md-6" data-container="middle-left-6">
            <div class="panel_s dashboard-widget">
                <div class="panel-body">
                    <div class="widget-dragger"></div>
                    <h4 class="no-margin text-center">Tổng quan Công việc</h4>
                    <hr class="hr-panel-heading-dashboard" />
                    <div class="relative" style="height: 300px">
                        <canvas id="tasks_chart_<?php echo $user_id; ?>" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Projects Chart -->
        <div class="col-md-6" data-container="middle-right-6">
            <div class="panel_s dashboard-widget">
                <div class="panel-body">
                    <div class="widget-dragger"></div>
                    <h4 class="no-margin text-center">Tổng quan Dự án</h4>
                    <hr class="hr-panel-heading-dashboard" />
                    <div class="relative" style="height: 300px">
                        <canvas id="projects_chart_<?php echo $user_id; ?>" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Second Charts Row -->
    <div class="row">
        <!-- Tickets Chart -->
        <div class="col-md-6" data-container="left-6">
            <div class="panel_s dashboard-widget">
                <div class="panel-body">
                    <div class="widget-dragger"></div>
                    <h4 class="no-margin text-center">Tổng quan Tickets</h4>
                    <hr class="hr-panel-heading-dashboard" />
                    <div class="relative" style="height: 300px">
                        <canvas id="tickets_chart_<?php echo $user_id; ?>" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Attendance Chart -->
        <div class="col-md-6" data-container="right-6">
            <div class="panel_s dashboard-widget">
                <div class="panel-body">
                    <div class="widget-dragger"></div>
                    <h4 class="no-margin text-center">Tổng quan Chuyên cần</h4>
                    <hr class="hr-panel-heading-dashboard" />
                    <div class="relative" style="height: 300px">
                        <canvas id="attendance_chart_<?php echo $user_id; ?>" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Activity and Additional Info Row -->
    <div class="row">
        <!-- Activity Log Widget -->
        <div class="col-md-8" data-container="left-8">
            <div class="panel_s dashboard-widget">
                <div class="panel-body">
                    <div class="widget-dragger"></div>
                    <h4 class="no-margin">Hoạt động gần đây</h4>
                    <hr class="hr-panel-heading-dashboard" />
                    
                    <?php
                    // Load staff activity
                    $activities = [];
                    try {
                        $CI->db->limit(10);
                        $CI->db->order_by('date', 'desc');
                        $CI->db->where('staffid', $user_id);
                        $CI->db->where('date >=', $date_from);
                        $CI->db->where('date <=', $date_to . ' 23:59:59');
                        $activities = $CI->db->get(db_prefix() . 'activity_log')->result_array();
                    } catch (Exception $e) {
                        // Fallback nếu bảng không tồn tại
                        $activities = [];
                    }
                    
                    if (count($activities) > 0) { 
                    ?>
                    <div class="activity-feed">
                        <?php foreach($activities as $activity) { ?>
                        <div class="feed-item">
                            <div class="date">
                                <span class="text-has-action" data-toggle="tooltip" data-title="<?php echo _dt($activity['date']); ?>">
                                    <?php echo time_ago($activity['date']); ?>
                                </span>
                            </div>
                            <div class="text">
                                <?php echo $activity['description']; ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="mtop15">
                        <a href="<?php echo admin_url('staff/member/' . $user_id); ?>" class="btn btn-default btn-sm">
                            Xem thông tin nhân viên
                        </a>
                    </div>
                    <?php } else { ?>
                    <div class="text-center mtop20">
                        <i class="fa fa-info-circle fa-3x text-muted"></i>
                        <p class="mtop15 text-muted">Không có hoạt động nào được tìm thấy</p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <!-- Performance Summary Widget -->
        <div class="col-md-4" data-container="right-4">
            <div class="panel_s dashboard-widget">
                <div class="panel-body">
                    <div class="widget-dragger"></div>
                    <h4 class="no-margin">Tổng kết hiệu suất</h4>
                    <hr class="hr-panel-heading-dashboard" />
                    
                    <div class="performance-summary">
                        <div class="summary-item">
                            <strong>Hiệu suất tổng thể</strong>
                            <?php 
                            $overall_score = 0;
                            $metrics_count = 0;
                            
                            if (isset($tasks['completion_rate'])) {
                                $overall_score += $tasks['completion_rate'];
                                $metrics_count++;
                            }
                            if (isset($projects['completion_rate'])) {
                                $overall_score += $projects['completion_rate'];
                                $metrics_count++;
                            }
                            if (isset($tickets['response_rate'])) {
                                $overall_score += $tickets['response_rate'];
                                $metrics_count++;
                            }
                            if (isset($attendance['attendance_rate'])) {
                                $overall_score += $attendance['attendance_rate'];
                                $metrics_count++;
                            }
                            
                            $overall_average = $metrics_count > 0 ? $overall_score / $metrics_count : 0;
                            $performance_color = 'success';
                            if ($overall_average < 50) $performance_color = 'danger';
                            elseif ($overall_average < 75) $performance_color = 'warning';
                            ?>
                            <div class="progress mtop5">
                                <div class="progress-bar progress-bar-<?php echo $performance_color; ?>" 
                                     style="width: <?php echo $overall_average; ?>%"></div>
                            </div>
                            <span class="text-<?php echo $performance_color; ?>">
                                <?php echo number_format($overall_average, 1); ?>%
                            </span>
                        </div>
                        
                        <hr>
                        
                        <div class="summary-details">
                            <div class="row">
                                <div class="col-xs-6"><strong><?php echo _l('tasks'); ?>:</strong></div>
                                <div class="col-xs-6 text-right"><?php echo isset($tasks['total']) ? $tasks['total'] : 0; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6"><strong><?php echo _l('projects'); ?>:</strong></div>
                                <div class="col-xs-6 text-right"><?php echo isset($projects['total']) ? $projects['total'] : 0; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6"><strong><?php echo _l('tickets'); ?>:</strong></div>
                                <div class="col-xs-6 text-right"><?php echo isset($tickets['total']) ? $tickets['total'] : 0; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6"><strong>Chuyên cần:</strong></div>
                                <div class="col-xs-6 text-right"><?php echo isset($attendance['present_days']) ? $attendance['present_days'] : 0; ?> ngày</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Data for Charts -->
<script>
// Dữ liệu hiệu suất cho JavaScript
var performanceData_<?php echo $user_id; ?> = <?php echo json_encode($performance); ?>;
var staffId_<?php echo $user_id; ?> = <?php echo $user_id; ?>;
var dateFrom = '<?php echo $date_from; ?>';
var dateTo = '<?php echo $date_to; ?>';

// Initialize Charts when document ready
$(document).ready(function() {
    if (typeof initPerformanceCharts === 'function') {
        initPerformanceCharts(<?php echo $user_id; ?>);
    }
});
</script> 