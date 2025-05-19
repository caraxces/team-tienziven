<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="panel panel-default mtop20">
    <div class="panel-heading">
        <div class="media">
            <div class="media-left">
                <?php echo staff_profile_image($user['staffid'], ['staff-profile-image-small']); ?>
            </div>
            <div class="media-body">
                <h4 class="media-heading mtop5">
                    <?php echo $user['full_name']; ?>
                </h4>
                <p class="text-muted no-margin"><?php echo $user['email']; ?></p>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <!-- Performance Stats -->
        <div class="row">
            <?php
            // Get user performance statistics
            $tasks = $CI->tasks_model->get_tasks_by_staff_id($user['staffid']);
            $completed_tasks = count(array_filter($tasks, function($task) {
                return $task['status'] == Tasks_model::STATUS_COMPLETE; // Status 5 is Complete
            }));
            $pending_tasks = count(array_filter($tasks, function($task) {
                return $task['status'] != Tasks_model::STATUS_COMPLETE; // Not completed
            }));
            $total_task_comments = $CI->my_team_model->count_task_comments($user['staffid']);
            $knowledge_read = count($CI->my_team_model->get_staff_knowledge_items($user['staffid']));
            
            $total_tasks = $completed_tasks + $pending_tasks;
            $completed_percent = $total_tasks > 0 ? round(($completed_tasks / $total_tasks) * 100) : 0;
            ?>
            
            <div class="col-md-3">
                <div class="team-stats">
                    <h3 class="bold text-success"><?php echo $completed_tasks; ?></h3>
                    <p><?php echo _l('completed_tasks'); ?></p>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="team-stats">
                    <h3 class="bold text-warning"><?php echo $pending_tasks; ?></h3>
                    <p><?php echo _l('pending_tasks'); ?></p>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="team-stats">
                    <h3 class="bold text-info"><?php echo $total_task_comments; ?></h3>
                    <p><?php echo _l('task_comments'); ?></p>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="team-stats">
                    <h3 class="bold text-primary"><?php echo $knowledge_read; ?></h3>
                    <p><?php echo _l('knowledge_items_read'); ?></p>
                </div>
            </div>
        </div>
        
        <div class="row mtop15">
            <div class="col-md-12">
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $completed_percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $completed_percent; ?>%">
                        <?php echo $completed_percent; ?>%
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Widgets -->
        <div class="row mtop15">
            <div class="col-md-8">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('tasks_and_projects'); ?></h4>
                        <hr class="hr-panel-heading" />
                        
                        <div class="clearfix"></div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <!-- Tasks -->
                                <div role="tabpanel" class="tab-pane active" id="user_tasks_<?php echo $user['staffid']; ?>">
                                    <h5><i class="fa fa-tasks"></i> <?php echo _l('home_my_tasks'); ?> 
                                        <a href="<?php echo admin_url('tasks?staffid=' . $user['staffid']); ?>" class="pull-right smaller">
                                            <?php echo _l('home_widget_view_all'); ?>
                                        </a>
                                    </h5>
                                    <hr />
                                    <div class="table-responsive">
                                        <table class="table dt-table table-staff-tasks-performance-<?php echo $user['staffid']; ?>" data-order-col="2" data-order-type="asc" data-user-id="<?php echo $user['staffid']; ?>">
                                            <thead>
                                                <tr>
                                                    <th><?php echo _l('tasks_dt_name'); ?></th>
                                                    <th><?php echo _l('tasks_dt_datestart'); ?></th>
                                                    <th><?php echo _l('task_duedate'); ?></th>
                                                    <th><?php echo _l('task_status'); ?></th>
                                                    <th><?php echo _l('tasks_dt_priority'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <!-- Projects -->
                                <div class="mtop30">
                                    <h5><i class="fa fa-bars"></i> <?php echo _l('home_my_projects'); ?> 
                                        <a href="<?php echo admin_url('projects?staffid=' . $user['staffid']); ?>" class="pull-right smaller">
                                            <?php echo _l('home_widget_view_all'); ?>
                                        </a>
                                    </h5>
                                    <hr />
                                    <div class="table-responsive">
                                        <table class="table dt-table table-staff-projects-performance-<?php echo $user['staffid']; ?>" data-order-col="3" data-order-type="desc" data-user-id="<?php echo $user['staffid']; ?>">
                                            <thead>
                                                <tr>
                                                    <th><?php echo _l('project_name'); ?></th>
                                                    <th><?php echo _l('project_start_date'); ?></th>
                                                    <th><?php echo _l('project_deadline'); ?></th>
                                                    <th><?php echo _l('project_status'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Todos Section -->
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('my_todos'); ?>
                            <a href="<?php echo admin_url('todo?staffid=' . $user['staffid']); ?>" class="pull-right smaller">
                                <i class="fa fa-list"></i> <?php echo _l('view_all'); ?>
                            </a>
                        </h4>
                        <hr class="hr-panel-heading" />
                        <?php 
                        // Load todos for this user
                        $CI->load->model('todo_model');
                        $CI->todo_model->setTodosLimit(5);
                        $todos = $CI->todo_model->get_todo_items(0, $user['staffid']);
                        $todos_finished = $CI->todo_model->get_todo_items(1, $user['staffid']);
                        
                        if(count($todos) > 0 || count($todos_finished) > 0){ ?>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#user_<?php echo $user['staffid']; ?>_todos_active" aria-controls="user_<?php echo $user['staffid']; ?>_todos_active" role="tab" data-toggle="tab">
                                    <?php echo _l('home_active_todos'); ?> <span class="badge"><?php echo count($todos); ?></span>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#user_<?php echo $user['staffid']; ?>_todos_finished" aria-controls="user_<?php echo $user['staffid']; ?>_todos_finished" role="tab" data-toggle="tab">
                                    <?php echo _l('home_finished_todos'); ?> <span class="badge"><?php echo count($todos_finished); ?></span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="user_<?php echo $user['staffid']; ?>_todos_active">
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
                            <div role="tabpanel" class="tab-pane" id="user_<?php echo $user['staffid']; ?>_todos_finished">
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
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tickets Section -->
        <div class="row mtop15">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('home_tickets'); ?>
                            <a href="<?php echo admin_url('tickets?staffid=' . $user['staffid']); ?>" class="pull-right smaller">
                                <i class="fa fa-list"></i> <?php echo _l('view_all'); ?>
                            </a>
                        </h4>
                        <hr class="hr-panel-heading" />
                        <div class="row mtop15">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table dt-table table-tickets-list-performance-<?php echo $user['staffid']; ?>" data-order-col="4" data-order-type="desc" data-user-id="<?php echo $user['staffid']; ?>">
                                        <thead>
                                            <tr>
                                                <th><?php echo _l('ticket_dt_subject'); ?></th>
                                                <th><?php echo _l('ticket_dt_department'); ?></th>
                                                <th><?php echo _l('ticket_dt_status'); ?></th>
                                                <th><?php echo _l('ticket_dt_priority'); ?></th>
                                                <th><?php echo _l('ticket_dt_last_reply'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize Datatables for this user
$(function() {
    // Initialize Tasks
    initDataTable('.table-staff-tasks-performance-<?php echo $user['staffid']; ?>', 
                  admin_url + 'tasks/table?staffid=<?php echo $user['staffid']; ?>', 
                  undefined, undefined, undefined, [2, 'asc']);
    
    // Initialize Projects
    initDataTable('.table-staff-projects-performance-<?php echo $user['staffid']; ?>', 
                  admin_url + 'projects/table?staffid=<?php echo $user['staffid']; ?>', 
                  undefined, undefined, undefined, [3, 'desc']);
    
    // Initialize Tickets
    initDataTable('.table-tickets-list-performance-<?php echo $user['staffid']; ?>', 
                  admin_url + 'tickets/table?staffid=<?php echo $user['staffid']; ?>', 
                  undefined, undefined, undefined, [4, 'desc']);
});
</script> 