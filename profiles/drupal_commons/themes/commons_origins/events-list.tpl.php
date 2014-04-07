<?php dpm($events); ?>
<div id="top-event-list">
   <h2><?php print t('My events')?></h2>
   <?php if(!empty($events)): ?>
   <table>
      <tbody>
         <?php foreach($events as $node): ?>
       <tr>
            <td class="col-1">
                <?php if (!empty($node->field_content_images[0]['filepath'])) : ?>
                    <a href="<?php echo url('node/' . $node->nid); ?>"><img src="<?php echo imagecache_create_url('events_overview_thumbnail', $node->field_content_images[0]['filepath']); ?>" alt="" /></a>
                <?php elseif (!empty($creator->picture)) : ?>
                    <a href="<?php echo url('node/' . $node->nid); ?>"><img src="<?php echo imagecache_create_url('events_overview_thumbnail', $creator->picture); ?>" alt="" /></a>                
                <?php endif; ?>
            </td>
            <td class="col-2">
                <?php echo l($node->title, 'node/' . $node->nid, array('attributes' => array('class' => 'event-title')));  ?> 
                <div class="event-date">
                <?php
                    $output_date = $start_date = $end_date = ''; 
                    if(!empty($node->field_date)){
                      $start_date = strtotime($node->field_date[0]['value']);
                      $end_date = strtotime($node->field_date[0]['value2']);  
                    }
                    if(!empty($start_date) && !empty($end_date) && date('m/d/Y', $start_date) != date('m/d/Y', $end_date)){
                      $output_date = '<div>'.date('l, F j H:i', $start_date).' - </div>';
                      $output_date .= '<div>'.date('l, F j H:i', $end_date).'</div>';
                    }
                    elseif(!empty($start_date) && !empty($end_date) && $start_date == $end_date){
                      $output_date = '<div>'.date('l, F j Y, H:i', $start_date).'</div>';   
                    }
                    elseif(!empty($start_date) && !empty($end_date) && date('m/d/Y', $start_date) == date('m/d/Y', $end_date)){
                      $output_date = '<div>'.date('l, F j', $start_date).'</div>';
                      $output_date .= '<div>'.date('H:i', $start_date).' - '.date('H:i', $end_date).'</div>';  
                    }
                    elseif(!empty($start_date) && !empty($end_date) && $start_date == $end_date){
                      $output_date = '<div>'.date('l, F j H:i', $start_date).'</div>';
                    }
                    elseif(!empty($start_date) && empty($end_date)){
                      $output_date = '<div>'.date('l, F j H:i', $start_date).'</div>';
                    }
                    echo $output_date; 
                 ?>
                 </div>
                <div class="event-gratuity"><?php echo $node->field_event_gratuity[0]['safe']; ?></div>
                <div class="going-friends">
                    <a href="javascript: void(0);" id="event_<?php echo $node->nid; ?>" class="going-users-link"> 
                        <?php if ($node->friends_going == 1) $postfix = ' is going'; else $postfix = 's are going'; ?>
                        <?php if (user_is_logged_in()) : ?>
                            <?php echo $node->friends_going; ?> <?php echo (!empty($node->whoisgoing) ? $node->whoisgoing : 'friend') ?><?php echo $postfix; ?>
                        <?php else : ?>
                            <?php echo $node->friends_going; ?> user<?php echo $postfix; ?>
                        <?php endif; ?>
                    </a>
                </div>
            </td>
            <td class="col-3">
                <?php if($node->field_event_tickets[0]['value'] == 1): ?>
                    <div class="add-to-calendar"><a href="<?php echo base_path(); ?>event-ticket-list/<?php echo($node->nid)?>" id="event_<?php echo $node->nid; ?>" title="<?php echo $title?>" class="add-event-link"><?php echo t('View sales'); ?></a></div>
                <?php endif; ?>
            </td>
        </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
   <?php endif; ?>
</div>