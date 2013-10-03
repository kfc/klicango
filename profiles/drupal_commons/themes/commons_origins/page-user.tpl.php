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
  <?php print $local_styles; ?>
 
  <link rel="stylesheet" href="/profiles/drupal_commons/themes/commons_origins/styles/style.css" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="/profiles/drupal_commons/themes/commons_origins/styles/custom.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <!--[if lte IE 6]><link rel="stylesheet" href="styles/style_ie.css" type="text/css" media="screen, projection" /><![endif]-->
    <?php //echo $scripts?> 
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="/misc/drupal.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="/profiles/drupal_commons/themes/fusion/fusion_core/js/superfish.js"></script>
    <script src="/profiles/drupal_commons/themes/fusion/fusion_core/js/supposition.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.formstyler.new.js"></script>
        
    <script type="text/javascript" src="/profiles/drupal_commons/modules/contrib/views/js/base.js"></script>
    <script type="text/javascript" src="/profiles/drupal_commons/modules/contrib/views/js/ajax.js"></script>
    <script type="text/javascript" src="/profiles/drupal_commons/modules/contrib/views/js/ajax_view.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/events.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/friends.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/main.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jScrollPane.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="/profiles/drupal_commons/themes/commons_origins/js/jquery.mousewheel.js"></script>
    <script type="text/javascript">
      $(function() {

        function setEqualHeight(columns){
         var tallestcolumn = 0;
         columns.each(function()
               {
                 currentHeight = $(this).height();
                 if(currentHeight > tallestcolumn)
                 {
                   tallestcolumn  = currentHeight;
                 }
               }
       );
       
       columns.height(tallestcolumn);
       
      }

      $(".block .calendar-calendar .month-view table tr").each(function(){
        setEqualHeight($(this).find("div.inner"));
      });
      
      });
      </script>

</head>

<body class="not-front">

    
    
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
            <?php print $content_bottom_left; ?>
            <?php print $content_bottom_right; ?>
          </div><!-- #content-->
        </div><!-- #container-->
        <aside id="sideRight">
          <?php print $right_aside; ?>  
        </aside>  
      </section><!-- #middle-->
    
    </div><!-- #wrapper -->
    
    <?php
        include_once 'footer.tpl.php';
    ?>
    
    <?php print $closure; ?>
    <?php print $create_event_form; ?>
    <?php echo $scripts_modified; ?>
</html>
