<?php

    if ($teaser) {
        global $user;
        $sender = user_load($node->event_data['sender_id']);
        if ($sender->uid != $node->uid) {
            $creator = user_load($node->uid);
        } else {
            $creator = $sender;
        }
        profile_load_profile($sender);
?>   
        <tr>
			<td class="col-1">
                <?php if (!empty($node->field_content_images[0]['filepath'])) : ?>
				    <a href="<?php echo url('node/' . $nid); ?>"><img src="<?php echo imagecache_create_url('events_overview_thumbnail', $node->field_content_images[0]['filepath']); ?>" alt="" /></a>
                <?php elseif (!empty($creator->picture)) : ?>
                    <a href="<?php echo url('node/' . $nid); ?>"><img src="<?php echo imagecache_create_url('events_overview_thumbnail', $creator->picture); ?>" alt="" /></a>                
                <?php endif; ?>
			</td>
			<td class="col-2">
				<?php
                    if (events_event_is_available_to_add($node)) { 
                        echo l(($sender->first_name ? $sender->first_name : $sender->name), 'user/' . $sender->uid, array('attributes' => array('class' => 'location-name'))) ?> invites you to <?php echo l($node->title, 'node/' . $node->nid, array('attributes' => array('class' => 'event-title')));
                    } else {
                        $place = user_load($node->uid);
                        profile_load_profile($place);
                        echo l($node->title, 'node/' . $node->nid, array('attributes' => array('class' => 'event-title'))) . ' at ' . l(($place->first_name ? $place->first_name : $place->name), 'user/' . $place->uid, array('attributes' => array('class' => 'location-name')));
                    }
                ?> 
                <div class="event-date"><?php echo strip_tags($node->field_date[0]['view']); ?></div>
				<div class="event-gratuity"><?php echo $node->field_event_gratuity[0]['safe']; ?></div>
				<div class="going-friends"><a href="javascript: void(0);" id="event_<?php echo $node->nid; ?>" class="going-users-link"> <?php echo $node->friends_going; ?> friends are going</a></div>
			</td>
			<td class="col-3">
                <?php if (events_event_is_available_to_add($node)) { ?>
    				<div class="add-to-calendar"><a href="javascript: void(0);" id="event_<?php echo $node->nid; ?>" class="add-event-link" onclick="acceptEvent(<?php echo $node->nid; ?>)">Add to my calendar</a></div>
    				<div class="clear-fix"></div>
    				<div class="decline"><a href="javascript: void(0);" id="event_<?php echo $node->nid; ?>" onclick="declineEvent(<?php echo $node->nid; ?>)">Decline</a></div>
                <?php } else { ?>
                    <?php if ($node->field_event_type[0]['value'] == 'public' || $node->uid == $user->uid) : ?>
                        <div id="invite-friend-link" class="invite-friend"><a href="javascript: void(0);" id="event_<?php echo $node->nid; ?>" class="current-event" onclick="setActiveEvent(<?php echo $node->nid; ?>);">Invite friends</a></div>
                    <?php endif; ?>      
                <?php } ?>
			</td>
		</tr>
<?php  
    } else {
        global $user;
        $location_info = user_load($node->uid);   
        $advanced_info = advanced_profile_load($location_info->uid);         
        ?>
        <?php if(!empty($node->field_content_images) && !empty($node->field_content_images[0]['filepath'])):?>
            <div class="public-event-top-banner">
              <?php echo theme_imagecache('event_image', $node->field_content_images[0]['filepath']);?>
            </div>
        <?php elseif(!empty($advanced_info[0]['photo']) || !empty($advanced_info['photo'])):?>
        <div class="public-event-top-banner">
          <?php echo theme_imagecache('event_image',(!empty($advanced_info['photo']) ? $advanced_info['photo'] : $advanced_info[0]['photo']));?>
        </div>
        <?php endif;?>
        <?php if( $node->uid == $user->uid):
          
        ?>
          <div class="public-event-modify-link">
            <a id="modify-event-link" href="/get_event_form_data/<?php echo $node->nid?>">Modify this event</a>
          </div>
        <?php endif;?>
        <?php if ($node->field_event_type[0]['value'] == 'public') : ?>
            <div class="public-event-coupon">
              <div class="event-coupon">
              <div class="first-column public-event-col">
                <div class="profile-info">
                  <div class="profile-thumbnail"><a href="/user/<?php echo $node->uid; ?>"><?php echo theme_imagecache('user_picture_meta', $location_info->picture);?></a></div>
                  <div class="profile-name"><?php echo $location_info->first_name;?></div>
                  <div class="profile-city"><?php echo $location_info->profile_location;?></div>
                </div>
                <div class="powered-by"><img src="/profiles/drupal_commons/themes/commons_origins/images/powered-by.png" alt="" /></div>
              </div>
              <div class="second-column public-event-col">
                <div class="public-event-date-time">
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
                      $output_date = '<div>'.date('l, F j', $start_date).'</div>';  
                      $output_date .= '<div>'.date('H:i', $start_date).'</div>';  
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
                <?php if(!empty($node->field_location) && !empty($node->field_location[0]['value'])): ?>
                  <div class="public-event-address"><?php echo $node->field_location[0]['safe']?><br/></div>
                <?php endif;?>
                <div class="public-event-contacts">
                  <?php if(!empty($node->field_event_contact_phone) && !empty($node->field_event_contact_phone[0]['value'])): ?>
                    <?php echo t('tel:').' '.$node->field_event_contact_phone[0]['safe']?>
                  <?php endif;?>
                  <br>
                  <?php if(!empty($node->field_event_email) && !empty($node->field_event_email[0]['value'])): ?>
                    <?php echo t('email:').' <a href="mailto:'.$node->field_event_email[0]['safe'].'">'.$node->field_event_email[0]['safe'].'</a>'?>
                  <?php endif;?>
                  
                </div>
              </div>
              <div class="third-column public-event-col">
                <div class="public-event-title"><?php echo $title?></div>
                <div class="public-event-description"><?php echo nl2br($node->field_event_details[0]['safe'])?></div>
                <div class="public-event-gratuity"><?php echo $node->field_event_gratuity[0]['safe']?></div>
              </div>
              </div>
            </div>
            
            <?php if(events_event_is_available_to_add($node)):?>
              <div class="going-status-button" id="event-action-button"><a class="add-event-link" <?php echo ( ($node->uid != $user->uid) ? 'href="/event_action?event_id='.$node->nid.'"' :'');?>><?php echo t('Add to my calendar')?></a></div>
            
            <?php elseif(events_get_event_status_for_user($node->nid, $user->uid) == EVENT_STATUS_ACCEPTED):?>
              <div class="going-status-button" id="event-action-button">
                <a class="remove-event-link" <?php echo ( ($node->uid != $user->uid) ? 'href="/event_action?event_id='.$node->nid.'"' :'');?>><?php echo t("I'm going")?></a>
              </div>
            <?php endif;?>
        <?php else : ?>
            <div id="private-event-description">
        		<div id="private-event-profile-info">
        			<div class="account-info-thumb"><a href="/user/<?php echo $node->uid; ?>"><?php echo theme_imagecache('user_picture_meta', $location_info->picture);?></a></div>
        			<div class="account-info-name"><?php echo $location_info->first_name;?> <?php echo $location_info->surname;?></div>
        			<div class="account-info-city"><?php echo $location_info->city;?></div>
                    
                    <?php
                    $output_date = $start_date = $end_date = ''; 
                    if(!empty($node->field_date)){
                      $start_date = strtotime($node->field_date[0]['value']);
                      $end_date = strtotime($node->field_date[0]['value2']);  
                    }
                    if(!empty($start_date) && !empty($end_date) && date('m/d/Y', $start_date) != date('m/d/Y', $end_date)){
                      $output_date = '<div class="event-date">'.date('l, F j H:i', $start_date).' - </div>';
                      $output_date .= '<div class="event-time">'.date('l, F j H:i', $end_date).'</div>';
                    }
                    elseif(!empty($start_date) && !empty($end_date) && $start_date == $end_date){
                      $output_date = '<div class="event-date">'.date('l, F j', $start_date).'</div>';  
                      $output_date .= '<div class="event-time">'.date('H:i', $start_date).'</div>';  
                    }
                    elseif(!empty($start_date) && !empty($end_date) && date('m/d/Y', $start_date) == date('m/d/Y', $end_date)){
                      $output_date = '<div class="event-date">'.date('l, F j', $start_date).'</div>';
                      $output_date .= '<div class="event-time">'.date('H:i', $start_date).' - '.date('H:i', $end_date).'</div>';  
                    }
                    elseif(!empty($start_date) && !empty($end_date) && $start_date == $end_date){
                      $output_date = '<div class="event-date">'.date('l, F j H:i', $start_date).'</div>';
                    }
                    elseif(!empty($start_date) && empty($end_date)){
                      $output_date = '<div class="event-date">'.date('l, F j H:i', $start_date).'</div>';
                    }
                    echo $output_date;  
                  ?>
        			<?php if(!empty($node->field_location) && !empty($node->field_location[0]['value'])): ?>
                      <div class="event-address"><?php echo $node->field_location[0]['safe']?><br/></div>
                    <?php endif;?>
        			<div class="event-contacts">
                      <?php if(!empty($node->field_event_contact_phone) && !empty($node->field_event_contact_phone[0]['value'])): ?>
                        <?php echo t('tel:').' '.$node->field_event_contact_phone[0]['safe']?>
                      <?php endif;?>
                      <br>
                      <?php if(!empty($node->field_event_email) && !empty($node->field_event_email[0]['value'])): ?>
                        <?php echo t('email:').' <a href="mailto:'.$node->field_event_email[0]['safe'].'">'.$node->field_event_email[0]['safe'].'</a>'?>
                      <?php endif;?>
                      
                    </div>
        		</div>
        		<div id="private-event-info-block">
        			<div class="event-title"><a href="javascript: void(0);" style="cursor: default;"><?php echo $title?></a></div>
        			<div class="event-description"><?php echo nl2br($node->field_event_details[0]['safe'])?></div>
        			<?php if(events_event_is_available_to_add($node)):?>
                      <div class="going-status-button" id="event-action-button">
                        <a class="add-event-link" <?php echo ( ($node->uid != $user->uid) ? 'href="/event_action?event_id='.$node->nid.'"' :'');?>><?php echo t('Add to my calendar')?></a>
                      </div>
                    
                    <?php elseif(events_get_event_status_for_user($node->nid, $user->uid) == EVENT_STATUS_ACCEPTED):?>
                      <div class="going-status-button" id="event-action-button">
                        <a class="remove-event-link" <?php echo ( ($node->uid != $user->uid) ? 'href="/event_action?event_id='.$node->nid.'"' :'');?>><?php echo t("I'm going")?></a>
                      </div>
                    <?php endif;?>
        		</div>
        	</div>
            <div class="clear-fix"></div>
        <?php endif; ?>
        
        <div class="event-people-block">
        <?php if(!empty($people_going)):
          $person_to_show = 4;
        ?>
          <?php if(!empty($people_going['going'])):?>
            <div class="going-block">
              <a href="javascript: void(0);" class="going-users-link" id="event_<?php echo $node->nid; ?>"><?php echo t('Going')?> (<?php echo count($people_going['going'])?>)</a>
              <?php 
                if(count($people_going['going']) > $person_to_show)
                  $people_going['going'] = array_slice($people_going['going'],0,$person_to_show);  
              ?>
              <?php foreach($people_going['going'] as $_person):?>
                <div class="person-row">
                  <div class="person-thumbnail">
                  <?php if(!empty($_person['user_id'])):?>
                    <a href="<?php echo url('user/'.$_person['id'])?>"><?php echo $_person['photo']?></a>
                  <?php else:?>
                    <a title="<?php echo t('Facebook user')?>"><?php echo $_person['photo']?></a>  
                  <?php endif;?>  
                  </div>
                  <div class="person-name">
                  <?php if(!empty($_person['user_id'])):?>
                    <a href="<?php echo url('user/'.$_person['id'])?>"><?php echo $_person['full_name']?></a>
                  <?php else:?> 
                    <a title="<?php echo t('Facebook user')?>"><?php echo $_person['full_name']?></a>  
                  <?php endif;?> 
                  </div>  
                </div>
              <?php endforeach;?>  
            </div>
          <?php endif;?>
          <?php if(!empty($people_going['invited'])):?>
            <div class="invited-block">
              <a href="javascript: void(0);" class="invited-users-link" id="event_<?php echo $node->nid; ?>"><?php echo t('Invited')?> (<?php echo count($people_going['invited'])?>)</a>
              <?php 
                if(count($people_going['invited']) > $person_to_show)
                  $people_going['invited'] = array_slice($people_going['invited'],0,$person_to_show);  
              ?>
              <?php foreach($people_going['invited'] as $_person):?>
                <div class="person-row">
                  <div class="person-thumbnail">
                  <?php if(!empty($_person['user_id'])):?>
                    <a href="<?php echo url('user/'.$_person['user_id'])?>"><?php echo $_person['photo']?></a>
                  <?php else:?>
                    <a title="<?php echo t('Facebook user')?>"><?php echo $_person['photo']?></a>  
                  <?php endif;?>  
                  </div>
                  <div class="person-name">
                  <?php if(!empty($_person['user_id'])):?>
                    <a href="<?php echo url('user/'.$_person['user_id'])?>"><?php echo $_person['full_name']?></a>
                  <?php else:?> 
                    <a title="<?php echo t('Facebook user')?>"><?php echo $_person['full_name']?></a>  
                  <?php endif;?>  
                  </div> 
                </div>
              <?php endforeach;?>  
            </div>
          <?php endif;?>
        
        <?php endif;?>
        <?php if ($node->field_event_type[0]['value'] == 'public' || $node->uid == $user->uid) :?>
            <div class="invite-friend" id="invite-friend-link"><a href="javascript: void(0);"><?php echo t('Invite Friends')?></a></div>
          <?php endif; ?>
        </div>
        <div class="event-comment-box">
          <?php if(user_is_logged_in()):?>
            <div class="post-box">
              <?php echo $comments_form?>
            </div>
          <?php endif;?>
          <div class="activity-stream-list">
            <?php echo $comments_view?>
          </div>
        </div>
        
        <?php 
        echo $invite_friends_form; 
    }
?>