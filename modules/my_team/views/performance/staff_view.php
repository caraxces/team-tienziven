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

                        <!-- Performance Dashboard -->
                        <?php 
                        // Hiển thị dashboard cho user hiện tại
                        echo '<div data-user-id="' . $user['staffid'] . '" class="user-dashboard-container">';
                        $this->load->view('my_team/performance/user_dashboard_group', ['user' => $user, 'CI' => $CI]);
                        echo '</div>';
                        ?>
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