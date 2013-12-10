<?php
// $Id: calendar-datebox.tpl.php,v 1.2.2.3 2010/11/21 14:15:32 karens Exp $
/**
 * @file 
 * Template to display the date box in a calendar.
 *
 * - $view: The view.
 * - $granularity: The type of calendar this box is in -- year, month, day, or week.
 * - $mini: Whether or not this is a mini calendar.
 * - $class: The class for this box -- mini-on, mini-off, or day.
 * - $day:  The day of the month.
 * - $date: The current date, in the form YYYY-MM-DD.
 * - $link: A formatted link to the calendar day view for this day.
 * - $url:  The url to the calendar day view for this day.
 * - $selected: Whether or not this day has any items.
 * - $items: An array of items for this day.
 */
 global $user;
 $date_parts = explode('-',$date);
 $day_of_week =  date('D', mktime(0,0,0,$date_parts['1'],$date_parts['2'],$date_parts['0']));
 $active_user_uid = $user->uid;
 if(arg(0) == 'user' && arg(1) > 0){
  $active_user_uid = arg(1);
 }elseif(arg(0) == 'user_calendar' && arg(2) > 0){
    $active_user_uid = arg(2);
  }
  $day_events_count = 0;
  if(!empty($items[$date])){
  foreach($items[$date] as $_time => $_time_events)
    $day_events_count += count($_time_events);
  }
?>                       
<div class="<?php print $granularity ?> <?php print $class; ?>"> <?php print strtolower($day_of_week).' '.$day; ?> </div>
<?php if($day_events_count > 1):?>
  <div class="more-events"><a rel="lightbox" class="show-events-link" href="/show_events/<?php echo $active_user_uid?>/<?php echo $date;?>"><?php echo '+'.($day_events_count - 1).' '.t('event(s)');?></a></div>    
<?php endif;?>