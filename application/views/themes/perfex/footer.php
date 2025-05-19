<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <span
                    class="copyright-footer"><?= date('Y'); ?>
                    <?= e(_l('clients_copyright', get_option('companyname'))); ?>
                </span>
                <?php if (is_gdpr() && get_option('gdpr_show_terms_and_conditions_in_footer') == '1') { ?>
                - <a href="<?= terms_url(); ?>"
                    class="terms-and-conditions-footer">
                    <?= _l('terms_and_conditions'); ?>
                </a>
                <?php } ?>
                <?php if (is_gdpr() && is_client_logged_in() && get_option('show_gdpr_link_in_footer') == '1') { ?>
                - <a href="<?= site_url('clients/gdpr'); ?>"
                    class="gdpr-footer">
                    <?= _l('gdpr_short'); ?>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</footer>

<!-- Load custom gradient animation script -->
<script src="<?= base_url('assets/themes/perfex/js/gradient-animation.js'); ?>"></script>

<?php if(basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php' || strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false): ?>
<!-- Load custom dashboard scripts -->
<script src="<?= base_url('assets/themes/perfex/js/dashboard-red.js'); ?>"></script>
<?php endif; ?>