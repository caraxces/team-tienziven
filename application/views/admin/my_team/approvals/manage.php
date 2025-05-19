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
                                <h4 class="no-margin"><?php echo _l('approvals'); ?></h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-plus"></i> <?php echo _l('new_approval'); ?> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="<?php echo admin_url('my_team/add_approval/attendance'); ?>">
                                                <?php echo _l('attendance'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo admin_url('my_team/add_approval/leave'); ?>">
                                                <?php echo _l('leave_request'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo admin_url('my_team/add_approval/payment_request'); ?>">
                                                <?php echo _l('payment_request'); ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="<?php echo $type == 'attendance' ? 'active' : ''; ?>">
                                <a href="<?php echo admin_url('my_team/approvals/attendance'); ?>" aria-controls="attendance">
                                    <?php echo _l('attendance'); ?>
                                </a>
                            </li>
                            <li role="presentation" class="<?php echo $type == 'leave' ? 'active' : ''; ?>">
                                <a href="<?php echo admin_url('my_team/approvals/leave'); ?>" aria-controls="leave">
                                    <?php echo _l('leave_request'); ?>
                                </a>
                            </li>
                            <li role="presentation" class="<?php echo $type == 'payment_request' ? 'active' : ''; ?>">
                                <a href="<?php echo admin_url('my_team/approvals/payment_request'); ?>" aria-controls="payment_request">
                                    <?php echo _l('payment_request'); ?>
                                </a>
                            </li>
                        </ul>
                        
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active">
                                <?php if (!empty($approvals)) { ?>
                                <div class="table-responsive mtop15">
                                    <table class="table dt-table">
                                        <thead>
                                            <tr>
                                                <th><?php echo _l('subject'); ?></th>
                                                <?php if ($is_manager) { ?>
                                                <th><?php echo _l('staff_member'); ?></th>
                                                <?php } ?>
                                                <th><?php echo _l('date'); ?></th>
                                                <th><?php echo _l('status'); ?></th>
                                                <th><?php echo _l('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($approvals as $approval) { ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo admin_url('my_team/view_approval/' . $approval['id']); ?>">
                                                        <?php echo $approval['subject']; ?>
                                                    </a>
                                                </td>
                                                <?php if ($is_manager) { ?>
                                                <td><?php echo $approval['staff_name']; ?></td>
                                                <?php } ?>
                                                <td><?php echo _d($approval['date']); ?></td>
                                                <td>
                                                    <?php
                                                    $status_badge = '';
                                                    if ($approval['status'] == 1) {
                                                        $status_badge = 'warning';
                                                        $status_text = _l('pending');
                                                    } elseif ($approval['status'] == 2) {
                                                        $status_badge = 'success';
                                                        $status_text = _l('approved');
                                                    } else {
                                                        $status_badge = 'danger';
                                                        $status_text = _l('rejected');
                                                    }
                                                    ?>
                                                    <span class="label label-<?php echo $status_badge; ?> approval-badge">
                                                        <?php echo $status_text; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="<?php echo admin_url('my_team/view_approval/' . $approval['id']); ?>" class="btn btn-default btn-icon">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } else { ?>
                                <div class="alert alert-info mtop15">
                                    <?php echo _l('no_approvals_found'); ?>
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
<?php init_tail(); ?>
<script>
$(function() {
    $('.dt-table').DataTable();
});
</script>
</body>
</html> 