<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('my_team_dashboard'); ?></h4>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Widget Tổng quan -->
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="info-box-horizontal">
                                    <span class="info-box-icon bg-aqua">
                                        <i class="fa fa-users"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><?php echo _l('total_staff'); ?></span>
                                        <span class="info-box-number"><?php echo $total_staff; ?></span>
                                        <div class="progress-description">
                                            <?php echo _l('active_staff'); ?>: <?php echo $active_staff; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="info-box-horizontal">
                                    <span class="info-box-icon bg-yellow">
                                        <i class="fa fa-check-circle"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><?php echo _l('pending_approvals'); ?></span>
                                        <span class="info-box-number"><?php echo $pending_approvals; ?></span>
                                        <div class="progress-description">
                                            <?php echo _l('total_approvals'); ?>: <?php echo $total_approvals; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="info-box-horizontal">
                                    <span class="info-box-icon bg-green">
                                        <i class="fa fa-book"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><?php echo _l('knowledge_items'); ?></span>
                                        <span class="info-box-number"><?php echo $knowledge_items; ?></span>
                                        <div class="progress-description">
                                            <?php echo _l('knowledge_categories'); ?>: <?php echo $knowledge_categories; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="info-box-horizontal">
                                    <span class="info-box-icon bg-red">
                                        <i class="fa fa-chart-line"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><?php echo _l('active_projects'); ?></span>
                                        <span class="info-box-number"><?php echo $active_projects; ?></span>
                                        <div class="progress-description">
                                            <?php echo _l('active_tasks'); ?>: <?php echo $active_tasks; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="hr-panel-heading" />
                        
                        <div class="row">
                            <!-- Thành viên gần đây -->
                            <div class="col-md-6">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('recent_staff_activity'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        
                                        <?php if (count($recent_activities) > 0) { ?>
                                            <div class="activity-feed">
                                                <?php foreach ($recent_activities as $activity) { ?>
                                                <div class="feed-item">
                                                    <div class="date">
                                                        <span class="text-has-action" data-toggle="tooltip" data-title="<?php echo _dt($activity['date']); ?>">
                                                            <?php echo time_ago($activity['date']); ?>
                                                        </span>
                                                    </div>
                                                    <div class="text">
                                                        <a href="<?php echo admin_url('my_team/view_member/' . $activity['staff_id']); ?>">
                                                            <?php echo $activity['full_name']; ?>
                                                        </a> 
                                                        <?php echo $activity['description']; ?>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="text-center mtop20">
                                                <i class="fa fa-info-circle fa-3x text-muted"></i>
                                                <p class="mtop15 text-muted"><?php echo _l('no_activity_found'); ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Phê duyệt gần đây -->
                            <div class="col-md-6">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('recent_approvals'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        
                                        <?php if (count($recent_approvals) > 0) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo _l('general_subject'); ?></th>
                                                            <th><?php echo _l('approval_type'); ?></th>
                                                            <th><?php echo _l('approval_status'); ?></th>
                                                            <th><?php echo _l('general_date'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($recent_approvals as $approval) { ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<?php echo admin_url('my_team/view_approval/' . $approval['id']); ?>">
                                                                    <?php echo $approval['subject']; ?>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                $approval_type = _l('approval_type_' . $approval['approval_type']); 
                                                                $badge_class = 'badge-primary';
                                                                
                                                                switch ($approval['approval_type']) {
                                                                    case 'leave':
                                                                        $badge_class = 'badge-info';
                                                                        break;
                                                                    case 'financial':
                                                                        $badge_class = 'badge-warning';
                                                                        break;
                                                                    case 'attendance':
                                                                        $badge_class = 'badge-success';
                                                                        break;
                                                                    default:
                                                                        $badge_class = 'badge-primary';
                                                                        break;
                                                                }
                                                                ?>
                                                                <span class="badge <?php echo $badge_class; ?>"><?php echo $approval_type; ?></span>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                switch ($approval['status']) {
                                                                    case 0:
                                                                        echo '<span class="label label-warning">' . _l('approval_status_pending') . '</span>';
                                                                        break;
                                                                    case 1:
                                                                        echo '<span class="label label-success">' . _l('approval_status_approved') . '</span>';
                                                                        break;
                                                                    case 2:
                                                                        echo '<span class="label label-danger">' . _l('approval_status_rejected') . '</span>';
                                                                        break;
                                                                    case 3:
                                                                        echo '<span class="label label-default">' . _l('approval_status_cancelled') . '</span>';
                                                                        break;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo date('d/m/Y H:i', strtotime($approval['created_date'])); ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="text-center mtop20">
                                                <i class="fa fa-info-circle fa-3x text-muted"></i>
                                                <p class="mtop15 text-muted"><?php echo _l('no_approvals_found'); ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- Kiến thức gần đây -->
                            <div class="col-md-6">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('recent_knowledge'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        
                                        <?php if (count($recent_knowledge) > 0) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo _l('general_subject'); ?></th>
                                                            <th><?php echo _l('knowledge_category'); ?></th>
                                                            <th><?php echo _l('general_created_at'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($recent_knowledge as $item) { ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<?php echo admin_url('my_team/view_knowledge/' . $item['id']); ?>">
                                                                    <?php echo $item['subject']; ?>
                                                                </a>
                                                            </td>
                                                            <td><?php echo $item['category_name'] ? $item['category_name'] : '-'; ?></td>
                                                            <td><?php echo date('d/m/Y H:i', strtotime($item['created_date'])); ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="text-center mtop20">
                                                <i class="fa fa-info-circle fa-3x text-muted"></i>
                                                <p class="mtop15 text-muted"><?php echo _l('no_knowledge_items_found'); ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Hiệu suất phòng ban -->
                            <div class="col-md-6">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin"><?php echo _l('department_performance'); ?></h4>
                                        <hr class="hr-panel-heading" />
                                        
                                        <?php if (count($departments) > 0) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo _l('general_department'); ?></th>
                                                            <th><?php echo _l('staff_count'); ?></th>
                                                            <th><?php echo _l('projects_count'); ?></th>
                                                            <th><?php echo _l('tasks_count'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($departments as $dept) { ?>
                                                        <tr>
                                                            <td><?php echo $dept['name']; ?></td>
                                                            <td><?php echo $dept['staff_count']; ?></td>
                                                            <td><?php echo $dept['projects_count']; ?></td>
                                                            <td><?php echo $dept['tasks_count']; ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="text-center mtop20">
                                                <i class="fa fa-info-circle fa-3x text-muted"></i>
                                                <p class="mtop15 text-muted"><?php echo _l('no_departments_found'); ?></p>
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
    // Chart.js initialization code can be added here if needed
});
</script> 