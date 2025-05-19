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
                        
                        <!-- Buttons -->
                        <div class="row mbot20">
                            <div class="col-md-12">
                                <a href="<?php echo admin_url('dashboard'); ?>" class="btn btn-default pull-left">
                                    <i class="fa fa-arrow-left"></i> <?php echo _l('home'); ?>
                                </a>
                                <div class="pull-right">
                                    <a href="<?php echo admin_url('my_team/performance'); ?>" class="btn btn-info">
                                        <i class="fa fa-refresh"></i> <?php echo _l('refresh'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Team Members Performance Summary -->
                        <?php if (!empty($team_members)) { ?>
                        <div class="row mtop20">
                            <div class="col-md-12">
                                <h4><?php echo _l('team_performance_summary'); ?></h4>
                            </div>
                            
                            <?php 
                            // Hiển thị dashboard cho mỗi thành viên trong team
                            foreach ($team_members as $member) { 
                                // Chuẩn bị dữ liệu user
                                $user = [
                                    'staffid' => $member['staffid'],
                                    'full_name' => $member['full_name'],
                                    'email' => $member['email']
                                ];
                                
                                // Load partial view cho mỗi user
                                echo '<div data-user-id="' . $user['staffid'] . '" class="user-dashboard-container">';
                                $this->load->view('my_team/performance/user_dashboard_group', ['user' => $user, 'CI' => $CI]);
                                echo '</div>';
                            } 
                            ?>
                        </div>
                        <hr />
                        <?php } ?>

                        <!-- Dashboard Widget của người quản lý -->
                        <div class="row mtop20">
                            <div class="col-md-12">
                                <h4><?php echo _l('your_performance_dashboard'); ?></h4>
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

                        <!-- My Tasks and Projects -->
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

                        <!-- Todos Section -->
                        <div class="row mtop15">
                            <div class="col-md-6">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('my_todos'); ?>
                                            <a href="<?php echo admin_url('todo'); ?>" class="pull-right smaller">
                                                <i class="fa fa-list"></i> <?php echo _l('view_all'); ?>
                                            </a>
                                        </h4>
                                        <hr class="hr-panel-heading" />
                                        
                                        <?php if(count($todos) > 0 || count($todos_finished) > 0){ ?>
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#active_todos" aria-controls="active_todos" role="tab" data-toggle="tab">
                                                    <?php echo _l('home_active_todos'); ?> <span class="badge"><?php echo count($todos); ?></span>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#completed_todos" aria-controls="completed_todos" role="tab" data-toggle="tab">
                                                    <?php echo _l('home_finished_todos'); ?> <span class="badge"><?php echo count($todos_finished); ?></span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="active_todos">
                                                <?php foreach($todos as $todo) { ?>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="media-heading mtop5">
                                                            <?php echo $todo['description']; ?>
                                                        </h5>
                                                        <span class="text-muted"><?php echo _dt($todo['dateadded']); ?></span>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php } ?>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="completed_todos">
                                                <?php foreach($todos_finished as $todo_finished) { ?>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h5 class="media-heading mtop5">
                                                            <?php echo $todo_finished['description']; ?>
                                                        </h5>
                                                        <span class="text-muted"><?php echo _dt($todo_finished['dateadded']); ?></span>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php } else { ?>
                                        <p class="text-muted"><?php echo _l('no_todos_found'); ?></p>
                                        <?php } ?>
                                        
                                        <a href="#" class="btn btn-success mtop15" onclick="slideToggle('#add_todo_modal'); return false;"><?php echo _l('new_todo'); ?></a>
                                        <div id="add_todo_modal" class="hide mtop15">
                                            <form method="post" action="<?php echo admin_url('todo/add'); ?>">
                                                <div class="form-group">
                                                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="<?php echo _l('add_note_description'); ?>"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-info pull-right"><?php echo _l('add_todo'); ?></button>
                                                <button type="button" class="btn btn-default pull-right mright5" onclick="slideToggle('#add_todo_modal'); return false;"><?php echo _l('close'); ?></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tickets Section -->
                            <div class="col-md-6">
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
<script src="<?php echo module_dir_url('my_team', 'assets/js/performance_dashboard.js'); ?>"></script>
</body>
</html> 