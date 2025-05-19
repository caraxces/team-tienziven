/* My Team Module JavaScript */
$(function() {
    initMyTeam();
    
    // Khởi tạo sidebar nếu đang ở trang my_team
    if (window.location.href.indexOf('my_team') > -1) {
        initSidebarMenu();
    }
    
    // Khởi tạo các datatable nếu đang ở trang performance
    if (window.location.href.indexOf('my_team/performance') > -1) {
        initPerformanceDatatables();
    }
});

/**
 * Initialize all My Team functionality
 */
function initMyTeam() {
    // Initialize datatables
    if($.fn.DataTable) {
        $('.my-team-table').dataTable({
            "order": [[0, "asc"]],
            "pageLength": 25,
            "responsive": true
        });
    }
    
    // Handle approval actions
    $('.approve-btn').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        if(confirm(app.lang.confirm_action_prompt)) {
            window.location.href = url;
        }
    });
    
    $('.reject-btn').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        if(confirm(app.lang.confirm_action_prompt)) {
            window.location.href = url;
        }
    });
    
    // Initialize calendar for attendance view if fullCalendar exists
    if($.fn.fullCalendar && $('#calendar').length) {
        $('#calendar').fullCalendar({
            // Calendar options will be loaded from the view
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: app.lang.today,
                month: app.lang.month,
                week: app.lang.week,
                day: app.lang.day
            }
        });
    }
    
    // Make sure the My Team menu item is always visible
    // This ensures it's not hidden by any JS menu toggling
    if ($('.menu-item-my-team').length) {
        $('.menu-item-my-team').removeClass('hide');
    }
    
    // Team member search functionality
    $('#team_member_search').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('.team-member-card').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
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

/**
 * Initialize all datatables for performance dashboard
 */
function initPerformanceDatatables() {
    // Tìm tất cả các datatable cần khởi tạo
    $('.table-staff-tasks-performance-').each(function() {
        var tableId = $(this).attr('id');
        var userId = tableId.replace('DataTables_Table_', '').split('_')[0];
        
        // Khởi tạo datatable cho tasks
        initDataTable('#' + tableId, 
                     admin_url + 'tasks/table?staffid=' + userId, 
                     undefined, undefined, undefined, [2, 'asc']);
    });
    
    // Khởi tạo datatable cho projects
    $('.table-staff-projects-performance-').each(function() {
        var tableId = $(this).attr('id');
        var userId = tableId.replace('DataTables_Table_', '').split('_')[0];
        
        initDataTable('#' + tableId, 
                     admin_url + 'projects/table?staffid=' + userId, 
                     undefined, undefined, undefined, [3, 'desc']);
    });
    
    // Khởi tạo datatable cho tickets
    $('.table-tickets-list-performance-').each(function() {
        var tableId = $(this).attr('id');
        var userId = tableId.replace('DataTables_Table_', '').split('_')[0];
        
        initDataTable('#' + tableId, 
                     admin_url + 'tickets/table?staffid=' + userId, 
                     undefined, undefined, undefined, [4, 'desc']);
    });
} 