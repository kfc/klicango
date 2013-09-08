<!DOCTYPE HTML>
<!--[if IE 7 ]><html lang="en" class="ie8"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]>
<!--><html lang="en"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Klicango</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="/<?php print drupal_get_path('theme', 'commons_origins'); ?>/images/favicon.ico">
		<link rel="apple-touch-icon" href="/<?php print drupal_get_path('theme', 'commons_origins'); ?>/images/favicon.png">
		<link rel="stylesheet" href="/<?php print drupal_get_path('theme', 'commons_origins'); ?>/css/commons_origins-style.css" media="all">
        <link rel="stylesheet" href="/<?php print drupal_get_path('theme', 'commons_origins'); ?>/css/login.css" media="all">
		<!--[if lt IE 9 ]>
			<script>
				/* emulate HTML5 elements */
				var E  = ('article:aside:audio:canvas:figure:footer:header:hgroup:nav:section:video:output:detalis:keygen:meter:progress:figcaption:mark:summary:time:wbr').split(':');   
				for (var c = 0; c < E.length; c++) {
					document.createElement(E[c]);
				}
			</script>
		<![endif]-->		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script>if(typeof(jQuery)=='undefined'){document.write("<scr" + "ipt src='j/jquery-1.8.2.min.js'></scr" + "ipt>");	}</script>
	</head>
	<body>
		<div class="page">
			<header>
				<a href="" class="logo"><img src="/<?php print drupal_get_path('theme', 'commons_origins'); ?>/images/logo.png" alt="Klicango" width="420" height="60"></a>
				<h1>Passez du virtuel au réel !</h1>
			</header>
			<section class="siteContent clearfix">
				<aside>
					<img src="/<?php print drupal_get_path('theme', 'commons_origins'); ?>/images/image.png" alt="Alternate text" width="430" height="495">
				</aside>
				<article style="margin-top: 50px;">
                    <?php print $messages; ?>
                    <?php
                        print drupal_get_form('user_login');
                    ?>
                    <form>
                        <input type="submit" class="form-submit" style="margin-top: 10px;" value="Register" onclick="document.location='/user/register'; return false;" id="edit-submit-2" name="op">
                    </form>
                    <div style="margin-top: 30px;"><?php print $content_bottom; ?></div>
				</article>
			</section>
			<footer class="clearfix">
				<nav class="footerNav">
					<a href="#" title="Qui sommes-nous">Qui sommes-nous</a>
					-
					<a href="#" title="aide">aide</a>
					-
					<a href="#" title="créer un agenda e-commerce">créer un agenda e-commerce</a>
					-
					<a href="#" title="confidentialité">confidentialité</a>
					-
					<a href="#" title="condition d'utilisation">condition d'utilisation</a>
				</nav>
				<nav class="copiesNav">
					<a href="#" title="© KLICANGO 2012">© KLICANGO 2012</a>
					|
					<a href="#" title="mentions légales">mentions légales</a>
				</nav>
			</footer>
		</div>
		<script src="/<?php print drupal_get_path('theme', 'commons_origins'); ?>/js/login.js"></script>
	</body>
</html>