<?php
// $Id: page.tpl.php $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" class="no-js">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php //print $styles; ?>
  <?php //print $setting_styles; ?>
  <!--[if IE 8]>
  <?php //print $ie8_styles; ?>
  <![endif]-->
  <!--[if IE 7]>
  <?php //print $ie7_styles; ?>
  <![endif]-->
  <!--[if lte IE 6]>
  <?php //print $ie6_styles; ?>
  <![endif]-->
  <?php //print $local_styles; ?>
  <?php //print $scripts; ?>
  <link rel="stylesheet" href="/profiles/drupal_commons/themes/commons_origins/styles/style.css" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="/profiles/drupal_commons/themes/commons_origins/styles/custom.css" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="/profiles/drupal_commons/themes/commons_origins/styles/jquery-ui.min.css" />
    <!--[if lte IE 6]><link rel="stylesheet" href="styles/style_ie.css" type="text/css" media="screen, projection" /><![endif]-->
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery-1.9.1.min.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery-ui.min.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.infieldlabel.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.formstyler.new.js"></script>
    <script src="/misc/drupal.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/events.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/friends.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/photos.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/main.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jScrollPane.js"></script>
	<script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.mCustomScrollbar.min.js"></script>
	<script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.mousewheel.js"></script>
</head>

<body class="front">
    <?php include_once 'facebook.tpl.php'; ?>

    <div id="wrapper">
    
    	<header id="header">
    		
    		<div class="container">
    		
    			<div id="logo">
    				<a href="/">
    					<img src="/profiles/drupal_commons/themes/commons_origins/images/logo.png" alt=""/>
    				</a>
    			</div>
                
                <?php
                    include_once 'menu.tpl.php';
                ?>
                
    			<!-- Форма поиска -->
    				<div id="search-form">
    					<form action="/klicando_search" method="get">
    						<input type="text" name="term" value="<?php echo t('Search for events, friends...')?>" class="search_input" onfocus="javascript: if(this.value == 'Search for events, friends...') this.value = '';" onblur="javascript: if(this.value == '') { this.value = 'Search for events, friends...';}" />
    					</form>
    				</div>
    			<!-- Форма поиска -->
    		</div>
    	</header><!-- #header-->
    	
    	<section id="spacer"></section>
    	
    	<?php print $carousel; ?>
    	
    	<div class="clear-fix"></div>
    
    	<section id="middle">
    
    		<div id="container">
    			<div id="content">
            <?php print $messages; ?>
    				<?php print $content; ?>
    			</div><!-- #content-->
    		</div><!-- #container-->
    
    	</section><!-- #middle-->
    
    </div><!-- #wrapper -->
    
    
    <?php
        include_once 'footer.tpl.php';
    ?>
    
    <?php print $create_event_form; ?>
    <?php echo $scripts_modified; ?>
    <?php if (!empty($_GET['facebook']) && $_GET['facebook'] == 'true') : ?>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#log_in').click();
          });
        </script>
    <?php endif; ?>
  </body>
</html>
