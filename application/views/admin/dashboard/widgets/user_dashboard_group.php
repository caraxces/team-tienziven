<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
/**
 * Partial view hiển thị dashboard cho người dùng
 * 
 * @param int $user_id ID của người dùng
 * @param array $performance Dữ liệu hiệu suất từ model
 */

$CI = &get_instance();
$staff = $CI->staff_model->get($user_id);

// Giá trị mặc định cho các biến
$tasks = $performance['tasks'] ?? [];
$projects = $performance['projects'] ?? [];
$tickets = $performance['tickets'] ?? [];
$attendance = $performance['attendance'] ?? [];
$timesheet = $performance['timesheet'] ?? [];

// Chuẩn bị dữ liệu cho JavaScript
?>
<script>
// Dữ liệu hiệu suất cho người dùng này
var userPerformance_<?php echo $user_id; ?> = <?php echo json_encode($performance); ?>;
</script>

<div class="panel_s user-dashboard-widget" id="user_dashboard_widget_<?php echo $user_id; ?>">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
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
                </h4>
            </div>
        </div>
        <hr class="hr-panel-heading-dashboard" />
        
        <!-- Overview Section -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-tasks"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo _l('performance_tasks'); ?></span>
                        <span class="info-box-number">
                            <?php echo isset($tasks['completed']) ? $tasks['completed'] : 0; ?> / <?php echo isset($tasks['total']) ? $tasks['total'] : 0; ?>
                        </span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: <?php echo isset($tasks['completion_rate']) ? $tasks['completion_rate'] : 0; ?>%"></div>
                        </div>
                        <span class="progress-description">
                            <?php echo _l('performance_task_completion_rate'); ?>: <?php echo isset($tasks['completion_rate']) ? number_format($tasks['completion_rate'], 2) : 0; ?>%
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-line-chart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo _l('performance_projects'); ?></span>
                        <span class="info-box-number">
                            <?php echo isset($projects['completed']) ? $projects['completed'] : 0; ?> / <?php echo isset($projects['total']) ? $projects['total'] : 0; ?>
                        </span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: <?php echo isset($projects['completion_rate']) ? $projects['completion_rate'] : 0; ?>%"></div>
                        </div>
                        <span class="progress-description">
                            <?php echo _l('performance_project_completion_rate'); ?>: <?php echo isset($projects['completion_rate']) ? number_format($projects['completion_rate'], 2) : 0; ?>%
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-ticket"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo _l('performance_tickets'); ?></span>
                        <span class="info-box-number">
                            <?php echo isset($tickets['closed']) ? $tickets['closed'] : 0; ?> / <?php echo isset($tickets['total']) ? $tickets['total'] : 0; ?>
                        </span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: <?php echo isset($tickets['response_rate']) ? $tickets['response_rate'] : 0; ?>%"></div>
                        </div>
                        <span class="progress-description">
                            <?php echo _l('performance_ticket_response_rate'); ?>: <?php echo isset($tickets['response_rate']) ? number_format($tickets['response_rate'], 2) : 0; ?>%
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo _l('attendance_record'); ?></span>
                        <span class="info-box-number">
                            <?php echo isset($attendance['present_days']) ? $attendance['present_days'] : 0; ?> / <?php echo isset($attendance['present_days']) + (isset($attendance['absent_days']) ? $attendance['absent_days'] : 0) + (isset($attendance['late_days']) ? $attendance['late_days'] : 0); ?>
                        </span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: <?php echo isset($attendance['attendance_rate']) ? $attendance['attendance_rate'] : 0; ?>%"></div>
                        </div>
                        <span class="progress-description">
                            <?php echo _l('attendance_rate'); ?>: <?php echo isset($attendance['attendance_rate']) ? number_format($attendance['attendance_rate'], 2) : 0; ?>%
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Charts Section -->
        <div class="row mtop15">
            <div class="col-md-6">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin text-center"><?php echo _l('performance_tasks'); ?></h4>
                        <hr class="hr-panel-heading-dashboard" />
                        <div class="relative" style="height: 250px">
                            <canvas id="tasks_chart_<?php echo $user_id; ?>" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin text-center"><?php echo _l('performance_projects'); ?></h4>
                        <hr class="hr-panel-heading-dashboard" />
                        <div class="relative" style="height: 250px">
                            <canvas id="projects_chart_<?php echo $user_id; ?>" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin text-center"><?php echo _l('performance_tickets'); ?></h4>
                        <hr class="hr-panel-heading-dashboard" />
                        <div class="relative" style="height: 250px">
                            <canvas id="tickets_chart_<?php echo $user_id; ?>" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin text-center"><?php echo _l('attendance_record'); ?></h4>
                        <hr class="hr-panel-heading-dashboard" />
                        <div class="relative" style="height: 250px">
                            <canvas id="attendance_chart_<?php echo $user_id; ?>" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Activity Section -->
        <div class="row mtop15">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('performance_activity_log'); ?></h4>
                        <hr class="hr-panel-heading-dashboard" />
                        
                        <?php
                        // Load staff activity
                        $CI->load->model('staff_model');
                        $activities = $CI->staff_model->get_staff_activity($user_id, 5);
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
                        <div class="mtop15"></div>
                        <a href="<?php echo admin_url('staff/member/' . $user_id . '/activity'); ?>" class="btn btn-default btn-sm">
                            <?php echo _l('view_all'); ?>
                        </a>
                        <?php } else { ?>
                        <div class="text-center mtop20">
                            <i class="fa fa-info-circle fa-3x text-muted"></i>
                            <p class="mtop15 text-muted"><?php echo _l('no_activity_found'); ?></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 