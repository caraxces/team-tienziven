<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
// Performance Dashboard JavaScript Initialization
$(document).ready(function() {
    // Load Chart.js if not already loaded
    if (typeof Chart === 'undefined') {
        $.getScript('<?php echo base_url('assets/plugins/Chart.js/Chart.min.js'); ?>', function() {
            console.log('Chart.js loaded successfully');
        });
    }
    
    // Initialize performance dashboard specific features
    initPerformanceDashboard();
});

function initPerformanceDashboard() {
    // Add loading states to charts
    $('.chart-container canvas').each(function() {
        var $canvas = $(this);
        var $container = $canvas.closest('.chart-container');
        
        if (!$container.find('.loading-chart').length) {
            $container.append('<div class="loading-chart"><i class="fa fa-spinner fa-spin"></i> Đang tải...</div>');
        }
    });
    
    // Remove loading states after charts are initialized
    setTimeout(function() {
        $('.loading-chart').fadeOut(500, function() {
            $(this).remove();
        });
    }, 2000);
    
    // Add hover effects to dashboard widgets
    $('.dashboard-widget').hover(
        function() {
            $(this).addClass('widget-hover');
        },
        function() {
            $(this).removeClass('widget-hover');
        }
    );
    
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Add click handlers for performance widgets
    $('.info-box').click(function() {
        var $widget = $(this).closest('.dashboard-widget');
        var widgetType = '';
        
        if ($widget.find('.fa-tasks').length) {
            widgetType = 'tasks';
        } else if ($widget.find('.fa-line-chart').length) {
            widgetType = 'projects';
        } else if ($widget.find('.fa-ticket').length) {
            widgetType = 'tickets';
        } else if ($widget.find('.fa-calendar').length) {
            widgetType = 'attendance';
        }
        
        if (widgetType) {
            // Scroll to corresponding chart
            var $chart = $('#' + widgetType + '_chart_' + (window.staffId || ''));
            if ($chart.length) {
                $('html, body').animate({
                    scrollTop: $chart.closest('.panel_s').offset().top - 100
                }, 500);
            }
        }
    });
    
    // Add refresh functionality
    $('.widget-refresh').click(function(e) {
        e.preventDefault();
        var $widget = $(this).closest('.dashboard-widget');
        refreshWidget($widget);
    });
    
    // Performance level indicators
    updatePerformanceLevelIndicators();
}

function refreshWidget($widget) {
    $widget.addClass('widget-loading');
    
    // Simulate refresh (replace with actual AJAX call)
    setTimeout(function() {
        $widget.removeClass('widget-loading');
        showAlert('success', 'Widget đã được cập nhật');
    }, 1000);
}

function updatePerformanceLevelIndicators() {
    $('.progress-bar').each(function() {
        var $bar = $(this);
        var width = parseFloat($bar.css('width'));
        var parentWidth = $bar.parent().width();
        var percentage = (width / parentWidth) * 100;
        
        // Remove existing classes
        $bar.removeClass('progress-bar-success progress-bar-warning progress-bar-danger');
        
        // Add appropriate class based on percentage
        if (percentage >= 80) {
            $bar.addClass('progress-bar-success');
        } else if (percentage >= 50) {
            $bar.addClass('progress-bar-warning');
        } else {
            $bar.addClass('progress-bar-danger');
        }
    });
}

function showAlert(type, message) {
    var alertClass = 'alert-' + type;
    var $alert = $('<div class="alert ' + alertClass + ' alert-dismissible fade in" role="alert">' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button>' +
        message +
        '</div>');
    
    $('.content').prepend($alert);
    
    setTimeout(function() {
        $alert.fadeOut(500, function() {
            $(this).remove();
        });
    }, 3000);
}

// Export function for external use
window.initPerformanceDashboard = initPerformanceDashboard;

// Store performance data globally for modal charts
<?php if (isset($performance_data) && isset($staff_id)): ?>
window.performanceData = <?php echo json_encode($performance_data); ?>;
window.currentStaffId = <?php echo $staff_id; ?>;
window['performanceData_<?php echo $staff_id; ?>'] = <?php echo json_encode($performance_data); ?>;
<?php endif; ?>
</script>

<style>
/* Additional CSS for performance dashboard */
.widget-loading {
    opacity: 0.6;
    pointer-events: none;
}

.widget-loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    z-index: 10;
}

.widget-hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

.info-box {
    cursor: pointer;
    transition: all 0.3s ease;
}

.info-box:hover {
    background-color: #f8f9fa;
}

.chart-container {
    position: relative;
}

.loading-chart {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 5;
    color: #999;
    font-size: 16px;
}

/* Animation for dashboard widgets */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translate3d(0, 30px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

.dashboard-widget {
    animation: slideInUp 0.6s ease-out;
}

.dashboard-widget:nth-child(1) { animation-delay: 0.1s; }
.dashboard-widget:nth-child(2) { animation-delay: 0.2s; }
.dashboard-widget:nth-child(3) { animation-delay: 0.3s; }
.dashboard-widget:nth-child(4) { animation-delay: 0.4s; }
</style> 