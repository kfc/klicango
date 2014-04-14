<?php if(!empty($updated_events)) :?>
<div id="public-event-list">
   <div class="list-item">
      <table>
         <tbody>
            <?php foreach($updated_events as $node): ?>
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
                    <div class="going-friends">
                        <a href="javascript: void(0);" id="event_<?php echo $node->nid; ?>" class="going-users-link"> 
                            <?php
                            if(!empty($node->update_data['going_people'])){
                                echo  t('+ @people (@total total)', array(
                                        '@people' => format_plural($node->update_data['going_people'], '1 new person is going', '@count new people are going'),
                                        '@total' => count($node->people_going['going'])));                                 
                            }
                            ?>
                        </a>
                    </div>
                    <?php if($node->field_event_tickets[0]['value'] == 1): ?>
                    <div class="price-block t-tickets-sold">
                        <a href="<?php echo base_path(); ?>event-ticket-list/<?php echo($node->nid)?>">
                            <?php
                            if(!empty($node->update_data['new_tickets_count'])){
                                echo  t('+ @new (@total total)', array(
                                        '@new' => format_plural($node->update_data['new_tickets_count'], '1 new ticket has been sold', '@count new tickets have been sold'),
                                        '@total' => $node->tickets_sold_total));                                 
                            }
                            ?>
                        </a>   
                    </div>
                    <?php endif; ?>
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
   </div>
</div>
<?php endif; ?>
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
                <div class="going-friends">
                    <a href="javascript: void(0);" id="event_<?php echo $node->nid; ?>" class="going-users-link"> 
                        <?php echo format_plural(count($node->people_going['going']), '1 person is going', '@count  people are going');?>
                    </a>
                </div>
                <?php if($node->field_event_tickets[0]['value'] == 1): ?>
                <div class="price-block t-tickets-sold">
                    <a href="<?php echo base_path(); ?>event-ticket-list/<?php echo($node->nid)?>">
                    <?php echo format_plural($node->tickets_sold_total, '1 ticket has been sold', '@count tickets have been sold'); ?>
                    </a>
                </div>
                <?php endif; ?>
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