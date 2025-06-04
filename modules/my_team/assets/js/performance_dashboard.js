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
        
        // Apply performance level colors
        applyPerformanceColors(user_id, performance);
        
        // Tasks Chart
        var tasksChartCanvas = document.getElementById('tasks_chart_' + user_id);
        if (tasksChartCanvas) {
            var tasksChartCtx = tasksChartCanvas.getContext('2d');
            var tasksChart = new Chart(tasksChartCtx, {
                type: 'doughnut',
                data: {
                    labels: [
                        'Hoàn thành',
                        'Đang thực hiện', 
                        'Chưa bắt đầu'
                    ],
                    datasets: [{
                        data: [
                            tasks.completed || 0,
                            tasks.in_progress || 0,
                            tasks.not_started || 0
                        ],
                        backgroundColor: [
                            '#28a745',
                            '#007bff',
                            '#6c757d'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom'
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index];
                                var value = data.datasets[0].data[tooltipItem.index];
                                var total = data.datasets[0].data.reduce(function(a, b) { return a + b; }, 0);
                                var percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            });
        }
        
        // Projects Chart
        var projectsChartCanvas = document.getElementById('projects_chart_' + user_id);
        if (projectsChartCanvas) {
            var projectsChartCtx = projectsChartCanvas.getContext('2d');
            var projectsChart = new Chart(projectsChartCtx, {
                type: 'doughnut',
                data: {
                    labels: [
                        'Hoàn thành',
                        'Đang thực hiện',
                        'Chưa bắt đầu'
                    ],
                    datasets: [{
                        data: [
                            projects.completed || 0,
                            projects.in_progress || 0,
                            projects.not_started || 0
                        ],
                        backgroundColor: [
                            '#28a745',
                            '#007bff',
                            '#6c757d'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom'
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index];
                                var value = data.datasets[0].data[tooltipItem.index];
                                var total = data.datasets[0].data.reduce(function(a, b) { return a + b; }, 0);
                                var percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return label + ': ' + value + ' (' + percentage + '%)';
                            }
                        }
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
        initDetailedChartsModal();
        
        // Initialize charts
        initExistingUserDashboards();
        createDepartmentCharts();
    }
    
    // Apply performance level colors to dashboard widgets
    function applyPerformanceColors(user_id, performance) {
        var overall_score = 0;
        var metrics_count = 0;
        
        // Calculate overall performance
        ['tasks', 'projects', 'tickets', 'attendance'].forEach(function(metric) {
            if (performance[metric] && performance[metric].completion_rate !== undefined) {
                overall_score += performance[metric].completion_rate;
                metrics_count++;
            } else if (performance[metric] && performance[metric].response_rate !== undefined) {
                overall_score += performance[metric].response_rate;
                metrics_count++;
            } else if (performance[metric] && performance[metric].attendance_rate !== undefined) {
                overall_score += performance[metric].attendance_rate;
                metrics_count++;
            }
        });
        
        var overall_average = metrics_count > 0 ? overall_score / metrics_count : 0;
        var performance_class = '';
        
        if (overall_average >= 90) {
            performance_class = 'performance-excellent';
        } else if (overall_average >= 75) {
            performance_class = 'performance-good';
        } else if (overall_average >= 50) {
            performance_class = 'performance-average';
        } else {
            performance_class = 'performance-poor';
        }
        
        // Apply class to dashboard widgets
        $('.dashboard-widget').addClass(performance_class);
    }
    
    // Initialize performance charts for a specific user (called from view)
    window.initPerformanceCharts = function(user_id) {
        if (typeof window['performanceData_' + user_id] !== 'undefined') {
            var performance = window['performanceData_' + user_id];
            createUserDashboardCharts(user_id, performance);
        }
    };
    
    // Load CSS for performance dashboard
    function loadPerformanceCSS() {
        if (!$('link[href*="performance_dashboard.css"]').length) {
            $('<link/>', {
                rel: 'stylesheet',
                type: 'text/css',
                href: site_url + 'modules/my_team/assets/css/performance_dashboard.css'
            }).appendTo('head');
        }
    }
    
    // Handle detailed charts modal
    function initDetailedChartsModal() {
        $('#show-detailed-charts').on('click', function() {
            var staffId = $(this).data('staff-id');
            var staffName = $('#staff_id option:selected').text() || 'Nhân viên hiện tại';
            
            // Update modal title
            $('#modal-staff-name').text(' - ' + staffName);
            
            // Clear previous charts
            destroyModalCharts();
            
            // Show modal
            $('#detailed-charts-modal').modal('show');
            
            // Load and create detailed charts after modal is shown
            $('#detailed-charts-modal').on('shown.bs.modal', function() {
                createDetailedModalCharts(staffId);
            });
        });
        
        // Handle modal close - destroy charts to prevent memory leaks
        $('#detailed-charts-modal').on('hidden.bs.modal', function() {
            destroyModalCharts();
        });
        
        // Handle export charts
        $('#export-charts').on('click', function() {
            exportModalCharts();
        });
    }
    
    // Destroy modal charts to prevent memory leaks
    function destroyModalCharts() {
        if (window.modalTasksChart) {
            window.modalTasksChart.destroy();
            window.modalTasksChart = null;
        }
        if (window.modalProjectsChart) {
            window.modalProjectsChart.destroy();
            window.modalProjectsChart = null;
        }
        if (window.modalTicketsChart) {
            window.modalTicketsChart.destroy();
            window.modalTicketsChart = null;
        }
        if (window.modalAttendanceChart) {
            window.modalAttendanceChart.destroy();
            window.modalAttendanceChart = null;
        }
    }
    
    // Create detailed charts in modal
    function createDetailedModalCharts(staffId) {
        if (typeof Chart === 'undefined') {
            console.error('Chart.js not loaded');
            return;
        }
        
        // Show loading indicators
        showModalLoading();
        
        // Get performance data via AJAX
        $.ajax({
            url: admin_url + 'my_team/get_performance_data',
            type: 'GET',
            data: {
                staff_id: staffId,
                period: $('#period').val() || 'this_month',
                date_from: $('#date_from').val(),
                date_to: $('#date_to').val()
            },
            dataType: 'json',
            success: function(response) {
                hideModalLoading();
                
                if (response.success && response.data) {
                    var performanceData = response.data;
                    var tasks = performanceData.tasks || {};
                    var projects = performanceData.projects || {};
                    var tickets = performanceData.tickets || {};
                    var attendance = performanceData.attendance || {};
                    
                    // Update stats
                    updateModalStats(tasks, projects, tickets, attendance);
                    
                    // Create Charts
                    createModalTasksChart(tasks);
                    createModalProjectsChart(projects);
                    createModalTicketsChart(tickets);
                    createModalAttendanceChart(attendance);
                } else {
                    // Fallback to static data if available
                    var performanceData = window['performanceData_' + staffId] || {};
                    var tasks = performanceData.tasks || getDefaultTasksData();
                    var projects = performanceData.projects || getDefaultProjectsData();
                    var tickets = performanceData.tickets || getDefaultTicketsData();
                    var attendance = performanceData.attendance || getDefaultAttendanceData();
                    
                    updateModalStats(tasks, projects, tickets, attendance);
                    createModalTasksChart(tasks);
                    createModalProjectsChart(projects);
                    createModalTicketsChart(tickets);
                    createModalAttendanceChart(attendance);
                }
            },
            error: function(xhr, status, error) {
                hideModalLoading();
                console.error('Error loading performance data:', error);
                
                // Use fallback data
                var tasks = getDefaultTasksData();
                var projects = getDefaultProjectsData();
                var tickets = getDefaultTicketsData();
                var attendance = getDefaultAttendanceData();
                
                updateModalStats(tasks, projects, tickets, attendance);
                createModalTasksChart(tasks);
                createModalProjectsChart(projects);
                createModalTicketsChart(tickets);
                createModalAttendanceChart(attendance);
            }
        });
    }
    
    // Show loading indicators in modal
    function showModalLoading() {
        $('.chart-container').each(function() {
            if (!$(this).find('.chart-loading').length) {
                $(this).append('<div class="chart-loading"><i class="fa fa-spinner fa-spin"></i> Đang tải...</div>');
            }
        });
    }
    
    // Hide loading indicators in modal
    function hideModalLoading() {
        $('.chart-loading').remove();
    }
    
    // Default data functions
    function getDefaultTasksData() {
        return {
            total: 10,
            completed: 7,
            in_progress: 2,
            not_started: 1,
            completion_rate: 70.0
        };
    }
    
    function getDefaultProjectsData() {
        return {
            total: 5,
            completed: 3,
            in_progress: 1,
            not_started: 1,
            completion_rate: 60.0
        };
    }
    
    function getDefaultTicketsData() {
        return {
            total: 8,
            closed: 6,
            open: 2,
            response_rate: 75.0
        };
    }
    
    function getDefaultAttendanceData() {
        return {
            present_days: 20,
            absent_days: 2,
            late_days: 1,
            attendance_rate: 87.0
        };
    }
    
    // Update modal statistics
    function updateModalStats(tasks, projects, tickets, attendance) {
        // Tasks stats
        $('#modal-tasks-total').text(tasks.total || 0);
        $('#modal-tasks-completed').text(tasks.completed || 0);
        $('#modal-tasks-rate').text((tasks.completion_rate || 0).toFixed(1) + '%');
        
        // Projects stats
        $('#modal-projects-total').text(projects.total || 0);
        $('#modal-projects-completed').text(projects.completed || 0);
        $('#modal-projects-rate').text((projects.completion_rate || 0).toFixed(1) + '%');
        
        // Tickets stats
        $('#modal-tickets-total').text(tickets.total || 0);
        $('#modal-tickets-closed').text(tickets.closed || 0);
        $('#modal-tickets-rate').text((tickets.response_rate || 0).toFixed(1) + '%');
        
        // Attendance stats
        $('#modal-attendance-present').text(attendance.present_days || 0);
        $('#modal-attendance-absent').text(attendance.absent_days || 0);
        $('#modal-attendance-rate').text((attendance.attendance_rate || 0).toFixed(1) + '%');
    }
    
    // Create modal tasks chart
    function createModalTasksChart(tasks) {
        var ctx = document.getElementById('modal-tasks-chart');
        if (!ctx) return;
        
        // Destroy existing chart if exists
        if (window.modalTasksChart) {
            window.modalTasksChart.destroy();
        }
        
        window.modalTasksChart = new Chart(ctx.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Hoàn thành', 'Đang thực hiện', 'Chưa bắt đầu'],
                datasets: [{
                    data: [
                        tasks.completed || 0,
                        tasks.in_progress || 0,
                        tasks.not_started || 0
                    ],
                    backgroundColor: [
                        '#28a745',
                        '#007bff', 
                        '#6c757d'
                    ],
                    borderWidth: 3,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index];
                            var value = data.datasets[0].data[tooltipItem.index];
                            var total = data.datasets[0].data.reduce(function(a, b) { return a + b; }, 0);
                            var percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        });
    }
    
    // Create modal projects chart
    function createModalProjectsChart(projects) {
        var ctx = document.getElementById('modal-projects-chart');
        if (!ctx) return;
        
        // Destroy existing chart if exists
        if (window.modalProjectsChart) {
            window.modalProjectsChart.destroy();
        }
        
        window.modalProjectsChart = new Chart(ctx.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Hoàn thành', 'Đang thực hiện', 'Chưa bắt đầu'],
                datasets: [{
                    data: [
                        projects.completed || 0,
                        projects.in_progress || 0,
                        projects.not_started || 0
                    ],
                    backgroundColor: [
                        '#28a745',
                        '#007bff',
                        '#6c757d'
                    ],
                    borderWidth: 3,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index];
                            var value = data.datasets[0].data[tooltipItem.index];
                            var total = data.datasets[0].data.reduce(function(a, b) { return a + b; }, 0);
                            var percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        });
    }
    
    // Create modal tickets chart
    function createModalTicketsChart(tickets) {
        var ctx = document.getElementById('modal-tickets-chart');
        if (!ctx) return;
        
        // Destroy existing chart if exists
        if (window.modalTicketsChart) {
            window.modalTicketsChart.destroy();
        }
        
        window.modalTicketsChart = new Chart(ctx.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Đã đóng', 'Đang mở'],
                datasets: [{
                    data: [
                        tickets.closed || 0,
                        tickets.open || 0
                    ],
                    backgroundColor: [
                        '#28a745',
                        '#dc3545'
                    ],
                    borderWidth: 3,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index];
                            var value = data.datasets[0].data[tooltipItem.index];
                            var total = data.datasets[0].data.reduce(function(a, b) { return a + b; }, 0);
                            var percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        });
    }
    
    // Create modal attendance chart
    function createModalAttendanceChart(attendance) {
        var ctx = document.getElementById('modal-attendance-chart');
        if (!ctx) return;
        
        // Destroy existing chart if exists
        if (window.modalAttendanceChart) {
            window.modalAttendanceChart.destroy();
        }
        
        window.modalAttendanceChart = new Chart(ctx.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Có mặt', 'Đi muộn', 'Vắng mặt'],
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
                    ],
                    borderWidth: 3,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index];
                            var value = data.datasets[0].data[tooltipItem.index];
                            var total = data.datasets[0].data.reduce(function(a, b) { return a + b; }, 0);
                            var percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        });
    }
    
    // Export modal charts
    function exportModalCharts() {
        var charts = [
            { chart: window.modalTasksChart, name: 'tasks-chart' },
            { chart: window.modalProjectsChart, name: 'projects-chart' },
            { chart: window.modalTicketsChart, name: 'tickets-chart' },
            { chart: window.modalAttendanceChart, name: 'attendance-chart' }
        ];
        
        charts.forEach(function(item) {
            if (item.chart) {
                var link = document.createElement('a');
                link.download = item.name + '.png';
                link.href = item.chart.toBase64Image();
                link.click();
            }
        });
        
        alert_float('success', 'Biểu đồ đã được xuất thành công!');
    }
    
    // Start the initialization
    loadPerformanceCSS();
    init();
}); 