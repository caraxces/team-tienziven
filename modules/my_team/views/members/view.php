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
                                <h4 class="no-margin"><?php echo $member->firstname . ' ' . $member->lastname; ?></h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="<?php echo admin_url('my_team'); ?>" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> <?php echo _l('back_to_team_members'); ?>
                                </a>
                                <?php if($is_manager && has_permission('my_team', '', 'create')){ ?>
                                <a href="<?php echo admin_url('my_team/add_attitude_evaluation/' . $staff_id); ?>" class="btn btn-info">
                                    <i class="fa fa-plus"></i> <?php echo _l('add_attitude_evaluation'); ?>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="staff-profile-info">
                                    <div class="staff-profile-image text-center">
                                        <?php echo staff_profile_image($member->staffid, ['staff-profile-image-large']); ?>
                                    </div>
                                    <h4 class="text-center mtop10"><?php echo $member->firstname . ' ' . $member->lastname; ?></h4>
                                    <p class="text-center"><?php echo $member->role_name; ?></p>
                                    <hr />
                                    <ul class="list-unstyled">
                                        <li><strong><?php echo _l('staff_email'); ?>:</strong> <?php echo $member->email; ?></li>
                                        <li><strong><?php echo _l('staff_phonenumber'); ?>:</strong> <?php echo $member->phonenumber; ?></li>
                                        <?php if($member->last_login){ ?>
                                        <li><strong><?php echo _l('staff_last_login'); ?>:</strong> <?php echo time_ago($member->last_login); ?></li>
                                        <?php } ?>
                                        <li><strong><?php echo _l('staff_status'); ?>:</strong> <?php echo ($member->active == 1 ? '<span class="label label-success">'._l('staff_status_active').'</span>' : '<span class="label label-danger">'._l('staff_status_inactive').'</span>'); ?></li>
                                        <?php if($member->facebook){ ?>
                                        <li><strong>Facebook:</strong> <a href="<?php echo html_escape($member->facebook); ?>" target="_blank"><?php echo html_escape($member->facebook); ?></a></li>
                                        <?php } ?>
                                        <?php if($member->linkedin){ ?>
                                        <li><strong>LinkedIn:</strong> <a href="<?php echo html_escape($member->linkedin); ?>" target="_blank"><?php echo html_escape($member->linkedin); ?></a></li>
                                        <?php } ?>
                                        <?php if($member->skype){ ?>
                                        <li><strong>Skype:</strong> <a href="skype:<?php echo html_escape($member->skype); ?>?call"><?php echo html_escape($member->skype); ?></a></li>
                                        <?php } ?>
                                    </ul>
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
                                        <h4 class="mtop20"><?php echo _l('staff_projects'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        
                                        <?php if(!empty($projects)){ ?>
                                        <div class="table-responsive">
                                            <table class="table dt-table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo _l('project_name'); ?></th>
                                                        <th><?php echo _l('project_status'); ?></th>
                                                        <th><?php echo _l('project_start_date'); ?></th>
                                                        <th><?php echo _l('project_deadline'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($projects as $project){ ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo admin_url('projects/view/'.$project['id']); ?>">
                                                                <?php echo $project['name']; ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $status = get_project_status_by_id($project['status']);
                                                            echo '<span class="label" style="background:'.$status['color'].'">'.$status['name'].'</span>';
                                                            ?>
                                                        </td>
                                                        <td><?php echo _d($project['start_date']); ?></td>
                                                        <td><?php echo _d($project['deadline']); ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php }else{ ?>
                                            <div class="alert alert-info mbot15">
                                                <?php echo _l('no_projects_found'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    
                                    <div role="tabpanel" class="tab-pane" id="tasks">
                                        <h4 class="mtop20"><?php echo _l('staff_tasks'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        
                                        <?php if(!empty($tasks)){ ?>
                                        <div class="table-responsive">
                                            <table class="table dt-table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo _l('tasks_dt_name'); ?></th>
                                                        <th><?php echo _l('task_status'); ?></th>
                                                        <th><?php echo _l('task_priority'); ?></th>
                                                        <th><?php echo _l('task_duedate'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($tasks as $task){ ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo admin_url('tasks/view/'.$task['id']); ?>">
                                                                <?php echo $task['name']; ?>
                                                            </a>
                                                        </td>
                                                        <td><?php echo format_task_status($task['status']); ?></td>
                                                        <td><?php echo task_priority($task['priority']); ?></td>
                                                        <td><?php echo _d($task['duedate']); ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php }else{ ?>
                                            <div class="alert alert-info mbot15">
                                                <?php echo _l('no_tasks_found'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    
                                    <div role="tabpanel" class="tab-pane" id="knowledge">
                                        <h4 class="mtop20"><?php echo _l('knowledge_items_read'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        
                                        <?php if(!empty($knowledge_items)){ ?>
                                        <div class="table-responsive">
                                            <table class="table dt-table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo _l('knowledge_title'); ?></th>
                                                        <th><?php echo _l('date_read'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($knowledge_items as $item){ ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo admin_url('my_team/view_knowledge_item/'.$item['id']); ?>">
                                                                <?php echo $item['title']; ?>
                                                            </a>
                                                        </td>
                                                        <td><?php echo _dt($item['date_read']); ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php }else{ ?>
                                            <div class="alert alert-info mbot15">
                                                <?php echo _l('no_knowledge_items_found'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    
                                    <div role="tabpanel" class="tab-pane" id="attitude">
                                        <h4 class="mtop20"><?php echo _l('attitude_evaluations'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        
                                        <?php if(!empty($attitude_evaluations)){ ?>
                                        <div class="table-responsive">
                                            <table class="table dt-table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo _l('evaluation_period'); ?></th>
                                                        <th><?php echo _l('evaluation_by'); ?></th>
                                                        <th><?php echo _l('rating'); ?></th>
                                                        <th><?php echo _l('evaluation'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($attitude_evaluations as $evaluation){ ?>
                                                    <tr>
                                                        <td><?php echo date('F Y', mktime(0, 0, 0, $evaluation['month'], 1, $evaluation['year'])); ?></td>
                                                        <td><?php echo $evaluation['manager_name']; ?></td>
                                                        <td>
                                                            <?php for($i = 1; $i <= 5; $i++){ ?>
                                                                <i class="fa fa-star<?php echo ($i <= $evaluation['rating'] ? '' : '-o'); ?>" style="color: #f8c44c;"></i>
                                                            <?php } ?>
                                                        </td>
                                                        <td><?php echo $evaluation['evaluation']; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php }else{ ?>
                                            <div class="alert alert-info mbot15">
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
    $(function(){
        initDataTable('.dt-table');
        
        // Activate tab based on hash if present
        var hash = window.location.hash;
        if(hash) {
            $('.nav-tabs a[href="' + hash + '"]').tab('show');
        }
        
        // Set hash on tab change
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            window.location.hash = e.target.hash;
        });
    });
</script>
</body>
</html> 