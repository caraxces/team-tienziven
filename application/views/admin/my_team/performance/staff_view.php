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
                        
                        <?php if (isset($manager)) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h5><?php echo _l('your_manager'); ?></h5>
                                <div class="panel panel-info">
                                    <div class="panel-body">
                                        <div class="media">
                                            <div class="media-left">
                                                <?php echo staff_profile_image($manager->staffid, ['staff-profile-image-small']); ?>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading mtop5"><?php echo $manager->firstname . ' ' . $manager->lastname; ?></h5>
                                                <p class="text-muted"><?php echo $manager->email; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <!-- Performance Stats -->
                        <div class="row mtop15">
                            <div class="col-md-12">
                                <h5><?php echo _l('your_performance'); ?></h5>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="team-stats">
                                    <h3 class="bold text-success"><?php echo isset($completed_tasks) ? $completed_tasks : 0; ?></h3>
                                    <p><?php echo _l('completed_tasks'); ?></p>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="team-stats">
                                    <h3 class="bold text-warning"><?php echo isset($pending_tasks) ? $pending_tasks : 0; ?></h3>
                                    <p><?php echo _l('pending_tasks'); ?></p>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="team-stats">
                                    <h3 class="bold text-info"><?php echo isset($total_task_comments) ? $total_task_comments : 0; ?></h3>
                                    <p><?php echo _l('task_comments'); ?></p>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="team-stats">
                                    <h3 class="bold text-primary"><?php echo isset($knowledge_read) ? $knowledge_read : 0; ?></h3>
                                    <p><?php echo _l('knowledge_items_read'); ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mtop15">
                            <div class="col-md-12">
                                <?php 
                                $total_tasks = ($completed_tasks ?? 0) + ($pending_tasks ?? 0);
                                $completed_percent = $total_tasks > 0 ? round(($completed_tasks / $total_tasks) * 100) : 0;
                                ?>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $completed_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $completed_percent; ?>%">
                                        <?php echo $completed_percent; ?>%
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Calendar & My Reminders Section -->
                        <div class="row mtop30">
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
                        
                        <!-- User Data (Tasks & Projects) -->
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