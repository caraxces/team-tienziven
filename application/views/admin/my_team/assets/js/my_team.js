/**
 * My Team Module JavaScript
 */

$(function() {
    'use strict';
    
    // Initialize Datepickers
    if ($.fn.datepicker) {
        $('.datepicker').datepicker({
            format: app.options.date_format,
            autoclose: true,
            todayHighlight: true
        });
        
        // Date range picker
        $('input.date-range-picker').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear',
                applyLabel: app.lang.apply,
                cancelLabel: app.lang.cancel,
                fromLabel: app.lang.from,
                toLabel: app.lang.to,
                customRangeLabel: app.lang.custom,
                daysOfWeek: [
                    app.lang.Sunday_short,
                    app.lang.Monday_short,
                    app.lang.Tuesday_short,
                    app.lang.Wednesday_short,
                    app.lang.Thursday_short,
                    app.lang.Friday_short,
                    app.lang.Saturday_short
                ],
                monthNames: [
                    app.lang.January,
                    app.lang.February,
                    app.lang.March,
                    app.lang.April,
                    app.lang.May,
                    app.lang.June,
                    app.lang.July,
                    app.lang.August,
                    app.lang.September,
                    app.lang.October,
                    app.lang.November,
                    app.lang.December
                ],
                firstDay: app.options.calendar_first_day
            }
        });
        
        $('input.date-range-picker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format(app.options.date_format) + ' - ' + picker.endDate.format(app.options.date_format));
        });
        
        $('input.date-range-picker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    }
    
    // Init Select2 elements
    if ($.fn.select2) {
        $('.select2').select2({
            language: app.lang.locale,
            placeholder: app.lang.dropdown_non_selected_tex
        });
    }
    
    // Period changes on performance view
    $('#period').on('change', function() {
        var value = $(this).val();
        if (value == 'custom') {
            $('.custom-date-picker').show();
        } else {
            $('.custom-date-picker').hide();
        }
    });
    
    // Knowledge search
    $('#knowledge_search').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('.knowledge-item').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    
    // File upload preview
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
    });
    
    // Approval rejection modal
    $('body').on('click', '.btn-reject-approval', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#reject_approval_id').val(id);
        $('#rejectApprovalModal').modal('show');
    });
    
    // Knowledge visibility selection
    $('#visibility').on('change', function() {
        var value = $(this).val();
        if (value == 'departments') {
            $('.department-visibility').show();
        } else {
            $('.department-visibility').hide();
        }
    });
    
    // Staff performance chart data request
    $('body').on('click', '.view-performance-btn', function(e) {
        e.preventDefault();
        var staffId = $(this).data('staff-id');
        loadStaffPerformance(staffId);
    });
    
    // Init knowledge rich text editor
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: '.tinymce-knowledge',
            height: 300,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'template paste textcolor colorpicker textpattern imagetools codesample'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true
        });
    }
});

/**
 * Load staff performance data
 * @param {int} staffId 
 */
function loadStaffPerformance(staffId) {
    var $container = $('#staff_performance_container');
    $container.html('<div class="text-center mtop30"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');
    
    $.ajax({
        url: admin_url + 'my_team/get_performance_data',
        type: 'GET',
        data: {
            staff_id: staffId,
            period: $('#period').val(),
            date_from: $('#date_from').val(),
            date_to: $('#date_to').val()
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                renderPerformanceCharts(response.data, staffId);
            } else {
                $container.html('<div class="alert alert-danger">' + response.message + '</div>');
            }
        },
        error: function() {
            $container.html('<div class="alert alert-danger">Error loading performance data</div>');
        }
    });
}

/**
 * Render performance charts
 * @param {object} data 
 * @param {int} staffId 
 */
function renderPerformanceCharts(data, staffId) {
    // Implementation will depend on chart library
    console.log('Performance data:', data);
}
