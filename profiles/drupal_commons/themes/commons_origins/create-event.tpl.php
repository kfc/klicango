<?php 
global $user;

$values = array();
$nid = arg(1);
$node = node_load($nid);
if($node->type == 'event' && $node->uid == $user->uid){
  $values = (array)$node;
}
?>
<div id="create-event-form" title="Create Event">
  <form action="/create_event_if_valid" method="post" id="form_create_event" enctype="multipart/form-data">
  <div id="create_event_form_errors"></div>
  <div class="form-item">
    <label><?php echo t('Title')?></label>
    <input type="text" name="title" value="<?php echo (isset($values['title']) ? $values['title'] : '');?>" style="width: 294px;" placeholder="<?php echo t('such as birtday party')?>" />
  </div>
  <div class="form-item">
    <label><?php echo t('Details')?></label>
    <textarea name="details" style="width: 294px; height: 50px;" placeholder="<?php echo t('write a description')?>"></textarea>
  </div>
  <div class="form-item">
    <label><?php echo t('Where')?></label>
    <input type="text" name="location" style="width: 294px;" placeholder="<?php echo t('such as 11, rue Bellevue, 83270 Saint-Cyr-sur-Mer')?>" />
  </div>
  <div class="form-item">
    <label><?php echo t('When')?></label>
    <input type="text" name="date" placeholder="<?php echo ('format: d/m/Y');?>" />
    <input type="text" name="time" placeholder="<?php echo ('ex: 20:30');?>" />
  </div>
  <?php if(in_array('professional', $user->roles)):?>
    <div class="form-item">
      <label><?php echo t('Gratuity')?></label>
      <input type="text" name="gratuity" style="width: 294px;" placeholder="<?php echo t('')?>" />
    </div>  
  
  <?php endif;?>
  
  <div class="form-item">
    <label><?php echo t('Contact')?></label>
    <input type="text" name="email" placeholder="<?php echo ('email');?>" />
    <input type="text" name="phone" placeholder="<?php echo ('phone');?>" />
  </div>
  
 
  <div class="form-item profile-links">
    <input type="file" id="field-image-upload" name="files[photo]" class="form-file profile-upload" />
  </div>
  
  <div class="form-submit">   
    <input type="submit" value="<?php echo t('Create')?>"/>
  </div>
  </form>
</div>