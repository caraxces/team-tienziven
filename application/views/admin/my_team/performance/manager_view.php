<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('performance'); ?></h4>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Team Members Performance Summary -->
                        <?php if (!empty($team_members)) { ?>
                        <div class="row mtop20">
                            <div class="col-md-12">
                                <h4><?php echo _l('team_performance_summary'); ?></h4>
                            </div>
                            <?php foreach ($team_members as $member) { 
                                $member_stats = isset($team_stats[$member['staffid']]) ? $team_stats[$member['staffid']] : [];
                                $completed_tasks_percent = 0;
                                if (isset($member_stats['completed_tasks']) && isset($member_stats['pending_tasks'])) {
                                    $total_tasks = $member_stats['completed_tasks'] + $member_stats['pending_tasks'];
                                    $completed_tasks_percent = $total_tasks > 0 ? round(($member_stats['completed_tasks'] / $total_tasks) * 100) : 0;
                                }
                            ?>
                            <div class="col-md-4 col-sm-6 col-xs-12 mtop15">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="media">
                                            <div class="media-left">
                                                <?php echo staff_profile_image($member['staffid'], ['staff-profile-image-small']); ?>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading mtop5">
                                                    <a href="<?php echo admin_url('my_team/view_member/' . $member['staffid']); ?>">
                                                        <?php echo $member['full_name']; ?>
                                                    </a>
                                                </h5>
                                                <p class="text-muted no-margin"><?php echo $member['email']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row text-center">
                                            <div class="col-xs-4 border-right">
                                                <h3 class="bold"><?php echo isset($member_stats['completed_tasks']) ? $member_stats['completed_tasks'] : 0; ?></h3>
                                                <span class="text-success"><?php echo _l('completed_tasks'); ?></span>
                                            </div>
                                            <div class="col-xs-4 border-right">
                                                <h3 class="bold"><?php echo isset($member_stats['pending_tasks']) ? $member_stats['pending_tasks'] : 0; ?></h3>
                                                <span class="text-warning"><?php echo _l('pending_tasks'); ?></span>
                                            </div>
                                            <div class="col-xs-4">
                                                <h3 class="bold"><?php echo isset($member_stats['total_task_comments']) ? $member_stats['total_task_comments'] : 0; ?></h3>
                                                <span class="text-info"><?php echo _l('comments'); ?></span>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="clearfix">
                                            <p><?php echo _l('task_completion'); ?></p>
                                            <div class="progress no-margin">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $completed_tasks_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $completed_tasks_percent; ?>%">
                                                    <?php echo $completed_tasks_percent; ?>%
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <p><strong><?php echo _l('knowledge_items_read'); ?>:</strong> <?php echo isset($member_stats['knowledge_read']) ? $member_stats['knowledge_read'] : 0; ?></p>
                                        <div class="text-right">
                                            <a href="<?php echo admin_url('my_team/view_member/' . $member['staffid']); ?>" class="btn btn-default btn-sm">
                                                <?php echo _l('view_details'); ?> <i class="fa fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <hr />
                        <?php } ?>

                        <!-- Dashboard Widgets Section -->
                        <div class="row mtop20">
                            <div class="col-md-12">
                                <h4><?php echo _l('detailed_performance_tracking'); ?></h4>
                            </div>
                        </div>

                        <!-- Calendar & My Reminders Section -->
                        <div class="row mtop15">
                            <div class="col-md-8">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('calendar'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        <?php $this->load->view('admin/utilities/calendar_filters'); ?>
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('my_reminders'); ?>
                                            <a href="<?php echo admin_url('misc/reminders'); ?>" class="pull-right smaller">
                                                <i class="fa fa-list"></i> <?php echo _l('view_all'); ?>
                                            </a>
                                        </h4>
                                        <hr class="hr-panel-heading" />
                                        <?php render_datatable([
                                            _l('reminder_related'),
                                            _l('reminder_description'),
                                            _l('reminder_date'),
                                        ], 'my-reminders-performance'); ?>
                                        <a href="#" class="btn btn-info add-reminder-modal mtop15" data-toggle="modal" data-target="#reminder-modal">
                                            <i class="fa fa-bell-o"></i> <?php echo _l('add_reminder'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Data -->
                        <div class="row mtop15">
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('tasks_and_projects'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        
                                        <div class="clearfix"></div>
                                        <div class="panel-body">
                                            <div class="tab-content">
                                                <!-- My Tasks -->
                                                <div role="tabpanel" class="tab-pane active" id="home_my_tasks">
                                                    <h5><i class="fa fa-tasks"></i> <?php echo _l('home_my_tasks'); ?> 
                                                        <a href="<?php echo admin_url('tasks'); ?>" class="pull-right smaller">
                                                            <?php echo _l('home_widget_view_all'); ?>
                                                        </a>
                                                    </h5>
                                                    <hr />
                                                    <?php render_datatable([
                                                        _l('tasks_dt_name'),
                                                        _l('tasks_dt_datestart'),
                                                        _l('task_duedate'),
                                                        _l('task_status'),
                                                        _l('tasks_dt_priority'),
                                                    ], 'staff-tasks-performance', [], [
                                                        'data-last-order-identifier' => 'my-tasks',
                                                        'data-default-order'         => get_table_last_order('my-tasks'),
                                                    ]); ?>
                                                </div>
                                                
                                                <!-- My Projects -->
                                                <div class="mtop30">
                                                    <h5><i class="fa fa-bars"></i> <?php echo _l('home_my_projects'); ?> 
                                                        <a href="<?php echo admin_url('projects'); ?>" class="pull-right smaller">
                                                            <?php echo _l('home_widget_view_all'); ?>
                                                        </a>
                                                    </h5>
                                                    <hr />
                                                    <?php render_datatable([
                                                        _l('project_name'),
                                                        _l('project_start_date'),
                                                        _l('project_deadline'),
                                                        _l('project_status'),
                                                    ], 'staff-projects-performance', [], [
                                                        'data-last-order-identifier' => 'my-projects',
                                                        'data-default-order'         => get_table_last_order('my-projects'),
                                                    ]); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tickets -->
                        <div class="row mtop15">
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('home_tickets'); ?>
                                            <a href="<?php echo admin_url('tickets'); ?>" class="pull-right smaller">
                                                <i class="fa fa-list"></i> <?php echo _l('view_all'); ?>
                                            </a>
                                        </h4>
                                        <hr class="hr-panel-heading" />
                                        <?php if (is_admin()) { ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="tickets-report-table" class="table table-tickets-report">
                                                            <thead>
                                                                <tr>
                                                                    <th><?php echo _l('staff_report_total_tickets'); ?></th>
                                                                    <th><?php echo _l('staff_report_open_tickets'); ?></th>
                                                                    <th><?php echo _l('staff_report_closed_tickets'); ?></th>
                                                                    <th><?php echo _l('reports_total_answered_tickets'); ?></th>
                                                                    <th><?php echo _l('reports_total_unanswered_tickets'); ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><?php echo $tickets_report->total_tickets; ?></td>
                                                                    <td><?php echo $tickets_report->open_tickets; ?></td>
                                                                    <td><?php echo $tickets_report->closed_tickets; ?></td>
                                                                    <td><?php echo $tickets_report->total_answered_tickets; ?></td>
                                                                    <td><?php echo $tickets_report->total_unanswered_tickets; ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="row mtop15">
                                            <div class="col-md-12">
                                                <?php render_datatable([
                                                    _l('ticket_dt_subject'),
                                                    _l('ticket_dt_department'),
                                                    _l('ticket_dt_status'),
                                                    _l('ticket_dt_priority'),
                                                    _l('ticket_dt_last_reply'),
                                                ], 'tickets-list-performance'); ?>
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

<?php $this->load->view('admin/includes/modals/reminder', [
    'id' => '',
    'name' => '',
    'members' => $this->staff_model->get('', ['active' => 1]),
    'reminder_title' => _l('set_reminder')
]); ?>
<?php init_tail(); ?>
<?php $this->load->view('admin/utilities/calendar_template'); ?>

<script>
// Initialize Calendar
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
        },
    });
    calendar.render();
}

// Initialize Datatables
$(function() {
    // Initialize My Tasks
    initDataTable('.table-staff-tasks-performance', admin_url + 'tasks/table', undefined, undefined, undefined, [2, 'asc']);
    
    // Initialize My Projects
    initDataTable('.table-staff-projects-performance', admin_url + 'projects/table', undefined, undefined, 'undefined', [3, 'desc']);
    
    // Initialize My Reminders
    initDataTable('.table-my-reminders-performance', admin_url + 'misc/reminders_table', undefined, undefined, 'undefined', [2, 'asc']);
    
    // Initialize Tickets
    initDataTable('.table-tickets-list-performance', admin_url + 'tickets/table', undefined, undefined, 'undefined', [4, 'desc']);
});
</script>
</body>
</html> 