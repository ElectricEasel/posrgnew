<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.Joostrap
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once __DIR__ . '/functions/tpl-init.php';

JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework');
JHtml::_('bootstrap.tooltip');

?>
<!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="<?php echo $htmlLang; ?>" >
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="<?php echo $htmlLang; ?>" >
<!--<![endif]-->
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php if ($loadJquery == 1) : ?>
			<script src="<?php echo getDebugAssetUrl($tplUrl . '/js/jquery.min.js'); ?>" type="text/javascript"></script>
			<script src="<?php echo getDebugAssetUrl($tplUrl . '/js/jquery-noconflict.js'); ?>" type="text/javascript"></script>
			<script src="<?php echo getDebugAssetUrl($tplUrl . '/js/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
		<?php elseif ($loadJquery == 2) : ?>
			<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
			<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<?php endif; ?>
		<?php if ($loadBootstrap == 1) : ?>
			<script src="<?php echo getDebugAssetUrl($tplUrl . '/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
		<?php elseif ($loadBootstrap == 2) : ?>
			<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<?php endif; ?>
		<!--[if lt IE 9]>
		<script src="<?php echo $tplUrl; ?>/js/html5shiv.js" type="text/javascript"></script>
		<script src="<?php echo $tplUrl; ?>/js/respond.min.js" type="text/javascript"></script>
	    <![endif]-->
		<script src="<?php echo $tplUrl; ?>/js/modernizr.custom.js" type="text/javascript"></script>
		<script src="<?php echo $tplUrl; ?>/js/template.js" type="text/javascript"></script>
		<script src="<?php echo $tplUrl; ?>/js/j-backbone.js" type="text/javascript"></script>
		<!-- Place apple-touch-icon(s) in the site root directory -->
		<?php if ($loadBootstrap == 1) : ?>
			<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/bootstrap.min.css'); ?>">
		<?php elseif ($loadBootstrap == 2) : ?>
			<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<?php endif; ?>
		<?php if ($this->params->get('fontawesomecss')) : ?>
			<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/font-awesome.min.css'); ?>">
		<?php endif; ?>
		<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/animate.css'); ?>" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/template.css'); ?>" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/j-backbone.css'); ?>" type="text/css" media="screen" />
		<jdoc:include type="head" />
		<?php if (@filesize('templates/' . $this->template . '/css/custom.css') > 5): ?>
			<link rel="stylesheet" href="<?php echo $tplUrl; ?>/css/custom.css" type="text/css" media="screen" />
		<?php endif; ?>
		<?php if ($this->params->get('wireframing')) : ?>
			<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/wireframing.css'); ?>">
		<?php endif; ?>
		<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/jquery.mmenu.all.css'); ?>">
		<script src="<?php echo $tplUrl; ?>/js/jquery.mmenu.min.all.js" type="text/javascript"></script>
		<?php if (null !== $customColorsCss) : ?>
			<style type="text/css" charset="utf-8">
				<?php echo $customColorsCss; ?>
			</style>
		<?php endif; ?>
		<?php if (@filesize('templates/' . $this->template . '/js/analytics-head.js') > 5): ?>
			   <?php include_once('templates/' . $this->template . '/js/analytics-head.js'); ?>
		<?php endif; ?>
	</head>
    <body class="<?php echo $bodyclass. " " .$parentName. " " .$active->alias. " " .$option. " view-" .$view. " " .$frontpage. " itemid-" .$itemid. " " .$loggedin. " " .$rtl_detection; ?>">	<div class="body-wrapper" id="page">	<div class="wrapper">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
	</div>
</body>
</html>
