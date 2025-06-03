<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="tw-mt-0 tw-font-semibold tw-text-lg tw-text-neutral-700">
                    <?php echo _l('my_team'); ?> - <?php echo _l('dashboard'); ?>
                </h4>
            </div>
        </div>

        <div class="row mbot15">
            <div class="col-md-3">
                <div class="panel_s">
                    <div class="panel-body">
                        <h3 class="bold"><?php echo isset($total_staff) ? $total_staff : 0; ?></h3>
                        <span class="text-primary"><?php echo _l('staff_stats_total'); ?></span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="panel_s">
                    <div class="panel-body">
                        <h3 class="bold"><?php echo isset($active_staff) ? $active_staff : 0; ?></h3>
                        <span class="text-success"><?php echo _l('active_members'); ?></span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="panel_s">
                    <div class="panel-body">
                        <h3 class="bold"><?php echo isset($active_tasks) ? $active_tasks : 0; ?></h3>
                        <span class="text-info"><?php echo _l('tasks_in_progress'); ?></span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="panel_s">
                    <div class="panel-body">
                        <h3 class="bold"><?php echo isset($active_projects) ? $active_projects : 0; ?></h3>
                        <span class="text-warning"><?php echo _l('projects_in_progress'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('team_members'); ?></h4>
                        <hr class="hr-panel-heading" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table dt-table" data-order-col="1" data-order-type="asc">
                                        <thead>
                                            <tr>
                                                <th><?php echo _l('staff_dt_name'); ?></th>
                                                <th><?php echo _l('staff_dt_email'); ?></th>
                                                <th><?php echo _l('staff_dt_role'); ?></th>
                                                <th><?php echo _l('staff_dt_last_Login'); ?></th>
                                                <th><?php echo _l('staff_dt_active'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($staff_members) && !empty($staff_members)){ ?>
                                                <?php foreach($staff_members as $staff){ ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo admin_url('staff/profile/'.$staff['staffid']); ?>">
                                                                <?php echo staff_profile_image($staff['staffid'], ['staff-profile-image-small']); ?>
                                                                <?php echo $staff['firstname'] . ' ' . $staff['lastname']; ?>
                                                            </a>
                                                        </td>
                                                        <td><?php echo $staff['email']; ?></td>
                                                        <td>
                                                            <?php 
                                                                echo get_instance()->roles_model->get($staff['role'])->name;
                                                            ?>
                                                        </td>
                                                        <td><?php echo !empty($staff['last_login']) ? time_ago($staff['last_login']) : '-'; ?></td>
                                                        <td>
                                                            <div class="onoffswitch">
                                                                <input type="checkbox" data-switch-url="<?php echo admin_url('staff/change_staff_status'); ?>" name="onoffswitch" class="onoffswitch-checkbox" id="<?php echo $staff['staffid']; ?>" data-id="<?php echo $staff['staffid']; ?>" <?php if($staff['active'] == 1){echo 'checked';} ?>>
                                                                <label class="onoffswitch-label" for="<?php echo $staff['staffid']; ?>"></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
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
<?php init_tail(); ?> 