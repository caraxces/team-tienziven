/**
 * Performance Dashboard JavaScript
 * Dependencies: Chart.js
 */

$(function() {
    'use strict';
    
    // Initialize performance dashboard
    initializePerformanceDashboard();
    
    // Handle period changes
    $('#period').on('change', function() {
        var value = $(this).val();
        if (value == 'custom') {
            $('.custom-date-picker').show();
        } else {
            $('.custom-date-picker').hide();
            $('#filter-form').submit();
        }
    });
    
    // Handle staff selection
    $('#staff_id').on('change', function() {
        $('#filter-form').submit();
    });
    
    // Handle date range changes
    $('input.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format(app.options.date_format) + ' - ' + picker.endDate.format(app.options.date_format));
        if ($('#period').val() == 'custom') {
            $('#filter-form').submit();
        }
    });
});

/**
 * Initialize the performance dashboard
 */
function initializePerformanceDashboard() {
    // Get staff ID from the URL
    var urlParams = new URLSearchParams(window.location.search);
    var staffId = urlParams.get('staff_id') || '0';
    
    // Render charts for each section
    renderTasksChart(staffId);
    renderProjectsChart(staffId);
    renderTicketsChart(staffId);
    renderAttendanceChart(staffId);
    renderTimeTrackedChart(staffId);
}

/**
 * Render tasks completion chart
 * @param {string} staffId 
 */
function renderTasksChart(staffId) {
    if (!window['userPerformance_' + staffId] || $('#tasks_chart_' + staffId).length === 0) {
        return;
    }
    
    var ctx = document.getElementById('tasks_chart_' + staffId).getContext('2d');
    var tasks = window['userPerformance_' + staffId].tasks;
    
    // Prepare data for chart
    var labels = tasks.monthly_stats ? Object.keys(tasks.monthly_stats) : [];
    var completedData = [];
    var assignedData = [];
    
    if (tasks.monthly_stats) {
        for (var month in tasks.monthly_stats) {
            completedData.push(tasks.monthly_stats[month].completed || 0);
            assignedData.push(tasks.monthly_stats[month].assigned || 0);
        }
    }
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: app.lang.tasks_assigned,
                    data: assignedData,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1
                },
                {
                    label: app.lang.tasks_completed,
                    data: completedData,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
}

/**
 * Render projects chart
 * @param {string} staffId 
 */
function renderProjectsChart(staffId) {
    if (!window['userPerformance_' + staffId] || $('#projects_chart_' + staffId).length === 0) {
        return;
    }
    
    var ctx = document.getElementById('projects_chart_' + staffId).getContext('2d');
    var projects = window['userPerformance_' + staffId].projects;
    
    // Create status distribution chart
    var statusLabels = [];
    var statusData = [];
    var backgroundColors = [
        'rgba(54, 162, 235, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(255, 206, 86, 0.8)',
        'rgba(255, 99, 132, 0.8)',
        'rgba(153, 102, 255, 0.8)'
    ];
    
    if (projects.status_stats) {
        for (var status in projects.status_stats) {
            statusLabels.push(status);
            statusData.push(projects.status_stats[status]);
        }
    }
    
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusData,
                backgroundColor: backgroundColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'right'
            }
        }
    });
}

/**
 * Render tickets chart
 * @param {string} staffId 
 */
function renderTicketsChart(staffId) {
    if (!window['userPerformance_' + staffId] || $('#tickets_chart_' + staffId).length === 0) {
        return;
    }
    
    var ctx = document.getElementById('tickets_chart_' + staffId).getContext('2d');
    var tickets = window['userPerformance_' + staffId].tickets;
    
    // Prepare data for chart
    var labels = [];
    var responseTimeData = [];
    
    if (tickets.monthly_stats) {
        for (var month in tickets.monthly_stats) {
            labels.push(month);
            responseTimeData.push(tickets.monthly_stats[month].avg_response_time || 0);
        }
    }
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: app.lang.ticket_avg_response_time_hours,
                data: responseTimeData,
                fill: false,
                borderColor: 'rgb(255, 99, 132)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

/**
 * Render attendance chart
 * @param {string} staffId 
 */
function renderAttendanceChart(staffId) {
    if (!window['userPerformance_' + staffId] || $('#attendance_chart_' + staffId).length === 0) {
        return;
    }
    
    var ctx = document.getElementById('attendance_chart_' + staffId).getContext('2d');
    var attendance = window['userPerformance_' + staffId].attendance;
    
    // Prepare data for chart
    var data = {
        labels: ['Present', 'Late', 'Absent', 'On Leave'],
        datasets: [{
            data: [
                attendance.present_days || 0,
                attendance.late_days || 0,
                attendance.absent_days || 0,
                attendance.leave_days || 0
            ],
            backgroundColor: [
                'rgba(75, 192, 192, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(255, 99, 132, 0.8)',
                'rgba(54, 162, 235, 0.8)'
            ],
            borderWidth: 1
        }]
    };
    
    new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'right'
            }
        }
    });
}

/**
 * Render time tracked chart
 * @param {string} staffId 
 */
function renderTimeTrackedChart(staffId) {
    if (!window['userPerformance_' + staffId] || !$('#timesheet_chart_' + staffId).length) {
        return;
    }
    
    var ctx = document.getElementById('timesheet_chart_' + staffId).getContext('2d');
    var timesheet = window['userPerformance_' + staffId].timesheet;
    
    // Prepare data for chart
    var labels = [];
    var timeData = [];
    
    if (timesheet && timesheet.weekly_stats) {
        for (var week in timesheet.weekly_stats) {
            labels.push(week);
            timeData.push(timesheet.weekly_stats[week].total_hours || 0);
        }
    }
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: app.lang.hours_tracked,
                data: timeData,
                backgroundColor: 'rgba(153, 102, 255, 0.8)',
                borderColor: 'rgb(153, 102, 255)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

/**
 * Load performance data via AJAX
 * @param {int} staffId 
 * @param {string} period 
 * @param {string} dateFrom 
 * @param {string} dateTo 
 */
function loadPerformanceData(staffId, period, dateFrom, dateTo) {
    var $container = $('#staff_performance_container');
    $container.html('<div class="text-center mtop30"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
    
    $.ajax({
        url: admin_url + 'my_team/get_performance_data',
        type: 'GET',
        data: {
            staff_id: staffId,
            period: period,
            date_from: dateFrom,
            date_to: dateTo
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                window['userPerformance_' + staffId] = response.data;
                renderTasksChart(staffId);
                renderProjectsChart(staffId);
                renderTicketsChart(staffId);
                renderAttendanceChart(staffId);
                renderTimeTrackedChart(staffId);
            } else {
                $container.html('<div class="alert alert-danger">' + response.message + '</div>');
            }
        },
        error: function() {
            $container.html('<div class="alert alert-danger">Error loading performance data</div>');
        }
    });
} 