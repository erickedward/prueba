<?php

defined('_JEXEC') or die;

$lnkPath = JURI::base(true).'/templates/td_business/';
$document = JFactory::getDocument(); 
$slides          = $this->params->get('slides');
$shadows         = $this->params->get('shadows');
$headHeigh	     = $this->params->get('headHeigh');
$socialCode         = $this->params->get ('socialCode');
$jukenburn_thumb1 	= $this->params->get('jukenburn_thumb1', '' );
$jukenburn_thumb2 	= $this->params->get('jukenburn_thumb2', '' );
$jukenburn_thumb3 	= $this->params->get('jukenburn_thumb3', '' );
$jukenburn_thumb4 	= $this->params->get('jukenburn_thumb4', '' );
$jukenburn_thumb5 	= $this->params->get('jukenburn_thumb5', '' );
$jukenburn_thumb6 	= $this->params->get('jukenburn_thumb6', '' );
$jukenburn_texts1 	= $this->params->get('jukenburn_texts1', '' );
$jukenburn_texts2 	= $this->params->get('jukenburn_texts2', '' );
$jukenburn_texts3 	= $this->params->get('jukenburn_texts3', '' );
$jukenburn_texts4 	= $this->params->get('jukenburn_texts4', '' );
$jukenburn_texts5 	= $this->params->get('jukenburn_texts5', '' );
$jukenburn_texts6 	= $this->params->get('jukenburn_texts6', '' );

$document->addStyleSheet($lnkPath.'slider/css/settings.css');

?>

<style>
.tp-banner-container{
width:100% !important;		
position:relative;
padding:0;
margin: 0px;
max-height:<?php echo $this->params->get('headHeigh'); ?>px !important;
overflow:hidden;
}
</style>
<div class="tp-banner-container">
<div class="tp-banner">          
<ul>
<?php if ($jukenburn_thumb1): ?>
<li data-transition="random-static" data-slotamount="1" data-masterspeed="1000" data-title="<?php echo $jukenburn_texts1; ?>" > <img src="<?php echo $jukenburn_thumb1; ?>"  alt="<?php echo $jukenburn_texts1; ?>"  data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
</li>
<?php endif;?>
<?php if ($jukenburn_thumb2): ?>
<li data-transition="random-static" data-slotamount="1" data-masterspeed="1000" data-title="<?php echo $jukenburn_texts2; ?>" > <img src="<?php echo $jukenburn_thumb2; ?>"  alt="<?php echo $jukenburn_texts2; ?>"  data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
</li>
<?php endif;?>
<?php if ($jukenburn_thumb3): ?>
<li data-transition="random-static" data-slotamount="1" data-masterspeed="1000" data-title="<?php echo $jukenburn_texts3; ?>" > <img src="<?php echo $jukenburn_thumb3; ?>"  alt="<?php echo $jukenburn_texts3; ?>"  data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
</li>
<?php endif;?>
<?php if ($jukenburn_thumb4): ?>
<li data-transition="random-static" data-slotamount="1" data-masterspeed="1000" data-title="<?php echo $jukenburn_texts4; ?>" > <img src="<?php echo $jukenburn_thumb4; ?>"  alt="<?php echo $jukenburn_texts4; ?>"  data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
</li>
<?php endif;?>
<?php if ($jukenburn_thumb5): ?>
<li data-transition="random-static" data-slotamount="1" data-masterspeed="1000" data-title="<?php echo $jukenburn_texts5; ?>" > <img src="<?php echo $jukenburn_thumb5; ?>"  alt="<?php echo $jukenburn_texts5; ?>"  data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
</li>
<?php endif;?>
</ul>
<div class="tp-bannertimer"></div>
</div>
</div>

<script type = "text/javascript" src = "<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/slider/js/jquery.tools.min.js"></script>
<script type = "text/javascript" src = "<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/slider/js/jquery.revolution.min.js"></script>		
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('.tp-banner').revolution(
{
delay:7000,												
startwidth:890,
startheight:500,							
onHoverStop:"on",		
thumbWidth:100,							
thumbHeight:30,
thumbAmount:3,
hideThumbs:10,
navigationType:"none",	
navigationStyle:"preview1",				
touchenabled:"on",			
navOffsetHorizontal:0,
navOffsetVertical:20,
fullWidth:"on",
shadow:0,		
stopLoop:"off"			
});	
});
</script>


