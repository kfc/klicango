<div class="item">
  <a href="<?php echo $fields['path']->content?>">
    <?php echo $fields['field_content_images_fid']->content?>
    <div class="overlay-info">
    <div class="pad-layer">
      <?php $date = date('F, j', strtotime($fields['field_date_value']->raw));?>
      <div class="event_title"><?php echo $fields['title']->content?></div>
      <div class="event_gratuity"><?php echo $date.' '.t('at').' '.$fields['value']->content;?></div>
      <div class="event_address"></div>
      <div class="event_info">
        <?php echo $fields['field_location_value']->content?><br>
        <?php echo $fields['field_event_email_value']->content?>
        <?php if(!empty($fields['field_event_contact_phone_value']->content)):?> 
          <br><?php echo t('T:')?> <?php echo $fields['field_event_contact_phone_value']->content?>
        <?php endif;?>
      </div>
    </div>
  </div>
 </a> 
  <div class="party-title"><?php echo $fields['field_event_gratuity_value']->content?></div>
</div>