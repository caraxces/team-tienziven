<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $isRTL = (is_rtl() ? 'true' : 'false'); ?>

<!DOCTYPE html>
<html lang="<?= e($locale); ?>"
    dir="<?= ($isRTL == 'true') ? 'rtl' : 'ltr' ?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>
        <?= $title ?? get_option('companyname'); ?>
    </title>

    <?= app_compile_css(); ?>
    <?php render_admin_js_variables(); ?>

    <script>
        var totalUnreadNotifications = <?= e($current_user->total_unread_notifications); ?> ,
            proposalsTemplates = <?= json_encode(get_proposal_templates()); ?> ,
            contractsTemplates = <?= json_encode(get_contract_templates()); ?> ,
            billingAndShippingFields = ['billing_street', 'billing_city', 'billing_state', 'billing_zip',
                'billing_country',
                'shipping_street', 'shipping_city', 'shipping_state', 'shipping_zip', 'shipping_country'
            ],
            isRTL = '<?= e($isRTL); ?>',
            taskid, taskTrackingStatsData, taskAttachmentDropzone, taskCommentAttachmentDropzone, newsFeedDropzone,
            expensePreviewDropzone, taskTrackingChart, cfh_popover_templates = {},
            _table_api;

        // Tối ưu performance: Preload và prefetch
        var pagePaths = [
            '<?php echo admin_url('dashboard'); ?>',
            '<?php echo admin_url('clients'); ?>',
            '<?php echo admin_url('projects'); ?>',
            '<?php echo admin_url('tasks'); ?>'
        ];
        
        // Thêm preload cho các trang thường xuyên truy cập
        if (window.performance && window.performance.navigation.type === 0) {
            // Chỉ prefetch khi người dùng truy cập trực tiếp (không refresh)
            pagePaths.forEach(function(path) {
                var link = document.createElement('link');
                link.rel = 'prefetch';
                link.href = path;
                document.head.appendChild(link);
            });
        }
        
        // Lazy load các hình ảnh khi scroll
        document.addEventListener("DOMContentLoaded", function() {
            var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
            
            if ("IntersectionObserver" in window) {
                var lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            var lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;
                            if (lazyImage.dataset.srcset) {
                                lazyImage.srcset = lazyImage.dataset.srcset;
                            }
                            lazyImage.classList.remove("lazy");
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });
                
                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });
            }
        });
    </script>
    <?php app_admin_head(); ?>
</head>

<body <?= admin_body_class($bodyclass ?? ''); ?>>
    <?php hooks()->do_action('after_body_start'); ?>