/**
 * My Team Module - Core JS functions
 */

$(function() {
    // Xử lý hiệu ứng cho các card
    $('.staff-member-card').hover(
        function() {
            $(this).addClass('card-hover');
        }, 
        function() {
            $(this).removeClass('card-hover');
        }
    );
    
    // Xử lý confirm xóa
    $('body').on('click', '._delete', function(e) {
        if (!confirm(app.lang.confirm_action_prompt)) {
            e.preventDefault();
        }
    });

    // Xử lý tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Xử lý tab được lưu vào local storage
    var hash = window.location.hash;
    if (hash) {
        setTimeout(function() {
            $('a[href="' + hash + '"]').click();
        }, 200);
    }

    $('.nav-tabs a').on('shown.bs.tab', function(e) {
        var hash = $(e.target).attr('href');
        if (history.pushState) {
            history.pushState(null, null, hash);
        } else {
            location.hash = hash;
        }
        localStorage.setItem('my_team_active_tab', hash);
    });

    // Lấy tab đã lưu trước đó
    var lastTab = localStorage.getItem('my_team_active_tab');
    if (lastTab && !window.location.hash) {
        $('a[href="' + lastTab + '"]').click();
    }

    // Xử lý filter chọn nhân viên
    $('#staff_select').on('change', function() {
        var url = window.location.href.split('?')[0];
        var staffId = $(this).val();
        
        if (staffId) {
            url += '?staff_id=' + staffId;
        }
        
        window.location.href = url;
    });

    // Xử lý filter date range cho performance
    $('#performance_date_range').on('change', function() {
        var value = $(this).val();
        
        if (value === 'custom') {
            $('#custom_range_container').removeClass('hide');
        } else {
            $('#custom_range_container').addClass('hide');
            $('#performance_filter_form').submit();
        }
    });

    // Xử lý modal reject
    $('#reject-modal').on('show.bs.modal', function(e) {
        var approvalId = $(e.relatedTarget).data('approval-id');
        $('#reject_approval_id').val(approvalId);
    });

    // Kiểm tra lý do từ chối trước khi submit
    $('#reject-form').on('submit', function(e) {
        var reason = $('#reject_reason').val();
        
        if (!reason || reason.trim() === '') {
            e.preventDefault();
            alert(app.lang.rejection_reason_required || 'Reason is required');
            return false;
        }
        
        return true;
    });
}); 