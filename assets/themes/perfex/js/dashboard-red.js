/**
 * Red Dashboard Theme for Perfex CRM
 * JavaScript for charts and maps
 */

$(function() {
    // Apply custom styles to existing dashboard widgets
    applyCustomDashboardStyles();
    
    // Initialize custom charts if any chart libraries are available
    initializeCustomCharts();
    
    // Add hover effects to dashboard cards
    addCardHoverEffects();
});

/**
 * Apply custom CSS classes to existing dashboard elements
 */
function applyCustomDashboardStyles() {
    // Style dashboard widgets
    $('.widget').addClass('dashboard-card');
    $('.widget-heading').addClass('card-header');
    $('.widget-body').addClass('card-content');
    
    // Style quick stats
    $('.quick-stats').each(function(index) {
        // Add alternating red styles to every other stats box
        if (index % 3 === 0) {
            $(this).addClass('red');
        } else if (index % 3 === 1) {
            $(this).addClass('light-red');
        }
        
        // Add stats value and heading classes
        $(this).find('h3').addClass('stats-value');
        $(this).find('p').addClass('stats-heading');
        
        // Add icon based on content
        var iconClass = 'fa-chart-line';
        var statTitle = $(this).find('p').text().toLowerCase();
        
        if (statTitle.indexOf('lead') >= 0) {
            iconClass = 'fa-user-plus';
        } else if (statTitle.indexOf('client') >= 0 || statTitle.indexOf('customer') >= 0) {
            iconClass = 'fa-users';
        } else if (statTitle.indexOf('project') >= 0) {
            iconClass = 'fa-project-diagram';
        } else if (statTitle.indexOf('task') >= 0) {
            iconClass = 'fa-tasks';
        } else if (statTitle.indexOf('ticket') >= 0) {
            iconClass = 'fa-ticket-alt';
        } else if (statTitle.indexOf('invoice') >= 0 || statTitle.indexOf('payment') >= 0) {
            iconClass = 'fa-file-invoice-dollar';
        }
        
        $(this).append('<div class="stats-icon"><i class="fas ' + iconClass + '"></i></div>');
    });
    
    // Style tables
    $('.widget table').each(function() {
        var $table = $(this);
        var $widget = $table.closest('.widget');
        
        // Create a new container for the table
        var $container = $('<div class="data-table-container"></div>');
        var $header = $('<div class="table-header"></div>');
        var $title = $('<div class="table-title">' + $widget.find('.widget-heading').text() + '</div>');
        var $actions = $('<div class="table-actions"></div>');
        
        // Move any action buttons to the header
        $widget.find('.widget-heading a').appendTo($actions);
        
        // Assemble the header
        $header.append($title).append($actions);
        $container.append($header);
        
        // Wrap the table
        $table.wrap('<div class="table-content"></div>');
        $table.closest('.widget-body').find('.table-content').appendTo($container);
        
        // Replace the widget with our new container
        $widget.replaceWith($container);
    });
    
    // Style the activity feed
    if ($('.activity-feed').length) {
        $('.activity-feed').parent().addClass('activity-feed-container');
        $('.activity-feed').closest('.panel-body').before('<div class="feed-header"><div class="feed-title">Activity Feed</div></div>');
        $('.activity-feed').addClass('feed-content');
        
        // Add icons to activity items
        $('.feed-item').addClass('activity-item');
        $('.feed-item').each(function() {
            var iconClass = 'fa-history';
            var activityText = $(this).find('.text').text().toLowerCase();
            
            if (activityText.indexOf('created') >= 0) {
                iconClass = 'fa-plus';
            } else if (activityText.indexOf('updated') >= 0 || activityText.indexOf('edited') >= 0) {
                iconClass = 'fa-edit';
            } else if (activityText.indexOf('deleted') >= 0) {
                iconClass = 'fa-trash';
            } else if (activityText.indexOf('commented') >= 0) {
                iconClass = 'fa-comment';
            } else if (activityText.indexOf('logged') >= 0) {
                iconClass = 'fa-sign-in-alt';
            }
            
            $(this).prepend('<div class="activity-icon"><i class="fas ' + iconClass + '"></i></div>');
            $(this).find('.date').addClass('activity-time');
            $(this).find('.text').addClass('activity-title');
        });
    }
    
    // Style the calendar
    if ($('#calendar').length) {
        $('#calendar').closest('.panel_s').addClass('calendar-widget');
        $('#calendar').closest('.panel-body').before('<div class="calendar-header"><div class="calendar-title">Calendar</div></div>');
        $('#calendar').closest('.panel-body').addClass('calendar-content');
    }
}

/**
 * Initialize custom charts if any chart libraries are available
 */
function initializeCustomCharts() {
    // Check if Chart.js is available
    if (typeof Chart !== 'undefined') {
        // Add sample sparkline charts to stats boxes
        $('.quick-stats').each(function() {
            var $this = $(this);
            var color = $this.hasClass('red') || $this.hasClass('light-red') ? 'rgba(255,255,255,0.7)' : 'rgba(233,60,60,0.7)';
            
            // Create a canvas for the sparkline
            var $canvas = $('<canvas class="stats-chart"></canvas>');
            $this.append($canvas);
            
            // Generate random data
            var data = [];
            for (var i = 0; i < 10; i++) {
                data.push(Math.floor(Math.random() * 50) + 50);
            }
            
            // Create the chart
            new Chart($canvas[0].getContext('2d'), {
                type: 'line',
                data: {
                    labels: new Array(10).fill(''),
                    datasets: [{
                        data: data,
                        borderColor: color,
                        borderWidth: 2,
                        pointRadius: 0,
                        fill: false,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                    },
                    scales: {
                        x: {
                            display: false
                        },
                        y: {
                            display: false
                        }
                    }
                }
            });
        });
    }
    
    // Check if jvectormap is available
    if (typeof $.fn.vectorMap !== 'undefined') {
        // If there's a map container, initialize a sample map
        if ($('.map-container').length) {
            $('.map-container').vectorMap({
                map: 'world_mill',
                backgroundColor: 'transparent',
                zoomOnScroll: false,
                regionStyle: {
                    initial: {
                        fill: 'rgba(233,60,60,0.3)',
                        'fill-opacity': 1,
                        stroke: 'none',
                        'stroke-width': 0,
                        'stroke-opacity': 0
                    },
                    hover: {
                        'fill-opacity': 0.7,
                        cursor: 'pointer'
                    },
                    selected: {
                        fill: 'rgba(233,60,60,0.8)'
                    }
                },
                markerStyle: {
                    initial: {
                        fill: '#e93c3c',
                        stroke: '#c82333',
                        'fill-opacity': 1,
                        'stroke-width': 1,
                        'stroke-opacity': 0.8,
                        r: 5
                    },
                    hover: {
                        fill: '#c82333',
                        stroke: '#c82333',
                        'stroke-width': 2
                    }
                }
            });
        }
    }
}

/**
 * Add hover effects to dashboard cards
 */
function addCardHoverEffects() {
    // Add pulse effect on hover to quick stat boxes
    $('.quick-stats').hover(function() {
        $(this).addClass('pulse-animation');
    }, function() {
        setTimeout(function() {
            $('.quick-stats').removeClass('pulse-animation');
        }, 1000);
    });
    
    // Add subtle shadow effect to all cards
    $('.dashboard-card, .chart-container, .map-container, .data-table-container, .activity-feed-container, .calendar-widget').hover(function() {
        $(this).css('transform', 'translateY(-5px)');
        $(this).css('box-shadow', '0 5px 15px rgba(0, 0, 0, 0.1)');
    }, function() {
        $(this).css('transform', 'translateY(0)');
        $(this).css('box-shadow', '0 2px 10px rgba(0, 0, 0, 0.05)');
    });
}

// Add pulse animation CSS
$('<style>')
    .prop('type', 'text/css')
    .html(`
    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.03);
        }
        100% {
            transform: scale(1);
        }
    }
    .pulse-animation {
        animation: pulse 1s;
    }`)
    .appendTo('head'); 