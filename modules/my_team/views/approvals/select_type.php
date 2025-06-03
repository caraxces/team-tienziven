<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('select_approval_type'); ?></h4>
                        <hr class="hr-panel-heading" />
                        
                        <div class="row text-center">
                            <div class="col-md-12">
                                <p class="text-muted"><?php echo _l('select_approval_type_description'); ?></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- Approval Thanh toán -->
                            <div class="col-md-6 col-sm-12">
                                <div class="approval-type-card">
                                    <div class="panel panel-default">
                                        <div class="panel-body text-center" style="padding: 40px 20px;">
                                            <div class="approval-type-icon" style="margin-bottom: 20px;">
                                                <i class="fa fa-credit-card" style="font-size: 48px; color: #28a745;"></i>
                                            </div>
                                            <h4 style="margin-bottom: 15px; color: #333;">
                                                <?php echo _l('approval_type_payment'); ?>
                                            </h4>
                                            <p class="text-muted" style="margin-bottom: 25px;">
                                                <?php echo _l('approval_type_payment_description'); ?>
                                            </p>
                                            <div class="approval-type-features" style="margin-bottom: 25px;">
                                                <ul class="list-unstyled text-left" style="display: inline-block;">
                                                    <li><i class="fa fa-check text-success"></i> <?php echo _l('payment_subject'); ?></li>
                                                    <li><i class="fa fa-check text-success"></i> <?php echo _l('payment_amount'); ?></li>
                                                    <li><i class="fa fa-check text-success"></i> <?php echo _l('payment_details'); ?></li>
                                                    <li><i class="fa fa-check text-success"></i> <?php echo _l('payment_invoice_attachment'); ?></li>
                                                </ul>
                                            </div>
                                            <a href="<?php echo admin_url('my_team/approval_payment'); ?>" class="btn btn-success btn-lg">
                                                <i class="fa fa-plus"></i> <?php echo _l('create_payment_approval'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Approval Nghỉ phép / Out of Office -->
                            <div class="col-md-6 col-sm-12">
                                <div class="approval-type-card">
                                    <div class="panel panel-default">
                                        <div class="panel-body text-center" style="padding: 40px 20px;">
                                            <div class="approval-type-icon" style="margin-bottom: 20px;">
                                                <i class="fa fa-calendar-times-o" style="font-size: 48px; color: #007bff;"></i>
                                            </div>
                                            <h4 style="margin-bottom: 15px; color: #333;">
                                                <?php echo _l('approval_type_leave'); ?>
                                            </h4>
                                            <p class="text-muted" style="margin-bottom: 25px;">
                                                <?php echo _l('approval_type_leave_description'); ?>
                                            </p>
                                            <div class="approval-type-features" style="margin-bottom: 25px;">
                                                <ul class="list-unstyled text-left" style="display: inline-block;">
                                                    <li><i class="fa fa-check text-success"></i> <?php echo _l('leave_subject'); ?></li>
                                                    <li><i class="fa fa-check text-success"></i> <?php echo _l('leave_type_selection'); ?></li>
                                                    <li><i class="fa fa-check text-success"></i> <?php echo _l('leave_detailed_reason'); ?></li>
                                                    <li><i class="fa fa-check text-success"></i> <?php echo _l('leave_optional_attachment'); ?></li>
                                                </ul>
                                            </div>
                                            <a href="<?php echo admin_url('my_team/approval_leave'); ?>" class="btn btn-primary btn-lg">
                                                <i class="fa fa-plus"></i> <?php echo _l('create_leave_approval'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 text-center" style="margin-top: 30px;">
                                <a href="<?php echo admin_url('my_team/approvals'); ?>" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> <?php echo _l('back_to_approvals'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<style>
.approval-type-card {
    margin-bottom: 30px;
}

.approval-type-card .panel {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.approval-type-card .panel:hover {
    border-color: #007bff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    transform: translateY(-2px);
}

.approval-type-features li {
    padding: 3px 0;
}

.approval-type-features .fa-check {
    margin-right: 8px;
    width: 16px;
}

@media (max-width: 768px) {
    .approval-type-card {
        margin-bottom: 20px;
    }
    
    .approval-type-card .panel-body {
        padding: 30px 15px !important;
    }
    
    .approval-type-icon i {
        font-size: 36px !important;
    }
}
</style> 