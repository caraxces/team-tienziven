<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php 
// Debug: Kiểm tra dữ liệu được truyền vào view
if (ENVIRONMENT == 'development') {
    echo "<!-- DEBUG: View training/manage.php loaded -->";
    echo "<!-- DEBUG: is_manager = " . (isset($is_manager) ? ($is_manager ? 'true' : 'false') : 'not set') . " -->";
    echo "<!-- DEBUG: training_documents count = " . (isset($training_documents) ? count($training_documents) : 'not set') . " -->";
    echo "<!-- DEBUG: training_assignments count = " . (isset($training_assignments) ? count($training_assignments) : 'not set') . " -->";
}
?>
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
                                    <i class="fa fa-graduation-cap"></i> 
                                    <?php echo _l('team_training'); ?>
                                </h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <?php if ($is_manager) { ?>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadDocumentModal">
                                    <i class="fa fa-upload"></i> <?php echo _l('upload_training_document'); ?>
                                </button>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <?php if ($is_manager) { ?>
                        <!-- Manager View: Thống kê và quản lý documents -->
                        
                        <!-- Training Statistics -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel_s">
                                    <div class="panel-body text-center dashboard-panel dashboard-panel-primary">
                                        <div class="dashboard-panel-content">
                                            <span class="dashboard-summary-badge"><?php echo isset($training_stats['total_documents']) ? $training_stats['total_documents'] : 0; ?></span>
                                            <span class="dashboard-summary-label"><?php echo _l('total_training_documents'); ?></span>
                                        </div>
                                        <i class="fa fa-file-text icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel_s">
                                    <div class="panel-body text-center dashboard-panel dashboard-panel-info">
                                        <div class="dashboard-panel-content">
                                            <span class="dashboard-summary-badge"><?php echo isset($training_stats['total_assignments']) ? $training_stats['total_assignments'] : 0; ?></span>
                                            <span class="dashboard-summary-label"><?php echo _l('total_assignments'); ?></span>
                                        </div>
                                        <i class="fa fa-tasks icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel_s">
                                    <div class="panel-body text-center dashboard-panel dashboard-panel-success">
                                        <div class="dashboard-panel-content">
                                            <span class="dashboard-summary-badge"><?php echo isset($training_stats['completed_assignments']) ? $training_stats['completed_assignments'] : 0; ?></span>
                                            <span class="dashboard-summary-label"><?php echo _l('completed_assignments'); ?></span>
                                        </div>
                                        <i class="fa fa-check-circle icon"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel_s">
                                    <div class="panel-body text-center dashboard-panel dashboard-panel-warning">
                                        <div class="dashboard-panel-content">
                                            <span class="dashboard-summary-badge"><?php echo isset($training_stats['pending_assignments']) ? $training_stats['pending_assignments'] : 0; ?></span>
                                            <span class="dashboard-summary-label"><?php echo _l('pending_assignments'); ?></span>
                                        </div>
                                        <i class="fa fa-clock-o icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Training Documents List -->
                        <div class="row mtop15">
                            <div class="col-md-12">
                                <h5><?php echo _l('my_training_documents'); ?></h5>
                                <?php if (count($training_documents) > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table dt-table" data-order-col="0" data-order-type="desc">
                                        <thead>
                                            <tr>
                                                <th><?php echo _l('id'); ?></th>
                                                <th><?php echo _l('training_document_title'); ?></th>
                                                <th><?php echo _l('training_document_category'); ?></th>
                                                <th><?php echo _l('file_type'); ?></th>
                                                <th><?php echo _l('assignments_count'); ?></th>
                                                <th><?php echo _l('completed_count'); ?></th>
                                                <th><?php echo _l('created_at'); ?></th>
                                                <th><?php echo _l('actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($training_documents as $doc) { ?>
                                            <tr>
                                                <td><?php echo $doc['id']; ?></td>
                                                <td>
                                                    <strong><?php echo $doc['title']; ?></strong>
                                                    <?php if ($doc['description']) { ?>
                                                    <br><small class="text-muted"><?php echo character_limiter($doc['description'], 50); ?></small>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $doc['category_name'] ? $doc['category_name'] : '-'; ?></td>
                                                <td>
                                                    <span class="label label-default"><?php echo strtoupper(pathinfo($doc['file_name'], PATHINFO_EXTENSION)); ?></span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info assignments-count" data-document-id="<?php echo $doc['id']; ?>">0</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success completed-count" data-document-id="<?php echo $doc['id']; ?>">0</span>
                                                </td>
                                                <td><?php echo _dt($doc['created_at']); ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-sm assign-document" 
                                                                data-document-id="<?php echo $doc['id']; ?>"
                                                                data-document-title="<?php echo htmlspecialchars($doc['title']); ?>"
                                                                title="<?php echo _l('assign_to_staff'); ?>">
                                                            <i class="fa fa-user-plus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-info btn-sm view-assignments" 
                                                                data-document-id="<?php echo $doc['id']; ?>"
                                                                title="<?php echo _l('view_assignments'); ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <a href="<?php echo base_url($doc['file_path']); ?>" 
                                                           class="btn btn-success btn-sm" 
                                                           target="_blank"
                                                           title="<?php echo _l('download_document'); ?>">
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                        <a href="<?php echo admin_url('my_team/delete_training_document/' . $doc['id']); ?>" 
                                                           class="btn btn-danger btn-sm _delete"
                                                           title="<?php echo _l('delete'); ?>">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php } else { ?>
                                <div class="alert alert-info text-center">
                                    <i class="fa fa-info-circle"></i>
                                    <?php echo _l('no_training_documents_found'); ?>
                                    <br><br>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadDocumentModal">
                                        <i class="fa fa-upload"></i> <?php echo _l('upload_first_document'); ?>
                                    </button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <?php } else { ?>
                        <!-- Staff View: Assignments được giao -->
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h5><?php echo _l('my_training_assignments'); ?></h5>
                                <?php if (count($training_assignments) > 0) { ?>
                                <div class="row">
                                    <?php foreach ($training_assignments as $assignment) { ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="panel_s training-assignment-card">
                                            <div class="panel-body">
                                                <div class="training-assignment-header">
                                                    <h5 class="no-margin"><?php echo $assignment['title']; ?></h5>
                                                    <small class="text-muted">
                                                        <?php echo _l('assigned_by'); ?>: <?php echo $assignment['firstname'] . ' ' . $assignment['lastname']; ?>
                                                    </small>
                                                </div>
                                                
                                                <div class="training-assignment-content mtop10">
                                                    <?php if ($assignment['description']) { ?>
                                                    <p class="text-muted"><?php echo character_limiter($assignment['description'], 100); ?></p>
                                                    <?php } ?>
                                                    
                                                    <div class="progress mtop10">
                                                        <div class="progress-bar progress-bar-<?php echo $assignment['progress'] >= 100 ? 'success' : ($assignment['progress'] > 0 ? 'info' : 'default'); ?>" 
                                                             style="width: <?php echo $assignment['progress']; ?>%">
                                                            <?php echo $assignment['progress']; ?>%
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="training-assignment-meta mtop10">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <small class="text-muted">
                                                                    <i class="fa fa-calendar"></i> 
                                                                    <?php echo _dt($assignment['assigned_at']); ?>
                                                                </small>
                                                            </div>
                                                            <div class="col-md-6 text-right">
                                                                <?php if ($assignment['deadline']) { ?>
                                                                <small class="text-<?php echo strtotime($assignment['deadline']) < time() && $assignment['status'] != 'completed' ? 'danger' : 'muted'; ?>">
                                                                    <i class="fa fa-clock-o"></i> 
                                                                    <?php echo _d($assignment['deadline']); ?>
                                                                </small>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="training-assignment-actions mtop15">
                                                    <div class="btn-group btn-group-justified">
                                                        <a href="<?php echo admin_url('my_team/view_training_document/' . $assignment['id']); ?>" 
                                                           class="btn btn-info btn-sm">
                                                            <i class="fa fa-eye"></i> <?php echo _l('view_document'); ?>
                                                        </a>
                                                        <?php if ($assignment['status'] != 'completed') { ?>
                                                        <button type="button" 
                                                                class="btn btn-success btn-sm mark-completed" 
                                                                data-assignment-id="<?php echo $assignment['id']; ?>">
                                                            <i class="fa fa-check"></i> <?php echo _l('mark_completed'); ?>
                                                        </button>
                                                        <?php } else { ?>
                                                        <span class="btn btn-default btn-sm disabled">
                                                            <i class="fa fa-check-circle"></i> <?php echo _l('completed'); ?>
                                                        </span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                
                                                <!-- Status Badge -->
                                                <div class="training-status-badge">
                                                    <?php if ($assignment['status'] == 'completed') { ?>
                                                    <span class="label label-success"><?php echo _l('completed'); ?></span>
                                                    <?php } elseif ($assignment['deadline'] && strtotime($assignment['deadline']) < time()) { ?>
                                                    <span class="label label-danger"><?php echo _l('overdue'); ?></span>
                                                    <?php } elseif ($assignment['progress'] > 0) { ?>
                                                    <span class="label label-info"><?php echo _l('in_progress'); ?></span>
                                                    <?php } else { ?>
                                                    <span class="label label-default"><?php echo _l('assigned'); ?></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } else { ?>
                                <div class="alert alert-info text-center">
                                    <i class="fa fa-info-circle"></i>
                                    <?php echo _l('no_training_assignments_found'); ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($is_manager) { ?>
<!-- Upload Document Modal -->
<div class="modal fade" id="uploadDocumentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fa fa-upload"></i> <?php echo _l('upload_training_document'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <form id="uploadDocumentForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="document_title"><?php echo _l('training_document_title'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="document_title" name="title" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="document_category"><?php echo _l('training_document_category'); ?></label>
                                <select class="form-control selectpicker" id="document_category" name="category_id" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                    <option value=""><?php echo _l('dropdown_non_selected_tex'); ?></option>
                                    <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Placeholder for future features -->
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="document_description"><?php echo _l('training_document_description'); ?></label>
                                <textarea class="form-control" id="document_description" name="description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Drag & Drop Upload Area -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?php echo _l('training_document_file'); ?> <span class="text-danger">*</span></label>
                                <div id="dropzone" class="dropzone-area">
                                    <div class="dropzone-content">
                                        <i class="fa fa-cloud-upload fa-3x text-muted"></i>
                                        <h4><?php echo _l('drag_drop_files_here'); ?></h4>
                                        <p class="text-muted"><?php echo _l('or_click_to_browse'); ?></p>
                                        <input type="file" id="file_input" name="file" style="display: none;" 
                                               accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt,.jpg,.jpeg,.png,.gif,.mp4,.avi,.mov">
                                        <button type="button" class="btn btn-default" onclick="document.getElementById('file_input').click();">
                                            <i class="fa fa-folder-open"></i> <?php echo _l('browse_files'); ?>
                                        </button>
                                    </div>
                                    <div id="file_preview" class="file-preview" style="display: none;">
                                        <div class="file-info">
                                            <i class="fa fa-file file-icon"></i>
                                            <span class="file-name"></span>
                                            <span class="file-size"></span>
                                            <button type="button" class="btn btn-sm btn-danger remove-file">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted">
                                    <?php echo _l('supported_file_types'); ?>: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, TXT, JPG, PNG, GIF, MP4, AVI, MOV (<?php echo _l('max_file_size'); ?>: 50MB)
                                </small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="button" class="btn btn-info" id="uploadDocumentBtn">
                    <i class="fa fa-upload"></i> <?php echo _l('upload_document'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Assign Document Modal -->
<div class="modal fade" id="assignDocumentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fa fa-user-plus"></i> <?php echo _l('assign_training_document'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <form id="assignDocumentForm">
                    <input type="hidden" id="assign_document_id" name="document_id">
                    
                    <div class="form-group">
                        <label><?php echo _l('document_title'); ?></label>
                        <p id="assign_document_title" class="form-control-static"></p>
                    </div>
                    
                    <div class="form-group">
                        <label for="assign_staff_ids"><?php echo _l('select_staff_members'); ?> <span class="text-danger">*</span></label>
                        <select class="form-control selectpicker" id="assign_staff_ids" name="staff_ids[]" multiple 
                                data-live-search="true" data-none-selected-text="<?php echo _l('select_staff_members'); ?>" required>
                            <?php foreach ($subordinate_staff as $staff) { ?>
                            <option value="<?php echo $staff['staffid']; ?>">
                                <?php echo $staff['firstname'] . ' ' . $staff['lastname']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="assign_deadline"><?php echo _l('deadline'); ?></label>
                        <input type="date" class="form-control" id="assign_deadline" name="deadline">
                    </div>
                    
                    <div class="form-group">
                        <label for="assign_notes"><?php echo _l('notes'); ?></label>
                        <textarea class="form-control" id="assign_notes" name="notes" rows="3" 
                                  placeholder="<?php echo _l('assignment_notes_placeholder'); ?>"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="button" class="btn btn-info" id="assignDocumentBtn">
                    <i class="fa fa-user-plus"></i> <?php echo _l('assign_document'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View Assignments Modal -->
<div class="modal fade" id="viewAssignmentsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fa fa-eye"></i> <?php echo _l('view_document_assignments'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <div id="assignments_content">
                    <!-- Content will be loaded via AJAX -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php init_tail(); ?>

<style>
/* Training specific styles */
.training-assignment-card {
    position: relative;
    transition: all 0.3s ease;
    min-height: 250px;
}

.training-assignment-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.training-status-badge {
    position: absolute;
    top: 10px;
    right: 10px;
}

.dropzone-area {
    border: 2px dashed #ddd;
    border-radius: 5px;
    padding: 30px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.dropzone-area:hover {
    border-color: #5bc0de;
    background-color: #f8f9fa;
}

.dropzone-area.dragover {
    border-color: #5bc0de;
    background-color: #e3f2fd;
}

.file-preview {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    background-color: #f8f9fa;
}

.file-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.file-icon {
    font-size: 24px;
    color: #5bc0de;
}

.file-name {
    flex: 1;
    font-weight: bold;
}

.file-size {
    color: #666;
    font-size: 12px;
}

.remove-file {
    margin-left: auto;
}

.dashboard-panel {
    position: relative;
    overflow: hidden;
}

.dashboard-panel .icon {
    position: absolute;
    bottom: 10px;
    right: 10px;
    opacity: 0.3;
    font-size: 48px;
}

.dashboard-summary-badge {
    font-size: 24px;
    font-weight: bold;
    display: block;
}

.dashboard-summary-label {
    font-size: 12px;
    text-transform: uppercase;
    margin-top: 5px;
    display: block;
}
</style>

<script>
$(document).ready(function() {
    // Drag & Drop functionality
    var dropzone = $('#dropzone');
    var fileInput = $('#file_input');
    var filePreview = $('#file_preview');
    var dropzoneContent = $('.dropzone-content');
    
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone[0].addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });
    
    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone[0].addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropzone[0].addEventListener(eventName, unhighlight, false);
    });
    
    // Handle dropped files
    dropzone[0].addEventListener('drop', handleDrop, false);
    
    // Handle file input change
    fileInput.on('change', function() {
        if (this.files.length > 0) {
            handleFiles(this.files);
        }
    });
    
    // Click to browse
    dropzone.on('click', function() {
        fileInput.click();
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    function highlight(e) {
        dropzone.addClass('dragover');
    }
    
    function unhighlight(e) {
        dropzone.removeClass('dragover');
    }
    
    function handleDrop(e) {
        var dt = e.dataTransfer;
        var files = dt.files;
        handleFiles(files);
    }
    
    function handleFiles(files) {
        if (files.length > 0) {
            var file = files[0];
            
            // Validate file size (50MB)
            if (file.size > 50 * 1024 * 1024) {
                alert('<?php echo _l('file_too_large'); ?>');
                return;
            }
            
            // Show file preview
            showFilePreview(file);
            
            // Set file to input
            var dt = new DataTransfer();
            dt.items.add(file);
            fileInput[0].files = dt.files;
        }
    }
    
    function showFilePreview(file) {
        dropzoneContent.hide();
        filePreview.show();
        
        $('.file-name').text(file.name);
        $('.file-size').text(formatFileSize(file.size));
        
        // Set appropriate icon based on file type
        var extension = file.name.split('.').pop().toLowerCase();
        var iconClass = getFileIcon(extension);
        $('.file-icon').removeClass().addClass('fa file-icon ' + iconClass);
    }
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        var k = 1024;
        var sizes = ['Bytes', 'KB', 'MB', 'GB'];
        var i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    function getFileIcon(extension) {
        var icons = {
            'pdf': 'fa-file-pdf-o',
            'doc': 'fa-file-word-o',
            'docx': 'fa-file-word-o',
            'ppt': 'fa-file-powerpoint-o',
            'pptx': 'fa-file-powerpoint-o',
            'xls': 'fa-file-excel-o',
            'xlsx': 'fa-file-excel-o',
            'txt': 'fa-file-text-o',
            'jpg': 'fa-file-image-o',
            'jpeg': 'fa-file-image-o',
            'png': 'fa-file-image-o',
            'gif': 'fa-file-image-o',
            'mp4': 'fa-file-video-o',
            'avi': 'fa-file-video-o',
            'mov': 'fa-file-video-o'
        };
        return icons[extension] || 'fa-file-o';
    }
    
    // Remove file
    $(document).on('click', '.remove-file', function() {
        filePreview.hide();
        dropzoneContent.show();
        fileInput.val('');
    });
    
    // Upload document
    $('#uploadDocumentBtn').on('click', function() {
        var form = $('#uploadDocumentForm')[0];
        var formData = new FormData(form);
        
        if (!formData.get('title') || !formData.get('file')) {
            alert('<?php echo _l('please_fill_required_fields'); ?>');
            return;
        }
        
        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> <?php echo _l('uploading'); ?>...');
        
        $.ajax({
            url: '<?php echo admin_url('my_team/upload_training_document'); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    alert_float('success', data.message);
                    $('#uploadDocumentModal').modal('hide');
                    location.reload();
                } else {
                    alert_float('danger', data.message);
                }
            },
            error: function() {
                alert_float('danger', '<?php echo _l('something_went_wrong'); ?>');
            },
            complete: function() {
                btn.prop('disabled', false).html('<i class="fa fa-upload"></i> <?php echo _l('upload_document'); ?>');
            }
        });
    });
    
    <?php if ($is_manager) { ?>
    // Assign document
    $('.assign-document').on('click', function() {
        var documentId = $(this).data('document-id');
        var documentTitle = $(this).data('document-title');
        
        $('#assign_document_id').val(documentId);
        $('#assign_document_title').text(documentTitle);
        $('#assignDocumentModal').modal('show');
    });
    
    $('#assignDocumentBtn').on('click', function() {
        var formData = $('#assignDocumentForm').serialize();
        
        if (!$('#assign_staff_ids').val() || $('#assign_staff_ids').val().length === 0) {
            alert('<?php echo _l('please_select_staff_members'); ?>');
            return;
        }
        
        var btn = $(this);
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> <?php echo _l('assigning'); ?>...');
        
        $.ajax({
            url: '<?php echo admin_url('my_team/assign_document'); ?>',
            type: 'POST',
            data: formData,
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    alert_float('success', data.message);
                    $('#assignDocumentModal').modal('hide');
                    location.reload();
                } else {
                    alert_float('danger', data.message);
                }
            },
            error: function() {
                alert_float('danger', '<?php echo _l('something_went_wrong'); ?>');
            },
            complete: function() {
                btn.prop('disabled', false).html('<i class="fa fa-user-plus"></i> <?php echo _l('assign_document'); ?>');
            }
        });
    });
    
    // View assignments
    $('.view-assignments').on('click', function() {
        var documentId = $(this).data('document-id');
        
        $('#assignments_content').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> <?php echo _l('loading'); ?>...</div>');
        $('#viewAssignmentsModal').modal('show');
        
        // Load assignments via AJAX (implement this endpoint)
        $.get('<?php echo admin_url('my_team/get_document_assignments'); ?>/' + documentId, function(data) {
            $('#assignments_content').html(data);
        });
    });
    <?php } else { ?>
    // Mark training completed
    $('.mark-completed').on('click', function() {
        var assignmentId = $(this).data('assignment-id');
        var btn = $(this);
        
        if (confirm('<?php echo _l('confirm_mark_training_completed'); ?>')) {
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> <?php echo _l('processing'); ?>...');
            
            $.ajax({
                url: '<?php echo admin_url('my_team/mark_training_completed'); ?>',
                type: 'POST',
                data: { assignment_id: assignmentId },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        alert_float('success', data.message);
                        location.reload();
                    } else {
                        alert_float('danger', data.message);
                    }
                },
                error: function() {
                    alert_float('danger', '<?php echo _l('something_went_wrong'); ?>');
                },
                complete: function() {
                    btn.prop('disabled', false).html('<i class="fa fa-check"></i> <?php echo _l('mark_completed'); ?>');
                }
            });
        }
    });
    <?php } ?>
    
    // Reset modal when closed
    $('#uploadDocumentModal').on('hidden.bs.modal', function() {
        $('#uploadDocumentForm')[0].reset();
        filePreview.hide();
        dropzoneContent.show();
        $('.selectpicker').selectpicker('refresh');
    });
    
    $('#assignDocumentModal').on('hidden.bs.modal', function() {
        $('#assignDocumentForm')[0].reset();
        $('.selectpicker').selectpicker('refresh');
    });
});
</script>
<?php init_tail(); ?> 