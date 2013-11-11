<div class="item">
  <a href="<?php echo $fields['path']->content?>">
    <?php echo $fields['field_content_images_fid']->content?>
  </a>
  <?php $date = date('M d', strtotime($fields['field_date_value']->raw));?>
  <div class="party-title"><a href="<?php echo $fields['path']->content?>"><?php echo $fields['field_event_gratuity_value']->content?></a></div>
</div>