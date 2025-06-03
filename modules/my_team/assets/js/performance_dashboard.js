/**
 * Performance Dashboard JS
 */

// Init module on document ready
$(function() {
    // Create charts for a single user dashboard
    function createUserDashboardCharts(user_id, performance) {
        if(typeof(Chart) == 'undefined') {
            return;
        }
        
        // Get performance data
        var tasks = performance.tasks || {};
        var projects = performance.projects || {};
        var tickets = performance.tickets || {};
        var attendance = performance.attendance || {};
        
        // Tasks Chart
        var tasksChartCanvas = document.getElementById('tasks_chart_' + user_id);
        if (tasksChartCanvas) {
            var tasksChartCtx = tasksChartCanvas.getContext('2d');
            var tasksChart = new Chart(tasksChartCtx, {
                type: 'pie',
                data: {
                    labels: [
                        app.lang.performance_completed_tasks || 'Completed Tasks',
                        app.lang.performance_pending_tasks || 'Pending Tasks'
                    ],
                    datasets: [{
                        data: [
                            tasks.completed || 0,
                            tasks.pending || 0
                        ],
                        backgroundColor: [
                            '#28a745',
                            '#ffc107'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        }
        
        // Projects Chart
        var projectsChartCanvas = document.getElementById('projects_chart_' + user_id);
        if (projectsChartCanvas) {
            var projectsChartCtx = projectsChartCanvas.getContext('2d');
            var projectsChart = new Chart(projectsChartCtx, {
                type: 'pie',
                data: {
                    labels: [
                        app.lang.performance_completed_projects || 'Completed Projects',
                        app.lang.performance_ongoing_projects || 'Ongoing Projects'
                    ],
                    datasets: [{
                        data: [
                            projects.completed || 0,
                            projects.ongoing || 0
                        ],
                        backgroundColor: [
                            '#28a745',
                            '#007bff'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        }
        
        // Tickets Chart
        var ticketsChartCanvas = document.getElementById('tickets_chart_' + user_id);
        if (ticketsChartCanvas) {
            var ticketsChartCtx = ticketsChartCanvas.getContext('2d');
            var ticketsChart = new Chart(ticketsChartCtx, {
                type: 'pie',
                data: {
                    labels: [
                        app.lang.performance_closed_tickets || 'Closed Tickets',
                        app.lang.performance_open_tickets || 'Open Tickets'
                    ],
                    datasets: [{
                        data: [
                            tickets.closed || 0,
                            tickets.open || 0
                        ],
                        backgroundColor: [
                            '#28a745',
                            '#dc3545'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        }
        
        // Attendance Chart
        var attendanceChartCanvas = document.getElementById('attendance_chart_' + user_id);
        if (attendanceChartCanvas) {
            var attendanceChartCtx = attendanceChartCanvas.getContext('2d');
            var attendanceChart = new Chart(attendanceChartCtx, {
                type: 'pie',
                data: {
                    labels: [
                        app.lang.attendance_status_present || 'Present',
                        app.lang.attendance_status_late || 'Late',
                        app.lang.attendance_status_absent || 'Absent'
                    ],
                    datasets: [{
                        data: [
                            attendance.present_days || 0,
                            attendance.late_days || 0,
                            attendance.absent_days || 0
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
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        }
    }
    
    // Create charts for department overview
    function createDepartmentCharts() {
        if(typeof(Chart) == 'undefined') {
            return;
        }
        
        $('.department-chart').each(function() {
            var chartId = $(this).attr('id');
            var departmentId = chartId.replace('department_chart_', '');
            
            // Get data attributes
            var staffCount = parseInt($(this).data('staff-count') || 0);
            var projectsCount = parseInt($(this).data('projects-count') || 0);
            var tasksCount = parseInt($(this).data('tasks-count') || 0);
            var ticketsCount = parseInt($(this).data('tickets-count') || 0);
            
            var ctx = this.getContext('2d');
            var departmentChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        app.lang.staff || 'Staff',
                        app.lang.projects || 'Projects',
                        app.lang.tasks || 'Tasks',
                        app.lang.tickets || 'Tickets'
                    ],
                    datasets: [{
                        label: app.lang.count || 'Count',
                        data: [
                            staffCount,
                            projectsCount,
                            tasksCount,
                            ticketsCount
                        ],
                        backgroundColor: [
                            '#007bff',
                            '#28a745',
                            '#ffc107',
                            '#dc3545'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });
    }
    
    // Load performance data for a user via AJAX
    function loadUserPerformanceData(user_id, callback) {
        if (!user_id) {
            return;
        }
        
        // Get period filter values
        var period = $('#period').val() || 'this_month';
        var date_from = '';
        var date_to = '';
        
        if (period === 'custom') {
            var date_range = $('#date_range').val();
            if (date_range) {
                var date_parts = date_range.split(' - ');
                if (date_parts.length === 2) {
                    date_from = moment(date_parts[0], 'DD/MM/YYYY').format('YYYY-MM-DD');
                    date_to = moment(date_parts[1], 'DD/MM/YYYY').format('YYYY-MM-DD');
                }
            }
        }
        
        // Show loading
        $('#user_dashboard_' + user_id).addClass('loading');
        
        // Fetch data
        $.ajax({
            url: admin_url + 'my_team/get_performance_data',
            type: 'GET',
            dataType: 'json',
            data: {
                staff_id: user_id,
                period: period,
                date_from: date_from,
                date_to: date_to
            },
            success: function(response) {
                if (response.success) {
                    // Remove loading
                    $('#user_dashboard_' + user_id).removeClass('loading');
                    
                    // Handle the data
                    if (typeof callback === 'function') {
                        callback(response.data);
                    }
                } else {
                    // Show error
                    alert_float('danger', response.message || app.lang.error_loading_data);
                    $('#user_dashboard_' + user_id).removeClass('loading');
                }
            },
            error: function() {
                alert_float('danger', app.lang.error_loading_data);
                $('#user_dashboard_' + user_id).removeClass('loading');
            }
        });
    }
    
    // Handle staff selection on manager view
    function handleStaffSelection() {
        $('#staff_id').on('change', function() {
            var staff_id = $(this).val();
            if (!staff_id) {
                return;
            }
            
            // Redirect to the selected staff's performance page
            var url = admin_url + 'my_team/performance?staff_id=' + staff_id;
            
            // Include period filters if they exist
            var period = $('#period').val();
            if (period) {
                url += '&period=' + period;
                
                if (period === 'custom') {
                    var date_range = $('#date_range').val();
                    if (date_range) {
                        var date_parts = date_range.split(' - ');
                        if (date_parts.length === 2) {
                            var date_from = moment(date_parts[0], 'DD/MM/YYYY').format('YYYY-MM-DD');
                            var date_to = moment(date_parts[1], 'DD/MM/YYYY').format('YYYY-MM-DD');
                            url += '&date_from=' + date_from + '&date_to=' + date_to;
                        }
                    }
                }
            }
            
            window.location.href = url;
        });
    }
    
    // Handle period filter changes
    function handlePeriodChanges() {
        $('#period').on('change', function() {
            var value = $(this).val();
            if (value === 'custom') {
                $('.custom-date-picker').show();
            } else {
                $('.custom-date-picker').hide();
                
                // Auto submit form when period changes
                $('#filter-form').submit();
            }
        });
    }
    
    // Initialize date range picker
    function initDateRangePicker() {
        $('input.date-range-picker').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear',
                applyLabel: app.lang.apply || 'Apply',
                cancelLabel: app.lang.cancel || 'Cancel',
                fromLabel: app.lang.from || 'From',
                toLabel: app.lang.to || 'To',
                customRangeLabel: app.lang.custom || 'Custom',
                daysOfWeek: [
                    app.lang.Sunday_short || 'Su',
                    app.lang.Monday_short || 'Mo',
                    app.lang.Tuesday_short || 'Tu',
                    app.lang.Wednesday_short || 'We',
                    app.lang.Thursday_short || 'Th',
                    app.lang.Friday_short || 'Fr',
                    app.lang.Saturday_short || 'Sa'
                ],
                monthNames: [
                    app.lang.January || 'January',
                    app.lang.February || 'February',
                    app.lang.March || 'March',
                    app.lang.April || 'April',
                    app.lang.May || 'May',
                    app.lang.June || 'June',
                    app.lang.July || 'July',
                    app.lang.August || 'August',
                    app.lang.September || 'September',
                    app.lang.October || 'October',
                    app.lang.November || 'November',
                    app.lang.December || 'December'
                ],
                firstDay: app.options.calendar_first_day || 0
            }
        });
        
        $('input.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            
            // Optionally auto-submit form when date range is selected
            // $('#filter-form').submit();
        });
        
        $('input.date-range-picker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    }
    
    // Initialize filters from URL
    function initFiltersFromURL() {
        var urlParams = new URLSearchParams(window.location.search);
        
        if (urlParams.has('period')) {
            $('#period').val(urlParams.get('period')).selectpicker('refresh');
            if (urlParams.get('period') === 'custom') {
                $('.custom-date-picker').show();
            }
        }
        
        if (urlParams.has('date_from') && urlParams.has('date_to')) {
            var dateFrom = moment(urlParams.get('date_from'), 'YYYY-MM-DD').format('DD/MM/YYYY');
            var dateTo = moment(urlParams.get('date_to'), 'YYYY-MM-DD').format('DD/MM/YYYY');
            $('#date_range').val(dateFrom + ' - ' + dateTo);
        }
    }
    
    // Initialize existing user dashboards
    function initExistingUserDashboards() {
        $('.user-dashboard-group').each(function() {
            var user_id = $(this).attr('id').replace('user_dashboard_', '');
            var performance = window['userPerformance_' + user_id] || {};
            
            // Create charts for this dashboard
            createUserDashboardCharts(user_id, performance);
        });
    }
    
    // Initialize everything
    function init() {
        // Initialize UI components
        initDateRangePicker();
        handlePeriodChanges();
        handleStaffSelection();
        initFiltersFromURL();
        
        // Initialize charts
        initExistingUserDashboards();
        createDepartmentCharts();
    }
    
    // Start the initialization
    init();
}); 