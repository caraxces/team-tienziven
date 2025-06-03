<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
/**
 * Partial view cho hiển thị các widget dashboard cho từng user
 * Tái sử dụng cho cả manager và staff view, chỉ khác user_id
 * 
 * @param int $user_id ID của staff cần hiển thị hiệu suất
 * @param array $performance Dữ liệu hiệu suất từ model
 */

$staff_data = $this->staff_model->get($user_id);
?>
<div class="panel_s user-dashboard-group" id="user_dashboard_<?php echo $user_id; ?>">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <h4 class="no-margin text-success">
                    <?php echo staff_profile_image($user_id, ['staff-profile-image-small', 'mright5'], 'small'); ?>
                    <?php echo $staff_data->firstname . ' ' . $staff_data->lastname; ?>
                    <span class="text-muted mtop5 pull-right">
                        <?php 
                        $staff_department = '';
                        if (!empty($staff_data->departmentid)) {
                            $department = $this->departments_model->get($staff_data->departmentid);
                            if ($department) {
                                $staff_department = $department->name;
                            }
                        }
                        echo $staff_department;
                        ?>
                    </span>
                </h4>
            </div>
        </div>
        <hr class="hr-panel-heading hr-10" />
        
        <!-- Activity Overview -->
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-muted mtop0"><?php echo _l('performance_overview'); ?></h4>
            </div>
        </div>
        
        <!-- Activity Stats -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box info-box-horizontal">
                    <span class="info-box-icon bg-yellow text-white"><i class="fa fa-check-square-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo _l('performance_tasks'); ?></span>
                        <span class="info-box-number"><?php echo isset($performance['tasks']['completed']) ? $performance['tasks']['completed'] : 0; ?> / <?php echo isset($performance['tasks']['total']) ? $performance['tasks']['total'] : 0; ?></span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: <?php echo isset($performance['tasks']['completion_rate']) ? $performance['tasks']['completion_rate'] : 0; ?>%"></div>
                        </div>
                        <span class="progress-description">
                            <?php echo _l('performance_task_completion_rate'); ?>: <?php echo isset($performance['tasks']['completion_rate']) ? $performance['tasks']['completion_rate'] : 0; ?>%
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box info-box-horizontal">
                    <span class="info-box-icon bg-blue text-white"><i class="fa fa-area-chart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo _l('performance_projects'); ?></span>
                        <span class="info-box-number"><?php echo isset($performance['projects']['completed']) ? $performance['projects']['completed'] : 0; ?> / <?php echo isset($performance['projects']['total']) ? $performance['projects']['total'] : 0; ?></span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: <?php echo isset($performance['projects']['completion_rate']) ? $performance['projects']['completion_rate'] : 0; ?>%"></div>
                        </div>
                        <span class="progress-description">
                            <?php echo _l('performance_project_completion_rate'); ?>: <?php echo isset($performance['projects']['completion_rate']) ? $performance['projects']['completion_rate'] : 0; ?>%
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box info-box-horizontal">
                    <span class="info-box-icon bg-green text-white"><i class="fa fa-ticket"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo _l('performance_tickets'); ?></span>
                        <span class="info-box-number"><?php echo isset($performance['tickets']['closed']) ? $performance['tickets']['closed'] : 0; ?> / <?php echo isset($performance['tickets']['total']) ? $performance['tickets']['total'] : 0; ?></span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: <?php echo isset($performance['tickets']['response_rate']) ? $performance['tickets']['response_rate'] : 0; ?>%"></div>
                        </div>
                        <span class="progress-description">
                            <?php echo _l('performance_ticket_response_rate'); ?>: <?php echo isset($performance['tickets']['response_rate']) ? $performance['tickets']['response_rate'] : 0; ?>%
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box info-box-horizontal">
                    <span class="info-box-icon bg-red text-white"><i class="fa fa-clock-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo _l('attendance_work_hours'); ?></span>
                        <span class="info-box-number"><?php echo isset($performance['timesheet']['total_hours']) ? $performance['timesheet']['total_hours'] : 0; ?> <?php echo _l('hours'); ?></span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: <?php echo isset($performance['attendance']['attendance_rate']) ? $performance['attendance']['attendance_rate'] : 0; ?>%"></div>
                        </div>
                        <span class="progress-description">
                            <?php echo _l('performance_present_days'); ?>: <?php echo isset($performance['attendance']['present_days']) ? $performance['attendance']['present_days'] : 0; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <hr class="hr-panel-heading hr-10" />
        
        <!-- Widgets -->
        <div class="row">
            <div class="col-md-6">
                <div class="panel_s">
                    <div class="panel-body padding-10">
                        <h4 class="text-center mtop5 no-margin"><?php echo _l('performance_tasks'); ?></h4>
                        <hr class="hr-panel-heading-dashboard">
                        <div class="row text-center">
                            <div class="col-md-4 col-xs-4 border-right">
                                <h3 class="bold"><?php echo isset($performance['tasks']['pending']) ? $performance['tasks']['pending'] : 0; ?></h3>
                                <span class="text-info"><?php echo _l('performance_pending_tasks'); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-4 border-right">
                                <h3 class="bold"><?php echo isset($performance['tasks']['total']) ? $performance['tasks']['total'] : 0; ?></h3>
                                <span class="text-info"><?php echo _l('performance_total_tasks'); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <h3 class="bold"><?php echo isset($performance['tasks']['completed']) ? $performance['tasks']['completed'] : 0; ?></h3>
                                <span class="text-success"><?php echo _l('performance_completed_tasks'); ?></span>
                            </div>
                        </div>
                        <hr class="hr-panel-heading-dashboard">
                        <div class="text-center">
                            <div id="tasks_chart_<?php echo $user_id; ?>" class="chart mtop10" style="height:280px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel_s">
                    <div class="panel-body padding-10">
                        <h4 class="text-center mtop5 no-margin"><?php echo _l('performance_projects'); ?></h4>
                        <hr class="hr-panel-heading-dashboard">
                        <div class="row text-center">
                            <div class="col-md-4 col-xs-4 border-right">
                                <h3 class="bold"><?php echo isset($performance['projects']['ongoing']) ? $performance['projects']['ongoing'] : 0; ?></h3>
                                <span class="text-info"><?php echo _l('performance_ongoing_projects'); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-4 border-right">
                                <h3 class="bold"><?php echo isset($performance['projects']['total']) ? $performance['projects']['total'] : 0; ?></h3>
                                <span class="text-info"><?php echo _l('performance_total_projects'); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <h3 class="bold"><?php echo isset($performance['projects']['completed']) ? $performance['projects']['completed'] : 0; ?></h3>
                                <span class="text-success"><?php echo _l('performance_completed_projects'); ?></span>
                            </div>
                        </div>
                        <hr class="hr-panel-heading-dashboard">
                        <div class="text-center">
                            <div id="projects_chart_<?php echo $user_id; ?>" class="chart mtop10" style="height:280px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="panel_s">
                    <div class="panel-body padding-10">
                        <h4 class="text-center mtop5 no-margin"><?php echo _l('performance_tickets'); ?></h4>
                        <hr class="hr-panel-heading-dashboard">
                        <div class="row text-center">
                            <div class="col-md-4 col-xs-4 border-right">
                                <h3 class="bold"><?php echo isset($performance['tickets']['open']) ? $performance['tickets']['open'] : 0; ?></h3>
                                <span class="text-info"><?php echo _l('performance_open_tickets'); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-4 border-right">
                                <h3 class="bold"><?php echo isset($performance['tickets']['total']) ? $performance['tickets']['total'] : 0; ?></h3>
                                <span class="text-info"><?php echo _l('performance_total_tickets'); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <h3 class="bold"><?php echo isset($performance['tickets']['closed']) ? $performance['tickets']['closed'] : 0; ?></h3>
                                <span class="text-success"><?php echo _l('performance_closed_tickets'); ?></span>
                            </div>
                        </div>
                        <hr class="hr-panel-heading-dashboard">
                        <div class="text-center">
                            <div id="tickets_chart_<?php echo $user_id; ?>" class="chart mtop10" style="height:280px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel_s">
                    <div class="panel-body padding-10">
                        <h4 class="text-center mtop5 no-margin"><?php echo _l('attendance_record'); ?></h4>
                        <hr class="hr-panel-heading-dashboard">
                        <div class="row text-center">
                            <div class="col-md-4 col-xs-4 border-right">
                                <h3 class="bold"><?php echo isset($performance['attendance']['present_days']) ? $performance['attendance']['present_days'] : 0; ?></h3>
                                <span class="text-success"><?php echo _l('attendance_status_present'); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-4 border-right">
                                <h3 class="bold"><?php echo isset($performance['attendance']['late_days']) ? $performance['attendance']['late_days'] : 0; ?></h3>
                                <span class="text-warning"><?php echo _l('attendance_status_late'); ?></span>
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <h3 class="bold"><?php echo isset($performance['attendance']['absent_days']) ? $performance['attendance']['absent_days'] : 0; ?></h3>
                                <span class="text-danger"><?php echo _l('attendance_status_absent'); ?></span>
                            </div>
                        </div>
                        <hr class="hr-panel-heading-dashboard">
                        <div class="text-center">
                            <div id="attendance_chart_<?php echo $user_id; ?>" class="chart mtop10" style="height:280px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    if(typeof(Chart) != 'undefined') {
        // Tasks Chart
        var tasksChartCanvas = document.getElementById('tasks_chart_<?php echo $user_id; ?>').getContext('2d');
        var tasksChart = new Chart(tasksChartCanvas, {
            type: 'pie',
            data: {
                labels: [
                    '<?php echo _l('performance_completed_tasks'); ?>',
                    '<?php echo _l('performance_pending_tasks'); ?>'
                ],
                datasets: [{
                    data: [
                        <?php echo isset($performance['tasks']['completed']) ? $performance['tasks']['completed'] : 0; ?>,
                        <?php echo isset($performance['tasks']['pending']) ? $performance['tasks']['pending'] : 0; ?>
                    ],
                    backgroundColor: [
                        '#28a745',
                        '#ffc107'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        
        // Projects Chart
        var projectsChartCanvas = document.getElementById('projects_chart_<?php echo $user_id; ?>').getContext('2d');
        var projectsChart = new Chart(projectsChartCanvas, {
            type: 'pie',
            data: {
                labels: [
                    '<?php echo _l('performance_completed_projects'); ?>',
                    '<?php echo _l('performance_ongoing_projects'); ?>'
                ],
                datasets: [{
                    data: [
                        <?php echo isset($performance['projects']['completed']) ? $performance['projects']['completed'] : 0; ?>,
                        <?php echo isset($performance['projects']['ongoing']) ? $performance['projects']['ongoing'] : 0; ?>
                    ],
                    backgroundColor: [
                        '#28a745',
                        '#007bff'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        
        // Tickets Chart
        var ticketsChartCanvas = document.getElementById('tickets_chart_<?php echo $user_id; ?>').getContext('2d');
        var ticketsChart = new Chart(ticketsChartCanvas, {
            type: 'pie',
            data: {
                labels: [
                    '<?php echo _l('performance_closed_tickets'); ?>',
                    '<?php echo _l('performance_open_tickets'); ?>'
                ],
                datasets: [{
                    data: [
                        <?php echo isset($performance['tickets']['closed']) ? $performance['tickets']['closed'] : 0; ?>,
                        <?php echo isset($performance['tickets']['open']) ? $performance['tickets']['open'] : 0; ?>
                    ],
                    backgroundColor: [
                        '#28a745',
                        '#dc3545'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        
        // Attendance Chart
        var attendanceChartCanvas = document.getElementById('attendance_chart_<?php echo $user_id; ?>').getContext('2d');
        var attendanceChart = new Chart(attendanceChartCanvas, {
            type: 'pie',
            data: {
                labels: [
                    '<?php echo _l('attendance_status_present'); ?>',
                    '<?php echo _l('attendance_status_late'); ?>',
                    '<?php echo _l('attendance_status_absent'); ?>'
                ],
                datasets: [{
                    data: [
                        <?php echo isset($performance['attendance']['present_days']) ? $performance['attendance']['present_days'] : 0; ?>,
                        <?php echo isset($performance['attendance']['late_days']) ? $performance['attendance']['late_days'] : 0; ?>,
                        <?php echo isset($performance['attendance']['absent_days']) ? $performance['attendance']['absent_days'] : 0; ?>
                    ],
                    backgroundColor: [
                        '#28a745',
                        '#ffc107',
                        '#dc3545'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
});
</script> 