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
                                    <?php echo _l('performance_charts_for'); ?>: <?php echo $member->firstname . ' ' . $member->lastname; ?>
                                </h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="<?php echo admin_url('my_team/view_member/' . $member->staffid); ?>" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> <?php echo _l('back_to_profile'); ?>
                                </a>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Filter -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo form_open(admin_url('my_team/performance_charts/' . $member->staffid), ['method' => 'get', 'id' => 'filter-form']); ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="period"><?php echo _l('period_datepicker'); ?></label>
                                            <select name="period" id="period" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                <option value="last_30_days" <?php if ($period == 'last_30_days') { echo 'selected'; } ?>><?php echo _l('last_30_days'); ?></option>
                                                <option value="this_month" <?php if ($period == 'this_month') { echo 'selected'; } ?>><?php echo _l('this_month'); ?></option>
                                                <option value="last_month" <?php if ($period == 'last_month') { echo 'selected'; } ?>><?php echo _l('last_month'); ?></option>
                                                <option value="this_year" <?php if ($period == 'this_year') { echo 'selected'; } ?>><?php echo _l('this_year'); ?></option>
                                                <option value="last_year" <?php if ($period == 'last_year') { echo 'selected'; } ?>><?php echo _l('last_year'); ?></option>
                                                <option value="custom" <?php if ($period == 'custom') { echo 'selected'; } ?>><?php echo _l('period_datepicker_custom'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 <?php if ($period != 'custom') { echo 'hide'; } ?>" id="custom-date-picker">
                                        <div class="form-group">
                                            <label for="date_range"><?php echo _l('date_range'); ?></label>
                                            <div class="input-group date-range-picker">
                                                <input type="text" name="date_range" id="date_range" class="form-control date-range-picker" value="<?php echo $date_range; ?>" autocomplete="off">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="chart_type"><?php echo _l('chart_type'); ?></label>
                                            <select name="chart_type" id="chart_type" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                <option value="line" <?php if ($chart_type == 'line') { echo 'selected'; } ?>><?php echo _l('chart_type_line'); ?></option>
                                                <option value="bar" <?php if ($chart_type == 'bar') { echo 'selected'; } ?>><?php echo _l('chart_type_bar'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-info"><?php echo _l('apply_filter'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        
                        <hr class="hr-panel-heading" />
                        
                        <!-- Charts -->
                        <div class="row">
                            <!-- Task Completion -->
                            <div class="col-md-6">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('task_completion'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        <div class="relative" style="height: 300px">
                                            <canvas id="task-completion-chart" height="300"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Project Status -->
                            <div class="col-md-6">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('project_status'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        <div class="relative" style="height: 300px">
                                            <canvas id="project-status-chart" height="300"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- Attendance Overview -->
                            <div class="col-md-6">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('attendance_overview'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        <div class="relative" style="height: 300px">
                                            <canvas id="attendance-chart" height="300"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Ticket Support -->
                            <div class="col-md-6">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('ticket_resolution_time'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        <div class="relative" style="height: 300px">
                                            <canvas id="ticket-time-chart" height="300"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Performance Summary -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('performance_summary'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6 text-center">
                                                <h3 class="bold"><?php echo $completion_rate; ?>%</h3>
                                                <p class="text-muted"><?php echo _l('task_completion_rate'); ?></p>
                                                <div class="progress mtop5">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $completion_rate; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $completion_rate; ?>%"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 text-center">
                                                <h3 class="bold"><?php echo $avg_task_time; ?></h3>
                                                <p class="text-muted"><?php echo _l('avg_task_time'); ?></p>
                                            </div>
                                            <div class="col-md-3 col-sm-6 text-center">
                                                <h3 class="bold"><?php echo $attendance_rate; ?>%</h3>
                                                <p class="text-muted"><?php echo _l('attendance_rate'); ?></p>
                                                <div class="progress mtop5">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $attendance_rate; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $attendance_rate; ?>%"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 text-center">
                                                <h3 class="bold"><?php echo $ticket_response_time; ?></h3>
                                                <p class="text-muted"><?php echo _l('avg_ticket_response_time'); ?></p>
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
<script src="<?php echo base_url('assets/plugins/Chart.js/Chart.min.js'); ?>"></script>
<script>
$(function() {
    // Period select change
    $('#period').on('change', function() {
        if ($(this).val() === 'custom') {
            $('#custom-date-picker').removeClass('hide');
        } else {
            $('#custom-date-picker').addClass('hide');
            $('#filter-form').submit();
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
    
    // Render Charts
    var chartType = '<?php echo $chart_type; ?>';
    var chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };

    var defaultOptions = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'bottom',
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: '<?php echo _l("date"); ?>'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: '<?php echo _l("count"); ?>'
                },
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    // Task Completion Chart
    var taskChartCanvas = document.getElementById('task-completion-chart').getContext('2d');
    var taskChart = new Chart(taskChartCanvas, {
        type: chartType,
        data: {
            labels: <?php echo json_encode($task_labels); ?>,
            datasets: [{
                label: '<?php echo _l("completed_tasks"); ?>',
                data: <?php echo json_encode($task_data['completed']); ?>,
                backgroundColor: chartColors.green,
                borderColor: chartColors.green,
                fill: false
            }, {
                label: '<?php echo _l("new_tasks"); ?>',
                data: <?php echo json_encode($task_data['new']); ?>,
                backgroundColor: chartColors.blue,
                borderColor: chartColors.blue,
                fill: false
            }]
        },
        options: defaultOptions
    });

    // Project Status Chart
    var projectChartCanvas = document.getElementById('project-status-chart').getContext('2d');
    var projectChart = new Chart(projectChartCanvas, {
        type: chartType,
        data: {
            labels: <?php echo json_encode($project_labels); ?>,
            datasets: [{
                label: '<?php echo _l("active_projects"); ?>',
                data: <?php echo json_encode($project_data['active']); ?>,
                backgroundColor: chartColors.blue,
                borderColor: chartColors.blue,
                fill: false
            }, {
                label: '<?php echo _l("completed_projects"); ?>',
                data: <?php echo json_encode($project_data['completed']); ?>,
                backgroundColor: chartColors.green,
                borderColor: chartColors.green,
                fill: false
            }]
        },
        options: defaultOptions
    });

    // Attendance Chart
    var attendanceChartCanvas = document.getElementById('attendance-chart').getContext('2d');
    var attendanceChart = new Chart(attendanceChartCanvas, {
        type: chartType,
        data: {
            labels: <?php echo json_encode($attendance_labels); ?>,
            datasets: [{
                label: '<?php echo _l("attendance_working_hours"); ?>',
                data: <?php echo json_encode($attendance_data['hours']); ?>,
                backgroundColor: chartColors.purple,
                borderColor: chartColors.purple,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: '<?php echo _l("date"); ?>'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: '<?php echo _l("hours"); ?>'
                    },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // Ticket Time Chart
    var ticketChartCanvas = document.getElementById('ticket-time-chart').getContext('2d');
    var ticketChart = new Chart(ticketChartCanvas, {
        type: chartType,
        data: {
            labels: <?php echo json_encode($ticket_labels); ?>,
            datasets: [{
                label: '<?php echo _l("response_time_hours"); ?>',
                data: <?php echo json_encode($ticket_data['response_time']); ?>,
                backgroundColor: chartColors.orange,
                borderColor: chartColors.orange,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: '<?php echo _l("date"); ?>'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: '<?php echo _l("hours"); ?>'
                    },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
});
</script> 