<?php
// $Id: page.tpl.php $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" class="no-js">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $setting_styles; ?>
  <!--[if IE 8]>
  <?php //print $ie8_styles; ?>
  <![endif]-->
  <!--[if IE 7]>
  <?php //print $ie7_styles; ?>
  <![endif]-->
  <!--[if lte IE 6]>
  <?php //print $ie6_styles; ?>
  <![endif]-->
  <?php print $local_styles; ?>
  <?php print $scripts; ?>
  <link rel="stylesheet" href="/profiles/drupal_commons/themes/commons_origins/styles/style.css" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="/profiles/drupal_commons/themes/commons_origins/styles/custom.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <!--[if lte IE 6]><link rel="stylesheet" href="styles/style_ie.css" type="text/css" media="screen, projection" /><![endif]-->
    
    
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.formstyler.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/events.js"></script>
</head>

<body class="not-front">

    
    
    <div id="wrapper">
    
    	<header id="header" style="display: none;">
    		
    		<div class="container">
    		
    			<div id="logo">
    				<a href="/">
    					<img src="/profiles/drupal_commons/themes/commons_origins/images/logo.png" alt=""/>
    				</a>
    			</div>
    		
    			<nav class="main_menu">
    				<ul class="menu">
    					<li>
    						<a href="">Calendar</a>
    						<span class="counter">2</span>
    					</li>
    					<li>
    						<a href="">Friends</a>
    						<span class="counter">12</span>
    					</li>
    					<li>
    						<a href="">Public events</a>
    						<span class="counter">10</span>
    					</li>
    					<li class="create_event">
    						<a id="create-event-link" href=""><?php echo t('+ Create event');?></a>
    					</li>
    				</ul>
    			</nav>
    			
    			<div id="auth-block">
    				<a id="login" href="">LOGIN</a>
                    <a id="login" href="">|</a>
                    <a id="login" href="">SIGN UP</a>
    			</div>
    			
    			<!-- Форма поиска -->
    				<div id="search-form">
    					<form action="" method="post">
    						<input type="text" value="Search for events, friends..." class="search_input" onfocus="javascript: if(this.value == 'Search for events, friends...') this.value = '';" onblur="javascript: if(this.value == '') { this.value = 'Search for events, friends...';}" />
    					</form>
    				</div>
    			<!-- Форма поиска -->
    		</div>
    	</header><!-- #header-->
    	
    	<section id="spacer"></section>
    	
    	
    	<div class="clear-fix"></div>
    
    	<section id="middle">
    
    		<div id="container">
    			<div id="content">
            <?php print $messages; ?>
    				<?php print $content; ?>
    			</div><!-- #content-->
    		</div><!-- #container-->
        <aside id="sideRight">
          <?php print $right_aside; ?>  
        </aside>  
    	</section><!-- #middle-->
    
    </div><!-- #wrapper -->
    
    <footer id="footer">
    	<div class="footer-left-block">
    		<img src="/profiles/drupal_commons/themes/commons_origins/images/footer-ico.png" alt="" />
    		<span>Clipby, partenaire officiel</span>
    	</div>
    	<div class="footer-right-block">
    		<ul class="menu">
    			<li><a href="">mentions légales</a></li>
    			<li><a href="">signaler un abus</a></li>
    			<li><a href="">contact</a></li>
    		</ul>
    		<span class="copyrights">© KLICANGO 2013</span>
    	</div>
    </footer><!-- #footer -->
    <?php print $closure; ?>
    <?php print $create_event_form; ?>
</html>
