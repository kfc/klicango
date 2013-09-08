<?php dpm($node);?>
<div class="public-event-top-banner">
  <img src="/profiles/drupal_commons/themes/commons_origins/images/top-banner.png" alt="" />
</div>

<div class="public-event-modify-link">
  <a href="">Modify this event</a>
</div>

<div class="public-event-coupon">
  <div class="event-coupon">
  <div class="first-column public-event-col">
    <div class="profile-info">
      <div class="profile-thumbnail"><img src="/profiles/drupal_commons/themes/commons_origins/images/profile-thumbnail.jpg" alt="" /></div>
      <div class="profile-name">Lounge Bar Promenade</div>
      <div class="profile-city">Nice</div>
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
          $output_date = '<div>'.date('l, F j', $start_date).'</date>';
          $output_date .= '<div>'.date('H:i', $start_date).' - '.date('H:i', $end_date).'</div>';  
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
    <div class="public-event-description"><?php echo $node->field_event_details[0]['safe']?></div>
    <div class="public-event-gratuity"><?php echo $node->field_event_gratuity[0]['safe']?></div>
  </div>
  </div>
</div>

<div class="going-status-button"><a href="">Add to my calendar</a></div>

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
  <div class="post-box">
    <form>
      <div class="post-box-title"><label>Post comment | </label><a href="">Add photo</a></div>
      <input type="text" />
    </form>
  </div>
  
  <div class="activity-stream-list">
    <div class="stream-item">
      <div class="person-thumbnail"><img src="/profiles/drupal_commons/themes/commons_origins/images/thumb1_40x40.jpg" alt="" /></div>
      <div class="stream-item-content">
        <div class="person-name"><a href="">Meaghan Perkins</a> <span class="activity_status">is going.</span></div>
        <div class="person-comment">Cool!</div>
        <div class="person-activity-time">1 hour ago</div>
      </div>
    </div>
    
    <div class="stream-item">
      <div class="person-thumbnail"><img src="/profiles/drupal_commons/themes/commons_origins/images/thumb2_40x40.jpg" alt="" /></div>
        <div class="stream-item-content">
        <div class="person-name"><a href="">Max Lamenace</a> <span class="activity_status">is going.</span></div>
        <div class="person-comment">It’s gonna be so cool! Cheers all!</div>
        <div class="person-activity-time">yesterday</div>
      </div>
    </div>
    
    <div class="stream-item">
      <div class="person-thumbnail"><img src="/profiles/drupal_commons/themes/commons_origins/images/thumb2_40x40.jpg" alt="" /></div>
      <div class="stream-item-content">
        <div class="person-name"><a href="">Max Lamenace</a> <span class="activity_status">posted 10 new photo.</span></div>
          <div class="added-new-photos">
          <a href=""><img src="/profiles/drupal_commons/themes/commons_origins/images/last-photo-1.jpg" alt="" /></a>
          <a href=""><img src="/profiles/drupal_commons/themes/commons_origins/images/last-photo-1.jpg" alt="" /></a>
          <a href=""><img src="/profiles/drupal_commons/themes/commons_origins/images/last-photo-1.jpg" alt="" /></a>
          <a href=""><img src="/profiles/drupal_commons/themes/commons_origins/images/last-photo-1.jpg" alt="" /></a>
          <a href=""><img src="/profiles/drupal_commons/themes/commons_origins/images/last-photo-1.jpg" alt="" /></a>
          </div>
        <div class="person-activity-time">yesterday</div>
      </div>
    </div>
    
    <div class="stream-item">
      <div class="person-thumbnail"><img src="/profiles/drupal_commons/themes/commons_origins/images/thumb2_40x40.jpg" alt="" /></div>
      <div class="stream-item-content">
        <div class="person-name"><a href="">Max Lamenace</a> <span class="activity_status">commented on <a href="">Cindy Blondel’s</a> photo:</span></div>
          <div class="commented-photo">
          <a href=""><img src="/profiles/drupal_commons/themes/commons_origins/images/commented-photo.jpg" alt="" /></a>
          Hummm ... you look so good!
          </div>
        <div class="person-activity-time">yesterday</div>
      </div>
    </div>
    
  </div>
  
</div>
