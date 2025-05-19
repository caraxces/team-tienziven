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
        <div class="row">
            <div class="col-md-12">
                <?php
                // Widget: Thống kê nhanh
                $this->load->view('admin/dashboard/widgets/top_stats', ['user_id' => $user['staffid']]);
                ?>
            </div>
        </div>
        <div class="row mtop10">
            <div class="col-md-8">
                <?php
                // Widget: Tasks, Projects, Tickets, Reminders
                $this->load->view('admin/dashboard/widgets/user_data', ['user_id' => $user['staffid']]);
                ?>
            </div>
            <div class="col-md-4">
                <?php
                // Widget: Calendar
                $this->load->view('admin/dashboard/widgets/calendar', ['user_id' => $user['staffid']]);
                ?>
                <?php
                // Widget: Todos
                $this->load->view('admin/dashboard/widgets/todos', ['user_id' => $user['staffid']]);
                ?>
            </div>
        </div>
        <div class="row mtop10">
            <div class="col-md-12">
                <?php
                // Widget: Finance overview
                $this->load->view('admin/dashboard/widgets/finance_overview', ['user_id' => $user['staffid']]);
                ?>
            </div>
        </div>
    </div>
</div> 