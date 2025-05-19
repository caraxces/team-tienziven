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
                        <?php echo form_open_multipart(admin_url('my_team/add_approval/' . $type)); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="approver_id"><?php echo _l('approver'); ?></label>
                                    <select class="form-control selectpicker" name="approver_id" id="approver_id" data-width="100%" required>
                                        <option value=""><?php echo _l('select_approver'); ?></option>
                                        <?php foreach ($staff as $member) { ?>
                                            <?php if (is_admin($member['staffid']) || has_permission('team_approvals', '', 'approve', $member['staffid'])) { ?>
                                                <option value="<?php echo $member['staffid']; ?>"><?php echo $member['firstname'] . ' ' . $member['lastname']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subject"><?php echo _l('approval_subject'); ?></label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                <div class="form-group">
                                    <label for="description"><?php echo _l('approval_description'); ?></label>
                                    <textarea class="form-control" name="description" id="description" rows="10"></textarea>
                                </div>
                                <?php if ($type == 'payment_requests') { ?>
                                <div class="form-group">
                                    <label for="amount">Số tiền</label>
                                    <input type="number" class="form-control" id="amount" name="amount" required>
                                </div>
                                <div class="form-group">
                                    <label for="purpose">Mục đích</label>
                                    <input type="text" class="form-control" id="purpose" name="purpose" required>
                                </div>
                                <div class="form-group">
                                    <label for="receiver">Người nhận</label>
                                    <input type="text" class="form-control" id="receiver" name="receiver" required>
                                </div>
                                <div class="form-group">
                                    <label for="invoice">Hóa đơn (nếu có)</label>
                                    <input type="file" class="form-control" id="invoice" name="invoice">
                                </div>
                                <?php } elseif ($type == 'leave') { ?>
                                <div class="form-group">
                                    <label for="leave_type">Loại phép</label>
                                    <select class="form-control" id="leave_type" name="leave_type" required>
                                        <option value="">Chọn loại phép</option>
                                        <option value="annual_leave">Nghỉ năm</option>
                                        <option value="sick_leave">Nghỉ ốm</option>
                                        <option value="unpaid_leave">Nghỉ không lương</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="handover_to">Người bàn giao</label>
                                    <input type="text" class="form-control" id="handover_to" name="handover_to">
                                </div>
                                <div class="form-group">
                                    <label for="reason">Lý do</label>
                                    <textarea class="form-control" id="reason" name="reason"></textarea>
                                </div>
                                <?php } elseif ($type == 'attendance') { ?>
                                <div class="form-group">
                                    <label for="reason">Lý do (đi muộn/về sớm...)</label>
                                    <input type="text" class="form-control" id="reason" name="reason" required>
                                </div>
                                <div class="form-group">
                                    <label for="file">File đính kèm (nếu có)</label>
                                    <input type="file" class="form-control" id="file" name="file">
                                </div>
                                <?php } ?>
                                <button type="submit" class="btn btn-info pull-right"><?php echo _l('submit'); ?></button>
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
    appValidateForm($('form'), {
        approver_id: 'required',
        subject: 'required'
    });
    
    $('#description').summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link']]
        ]
    });
});
</script>
</body>
</html> 