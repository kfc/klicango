<?php
  global $user;
  if(!empty($event->event_data['sender_id']))
    $sender = user_load($event->event_data['sender_id']);
  else
    $sender = user_load($event->uid);    
    
  if ($sender->uid != $event->uid) {
      $creator = user_load($event->uid);
  } else {
      $creator = $sender;
  }
  profile_load_profile($sender);
?>   
<tr>
<td class="col-1">
        <?php if (!empty($event->field_content_images[0]['filepath'])) : ?>
		<a href="<?php echo url('node/' . $event->nid); ?>"><img src="<?php echo imagecache_create_url('day_event_image', $event->field_content_images[0]['filepath']); ?>" alt="" /></a>
        <?php elseif (!empty($creator->picture)) : ?>
            <a href="<?php echo url('node/' . $nid); ?>"><img src="<?php echo imagecache_create_url('day_event_image', $creator->picture); ?>" alt="" /></a>                
        <?php endif; ?>
</td>
<td class="col-2">
<?php

            if (strtolower( $event->field_event_type[0]['value'] ) == 'private') { 
                echo l($event->title, 'node/' . $event->nid, array('attributes' => array('class' => 'event-title private'))) . ' in ' . $event->field_location[0]['value'];
            } else {
                $place = user_load($event->uid);
                profile_load_profile($place);
                echo l($event->title, 'node/' . $event->nid, array('attributes' => array('class' => 'event-title'))) . ' at ' . l(($place->first_name ? $place->first_name : $place->name), 'user/' . $place->uid, array('attributes' => array('class' => 'location-name')));
            }
            
            $date = strtotime($event->field_date[0]['value']);
        ?> 
        <div class="event-date"><?php echo date('l F jS',$date).' '.t('at').' '.date('g:i a',$date)?></div>
        <div class="event-gratuity"><?php echo $event->field_event_gratuity[0]['value']; ?></div>
        <div class="going-friends">
          <?php $friends_going = events_get_friends_going($event->nid, $user->uid);?>
            <a href="javascript: void(0);" id="event_<?php echo $event->nid; ?>" class="going-users-link"> 
                <?php if ($friends_going == 1) $postfix = ' is going'; else $postfix = 's are going'; ?>
                <?php if (user_is_logged_in()) : ?>
                    <?php echo $friends_going; ?> friend<?php echo $postfix; ?>
                <?php else : ?>
                    <?php echo $friends_going; ?> user<?php echo $postfix; ?>
                <?php endif; ?>
            </a>
        </div>
</td>
<td class="col-3">
  <?php if (($viewed_user_id != $user->uid) && events_event_is_available_to_add($event)) { ?>
    <div class="add-to-calendar"><a href="javascript: void(0);" id="event_<?php echo $event->nid; ?>" title="<?php echo $event->title?>" class="add-event-from-day-events-link" onclick="acceptEventFromDayEventsList(<?php echo $event->nid; ?>)"><?php echo t('Add to my calendar')?></a></div>
    <?php }?>
</td>
</tr>