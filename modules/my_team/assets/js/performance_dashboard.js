/**
 * Performance Dashboard JS
 * Xử lý khởi tạo datatable và các widget trên trang performance
 */
$(function() {
    // Khởi tạo các charts và widgets
    initPerformanceDashboard();
    
    // Khởi tạo sidebar menu
    initSidebarMenu();
    
    // Khởi tạo calendar
    initCalendar();
});

/**
 * Khởi tạo performance dashboard
 */
function initPerformanceDashboard() {
    // Xử lý nút refresh
    $('.btn-refresh').on('click', function(e) {
        e.preventDefault();
        window.location.reload();
    });
    
    // Khởi tạo các datatable
    initUserDatatables();
}

/**
 * Khởi tạo FullCalendar
 */
function initCalendar() {
    var calendar_selector = $('#calendar');
    if (calendar_selector.length > 0) {
        var calendarEl = calendar_selector[0];
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            editable: true,
            dayMaxEventRows: true,
            views: {
                dayGridMonth: {
                    dayMaxEventRows: 3
                }
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            events: function(fetchInfo, successCallback, failureCallback) {
                $.getJSON(admin_url + 'utilities/get_calendar_data', {
                    start: fetchInfo.startStr,
                    end: fetchInfo.endStr,
                    calendar_filters: true
                }, function(response) {
                    successCallback(response);
                });
            }
        });
        calendar.render();
    }
    
    // Khởi tạo datatables cần thiết cho trang manager view
    initDataTable('.table-staff-tasks-performance', admin_url + 'tasks/table', undefined, undefined, undefined, [2, 'asc']);
    initDataTable('.table-staff-projects-performance', admin_url + 'projects/table', undefined, undefined, undefined, [3, 'desc']);
    initDataTable('.table-my-reminders-performance', admin_url + 'misc/reminders_table', undefined, undefined, undefined, [2, 'asc']);
    initDataTable('.table-tickets-list-performance', admin_url + 'tickets/table', undefined, undefined, undefined, [4, 'desc']);
}

/**
 * Khởi tạo tất cả các datatable cho từng user
 */
function initUserDatatables() {
    // Tìm tất cả các bảng tasks
    $('.table-staff-tasks-performance-').each(function() {
        var tableId = $(this).attr('id') || $(this).data('table-id');
        var userId = $(this).data('user-id') || $(this).closest('[data-user-id]').data('user-id');
        
        if (!userId) {
            // Thử lấy từ class name
            var className = $(this).attr('class');
            var match = className.match(/table-staff-tasks-performance-(\d+)/);
            if (match && match[1]) {
                userId = match[1];
            }
        }
        
        if (userId) {
            initDataTable($(this).hasClass('dt-table') ? '.dt-table' : '.' + $(this).attr('class').split(' ').join('.'), 
                admin_url + 'tasks/table?staffid=' + userId, 
                undefined, undefined, undefined, [2, 'asc']);
        }
    });
    
    // Khởi tạo datatable cho projects
    $('.table-staff-projects-performance-').each(function() {
        var tableId = $(this).attr('id') || $(this).data('table-id');
        var userId = $(this).data('user-id') || $(this).closest('[data-user-id]').data('user-id');
        
        if (!userId) {
            // Thử lấy từ class name
            var className = $(this).attr('class');
            var match = className.match(/table-staff-projects-performance-(\d+)/);
            if (match && match[1]) {
                userId = match[1];
            }
        }
        
        if (userId) {
            initDataTable($(this).hasClass('dt-table') ? '.dt-table' : '.' + $(this).attr('class').split(' ').join('.'), 
                admin_url + 'projects/table?staffid=' + userId, 
                undefined, undefined, undefined, [3, 'desc']);
        }
    });
    
    // Khởi tạo datatable cho tickets
    $('.table-tickets-list-performance-').each(function() {
        var tableId = $(this).attr('id') || $(this).data('table-id');
        var userId = $(this).data('user-id') || $(this).closest('[data-user-id]').data('user-id');
        
        if (!userId) {
            // Thử lấy từ class name
            var className = $(this).attr('class');
            var match = className.match(/table-tickets-list-performance-(\d+)/);
            if (match && match[1]) {
                userId = match[1];
            }
        }
        
        if (userId) {
            initDataTable($(this).hasClass('dt-table') ? '.dt-table' : '.' + $(this).attr('class').split(' ').join('.'), 
                admin_url + 'tickets/table?staffid=' + userId, 
                undefined, undefined, undefined, [4, 'desc']);
        }
    });
}

/**
 * Fix sidebar menu for My Team module
 */
function initSidebarMenu() {
    // Đảm bảo menu được mở rộng và mục hiện tại được đánh dấu
    setTimeout(function() {
        // Đánh dấu mục My Team là active
        $('li.menu-item-my-team').addClass('active');
        
        // Mở rộng submenu của My Team
        $('li.menu-item-my-team > ul.nav-second-level').addClass('in').css('display', 'block');
        
        // Đánh dấu submenu hiện tại là active dựa vào URL
        var currentUrl = window.location.href;
        
        if (currentUrl.indexOf('my_team/performance') > -1) {
            $('#my-team-performance').addClass('active');
        } else if (currentUrl.indexOf('my_team/approvals') > -1) {
            $('#my-team-approvals').addClass('active');
        } else if (currentUrl.indexOf('my_team/knowledge') > -1) {
            $('#my-team-knowledge').addClass('active');
        } else {
            $('#my-team-members').addClass('active');
        }
        
        // Khắc phục lỗi arrow không click được
        $('.arrow').off('click').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $this = $(this);
            var li = $this.closest('li');
            
            if (li.hasClass('active')) {
                li.removeClass('active');
                $('ul.nav-second-level', li).slideUp(200);
            } else {
                li.addClass('active');
                $('ul.nav-second-level', li).slideDown(200);
            }
        });
    }, 500);
} 