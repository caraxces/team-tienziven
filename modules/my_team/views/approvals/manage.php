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
                                <a href="<?php echo admin_url('my_team/add_approval/' . $type); ?>" class="btn btn-info">
                                    <i class="fa fa-plus"></i> <?php echo _l('add_approval'); ?>
                                </a>
                                <a href="<?php echo admin_url('my_team/export_approvals/' . $type); ?>" class="btn btn-success" style="margin-left:10px;">
                                    <i class="fa fa-download"></i> Xuất CSV
                                </a>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" <?php echo $type == 'payment_requests' ? 'class="active"' : ''; ?>>
                                <a href="<?php echo admin_url('my_team/approvals/payment_requests'); ?>">
                                    <?php echo _l('payment_requests'); ?>
                                </a>
                            </li>
                            <li role="presentation" <?php echo $type == 'leave' ? 'class="active"' : ''; ?>>
                                <a href="<?php echo admin_url('my_team/approvals/leave'); ?>">
                                    <?php echo _l('leave_requests'); ?>
                                </a>
                            </li>
                            <li role="presentation" <?php echo $type == 'attendance' ? 'class="active"' : ''; ?>>
                                <a href="<?php echo admin_url('my_team/approvals/attendance'); ?>">
                                    <?php echo _l('attendance_requests'); ?>
                                </a>
                            </li>
                        </ul>
                        
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active">
                                <?php if(!empty($approvals)){ ?>
                                <div class="table-responsive mtop15">
                                    <table class="table dt-table">
                                        <thead>
                                            <tr>
                                                <th><?php echo _l('staff_member'); ?></th>
                                                <th><?php echo _l('subject'); ?></th>
                                                <th><?php echo _l('date_requested'); ?></th>
                                                <?php if($type == 'payment_requests' || $type == 'leave'){ ?>
                                                <th><?php echo _l('date'); ?></th>
                                                <?php } ?>
                                                <th><?php echo _l('status'); ?></th>
                                                <th><?php echo _l('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($approvals as $approval){ ?>
                                            <tr>
                                                <td><?php echo $approval['staff_name']; ?></td>
                                                <td>
                                                    <a href="<?php echo admin_url('my_team/view_approval/' . $approval['id']); ?>">
                                                        <?php echo $approval['subject']; ?>
                                                        <?php
                                                        // Hiển thị badge đỏ nếu chưa đọc
                                                        $is_unread = false;
                                                        if ($can_approve && isset($approval['read_by_approver']) && $approval['read_by_approver'] == 0) {
                                                            $is_unread = true;
                                                        } elseif (!$can_approve && isset($approval['read_by_staff']) && $approval['read_by_staff'] == 0) {
                                                            $is_unread = true;
                                                        }
                                                        if ($is_unread) {
                                                            echo '<span style="color:red;font-size:18px;margin-left:5px;vertical-align:middle;">●</span>';
                                                        }
                                                        ?>
                                                    </a>
                                                </td>
                                                <td><?php echo _dt($approval['datecreated']); ?></td>
                                                <?php if($type == 'payment_requests' || $type == 'leave'){ ?>
                                                <td><?php echo _d($approval['date']); ?></td>
                                                <?php } ?>
                                                <td>
                                                    <?php
                                                    $status_class = '';
                                                    $status_text = '';
                                                    
                                                    switch($approval['status']){
                                                        case 1:
                                                            $status_class = 'warning';
                                                            $status_text = _l('pending');
                                                            break;
                                                        case 2:
                                                            $status_class = 'success';
                                                            $status_text = _l('approved');
                                                            break;
                                                        case 3:
                                                            $status_class = 'danger';
                                                            $status_text = _l('rejected');
                                                            break;
                                                    }
                                                    ?>
                                                    <span class="label label-<?php echo $status_class; ?>">
                                                        <?php echo $status_text; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="<?php echo admin_url('my_team/view_approval/' . $approval['id']); ?>" class="btn btn-default btn-icon"><i class="fa fa-eye"></i></a>
                                                        <?php if($can_approve && $approval['status'] == 1){ ?>
                                                        <a href="<?php echo admin_url('my_team/change_approval_status/' . $approval['id'] . '/2'); ?>" class="btn btn-success btn-icon" data-toggle="tooltip" title="<?php echo _l('approve'); ?>"><i class="fa fa-check"></i></a>
                                                        <a href="<?php echo admin_url('my_team/change_approval_status/' . $approval['id'] . '/3'); ?>" class="btn btn-danger btn-icon" data-toggle="tooltip" title="<?php echo _l('reject'); ?>"><i class="fa fa-times"></i></a>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php }else{ ?>
                                <div class="alert alert-info mtop15">
                                    <p><?php echo _l('no_approvals_found'); ?></p>
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
    $(function(){
        initDataTable('.dt-table');
        
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html> 