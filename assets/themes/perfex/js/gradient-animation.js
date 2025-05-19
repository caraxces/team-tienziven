/**
 * Enhanced Gradient Animation Effects
 * Adds dynamic gradient animations to header, footer and various UI elements
 */

$(function() {
    // Add ripple effect to buttons
    addRippleEffect();
    
    // Make gradient effect respond to mouse movement
    addMouseGradientEffect();
    
    // Add extra animation to panels
    addPanelAnimations();
});

/**
 * Adds ripple effect to buttons
 */
function addRippleEffect() {
    // Add ripple div to all buttons with primary class
    $('.btn-primary, .btn-info, .btn-success, .btn-warning, .btn-danger').each(function() {
        $(this).addClass('ripple-btn');
        $(this).append('<span class="ripple-effect"></span>');
    });
    
    // Handle ripple effect on click
    $(document).on('click', '.ripple-btn', function(e) {
        var $btn = $(this);
        var $ripple = $btn.find('.ripple-effect');
        
        // Get button position
        var btnOffset = $btn.offset();
        var xPos = e.pageX - btnOffset.left;
        var yPos = e.pageY - btnOffset.top;
        
        // Add ripple effect
        $ripple.css({
            top: yPos + 'px',
            left: xPos + 'px'
        }).addClass('animate');
        
        // Remove animation after it completes
        setTimeout(function() {
            $ripple.removeClass('animate');
        }, 700);
    });
    
    // Add ripple CSS
    $('<style>')
        .prop('type', 'text/css')
        .html(`
        .ripple-btn {
            position: relative;
            overflow: hidden;
        }
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            opacity: 1;
            pointer-events: none;
        }
        .ripple-effect.animate {
            animation: ripple 0.7s linear;
        }
        @keyframes ripple {
            100% {
                transform: scale(4);
                opacity: 0;
            }
        }`)
        .appendTo('head');
}

/**
 * Makes gradient effect respond to mouse movement
 */
function addMouseGradientEffect() {
    // Add effect to body only if it's not a mobile device
    if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('body').on('mousemove', function(e) {
            var width = $(this).width();
            var height = $(this).height();
            var x = e.pageX / width * 100;
            var y = e.pageY / height * 100;
            
            // Update body gradient position based on mouse
            $(this).css('background', `radial-gradient(circle at ${x}% ${y}%, rgba(255, 255, 255, 0.9), rgba(233, 60, 60, 0.1))`);
        });
    }
    
    // Add smooth gradient hover effect to navigation
    $('.navbar-nav > li > a').on('mouseenter', function() {
        $(this).css('background', 'linear-gradient(90deg, rgba(233, 60, 60, 0.1), rgba(255, 255, 255, 0.5))');
    }).on('mouseleave', function() {
        $(this).css('background', '');
    });
}

/**
 * Adds enhanced animations to panels and cards
 */
function addPanelAnimations() {
    // Add hover effect to all panels
    $('.panel, .dashboard-card, .quick-stats').on('mouseenter', function() {
        $(this).addClass('panel-hover-effect');
    }).on('mouseleave', function() {
        $(this).removeClass('panel-hover-effect');
    });
    
    // Add panel hover effect CSS
    $('<style>')
        .prop('type', 'text/css')
        .html(`
        .panel-hover-effect {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(233, 60, 60, 0.2);
            transition: all 0.3s ease;
        }
        .panel-hover-effect::before {
            animation: headerGradient 5s infinite !important;
        }`)
        .appendTo('head');
    
    // Add dynamic border glow effect to active elements
    $('<style>')
        .prop('type', 'text/css')
        .html(`
        .widget-card:focus-within,
        .panel:focus-within,
        .data-table-container:focus-within {
            box-shadow: 0 0 15px rgba(233, 60, 60, 0.3);
        }
        input:focus, select:focus, textarea:focus {
            border-color: #e93c3c !important;
            box-shadow: 0 0 5px rgba(233, 60, 60, 0.3) !important;
        }`)
        .appendTo('head');
}

// Add custom gradient overlay to body, header and footer
$(window).on('load', function() {
    // Create gradient overlays
    var $headerOverlay = $('<div class="gradient-overlay header-overlay"></div>');
    var $footerOverlay = $('<div class="gradient-overlay footer-overlay"></div>');
    
    // Add overlays to DOM
    $('.navbar-default').append($headerOverlay);
    $('.footer').append($footerOverlay);
    
    // Add overlay CSS
    $('<style>')
        .prop('type', 'text/css')
        .html(`
        .gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            opacity: 0.7;
        }
        .header-overlay {
            background: linear-gradient(90deg, rgba(233, 60, 60, 0.3) 0%, rgba(255, 255, 255, 0.5) 50%, rgba(233, 60, 60, 0.3) 100%);
            background-size: 200% 200%;
            animation: headerOverlayGradient 10s ease infinite;
        }
        .footer-overlay {
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.5) 0%, rgba(233, 60, 60, 0.3) 50%, rgba(255, 255, 255, 0.5) 100%);
            background-size: 200% 200%;
            animation: footerOverlayGradient 10s ease infinite;
        }
        @keyframes headerOverlayGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes footerOverlayGradient {
            0% { background-position: 100% 50%; }
            50% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }`)
        .appendTo('head');
}); 