<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo _l('approval_report'); ?></h4>
                        <hr class="hr-panel-heading" />
                        
                        <?php if (isset($table_not_exists) && $table_not_exists === true): ?>
                        <!-- Database Setup Required -->
                        <div class="alert alert-warning" role="alert">
                            <h4><i class="fa fa-exclamation-triangle"></i> Cần thiết lập Database</h4>
                            <p>Các bảng dữ liệu cho module My Team chưa được tìm thấy.</p>
                            <p>Vui lòng thiết lập database trước khi sử dụng tính năng báo cáo.</p>
                            <?php if (isset($error_message)): ?>
                            <p><strong>Lỗi:</strong> <?php echo $error_message; ?></p>
                            <?php endif; ?>
                            <a href="<?php echo isset($setup_url) ? $setup_url : admin_url('my_team/setup_tables'); ?>" class="btn btn-primary">
                                <i class="fa fa-cogs"></i> Thiết lập Database
                            </a>
                            <a href="<?php echo admin_url('my_team'); ?>" class="btn btn-default">
                                <i class="fa fa-arrow-left"></i> Quay lại My Team
                            </a>
                        </div>
                        <?php else: ?>
                        
                        <!-- Filter Section -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <?php echo form_open(admin_url('my_team/report'), ['method' => 'get', 'id' => 'filter-form']); ?>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="approval_type">Loại phê duyệt</label>
                                                    <select name="approval_type" id="approval_type" class="selectpicker" data-width="100%">
                                                        <option value="">Tất cả</option>
                                                        <option value="general" <?php if (isset($_GET['approval_type']) && $_GET['approval_type'] == 'general') { echo 'selected'; } ?>>Tổng quát</option>
                                                        <option value="leave" <?php if (isset($_GET['approval_type']) && $_GET['approval_type'] == 'leave') { echo 'selected'; } ?>>Nghỉ phép</option>
                                                        <option value="payment" <?php if (isset($_GET['approval_type']) && $_GET['approval_type'] == 'payment') { echo 'selected'; } ?>>Thanh toán</option>
                                                        <option value="financial" <?php if (isset($_GET['approval_type']) && $_GET['approval_type'] == 'financial') { echo 'selected'; } ?>>Tài chính</option>
                                                        <option value="attendance" <?php if (isset($_GET['approval_type']) && $_GET['approval_type'] == 'attendance') { echo 'selected'; } ?>>Điểm danh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="status">Trạng thái</label>
                                                    <select name="status" id="status" class="selectpicker" data-width="100%">
                                                        <option value="">Tất cả</option>
                                                        <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == '0') { echo 'selected'; } ?>>Chờ duyệt</option>
                                                        <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == '1') { echo 'selected'; } ?>>Đã duyệt</option>
                                                        <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == '2') { echo 'selected'; } ?>>Từ chối</option>
                                                        <option value="3" <?php if (isset($_GET['status']) && $_GET['status'] == '3') { echo 'selected'; } ?>>Đã hủy</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="department_id">Phòng ban</label>
                                                    <select name="department_id" id="department_id" class="selectpicker" data-width="100%">
                                                        <option value="">Tất cả</option>
                                                        <?php if (isset($departments) && is_array($departments)): ?>
                                                        <?php foreach ($departments as $department) { ?>
                                                        <option value="<?php echo $department['departmentid']; ?>" <?php if (isset($_GET['department_id']) && $_GET['department_id'] == $department['departmentid']) { echo 'selected'; } ?>><?php echo $department['name']; ?></option>
                                                        <?php } ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="staff_id">Nhân viên</label>
                                                    <select name="staff_id" id="staff_id" class="selectpicker" data-width="100%" data-live-search="true">
                                                        <option value="">Tất cả</option>
                                                        <?php if (isset($staff_members) && is_array($staff_members)): ?>
                                                        <?php foreach ($staff_members as $staff) { ?>
                                                        <option value="<?php echo $staff['staffid']; ?>" <?php if (isset($_GET['staff_id']) && $_GET['staff_id'] == $staff['staffid']) { echo 'selected'; } ?>><?php echo $staff['firstname'] . ' ' . $staff['lastname']; ?></option>
                                                        <?php } ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                                        <a href="<?php echo admin_url('my_team/report'); ?>" class="btn btn-default">Reset</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Summary Section -->
                        <?php if (isset($approvals) && is_array($approvals)): ?>
                        <div class="row mtop15">
                            <div class="col-md-3 col-sm-6">
                                <div class="widget widget-bg-color-white border-radius">
                                    <div class="widget-body">
                                        <div class="widget-stat-header">
                                            <div class="pull-left" style="width: 100%;">
                                                <h4 class="bold no-margin text-warning">Chờ duyệt</h4>
                                                <span class="widget-subtitle text-muted">Tổng số chờ duyệt</span>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="widget-stat-body">
                                            <h2 class="bold">
                                                <?php
                                                    $pending_count = 0;
                                                    foreach ($approvals as $approval) {
                                                        if ($approval['status'] == 0) {
                                                            $pending_count++;
                                                        }
                                                    }
                                                    echo $pending_count;
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="widget widget-bg-color-white border-radius">
                                    <div class="widget-body">
                                        <div class="widget-stat-header">
                                            <div class="pull-left" style="width: 100%;">
                                                <h4 class="bold no-margin text-success">Đã duyệt</h4>
                                                <span class="widget-subtitle text-muted">Tổng số đã duyệt</span>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="widget-stat-body">
                                            <h2 class="bold">
                                                <?php
                                                    $approved_count = 0;
                                                    foreach ($approvals as $approval) {
                                                        if ($approval['status'] == 1) {
                                                            $approved_count++;
                                                        }
                                                    }
                                                    echo $approved_count;
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="widget widget-bg-color-white border-radius">
                                    <div class="widget-body">
                                        <div class="widget-stat-header">
                                            <div class="pull-left" style="width: 100%;">
                                                <h4 class="bold no-margin text-danger">Từ chối</h4>
                                                <span class="widget-subtitle text-muted">Tổng số từ chối</span>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="widget-stat-body">
                                            <h2 class="bold">
                                                <?php
                                                    $rejected_count = 0;
                                                    foreach ($approvals as $approval) {
                                                        if ($approval['status'] == 2) {
                                                            $rejected_count++;
                                                        }
                                                    }
                                                    echo $rejected_count;
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="widget widget-bg-color-white border-radius">
                                    <div class="widget-body">
                                        <div class="widget-stat-header">
                                            <div class="pull-left" style="width: 100%;">
                                                <h4 class="bold no-margin text-muted">Đã hủy</h4>
                                                <span class="widget-subtitle text-muted">Tổng số đã hủy</span>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="widget-stat-body">
                                            <h2 class="bold">
                                                <?php
                                                    $cancelled_count = 0;
                                                    foreach ($approvals as $approval) {
                                                        if ($approval['status'] == 3) {
                                                            $cancelled_count++;
                                                        }
                                                    }
                                                    echo $cancelled_count;
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Table Section -->
                        <div class="row mtop15">
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h4 class="no-margin">Danh sách phê duyệt</h4>
                                        <hr class="hr-panel-heading" />
                                        
                                        <?php if (count($approvals) > 0) { ?>
                                        <div class="table-responsive">
                                            <table class="table dt-table" data-order-col="0" data-order-type="desc">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Chủ đề</th>
                                                        <th>Nhân viên</th>
                                                        <th>Phòng ban</th>
                                                        <th>Loại</th>
                                                        <th>Trạng thái</th>
                                                        <th>Số tiền</th>
                                                        <th>Ngày tạo</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($approvals as $approval) { ?>
                                                    <tr>
                                                        <td><?php echo $approval['id']; ?></td>
                                                        <td>
                                                            <a href="<?php echo admin_url('my_team/view_approval/' . $approval['id']); ?>"><?php echo $approval['subject']; ?></a>
                                                        </td>
                                                        <td><?php echo $approval['firstname'] . ' ' . $approval['lastname']; ?></td>
                                                        <td><?php echo $approval['department_name']; ?></td>
                                                        <td>
                                                            <?php 
                                                            $badge_class = 'badge-primary';
                                                            switch ($approval['approval_type']) {
                                                                case 'leave':
                                                                    $badge_class = 'badge-info';
                                                                    $type_text = 'Nghỉ phép';
                                                                    break;
                                                                case 'payment':
                                                                    $badge_class = 'badge-success';
                                                                    $type_text = 'Thanh toán';
                                                                    break;
                                                                case 'financial':
                                                                    $badge_class = 'badge-warning';
                                                                    $type_text = 'Tài chính';
                                                                    break;
                                                                case 'attendance':
                                                                    $badge_class = 'badge-secondary';
                                                                    $type_text = 'Điểm danh';
                                                                    break;
                                                                default:
                                                                    $badge_class = 'badge-primary';
                                                                    $type_text = 'Tổng quát';
                                                                    break;
                                                            }
                                                            ?>
                                                            <span class="badge <?php echo $badge_class; ?>"><?php echo $type_text; ?></span>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                            switch ($approval['status']) {
                                                                case 0:
                                                                    echo '<span class="label label-warning">Chờ duyệt</span>';
                                                                    break;
                                                                case 1:
                                                                    echo '<span class="label label-success">Đã duyệt</span>';
                                                                    break;
                                                                case 2:
                                                                    echo '<span class="label label-danger">Từ chối</span>';
                                                                    break;
                                                                case 3:
                                                                    echo '<span class="label label-default">Đã hủy</span>';
                                                                    break;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo number_format($approval['amount'], 0, ',', '.'); ?> VND</td>
                                                        <td><?php echo date('d/m/Y H:i', strtotime($approval['created_date'])); ?></td>
                                                        <td>
                                                            <a href="<?php echo admin_url('my_team/view_approval/' . $approval['id']); ?>" class="btn btn-default btn-icon"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php } else { ?>
                                        <div class="alert alert-info">
                                            Không tìm thấy yêu cầu phê duyệt nào.
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php endif; // End of table_not_exists check ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script>
$(function() {
    // DataTable initialization
    if ($.fn.DataTable) {
        $('.dt-table').DataTable({
            "pageLength": 25,
            "order": [[ 0, "desc" ]],
            "language": {
                "lengthMenu": "Hiển thị _MENU_ dòng trên mỗi trang",
                "zeroRecords": "Không tìm thấy dữ liệu",
                "info": "Hiển thị _START_ đến _END_ của _TOTAL_ dòng",
                "infoEmpty": "Hiển thị 0 đến 0 của 0 dòng",
                "infoFiltered": "(lọc từ _MAX_ tổng số dòng)",
                "search": "Tìm kiếm:",
                "paginate": {
                    "first": "Đầu",
                    "last": "Cuối",
                    "next": "Tiếp",
                    "previous": "Trước"
                }
            }
        });
    }
});
</script> 