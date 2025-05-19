/* My Team Module JavaScript */
$(function() {
    initMyTeam();
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