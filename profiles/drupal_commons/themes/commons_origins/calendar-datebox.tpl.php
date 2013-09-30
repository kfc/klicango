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
 $date_parts = explode('-',$date);
 $day_of_week =  date('D', mktime(0,0,0,$date_parts['1'],$date_parts['2'],$date_parts['0']));
 $link
?>                       
<div class="<?php print $granularity ?> <?php print $class; ?>"> <?php print $selected ? l(strtolower($day_of_week).' '.$day, 'show_events_for_date',array('query'=>array('date'=>$date))) : strtolower($day_of_week).' '.$day; ?> </div>
<?php if(count($items[$date]) > 1):?>
  <div class="more-events"><a rel="lightbox" class="show-events-link" href="/show_events/<?php echo $date;?>"><?php echo '+'.(count($items[$date])-1).' '.t('event(s)');?></a></div>    
<?php endif;?>