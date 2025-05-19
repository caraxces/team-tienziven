<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">Báo cáo phê duyệt: <?php echo _l($type); ?></h4>
                        <hr class="hr-panel-heading" />
                        <form method="get" class="form-inline" style="margin-bottom:20px;">
                            <div class="form-group">
                                <label for="start_date">Từ ngày</label>
                                <input type="date" class="form-control" name="start_date" value="<?php echo html_escape($this->input->get('start_date')); ?>">
                            </div>
                            <div class="form-group" style="margin-left:10px;">
                                <label for="end_date">Đến ngày</label>
                                <input type="date" class="form-control" name="end_date" value="<?php echo html_escape($this->input->get('end_date')); ?>">
                            </div>
                            <button type="submit" class="btn btn-info" style="margin-left:10px;">Lọc</button>
                        </form>
                        <?php if ($type == 'payment_requests') { ?>
                            <div class="alert alert-success">Tổng số tiền: <strong><?php echo number_format($report['total_amount'], 0, ',', '.'); ?> VNĐ</strong> | Số yêu cầu: <strong><?php echo $report['count']; ?></strong></div>
                        <?php } else { ?>
                            <div class="alert alert-info">Tổng số yêu cầu: <strong><?php echo $report['count']; ?></strong></div>
                        <?php } ?>
                        <div class="table-responsive mtop15">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Người gửi</th>
                                        <th>Tiêu đề</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Dữ liệu động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($approvals as $a){ ?>
                                    <tr>
                                        <td><?php echo $a['id']; ?></td>
                                        <td><?php echo $a['staff_name']; ?></td>
                                        <td><?php echo $a['subject']; ?></td>
                                        <td><?php echo $a['status']; ?></td>
                                        <td><?php echo $a['datecreated']; ?></td>
                                        <td><?php echo htmlspecialchars($a['data']); ?></td>
                                    </tr>
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
<?php init_tail(); ?>
</body>
</html> 