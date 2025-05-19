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
                                <h4 class="no-margin"><?php echo _l('team_members'); ?></h4>
                            </div>
                            <?php if($is_manager && has_permission('my_team', '', 'create')){ ?>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_team_member_modal">
                                    <i class="fa fa-plus"></i> <?php echo _l('add_team_member'); ?>
                                </button>
                            </div>
                            <?php } ?>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <?php if($is_manager){ ?>
                            <?php if(empty($team_members)){ ?>
                                <div class="alert alert-info">
                                    <p><?php echo _l('no_team_members_found'); ?></p>
                                </div>
                            <?php }else{ ?>
                                <div class="table-responsive">
                                    <table class="table dt-table">
                                        <thead>
                                            <tr>
                                                <th><?php echo _l('staff_member'); ?></th>
                                                <th><?php echo _l('staff_email'); ?></th>
                                                <th><?php echo _l('staff_phonenumber'); ?></th>
                                                <th><?php echo _l('staff_last_login'); ?></th>
                                                <th><?php echo _l('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($team_members as $member){ ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo admin_url('my_team/view_member/'.$member['staffid']); ?>">
                                                        <?php echo staff_profile_image($member['staffid'], ['staff-profile-image-small',]); ?>
                                                        <?php echo $member['full_name']; ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $member['email']; ?></td>
                                                <td><?php echo $member['phonenumber']; ?></td>
                                                <td>
                                                    <?php 
                                                    if(!empty($member['last_login'])){
                                                        echo time_ago($member['last_login']);
                                                    }else{
                                                        echo _l('never');
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="<?php echo admin_url('my_team/view_member/'.$member['staffid']); ?>" class="btn btn-default btn-icon"><i class="fa fa-eye"></i></a>
                                                        <?php if(has_permission('my_team', '', 'delete')){ ?>
                                                        <a href="<?php echo admin_url('my_team/remove_team_member/'.$member['staffid']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><?php echo _l('your_manager'); ?></h3>
                                        </div>
                                        <div class="panel-body">
                                            <?php if(isset($manager)){ ?>
                                                <div class="text-center">
                                                    <?php echo staff_profile_image($manager->staffid, ['staff-profile-image-large']); ?>
                                                    <h4><?php echo $manager->firstname . ' ' . $manager->lastname; ?></h4>
                                                    <p><strong><?php echo _l('staff_email'); ?>:</strong> <?php echo $manager->email; ?></p>
                                                    <p><strong><?php echo _l('staff_phonenumber'); ?>:</strong> <?php echo $manager->phonenumber; ?></p>
                                                </div>
                                            <?php }else{ ?>
                                                <div class="alert alert-warning">
                                                    <p><?php echo _l('no_manager_assigned'); ?></p>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($is_manager && has_permission('my_team', '', 'create')){ ?>
<!-- Add Team Member Modal -->
<div class="modal fade" id="add_team_member_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo _l('add_team_member'); ?></h4>
            </div>
            <?php echo form_open(admin_url('my_team/add_team_member')); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="staff_id"><?php echo _l('select_staff_member'); ?></label>
                    <select name="staff_id" id="staff_id" class="form-control selectpicker" data-live-search="true" required>
                        <option value=""><?php echo _l('select_option'); ?></option>
                        <?php foreach($all_staff as $staff){ 
                            // Don't include staff that are already team members
                            $is_team_member = false;
                            foreach($team_members as $member){
                                if($member['staffid'] == $staff['staffid']){
                                    $is_team_member = true;
                                    break;
                                }
                            }
                            
                            if(!$is_team_member){
                        ?>
                            <option value="<?php echo $staff['staffid']; ?>"><?php echo $staff['firstname'] . ' ' . $staff['lastname']; ?></option>
                        <?php }} ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php } ?>

<?php init_tail(); ?>
<script>
    $(function(){
        initDataTable('.dt-table');
    });
</script>
</body>
</html> 