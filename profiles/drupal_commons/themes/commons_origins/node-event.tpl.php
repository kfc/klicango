<?php 
global $user;
$location_info = user_load($node->uid);   
$advanced_info = advanced_profile_load($location_info->uid);         
?>
<?php if(!empty($advanced_info[0]['photo']) || !empty($advanced_info['photo'])):?>
<div class="public-event-top-banner">
  <?php echo theme_imagecache('event_image',(!empty($advanced_info['photo']) ? $advanced_info['photo'] : $advanced_info[0]['photo']));?>
</div>
<?php endif;?>
<?php if( false && $node->uid == $user->uid):?>
  <div class="public-event-modify-link">
    <a id="modify-event-link" href="">Modify this event</a>
  </div>
<?php endif;?>

<div class="public-event-coupon">
  <div class="event-coupon">
  <div class="first-column public-event-col">
    <div class="profile-info">
      <div class="profile-thumbnail"><?php echo theme_imagecache('user_picture_meta', $location_info->picture);?></div>
      <div class="profile-name"><?php echo $location_info->name;?></div>
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
    <?php if(!empty($node->field_location)): ?>
      <div class="public-event-address"><?php echo $node->field_location[0]['safe']?><br/></div>
    <?php endif;?>
    <div class="public-event-contacts">
      <?php if(!empty($node->field_event_contact_phone)): ?>
        <?php echo t('tel:').' '.$node->field_event_contact_phone[0]['safe']?>
      <?php endif;?>
      <br>
      <?php if(!empty($node->field_event_email)): ?>
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
  <div class="going-status-button" id="event-action-button"><a class="add-event-link" href="/event_action?event_id=<?php echo $node->nid;?>"><?php echo t('Add to my calendar')?></a></div>

<?php elseif(events_get_event_status_for_user($node->nid, $user->uid) == EVENT_STATUS_ACCEPTED):?>
  <div class="going-status-button" id="event-action-button"><a class="remove-event-link" href="/event_action?event_id=<?php echo $node->nid;?>"><?php echo t("I'm going")?></a></div>
<?php endif;?>


<div class="event-people-block">
  <div class="going-block">
    <a href="">Going (8)</a>
    <div class="person-row">
      <div class="person-thumbnail"><img src="/profiles/drupal_commons/themes/commons_origins/images/thumb1.jpg" alt="" /></div>
      <div class="person-name">Meaghan Perkins</div>
    </div>
    <div class="person-row">
      <div class="person-thumbnail"><img src="/profiles/drupal_commons/themes/commons_origins/images/thumb2.jpg" alt="" /></div>
      <div class="person-name">Max Lamenace</div>
    </div>
  </div>
  <div class="invited-block">
    <a href="">Invited (18)</a>
    <div class="person-row">
      <div class="person-thumbnail"><img src="/profiles/drupal_commons/themes/commons_origins/images/thumb3.jpg" alt="" /></div>
      <div class="person-name">Karl Kreutzweld</div>
    </div>
  </div>
  <div class="invite-friend"><a href="">Invite friends</a></div>
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

