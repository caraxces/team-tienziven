<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('add_approval'); ?></h4>
                        <hr class="hr-panel-heading" />
                        
                        <?php echo form_open(admin_url('my_team/add_approval/' . $type)); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="subject"><?php echo _l('subject'); ?> *</label>
                                    <input type="text" class="form-control" name="subject" id="subject" required>
                                </div>
                                
                                <?php if ($type == 'attendance') { ?>
                                <div class="form-group">
                                    <label for="date"><?php echo _l('date'); ?> *</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" name="date" id="date" value="<?php echo _d(date('Y-m-d')); ?>" required>
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar calendar-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_time"><?php echo _l('start_time'); ?></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control timepicker" name="start_time" id="start_time">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_time"><?php echo _l('end_time'); ?></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control timepicker" name="end_time" id="end_time">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } elseif ($type == 'leave') { ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date"><?php echo _l('start_date'); ?> *</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control datepicker" name="start_date" id="start_date" value="<?php echo _d(date('Y-m-d')); ?>" required>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar calendar-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_date"><?php echo _l('end_date'); ?> *</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control datepicker" name="end_date" id="end_date" value="<?php echo _d(date('Y-m-d', strtotime('+1 day'))); ?>" required>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar calendar-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="leave_type"><?php echo _l('leave_type'); ?> *</label>
                                    <select class="form-control" name="leave_type" id="leave_type" required>
                                        <option value="vacation"><?php echo _l('vacation'); ?></option>
                                        <option value="sick"><?php echo _l('sick_leave'); ?></option>
                                        <option value="wfh"><?php echo _l('work_from_home'); ?></option>
                                        <option value="other"><?php echo _l('other'); ?></option>
                                    </select>
                                </div>
                                <?php } elseif ($type == 'payment_request') { ?>
                                <div class="form-group">
                                    <label for="date"><?php echo _l('date'); ?> *</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" name="date" id="date" value="<?php echo _d(date('Y-m-d')); ?>" required>
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar calendar-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="amount"><?php echo _l('amount'); ?> *</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="amount" id="amount" step="0.01" min="0" required>
                                        <div class="input-group-addon">
                                            <?php echo $base_currency->symbol; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="payment_method"><?php echo _l('payment_method'); ?></label>
                                    <select class="form-control" name="payment_method" id="payment_method">
                                        <option value=""></option>
                                        <?php foreach ($payment_modes as $mode) { ?>
                                        <option value="<?php echo $mode['id']; ?>"><?php echo $mode['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php } ?>
                                
                                <div class="form-group">
                                    <label for="description"><?php echo _l('description'); ?></label>
                                    <textarea class="form-control" name="description" id="description" rows="6"></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
                                <a href="<?php echo admin_url('my_team/approvals/' . $type); ?>" class="btn btn-default pull-left"><?php echo _l('cancel'); ?></a>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
$(function() {
    var validationFields = {
        subject: 'required',
        date: 'required'
    };
    
    <?php if ($type == 'leave') { ?>
    validationFields.start_date = 'required';
    validationFields.end_date = 'required';
    validationFields.leave_type = 'required';
    <?php } elseif ($type == 'payment_request') { ?>
    validationFields.amount = 'required';
    <?php } ?>
    
    appValidateForm($('form'), validationFields);
    
    $('.datepicker').datepicker({
        autoclose: true,
        format: app.options.date_format
    });
    
    $('.timepicker').timepicker({
        template: false,
        defaultTime: false,
        showInputs: false,
        minuteStep: 15
    });
});
</script>
</body>
</html> 