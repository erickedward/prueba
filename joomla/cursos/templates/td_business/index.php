<?php
/*---------------------------------------------------------------
# Package - Joomla Template based on Stools Framework   
# ---------------------------------------------------------------
# Author - joomlatd http://www.joomlatd.com
# Copyright (C) 2008 - 2018 joomlatd.com. All Rights Reserved.
# Websites: http://www.joomlatd.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');
require_once(dirname(__FILE__).'/lib/frame.php');
$jversion = new JVersion;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language;?>" >
<head>
<?php
$stools->loadHead();
$stools->addCSS('template.css,joomla.css,menu.css,override.css,modules.css');
if ($stools->isRTL()) $stools->addCSS('template_rtl.css');
?>

<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/custom.js"></script>
</head>
<?php $stools->addFeatures('ie6warn'); ?>
<body class="bg <?php echo $stools->direction . ' ' . $stools->style ?> clearfix">

<div id="ju-top-header" class="clearfix">
<div class="ju-base clearfix">
<?php 
$stools->addFeatures('colors');//Template colors
$stools->addFeatures('date'); //date feature
$stools->addModules('top-menu'); // module top-menu
?>
</div>
</div>
<div class="ju-base clearfix">
<div id="header" class="clearfix">
<?php 
$stools->addFeatures('logo');//Logo
?>
<div class="main_menu">
<?php 
$stools->addModules("mainmenu"); //position mainmenu
?>
</div>
</div>	
</div>

<div class="ju-base main-bg clearfix">		
<?php if ($stools->showSlideItem()): ?>
<div id="slides">
<?php include 'slider/slider.php'; ?> 	
<?php
$stools->addModules("header"); //position header
?>
</div>
<?php endif; ?>

<?php
$stools->addModules('top1, top2, top3, top4, top5, top6', 'ju_block', 'ju-userpos'); //positions top1-top6 
?>
<?php 
$stools->addModules("breadcrumbs"); //breadcrumbs
$stools->addModules('bookmarks'); // bookmarks
?>
<?php $stools->addModules('maptop'); ?>
<div class="clearfix">
<?php $stools->loadLayout(); //mainbody ?>
</div>
<?php $stools->addModules('bottom'); ?>
<?php 
$stools->addModules('mainbottom1,mainbottom2,mainbottom3,mainbottom4', 'ju_xhtml', 'ju-mainbottom'); //mainbottom1-mainbottom8	
?>
</div>

<?php if ($this->countModules( 'team' )) : ?>
<div class="ju-base clearfix">
<div id="set-team">
<?php
$stools->addModules('team', 'ju_xhtml'); //map 
?>			
</div>	
</div>
<?php endif; ?>

<?php
$stools->addModules('bottom1, bottom2, bottom3, bottom4, bottom5, bottom6', 'ju_block', 'ju-bottom', '', false, true); //positions bottom1-bottom6 
?>

<!--Start Footer-->
<div id="ju-footer" class="clearfix">
<div class="ju-base">
<div class="cp">
<?php $stools->addFeatures('copyright,designed')  ?>					
</div>	
<div class="clearfix"></div>
<?php 			
$stools->addModules("footer-nav"); 
?>
</div>
</div>


<?php 
$stools->addFeatures('analytics,jquery,ieonly'); /*--- analytics, jquery features ---*/
?>
<jdoc:include type="modules" name="debug" />
</body>
</html>