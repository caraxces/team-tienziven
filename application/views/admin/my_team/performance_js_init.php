<script>
    // Load thư viện Chart.js nếu chưa được tải
    if (typeof Chart === 'undefined') {
        var chartScript = document.createElement('script');
        chartScript.src = site_url + 'assets/plugins/Chart.js/Chart.min.js';
        document.head.appendChild(chartScript);
        
        chartScript.onload = function() {
            initializeCharts();
        };
    } else {
        // Nếu Chart.js đã được tải, khởi tạo biểu đồ ngay lập tức
        initializeCharts();
    }
    
    /**
     * Khởi tạo các biểu đồ
     */
    function initializeCharts() {
        // Lấy staff ID từ URL
        var urlParams = new URLSearchParams(window.location.search);
        var staffId = urlParams.get('staff_id') || '0';
        
        // Thử khởi tạo các biểu đồ, nếu biến dữ liệu đã được định nghĩa
        var userPerfVarName = 'userPerformance_' + staffId;
        if (typeof window[userPerfVarName] !== 'undefined') {
            // Sau khi tải Chart.js, khởi tạo các biểu đồ
            renderTasksChart(staffId);
            renderProjectsChart(staffId);
            renderTicketsChart(staffId);
            renderAttendanceChart(staffId);
            renderTimeTrackedChart(staffId);
        }
    }
</script> 