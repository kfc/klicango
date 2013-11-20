<?php

/**
 * Row & block theme functions
 * Adds divs to elements in page.tpl.php
 */
function commons_origins_grid_row($element, $name, $class='', $width='', $extra='') {
  $output = '';
  $extra = ($extra) ? ' ' . $extra : '';
  if ($element) {
    if ($class == 'full-width') {
      $output .= '<div id="' . $name . '-wrapper" class="' . $name . '-wrapper full-width">' . "\n";
      $output .= '<div id="' . $name . '" class="' . $name . ' row ' . $width . $extra . '">' . "\n";
    }
    else {
      $output .= '<div id="' . $name . '" class="' . $name . ' row ' . $class . ' ' . $width . $extra . '">' . "\n";
    }
    $output .= '<div id="' . $name . '-inner" class="' . $name . '-inner inner clearfix">' . "\n";
    if ($name == 'sidebar-last') {
      $output .= '<span class="sidebar-last-cap"></span>'. "\n";
    }
    $output .= $element;
    $output .= '</div><!-- /' . $name . '-inner -->' . "\n";
    $output .= '</div><!-- /' . $name . ' -->' . "\n";
    $output .= ($class == 'full-width') ? '</div><!-- /' . $name . '-wrapper -->' . "\n" : '';
  }
  return $output;
}

function commons_origins_preprocess_page(&$variables) {
  $variables['pre_header_top'] = theme('grid_row', $variables['header_top'], 'header-top', 'full-width', $variables['grid_width']);
  $variables['pre_secondary_links'] = theme('grid_block', theme('links', $variables['secondary_links']), 'secondary-menu');
  $variables['pre_search_box'] = theme('grid_block', $variables['search_box'], 'search-box');
  $variables['pre_primary_links_tree'] = theme('grid_block', $variables['primary_links_tree'], 'primary-menu');
  $variables['pre_breadcrumb'] = theme('grid_block', $variables['breadcrumb'], 'breadcrumbs');
  $variables['pre_preface_top'] = theme('grid_row', $variables['preface_top'], 'preface-top', 'full-width', $variables['grid_width']);
  $variables['pre_sidebar_first'] = theme('grid_row', $variables['sidebar_first'], 'sidebar-first', 'nested', $variables['sidebar_first_width']);
  $variables['pre_preface_bottom'] = theme('grid_row', $variables['preface_bottom'], 'preface-bottom', 'nested');
  $variables['pre_help'] = theme('grid_block', $variables['help'], 'content-help');
  $variables['pre_messages'] = theme('grid_block', $variables['messages'], 'content-messages');
  $variables['pre_tabs'] = theme('grid_block', $variables['tabs'], 'content-tabs');
  $variables['pre_content_bottom'] = theme('grid_row', $variables['content_bottom'], 'content-bottom', 'nested');
  $variables['pre_sidebar_last'] = theme('grid_row', $variables['sidebar_last'], 'sidebar-last', 'nested', $variables['sidebar_last_width']);
  $variables['pre_postscript_top'] = theme('grid_row', $variables['postscript_top'], 'postscript-top', 'nested');
  $variables['pre_postscript_bottom'] = theme('grid_row', $variables['postscript_bottom'], 'postscript-bottom', 'full-width', $variables['grid_width']);
  $variables['pre_footer'] = theme('grid_row', $variables['footer'] . $variables['footer_message'], 'footer', 'full-width', $variables['grid_width']);
  
  $variables['create_event_form'] = theme('create_event_form');
  
  
  
  //show group description if group node present
  if (isset($variables['node'])) {
    $node = $variables['node'];
    if (og_is_group_type($node->type)) {
      $variables['group_header_image'] = content_format('field_group_image', $node->field_group_image[0], 'user_picture_meta_default');
      
      if (!empty($node->body)) {
        $variables['group_header_text'] = check_markup($node->body, $node->format);  
      }
      else {
        $variables['group_header_text'] = check_plain($node->og_description);
      }
    }
  }  
  $js = drupal_add_js();
  unset($js['core']);
  unset($js['module']);
  unset($js['theme']);

  $vars['scripts'] = drupal_get_js('header', $js);
  
  $scripts_modified = drupal_add_js(); 
  
  $scripts_modified = array('inline' => $scripts_modified['inline']);
  

  $variables['scripts_modified' ] = drupal_get_js('inline' , $scripts_modified);
}

function commons_origins_preprocess_node(&$variables) {
  $query = 'destination=' . $_GET['q'];
  $variables['answers_login'] =  t('<a href="@login">Login</a> or <a href="@register">register</a> to vote', array('@login' => url('user/login', array('query' => $query)), '@register' => url('user/register', array('query' => $query))));
}

function commons_origins_preprocess_date_navigation(&$vars) {    
  $view = $vars['view'];
  $next_args = $view->args;
  $prev_args = $view->args;
  $pos = $view->date_info->date_arg_pos;
  $min_date = is_object($view->date_info->min_date) ? $view->date_info->min_date : date_now();
  $max_date = is_object($view->date_info->max_date) ? $view->date_info->max_date : date_now();
  //$view->date_info->url = drupal_get_path_alias($_GET['q']).(isset($_GET['cal']) ? '?cal='.$_GET['cal'] :'?cal='.date('Y-m'));
  $view->date_info->url = (isset($_GET['cal']) ? $_GET['cal'] : date('Y-m'));
  if (empty($view->date_info->hide_nav)) {
    $prev_date = drupal_clone($min_date);
    date_modify($prev_date, '-1 '. $view->date_info->granularity);
    $next_date = drupal_clone($min_date);
    date_modify($next_date, '+1 '. $view->date_info->granularity);
    $format = array('year' => 'Y', 'month' => 'Y-m', 'day' => 'Y-m-d');
    switch ($view->date_info->granularity) {
      case 'week':
        $next_week = date_week(date_format($next_date, 'Y-m-d'));
        $prev_week = date_week(date_format($prev_date, 'Y-m-d'));
        $next_arg = date_format($next_date, 'Y-\W') . $next_week;
        $prev_arg = date_format($prev_date, 'Y-\W') . $prev_week;
        break;
      default:
        $next_arg = date_format($next_date, $format[$view->date_info->granularity]);
        $prev_arg = date_format($prev_date, $format[$view->date_info->granularity]);
    }
     
    $next_path = str_replace($view->date_info->date_arg, $next_arg, $view->date_info->url);
    $prev_path = str_replace($view->date_info->date_arg, $prev_arg, $view->date_info->url);
    $next_args[$pos] = $next_arg;
    $prev_args[$pos] = $prev_arg;   
    $querystring = date_querystring($view);
    $vars['next_url'] = url($_GET['q'], array( 'query' => array_merge(array('cal'=>$next_path)), 'absolute' => TRUE));
    $vars['prev_url'] = url($_GET['q'], array( 'query' => array_merge(array('cal'=>$prev_path)), 'absolute' => TRUE));
    
    
    //$vars['next_url'] = $next_path; // date_real_url($view, NULL, $next_arg);
    //$vars['prev_url'] = $prev_path; // date_real_url($view, NULL, $prev_arg);
    $vars['next_options'] = $vars['prev_options'] = array();
    
  }
  else {
    $next_path = '';
    $prev_path = '';
    $vars['next_url'] = '';
    $vars['prev_url'] = '';
    $vars['next_options'] = $vars['prev_options'] = array();
  }

  // Check whether navigation links would point to
  // a date outside the allowed range.
  if (!empty($next_date) && !empty($vars['next_url']) && date_format($next_date, 'Y') > $view->date_info->max_allowed_year) {
    $vars['next_url'] = '';
  }
  if (!empty($prev_date) && !empty($vars['prev_url']) && date_format($prev_date, 'Y') < $view->date_info->min_allowed_year) {
    $vars['prev_url'] = '';
  }

  $vars['prev_options'] += array('attributes' => array());
  $vars['next_options'] += array('attributes' => array());
  $prev_title = '';
  $next_title = '';

  // Build next/prev link titles.
  switch ($view->date_info->granularity) {
    case 'year':
      $prev_title = t('Navigate to previous year');
      $next_title = t('Navigate to next year');
      break;
    case 'month':
      $prev_title = t('Navigate to previous month');
      $next_title = t('Navigate to next month');
      break;
    case 'week':
      $prev_title = t('Navigate to previous week');
      $next_title = t('Navigate to next week');
      break;
    case 'day':
      $prev_title = t('Navigate to previous day');
      $next_title = t('Navigate to next day');
      break;
  }      
  $vars['prev_options']['attributes'] += array('title' => $prev_title);
  $vars['next_options']['attributes'] += array('title' => $next_title);

  // Add nofollow for next/prev links.
  $vars['prev_options']['attributes'] += array('rel' => 'nofollow');
  $vars['next_options']['attributes'] += array('rel' => 'nofollow');


  
  $vars['next_options']['date'] = date_format($next_date, 'F Y');
  $vars['prev_options']['date'] = date_format($prev_date, 'F Y');
  $link = FALSE;
  // Month navigation titles are used as links in the block view.
  if (!empty($view->date_info->block) && $view->date_info->granularity == 'month') {
    $link = TRUE;
  }

  $nav_title = theme('date_nav_title', $view->date_info->granularity, $view, $link);
  $vars['nav_title'] = $nav_title;
  $vars['block'] = !empty($view->date_info->block);
}
                                 
function commons_origins_menu_item_link($link){ 
  global $user;
 if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }
  if($link['title'] == '<none>')
    $link['title'] = '';
  if($link['href'] == 'messages'){
    $link['href'] = 'user/'.$user->uid.'/messages';  
  }
    
  return l($link['title'], $link['href'], $link['localized_options']);
  
}    

function commons_origins_fboauth_action__connect($action, $link) {
    $url = url($link['href'], array('query' => $link['query']));
    $link['attributes']['class'] = isset($link['attributes']['class']) ? $link['attributes']['class'] : 'facebook-action-connect';
    $link['attributes']['rel'] = 'nofollow';
    $attributes = isset($link['attributes']) ? drupal_attributes($link['attributes']) : '';
    $title = isset($link['title']) ? check_plain($link['title']) : '';
    
    return '<div class="form-item facebook-log-in active"><a ' . $attributes . ' onclick="if(!$(\'.facebook-log-in\').hasClass(\'active\')) return false;" href="' . $url . '">' . t('Log with Facebook') . '</a></div>';

}  

function commons_origins_calendar_empty_day($curday, $view) {
  global $user;
  if(arg(0) == 'user'){
    $userid = arg(1);
  }
  if ($view->date_info->calendar_type != 'day') {
    return '<div class="hover-wrapper">'.($userid == $user->uid ? '
              <a class="add-event-link add-event-from-calendar"  id="add-event-from-calendar-'.$curday.'" href="">+</a>
              ' : '').'
             </div>'."\n";
  }
  else {
    return '<div class="calendar-dayview-empty">'. t('Empty day') .'</div>';
  }
}     
function commons_origins_pager_previous($text, $limit, $element = 0, $interval = 1, $parameters = array()) {
  global $pager_page_array;
  $output = '';
  $text = t('‹ back');
  // If we are anywhere but the first page
  if ($pager_page_array[$element] > 0) {
    $page_new = pager_load_array($pager_page_array[$element] - $interval, $element, $pager_page_array);

    // If the previous page is the first page, mark the link as such.
    if ($page_new[$element] == 0) {
      $output = theme('pager_first', $text, $limit, $element, $parameters);
    }
    // The previous page is not the first page.
    else {
      $output = theme('pager_link', $text, $page_new, $element, $parameters);
    }
  }

  return $output;
}

