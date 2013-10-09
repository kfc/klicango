<?php 
global $user;

$values = array();
$nid = arg(1);
$node = node_load($nid);
if($node->type == 'event' && $node->uid == $user->uid){
  $values = (array)$node;
  $date = strtotime($node->field_date);
  drupal_add_js("var form_data = ".events_get_event_form_data($node).";",'inline');
  
}
?>
<div id="create-event-form" title="Create Event">
  <form action="/create_event_if_valid" method="post" id="form_create_event" enctype="multipart/form-data">
  <input type="hidden" name="nid">
  <div id="create_event_form_errors"></div>
  <div class="form-item">
    <label><?php echo t('Title')?></label>
    <input type="text" name="title" style="width: 294px;" placeholder="<?php echo t('such as birtday party')?>" />
  </div>
  <div class="form-item">
    <label><?php echo t('Details')?></label>
    <textarea name="details" style="width: 294px; height: 50px;" placeholder="<?php echo t('write a description')?>"></textarea>
  </div>
  <div class="form-item">
    <label><?php echo t('Where')?></label>
    <input type="text" name="location" style="width: 294px;"  placeholder="<?php echo t('such as 11, rue Bellevue, 83270 Saint-Cyr-sur-Mer')?>" />
  </div>
  <div class="form-item">
    <label><?php echo t('When')?></label>
    <input type="text" name="date" placeholder="<?php echo ('format: d/m/Y');?>" />
    <input type="text" name="time"  placeholder="<?php echo ('ex: 20:30');?>" />
  </div>
  <?php if(in_array('professional', $user->roles)):?>
    <div class="form-item">
      <label><?php echo t('Gratuity')?></label>
      <input type="text" name="gratuity" style="width: 294px;" placeholder="<?php echo t('')?>" />
    </div>  
  
  <?php endif;?>
  
  <div class="form-item">
    <label><?php echo t('Contact')?></label>
    <input type="text" name="email" placeholder="<?php echo t('email');?>" />
    <input type="text" name="phone" placeholder="<?php echo t('phone');?>" />
  </div>
  
  <div class="form-item profile-links">
    <input type="file" id="field-image-upload" name="files[photo]" class="form-file profile-upload" />
    <a href="" id="add-friends">Invite friends</a>
  </div>
    <?php
        global $user; 
        if(in_array('individual', $user->roles, 'true')) {
    ?>
    <div class="form-item search-for-friends">
    	<input type="text" name="field-search-for-friends" id="search-friends" placeholder="<?php echo t('Type at least 2 symbols to start search');?>"/>
    </div>
    <div class="scroll-pane">
    </div>
    <?php
        }
    ?>
  
  <div class="form-submit">   
    <input type="submit" value="<?php echo t('Create')?>"/>
  </div>
  </form>
</div>