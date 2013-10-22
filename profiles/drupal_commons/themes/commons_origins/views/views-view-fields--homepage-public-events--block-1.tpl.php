<?php //print_r(array_keys($fields)); die();?>
<div class="e-inner-wrapper" style="cursor: pointer;">
  <a href="<?php echo $fields['path']->content?>"><?php echo $fields['field_content_images_fid']->content?>
    <div class="overlay-info">
      <div class="pad-layer">
      <div class="event_title"><?php echo $fields['title']->content?></div>
      <?php 
        $date = strtotime($fields['field_date_value']->raw);
        
      ?>
      <div class="event_gratuity"><?php echo date('F, j',$date).' '.t('at').' '.(!empty($fields['value']->content) ? $fields['value']->content : $fields['name']->content);?></div>
      <div class="event_gratuity"><?php  echo $fields['field_event_gratuity_value']->content?></div>
      <div class="event_address"></div>
      <div class="event_info">
      <?php echo $fields['field_location_value']->content?><br>
      <?php echo $fields['field_event_email_value']->content?>
        <?php if(!empty($fields['field_event_contact_phone_value']->content)):?> 
          <br><?php echo t('T:')?> <?php echo $fields['field_event_contact_phone_value']->content?></div>
        <?php endif;?>
      </div>
    </div>
  </a>
</div>
