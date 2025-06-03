<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">
                            <i class="fa fa-cogs"></i> My Team - Database Setup
                        </h4>
                        <hr class="hr-panel-heading" />
                        
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i>
                            <strong>Thông tin:</strong> Trang này giúp bạn thiết lập các bảng cơ sở dữ liệu cần thiết cho module My Team.
                        </div>
                        
                        <!-- Trạng thái các bảng -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5><i class="fa fa-database"></i> Trạng thái các bảng:</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tên bảng</th>
                                                <th>Mô tả</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($tables_status as $table) { ?>
                                            <tr>
                                                <td><code><?php echo db_prefix() . $table['name']; ?></code></td>
                                                <td><?php echo $table['description']; ?></td>
                                                <td>
                                                    <?php if ($table['exists']) { ?>
                                                        <span class="label label-success">
                                                            <i class="fa fa-check"></i> Đã tồn tại
                                                        </span>
                                                    <?php } else { ?>
                                                        <span class="label label-warning">
                                                            <i class="fa fa-exclamation-triangle"></i> Chưa tồn tại
                                                        </span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Nút tạo bảng -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <?php echo form_open(admin_url('my_team/setup_tables')); ?>
                                
                                <div class="alert alert-warning">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    <strong>Cảnh báo:</strong> Thao tác này sẽ tạo các bảng mới trong cơ sở dữ liệu. 
                                    Vui lòng đảm bảo bạn đã sao lưu dữ liệu trước khi thực hiện.
                                </div>
                                
                                <button type="submit" name="create_tables" value="1" class="btn btn-primary btn-lg" onclick="return confirm('Bạn có chắc chắn muốn tạo các bảng? Thao tác này không thể hoàn tác.');">
                                    <i class="fa fa-database"></i> Tạo các bảng cần thiết
                                </button>
                                
                                <a href="<?php echo admin_url('my_team'); ?>" class="btn btn-default btn-lg">
                                    <i class="fa fa-arrow-left"></i> Quay lại Dashboard
                                </a>
                                
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        
                        <!-- Hướng dẫn -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <h5><i class="fa fa-question-circle"></i> Hướng dẫn:</h5>
                                <div class="well">
                                    <h6><strong>Các bảng sẽ được tạo:</strong></h6>
                                    <ul>
                                        <li><code><?php echo db_prefix(); ?>my_team_approvals</code> - Lưu trữ yêu cầu phê duyệt</li>
                                        <li><code><?php echo db_prefix(); ?>my_team_knowledge</code> - Lưu trữ tài liệu kiến thức</li>
                                        <li><code><?php echo db_prefix(); ?>my_team_knowledge_categories</code> - Danh mục kiến thức</li>
                                        <li><code><?php echo db_prefix(); ?>my_team_skills</code> - Kỹ năng của nhân viên</li>
                                        <li><code><?php echo db_prefix(); ?>my_team_training_documents</code> - Tài liệu đào tạo</li>
                                        <li><code><?php echo db_prefix(); ?>my_team_training_assignments</code> - Phân công đào tạo</li>
                                    </ul>
                                    
                                    <h6><strong>Lưu ý:</strong></h6>
                                    <ul>
                                        <li>Chỉ admin mới có quyền thực hiện thao tác này</li>
                                        <li>Các bảng đã tồn tại sẽ không bị ghi đè</li>
                                        <li>Nên sao lưu cơ sở dữ liệu trước khi thực hiện</li>
                                        <li>Sau khi tạo bảng thành công, bạn có thể sử dụng đầy đủ các tính năng của module</li>
                                    </ul>
                                </div>
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
.label {
    font-size: 12px;
    padding: 4px 8px;
}

.table code {
    background-color: #f8f9fa;
    padding: 2px 4px;
    border-radius: 3px;
    font-size: 12px;
}

.well {
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 5px;
    padding: 15px;
}

.well ul {
    margin-bottom: 0;
}

.well li {
    margin-bottom: 5px;
}

.alert i {
    margin-right: 8px;
}

.btn-lg {
    margin-right: 10px;
    margin-bottom: 10px;
}
</style> 