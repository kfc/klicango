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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <!--[if lte IE 6]><link rel="stylesheet" href="styles/style_ie.css" type="text/css" media="screen, projection" /><![endif]-->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.formstyler.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/events.js"></script>
    <script>
	  $(function() {
		$("#main-slider ul").carouFredSel({
			items				: 1,
			scroll : {
				items			: 1,
				duration		: 500,							
				pauseOnHover	: true
			}					
		});	
		$( "#dialog-form" ).dialog({
		  autoOpen: false,
		  height: 412,
		  width: 484,
		  modal: true
		});
	 
		$( "#login" )
		  .click(function(e) {
			e.preventDefault();
			$( "#dialog-form" ).dialog( "open" );
		});
		
		$("select").styler();
		$('input[type="checkbox"]').styler();
		
	  });
	  </script>
</head>

<body class="front">

    <div id="dialog-form" title="Sign up">
      <form>
    	<div class="form-item">
    		<label>Name</label>
    		<input type="text" />
    		<input type="text" />
    	</div>
    	<div class="form-item field-e-mail">
    		<label>E-mail</label>
    		<input type="text" />
    	</div>
    	<div class="form-item">
    		<label>Password</label>
    		<input type="password" />
    		<input type="password" />
    	</div>
    	<div class="form-item">
    		<label>Identity</label>
    		<select>
    			<option>male</option>
    			<option>female</option>
    		</select>
    		<input type="text" />
    	</div>
    	<div class="form-item">
    		<label>Location</label>
    		<select>
                <option>France</option>
    			<option>Germany</option>
    			<option>Belarus</option>
    		</select>
    		<input type="text" />
    	</div>
    	<div class="form-item">
    		<label>University</label>
    		<input type="text" />
    		<select>
    			<option>degree</option>
    			<option>agree</option>
    		</select>
    	</div>
    	<div class="form-item profile-links">
    		<a id="add-prof-photo" href="">Add profile photo</a>
    		<a id="add-friends" href="">Add friends</a>
    	</div>
    	<div class="form-submit">
    		<label><input type="checkbox"/>J’accepte les <a href="">conditions d’utilisation</a> du service</label>
    		<input type="submit" value="Sign up"/>
    	</div>
      </form>
    </div>
    
    <div id="wrapper">
    
    	<header id="header">
    		
    		<div class="container">
    		
    			<div id="logo">
    				<a href="/">
    					<img src="/profiles/drupal_commons/themes/commons_origins/images/logo.png" alt=""/>
    				</a>
    			</div>
    		
    			<nav class="main_menu">
    				<ul class="menu">
    					<li>
    						<a href="/user">Calendar</a>
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
    	
    	<section id="main-slider">
    		<ul>
    			<li>
    				<img src="/profiles/drupal_commons/themes/commons_origins/images/slide1.jpg" alt="" />
    				<div class="slider-text">
    					<img src="/profiles/drupal_commons/themes/commons_origins/images/profile-thumbnail.jpg" />
    					<div class="profile-name">Lounge Bar Promenade</div>
    					<div class="profile-address">3 Rue Barillerie - 06300 Nice</div>
    					<div class="profile-link"><a href="">more...</a></div>
    				</div>
    			</li>
    			<li>
    				<img src="/profiles/drupal_commons/themes/commons_origins/images/slide2.jpg" alt="" />
    			</li>
    		</ul>
    	</section>
    	
    	<div class="clear-fix"></div>
    
    	<section id="middle">
    
    		<div id="container">
    			<div id="content">
    				<?php print $content; ?>
    			</div><!-- #content-->
    		</div><!-- #container-->
    
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
     <?php print $create_event_form; ?>
</html>
