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
                                    <i class="fa fa-file-text"></i> 
                                    <?php echo $assignment->title; ?>
                                </h4>
                                <p class="text-muted mtop5">
                                    <?php echo _l('assigned_by'); ?>: <?php echo $assignment->firstname . ' ' . $assignment->lastname; ?>
                                    <span class="mleft10">
                                        <i class="fa fa-calendar"></i> <?php echo _dt($assignment->assigned_at); ?>
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="<?php echo admin_url('my_team/training'); ?>" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> <?php echo _l('back_to_training'); ?>
                                </a>
                            </div>
                        </div>
                        <hr class="hr-panel-heading" />
                        
                        <!-- Assignment Info -->
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Document Description -->
                                <?php if ($assignment->description) { ?>
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h5><i class="fa fa-info-circle"></i> <?php echo _l('description'); ?></h5>
                                        <p><?php echo nl2br($assignment->description); ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <!-- Assignment Notes -->
                                <?php if ($assignment->notes) { ?>
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h5><i class="fa fa-sticky-note"></i> <?php echo _l('assignment_notes'); ?></h5>
                                        <p><?php echo nl2br($assignment->notes); ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <!-- Document Viewer -->
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h5><i class="fa fa-eye"></i> <?php echo _l('document_content'); ?></h5>
                                        
                                        <div class="document-viewer">
                                            <?php 
                                            $file_extension = strtolower(pathinfo($assignment->file_name, PATHINFO_EXTENSION));
                                            $file_url = base_url($assignment->file_path);
                                            ?>
                                            
                                            <?php if ($file_extension == 'pdf') { ?>
                                            <!-- PDF Viewer -->
                                            <div class="pdf-viewer">
                                                <embed src="<?php echo $file_url; ?>" type="application/pdf" width="100%" height="600px">
                                                <p class="text-center mtop10">
                                                    <?php echo _l('pdf_not_supported'); ?>? 
                                                    <a href="<?php echo $file_url; ?>" target="_blank" class="btn btn-info btn-sm">
                                                        <i class="fa fa-external-link"></i> <?php echo _l('open_in_new_tab'); ?>
                                                    </a>
                                                </p>
                                            </div>
                                            
                                            <?php } elseif (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) { ?>
                                            <!-- Image Viewer -->
                                            <div class="image-viewer text-center">
                                                <img src="<?php echo $file_url; ?>" class="img-responsive" style="max-width: 100%; height: auto;">
                                            </div>
                                            
                                            <?php } elseif (in_array($file_extension, ['mp4', 'avi', 'mov'])) { ?>
                                            <!-- Video Viewer -->
                                            <div class="video-viewer">
                                                <video controls width="100%" height="400">
                                                    <source src="<?php echo $file_url; ?>" type="video/<?php echo $file_extension; ?>">
                                                    <?php echo _l('video_not_supported'); ?>
                                                </video>
                                            </div>
                                            
                                            <?php } elseif ($file_extension == 'txt') { ?>
                                            <!-- Text File Viewer -->
                                            <div class="text-viewer">
                                                <iframe src="<?php echo $file_url; ?>" width="100%" height="500" style="border: 1px solid #ddd;"></iframe>
                                            </div>
                                            
                                            <?php } else { ?>
                                            <!-- Other File Types -->
                                            <div class="file-preview text-center">
                                                <div class="file-icon-large">
                                                    <i class="fa fa-file-o fa-5x text-muted"></i>
                                                </div>
                                                <h4><?php echo _l('preview_not_available'); ?></h4>
                                                <p class="text-muted"><?php echo _l('file_type_not_supported_preview'); ?></p>
                                                <a href="<?php echo $file_url; ?>" target="_blank" class="btn btn-info">
                                                    <i class="fa fa-download"></i> <?php echo _l('download_document'); ?>
                                                </a>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <!-- Assignment Status -->
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h5><i class="fa fa-info"></i> <?php echo _l('assignment_status'); ?></h5>
                                        
                                        <div class="assignment-info">
                                            <div class="info-item">
                                                <strong><?php echo _l('current_status'); ?>:</strong>
                                                <span class="mleft5">
                                                    <?php if ($assignment->status == 'completed') { ?>
                                                    <span class="label label-success"><?php echo _l('completed'); ?></span>
                                                    <?php } elseif ($assignment->deadline && strtotime($assignment->deadline) < time()) { ?>
                                                    <span class="label label-danger"><?php echo _l('overdue'); ?></span>
                                                    <?php } elseif ($assignment->progress > 0) { ?>
                                                    <span class="label label-info"><?php echo _l('in_progress'); ?></span>
                                                    <?php } else { ?>
                                                    <span class="label label-default"><?php echo _l('assigned'); ?></span>
                                                    <?php } ?>
                                                </span>
                                            </div>
                                            
                                            <div class="info-item mtop10">
                                                <strong><?php echo _l('progress'); ?>:</strong>
                                                <div class="progress mtop5">
                                                    <div class="progress-bar progress-bar-<?php echo $assignment->progress >= 100 ? 'success' : ($assignment->progress > 0 ? 'info' : 'default'); ?>" 
                                                         style="width: <?php echo $assignment->progress; ?>%">
                                                        <?php echo $assignment->progress; ?>%
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php if ($assignment->deadline) { ?>
                                            <div class="info-item mtop10">
                                                <strong><?php echo _l('deadline'); ?>:</strong>
                                                <span class="mleft5 text-<?php echo strtotime($assignment->deadline) < time() && $assignment->status != 'completed' ? 'danger' : 'muted'; ?>">
                                                    <i class="fa fa-calendar"></i> <?php echo _d($assignment->deadline); ?>
                                                </span>
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if ($assignment->last_accessed) { ?>
                                            <div class="info-item mtop10">
                                                <strong><?php echo _l('last_accessed'); ?>:</strong>
                                                <span class="mleft5 text-muted">
                                                    <i class="fa fa-clock-o"></i> <?php echo _dt($assignment->last_accessed); ?>
                                                </span>
                                            </div>
                                            <?php } ?>
                                            
                                            <?php if ($assignment->completed_at) { ?>
                                            <div class="info-item mtop10">
                                                <strong><?php echo _l('completed_at'); ?>:</strong>
                                                <span class="mleft5 text-success">
                                                    <i class="fa fa-check-circle"></i> <?php echo _dt($assignment->completed_at); ?>
                                                </span>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Progress Control -->
                                <?php if ($assignment->staff_id == get_staff_user_id() && $assignment->status != 'completed') { ?>
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h5><i class="fa fa-sliders"></i> <?php echo _l('reading_progress'); ?></h5>
                                        
                                        <div class="progress-control">
                                            <label for="progress_slider"><?php echo _l('drag_to_update_progress'); ?>:</label>
                                            <input type="range" id="progress_slider" class="form-control" 
                                                   min="0" max="100" value="<?php echo $assignment->progress; ?>" 
                                                   style="width: 100%; margin: 10px 0;">
                                            <div class="text-center">
                                                <span id="progress_value"><?php echo $assignment->progress; ?>%</span>
                                            </div>
                                            
                                            <div class="mtop15 text-center">
                                                <button type="button" class="btn btn-success btn-block" id="mark_completed_btn"
                                                        <?php echo $assignment->progress >= 100 ? '' : 'disabled'; ?>>
                                                    <i class="fa fa-check-circle"></i> <?php echo _l('mark_as_completed'); ?>
                                                </button>
                                            </div>
                                            
                                            <small class="text-muted mtop10 block">
                                                <i class="fa fa-info-circle"></i> <?php echo _l('auto_save_progress'); ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <!-- File Info -->
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <h5><i class="fa fa-file"></i> <?php echo _l('file_info'); ?></h5>
                                        
                                        <div class="file-info">
                                            <div class="info-item">
                                                <strong><?php echo _l('file_name'); ?>:</strong>
                                                <span class="mleft5"><?php echo $assignment->file_name; ?></span>
                                            </div>
                                            
                                            <div class="info-item mtop5">
                                                <strong><?php echo _l('file_type'); ?>:</strong>
                                                <span class="mleft5">
                                                    <span class="label label-default"><?php echo strtoupper($file_extension); ?></span>
                                                </span>
                                            </div>
                                            
                                            <?php if ($assignment->file_size) { ?>
                                            <div class="info-item mtop5">
                                                <strong><?php echo _l('file_size'); ?>:</strong>
                                                <span class="mleft5"><?php echo bytesToSize($assignment->file_size * 1024); ?></span>
                                            </div>
                                            <?php } ?>
                                            
                                            <div class="mtop15">
                                                <a href="<?php echo $file_url; ?>" target="_blank" class="btn btn-info btn-block">
                                                    <i class="fa fa-download"></i> <?php echo _l('download_document'); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
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
.assignment-info .info-item {
    margin-bottom: 8px;
}

.document-viewer {
    min-height: 400px;
}

.file-icon-large {
    margin: 40px 0 20px 0;
}

.progress-control input[type="range"] {
    -webkit-appearance: none;
    appearance: none;
    height: 8px;
    background: #ddd;
    border-radius: 5px;
    outline: none;
}

.progress-control input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    background: #5bc0de;
    border-radius: 50%;
    cursor: pointer;
}

.progress-control input[type="range"]::-moz-range-thumb {
    width: 20px;
    height: 20px;
    background: #5bc0de;
    border-radius: 50%;
    cursor: pointer;
    border: none;
}

.file-info .info-item {
    margin-bottom: 5px;
}

.training-assignment-card {
    transition: all 0.3s ease;
}

.training-assignment-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>

<script>
$(document).ready(function() {
    var assignmentId = <?php echo $assignment->id; ?>;
    var currentProgress = <?php echo $assignment->progress; ?>;
    var progressSlider = $('#progress_slider');
    var progressValue = $('#progress_value');
    var markCompletedBtn = $('#mark_completed_btn');
    
    // Update progress display when slider changes
    progressSlider.on('input', function() {
        var progress = $(this).val();
        progressValue.text(progress + '%');
        
        // Enable/disable mark completed button
        if (progress >= 100) {
            markCompletedBtn.prop('disabled', false);
        } else {
            markCompletedBtn.prop('disabled', true);
        }
    });
    
    // Auto-save progress when slider changes (with debounce)
    var progressTimeout;
    progressSlider.on('change', function() {
        var progress = $(this).val();
        
        clearTimeout(progressTimeout);
        progressTimeout = setTimeout(function() {
            updateProgress(progress);
        }, 500);
    });
    
    // Update progress via AJAX
    function updateProgress(progress) {
        $.ajax({
            url: '<?php echo admin_url('my_team/update_training_progress'); ?>',
            type: 'POST',
            data: {
                assignment_id: assignmentId,
                progress: progress
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    // Update progress bar
                    $('.progress-bar').css('width', progress + '%').text(progress + '%');
                    
                    // Update progress bar color
                    $('.progress-bar').removeClass('progress-bar-default progress-bar-info progress-bar-success');
                    if (progress >= 100) {
                        $('.progress-bar').addClass('progress-bar-success');
                    } else if (progress > 0) {
                        $('.progress-bar').addClass('progress-bar-info');
                    } else {
                        $('.progress-bar').addClass('progress-bar-default');
                    }
                    
                    // Show success message briefly
                    alert_float('success', data.message, 2000);
                } else {
                    alert_float('danger', data.message);
                }
            },
            error: function() {
                alert_float('danger', '<?php echo _l('something_went_wrong'); ?>');
            }
        });
    }
    
    // Mark as completed
    markCompletedBtn.on('click', function() {
        if (confirm('<?php echo _l('confirm_mark_training_completed'); ?>')) {
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> <?php echo _l('processing'); ?>...');
            
            $.ajax({
                url: '<?php echo admin_url('my_team/mark_training_completed'); ?>',
                type: 'POST',
                data: {
                    assignment_id: assignmentId
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        alert_float('success', data.message);
                        // Reload page to show updated status
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        alert_float('danger', data.message);
                        btn.prop('disabled', false).html('<i class="fa fa-check-circle"></i> <?php echo _l('mark_as_completed'); ?>');
                    }
                },
                error: function() {
                    alert_float('danger', '<?php echo _l('something_went_wrong'); ?>');
                    btn.prop('disabled', false).html('<i class="fa fa-check-circle"></i> <?php echo _l('mark_as_completed'); ?>');
                }
            });
        }
    });
    
    // Auto-track reading time (optional feature)
    var startTime = new Date().getTime();
    var timeSpent = 0;
    
    // Track time spent on page
    setInterval(function() {
        timeSpent += 1; // 1 second
        
        // Auto-increment progress slightly based on time spent (optional)
        // This can be customized based on document length
        if (timeSpent > 0 && timeSpent % 30 === 0) { // Every 30 seconds
            var currentProg = parseInt(progressSlider.val());
            if (currentProg < 100) {
                var newProgress = Math.min(currentProg + 1, 100);
                progressSlider.val(newProgress);
                progressValue.text(newProgress + '%');
                
                if (newProgress >= 100) {
                    markCompletedBtn.prop('disabled', false);
                }
                
                // Auto-save the incremented progress
                updateProgress(newProgress);
            }
        }
    }, 1000);
});
</script>

<?php
// Helper function to convert bytes to human readable format
if (!function_exists('bytesToSize')) {
    function bytesToSize($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
?> 