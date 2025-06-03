<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="no-margin">
                                    <i class="fa fa-credit-card text-success"></i> 
                                    <?php echo $title; ?>
                                </h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="<?php echo admin_url('my_team/approval'); ?>" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> <?php echo _l('change_approval_type'); ?>
                                </a>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <?php echo form_open_multipart(admin_url('my_team/approval_payment/' . (isset($approval) ? $approval->id : '')), ['id' => 'payment-approval-form']); ?>
                        <input type="hidden" name="approval_type" value="payment">
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-info-circle"></i> <?php echo _l('payment_approval_information'); ?>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <!-- Chủ đề -->
                                        <div class="form-group">
                                            <label for="subject" class="required">
                                                <i class="fa fa-tag"></i> <?php echo _l('payment_subject'); ?>
                                            </label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   name="subject" 
                                                   id="subject" 
                                                   value="<?php echo (isset($approval) ? $approval->subject : ''); ?>" 
                                                   placeholder="<?php echo _l('payment_subject_placeholder'); ?>"
                                                   required>
                                            <small class="text-muted"><?php echo _l('payment_subject_help'); ?></small>
                                        </div>
                                        
                                        <!-- Số tiền -->
                                        <div class="form-group">
                                            <label for="amount" class="required">
                                                <i class="fa fa-money"></i> <?php echo _l('payment_amount'); ?>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><?php echo $base_currency->symbol; ?></span>
                                                <input type="number" 
                                                       class="form-control text-right" 
                                                       name="amount" 
                                                       id="amount" 
                                                       value="<?php echo (isset($approval) ? $approval->amount : ''); ?>" 
                                                       step="0.01" 
                                                       min="0.01"
                                                       placeholder="0.00"
                                                       required>
                                            </div>
                                            <small class="text-muted"><?php echo _l('payment_amount_help'); ?></small>
                                        </div>
                                        
                                        <!-- Thông tin chi tiết -->
                                        <div class="form-group">
                                            <label for="description" class="required">
                                                <i class="fa fa-file-text-o"></i> <?php echo _l('payment_details'); ?>
                                            </label>
                                            <textarea name="description" 
                                                      id="description" 
                                                      class="form-control" 
                                                      rows="6"
                                                      placeholder="<?php echo _l('payment_details_placeholder'); ?>"
                                                      required><?php echo (isset($approval) ? $approval->description : ''); ?></textarea>
                                            <small class="text-muted"><?php echo _l('payment_details_help'); ?></small>
                                        </div>
                                        
                                        <!-- Đính kèm file PDF hóa đơn -->
                                        <div class="form-group">
                                            <label for="invoice_attachment" class="required">
                                                <i class="fa fa-paperclip"></i> <?php echo _l('payment_invoice_attachment'); ?>
                                            </label>
                                            <input type="file" 
                                                   name="invoice_attachment" 
                                                   id="invoice_attachment" 
                                                   class="form-control"
                                                   accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                                   <?php echo (!isset($approval) ? 'required' : ''); ?>>
                                            
                                            <?php if (isset($approval) && $approval->attachment) { ?>
                                            <div class="mtop10">
                                                <div class="alert alert-info">
                                                    <i class="fa fa-file-pdf-o"></i> 
                                                    <strong><?php echo _l('current_attachment'); ?>:</strong>
                                                    <a href="<?php echo admin_url('my_team/download_attachment/' . $approval->id); ?>" 
                                                       class="text-info" target="_blank">
                                                        <?php echo _l('download_current_attachment'); ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            
                                            <small class="text-muted">
                                                <?php echo _l('payment_invoice_attachment_help'); ?>
                                                <br>
                                                <strong><?php echo _l('accepted_formats'); ?>:</strong> PDF, JPG, PNG, DOC, DOCX (<?php echo _l('max_size'); ?>: 10MB)
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Sidebar thông tin -->
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-cog"></i> <?php echo _l('approval_settings'); ?>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <!-- Phòng ban -->
                                        <div class="form-group">
                                            <label for="department_id">
                                                <i class="fa fa-building"></i> <?php echo _l('department'); ?>
                                                <span class="text-muted">(<?php echo _l('optional'); ?>)</span>
                                            </label>
                                            <select name="department_id" id="department_id" class="selectpicker" data-width="100%">
                                                <option value=""><?php echo _l('select_department'); ?></option>
                                                <?php if (!empty($departments)) { ?>
                                                    <?php foreach ($departments as $department) { ?>
                                                    <option value="<?php echo $department['departmentid']; ?>" 
                                                            <?php if (isset($approval) && $approval->department_id == $department['departmentid']) { echo 'selected'; } ?>>
                                                        <?php echo $department['name']; ?>
                                                    </option>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <option value="" disabled><?php echo _l('no_departments_available'); ?></option>
                                                <?php } ?>
                                            </select>
                                            <small class="text-muted"><?php echo _l('department_help_optional'); ?></small>
                                        </div>
                                        
                                        <!-- Mức độ ưu tiên -->
                                        <div class="form-group">
                                            <label for="priority">
                                                <i class="fa fa-flag"></i> <?php echo _l('priority'); ?>
                                            </label>
                                            <select name="priority" id="priority" class="selectpicker" data-width="100%">
                                                <option value="normal" <?php if (isset($approval) && $approval->priority == 'normal') { echo 'selected'; } ?>>
                                                    <?php echo _l('priority_normal'); ?>
                                                </option>
                                                <option value="high" <?php if (isset($approval) && $approval->priority == 'high') { echo 'selected'; } ?>>
                                                    <?php echo _l('priority_high'); ?>
                                                </option>
                                                <option value="urgent" <?php if (isset($approval) && $approval->priority == 'urgent') { echo 'selected'; } ?>>
                                                    <?php echo _l('priority_urgent'); ?>
                                                </option>
                                            </select>
                                        </div>
                                        
                                        <!-- Ngày cần thanh toán -->
                                        <div class="form-group">
                                            <label for="payment_date">
                                                <i class="fa fa-calendar"></i> <?php echo _l('payment_due_date'); ?>
                                            </label>
                                            <div class="input-group date">
                                                <input type="text" 
                                                       name="payment_date" 
                                                       id="payment_date" 
                                                       class="form-control datepicker" 
                                                       value="<?php echo (isset($approval) && $approval->date_from ? _d($approval->date_from) : ''); ?>"
                                                       autocomplete="off">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <small class="text-muted"><?php echo _l('payment_due_date_help'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Hướng dẫn -->
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-lightbulb-o"></i> <?php echo _l('payment_approval_tips'); ?>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-check text-success"></i> <?php echo _l('tip_clear_subject'); ?></li>
                                            <li><i class="fa fa-check text-success"></i> <?php echo _l('tip_exact_amount'); ?></li>
                                            <li><i class="fa fa-check text-success"></i> <?php echo _l('tip_detailed_description'); ?></li>
                                            <li><i class="fa fa-check text-success"></i> <?php echo _l('tip_attach_invoice'); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action buttons -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="hr-panel-heading" />
                                <div class="text-right">
                                    <a href="<?php echo admin_url('my_team/approvals'); ?>" class="btn btn-default mright10">
                                        <i class="fa fa-times"></i> <?php echo _l('cancel'); ?>
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-paper-plane"></i> <?php echo _l('submit_payment_approval'); ?>
                                    </button>
                                </div>
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
    // Initialize date picker
    init_datepicker();
    
    // Auto-format amount
    $('#amount').on('blur', function() {
        var value = parseFloat($(this).val());
        if (!isNaN(value)) {
            $(this).val(value.toFixed(2));
        }
    });
    
    // File validation
    $('#invoice_attachment').on('change', function() {
        var file = this.files[0];
        if (file) {
            // Check file size (10MB)
            var maxSize = 10 * 1024 * 1024; // 10MB in bytes
            if (file.size > maxSize) {
                alert('<?php echo _l('file_too_large'); ?>');
                $(this).val('');
                return;
            }
            
            // Check file type
            var allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if (allowedTypes.indexOf(file.type) === -1) {
                alert('<?php echo _l('invalid_file_type'); ?>');
                $(this).val('');
                return;
            }
            
            // Show file name
            var fileName = file.name;
            if (fileName.length > 30) {
                fileName = fileName.substring(0, 27) + '...';
            }
            
            // Create preview
            var preview = '<div class="alert alert-success mtop10" id="file-preview">' +
                         '<i class="fa fa-file"></i> <strong><?php echo _l('selected_file'); ?>:</strong> ' + fileName +
                         '</div>';
            
            $('#file-preview').remove();
            $(this).after(preview);
        }
    });
    
    // Form validation
    $('#payment-approval-form').on('submit', function(e) {
        var amount = parseFloat($('#amount').val());
        
        if (isNaN(amount) || amount <= 0) {
            alert('<?php echo _l('please_enter_valid_amount'); ?>');
            $('#amount').focus();
            e.preventDefault();
            return false;
        }
        
        if ($.trim($('#description').val()).length < 10) {
            alert('<?php echo _l('description_too_short'); ?>');
            $('#description').focus();
            e.preventDefault();
            return false;
        }
        
        <?php if (!isset($approval)) { ?>
        if (!$('#invoice_attachment').val()) {
            alert('<?php echo _l('please_attach_invoice'); ?>');
            $('#invoice_attachment').focus();
            e.preventDefault();
            return false;
        }
        <?php } ?>
        
        // Show loading
        $(this).find('button[type="submit"]').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> <?php echo _l('processing'); ?>');
        
        return true;
    });
    
    // Auto-generate subject based on amount and description
    $('#amount, #description').on('blur', function() {
        if (!$.trim($('#subject').val())) {
            var amount = $('#amount').val();
            var description = $('#description').val();
            
            if (amount && description) {
                var subject = '<?php echo _l('payment_request'); ?> - ' + '<?php echo $base_currency->symbol; ?>' + amount;
                var firstLine = description.split('\n')[0];
                if (firstLine && firstLine.length < 50) {
                    subject += ' (' + firstLine + ')';
                }
                $('#subject').val(subject);
            }
        }
    });
});
</script>

<style>
.required:after {
    content: " *";
    color: #e74c3c;
}

.panel-title i {
    margin-right: 8px;
}

.form-group label i {
    margin-right: 5px;
    width: 15px;
    text-align: center;
}

.input-group-addon {
    min-width: 45px;
}

#file-preview {
    margin-top: 10px;
}

.alert ul {
    margin-bottom: 0;
}

.alert li {
    padding: 2px 0;
}

.text-muted {
    font-weight: normal;
}

.form-group label .text-muted {
    font-size: 12px;
    margin-left: 5px;
}

@media (max-width: 768px) {
    .text-right {
        text-align: center !important;
        margin-top: 15px;
    }
    
    .mright10 {
        margin-right: 0 !important;
        margin-bottom: 10px;
    }
}
</style> 