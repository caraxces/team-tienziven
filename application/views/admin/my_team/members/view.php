<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="no-margin"><?php echo $title; ?></h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="<?php echo admin_url('my_team'); ?>" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> <?php echo _l('back_to_team'); ?>
                                </a>
                                <?php if (has_permission('my_team', '', 'create') || is_admin()) { ?>
                                <a href="<?php echo admin_url('my_team/add_attitude_evaluation/' . $staff_id); ?>" class="btn btn-info">
                                    <i class="fa fa-star"></i> <?php echo _l('add_evaluation'); ?>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="staff-profile-image-thumb">
                                            <?php echo staff_profile_image($member->staffid, ['staff-profile-image-thumb']); ?>
                                        </div>
                                        <h4 class="text-center mtop15"><?php echo $member->firstname . ' ' . $member->lastname; ?></h4>
                                        <p class="text-muted text-center"><?php echo $member->email; ?></p>
                                        <hr />
                                        <p><strong><?php echo _l('staff_phonenumber'); ?>:</strong> <?php echo $member->phonenumber; ?></p>
                                        <p><strong><?php echo _l('staff_position'); ?>:</strong> <?php echo $member->job_title; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#projects" aria-controls="projects" role="tab" data-toggle="tab">
                                            <?php echo _l('projects'); ?>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">
                                            <?php echo _l('tasks'); ?>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#knowledge" aria-controls="knowledge" role="tab" data-toggle="tab">
                                            <?php echo _l('knowledge_items'); ?>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#attitude" aria-controls="attitude" role="tab" data-toggle="tab">
                                            <?php echo _l('attitude_evaluations'); ?>
                                        </a>
                                    </li>
                                </ul>
                                
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="projects">
                                        <h5 class="mtop15"><?php echo _l('assigned_projects'); ?></h5>
                                        <?php if (!empty($projects)) { ?>
                                        <div class="table-responsive">
                                            <table class="table dt-table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo _l('project_name'); ?></th>
                                                        <th><?php echo _l('project_start_date'); ?></th>
                                                        <th><?php echo _l('project_deadline'); ?></th>
                                                        <th><?php echo _l('project_status'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($projects as $project) { ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo admin_url('projects/view/' . $project['id']); ?>">
                                                                <?php echo $project['name']; ?>
                                                            </a>
                                                        </td>
                                                        <td><?php echo _d($project['start_date']); ?></td>
                                                        <td><?php echo _d($project['deadline']); ?></td>
                                                        <td><?php echo format_project_status($project['status']); ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php } else { ?>
                                        <div class="alert alert-info mtop15">
                                            <?php echo _l('no_projects_found'); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    
                                    <div role="tabpanel" class="tab-pane" id="tasks">
                                        <h5 class="mtop15"><?php echo _l('assigned_tasks'); ?></h5>
                                        <?php if (!empty($tasks)) { ?>
                                        <div class="table-responsive">
                                            <table class="table dt-table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo _l('tasks_dt_name'); ?></th>
                                                        <th><?php echo _l('task_status'); ?></th>
                                                        <th><?php echo _l('task_priority'); ?></th>
                                                        <th><?php echo _l('tasks_dt_datestart'); ?></th>
                                                        <th><?php echo _l('task_duedate'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($tasks as $task) { ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo admin_url('tasks/view/' . $task['id']); ?>">
                                                                <?php echo $task['name']; ?>
                                                            </a>
                                                        </td>
                                                        <td><?php echo format_task_status($task['status']); ?></td>
                                                        <td><?php echo task_priority($task['priority']); ?></td>
                                                        <td><?php echo _d($task['startdate']); ?></td>
                                                        <td><?php echo _d($task['duedate']); ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php } else { ?>
                                        <div class="alert alert-info mtop15">
                                            <?php echo _l('no_tasks_found'); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    
                                    <div role="tabpanel" class="tab-pane" id="knowledge">
                                        <h5 class="mtop15"><?php echo _l('knowledge_items_read'); ?></h5>
                                        <?php if (!empty($knowledge_items)) { ?>
                                        <div class="table-responsive">
                                            <table class="table dt-table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo _l('knowledge_base_article_title'); ?></th>
                                                        <th><?php echo _l('date_read'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($knowledge_items as $item) { ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo admin_url('my_team/view_knowledge_item/' . $item['id']); ?>">
                                                                <?php echo $item['title']; ?>
                                                            </a>
                                                        </td>
                                                        <td><?php echo _dt($item['date_read']); ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php } else { ?>
                                        <div class="alert alert-info mtop15">
                                            <?php echo _l('no_knowledge_items_found'); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    
                                    <div role="tabpanel" class="tab-pane" id="attitude">
                                        <h5 class="mtop15"><?php echo _l('attitude_evaluations'); ?></h5>
                                        <?php if (!empty($attitude_evaluations)) { ?>
                                        <div class="table-responsive">
                                            <table class="table dt-table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo _l('month'); ?></th>
                                                        <th><?php echo _l('year'); ?></th>
                                                        <th><?php echo _l('rating'); ?></th>
                                                        <th><?php echo _l('manager'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($attitude_evaluations as $eval) { ?>
                                                    <tr>
                                                        <td><?php echo date("F", mktime(0, 0, 0, $eval['month'], 1)); ?></td>
                                                        <td><?php echo $eval['year']; ?></td>
                                                        <td>
                                                            <?php 
                                                                $stars = '';
                                                                for ($i = 1; $i <= 5; $i++) {
                                                                    if ($i <= $eval['rating']) {
                                                                        $stars .= '<i class="fa fa-star text-warning"></i>';
                                                                    } else {
                                                                        $stars .= '<i class="fa fa-star-o text-warning"></i>';
                                                                    }
                                                                }
                                                                echo $stars;
                                                            ?>
                                                        </td>
                                                        <td><?php echo $eval['manager_name']; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php } else { ?>
                                        <div class="alert alert-info mtop15">
                                            <?php echo _l('no_evaluations_found'); ?>
                                        </div>
                                        <?php } ?>
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
<?php init_tail(); ?>
<script>
$(function() {
    $('.dt-table').DataTable();
});
</script>
</body>
</html> 