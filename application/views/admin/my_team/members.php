<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="tw-mt-0 tw-font-semibold tw-text-lg tw-text-neutral-700">
            <?php echo _l('team_members'); ?>
        </h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel_s">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-heading">
                            <h4 class="no-margin"><?php echo _l('staff_members'); ?></h4>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <a href="<?php echo admin_url('staff/member'); ?>" class="btn btn-info mbot20">
                            <i class="fa fa-plus-circle"></i> <?php echo _l('new_staff'); ?>
                        </a>
                        
                        <div class="clearfix"></div>
                        
                        <div class="table-responsive">
                            <table class="table dt-table" data-order-col="1" data-order-type="asc">
                                <thead>
                                    <tr>
                                        <th><?php echo _l('staff_dt_name'); ?></th>
                                        <th><?php echo _l('staff_dt_email'); ?></th>
                                        <th><?php echo _l('staff_dt_role'); ?></th>
                                        <th><?php echo _l('staff_dt_last_Login'); ?></th>
                                        <th><?php echo _l('staff_dt_active'); ?></th>
                                        <th><?php echo _l('options'); ?></th>
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
                                                <td><?php echo $staff['role_name']; ?></td>
                                                <td><?php echo !empty($staff['last_login']) ? time_ago($staff['last_login']) : '-'; ?></td>
                                                <td>
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" data-switch-url="<?php echo admin_url('staff/change_staff_status'); ?>" name="onoffswitch" class="onoffswitch-checkbox" id="m_<?php echo $staff['staffid']; ?>" data-id="<?php echo $staff['staffid']; ?>" <?php if($staff['active'] == 1){echo 'checked';} ?>>
                                                        <label class="onoffswitch-label" for="m_<?php echo $staff['staffid']; ?>"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="<?php echo admin_url('staff/member/'.$staff['staffid']); ?>" class="btn btn-default btn-icon">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
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