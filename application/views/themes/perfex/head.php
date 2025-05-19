<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="<?= e($locale); ?>">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?= $title ?? ''; ?></title>
	<?= compile_theme_css(); ?>
	<!-- Custom Red Theme CSS -->
	<link href="<?= base_url('assets/themes/perfex/css/custom-theme-red.css'); ?>" rel="stylesheet">
	<!-- Gradient Animation CSS -->
	<link href="<?= base_url('assets/themes/perfex/css/gradient-animation.css'); ?>" rel="stylesheet">
	<?php if(basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php' || strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false): ?>
	<link href="<?= base_url('assets/themes/perfex/css/dashboard-red.css'); ?>" rel="stylesheet">
	<?php endif; ?>
	<script
		src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>">
	</script>
	<?php app_customers_head(); ?>
</head>

<body
	class="customers <?= strtolower($this->agent->browser()); ?><?= is_mobile() ? ' mobile' : ''; ?><?= isset($bodyclass) ? ' ' . $bodyclass : ''; ?>"
	<?= $isRTL == 'true' ? 'dir="rtl"' : ''; ?>>

	<?php hooks()->do_action('customers_after_body_start'); ?>