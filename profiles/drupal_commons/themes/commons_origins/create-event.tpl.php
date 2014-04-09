<?php 
global $user;

$values = array();
$is_owner = false;
if(arg(0) == 'node'){
  $nid = arg(1);
  $node = node_load($nid);
  events_tickets_load($node);
  if($node->type == 'event' && $node->uid == $user->uid){
    $is_owner = true;
    $values = (array)$node;
    $date = strtotime($node->field_date);
    drupal_add_js("var form_data = ".events_get_event_form_data($node).";",'inline');
  }
}                         
$address = $phone = $class = '';
if(in_array('individual' ,$user->roles)){
  $address = '';//$user->city.', '.$user->country; 
  $class="private-event";
}
else{
  if(!isset($user->address))
    profile_load_profile($user);
  $address = $user->address.', '.$user->city.', '.$user->country;
  $phone = $user->phone;
  $class="public-event";
}
drupal_add_js("var user_data = ".json_encode(array('location'=>$address, 'email'=>$user->mail, 'phone'=> $phone)).";",'inline');

?>
<div id="create-event-form" class="<?php echo $class;?>" title="Create Event">
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
    <input type="text" name="location" style="width: 294px;" value="<?php echo $address;?>"  placeholder="<?php echo t('such as 11, rue Bellevue, 83270 Saint-Cyr-sur-Mer')?>" />
  </div>
  <div class="form-item">
    <label><?php echo t('When')?></label>
    <input type="text" name="date" id="datepicker" placeholder="<?php echo ('format: d/m/Y');?>" />
    <input type="text" name="time"  placeholder="<?php echo ('ex: 20:30');?>" />
  </div>
  <?php if(in_array('professional', $user->roles)):?>
    <div class="form-item">
      <label><?php echo t('Ticket')?></label>
      <input type="checkbox" id="event-sell-tickets" name="tickets" value="1" class="form-checkbox" />
      <label class="checkbox-label"><?php echo t('I want to sell tickets online '); ?><!--<a href="javascript: void(0);" id="edit-tickets-link" onclick="$( '#event-tickets-form' ).dialog( 'open' );" style="color: green;">edit</a>--></label>
    </div>
    
    <div class="form-item">
      <label><?php echo t('Gratuity')?></label>
      <input type="text" name="gratuity" style="width: 294px;" placeholder="<?php echo t('')?>" />
    </div>  
  
  <?php endif;?>
  
  <div class="form-item">
    <label><?php echo t('Contact')?></label>
    <input type="text" name="email" value="<?php echo $user->mail?>" placeholder="<?php echo t('email');?>" />
    <input type="text" name="phone" value="<?php echo $user->phone?>" placeholder="<?php echo t('phone');?>" />
  </div>
  
  <div class="form-item profile-links">
    <input type="file" id="field-image-upload" name="files[photo]" class="form-file profile-upload" />
    <?php if(in_array('individual', $user->roles, 'true')) { ?>
      <a href="" id="add-friends">Invite friends</a>
    <?php }?>
  </div>
    <?php
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
  
  <div class="form-submit" id="create-event-submit-wrapper"> 
    <input type="submit" id="create-event-submit" value="<?php echo t('Create')?>"/>
    <?php if($is_owner):?>
      <a href="/delete_event/<?php echo $nid;?>" onclick="return confirm(Drupal.t('Are you sure you want to delete this event?'));" class="event-delete-link"><?php echo t('Delete event');?></a>
    <?php endif;?>
    
  </div>
  <?php if(in_array('professional', $user->roles, 'true')) : ?>
    <div id="create-event-tickets-wrapper" class="form-submit" style="display: none;"> 
      <input type="button" id="create-event-tickets" value="<?php echo t('Next')?>"/>   
    </div>
  <?php endif; ?>
  
  <input type="hidden" id="tickets_date_check" name="tickets_date_check"/>
  
  </form>
</div>

<?php if(in_array('professional', $user->roles)):?>
  <div id="event-tickets-form" title="EVENT TICKETS">
    <div class="form-text">You can propose up to 3 different tickets. For each type of ticket, please provide a title, a price and a maximum number of tickets available (optional).</div>
    <div class="form-item-headers">
     <div class="form-item-headers-title">Ticket title*</div>
     <div class="form-item-headers-title">Price*</div>
     <div class="form-item-headers-title">Ticket available</div>
    </div>
    <div class="form-item">
     <label>Ticket 1</label>
     <input type="hidden" name="ticket_id_1" />
     <input type="text" name="ticket_title_1" class="static" placeholder="ex: entrée simple">
     <input type="text" class="price-input static" name="ticket_price_1" placeholder="ex: 15">
     <label class="afterprice-label">€**</label>
     <input type="text" class="price-input" name="ticket_quantity_1" placeholder="ex: 45">
     <label class="afterprice-label">max</label>
    </div>
    <div class="form-item">
     <label>Ticket 2</label>
     <input type="hidden" name="ticket_id_2" />
     <input type="text" name="ticket_title_2" class="static" placeholder="ex: entrée avec boisson">
     <input type="text" class="price-input static" name="ticket_price_2" placeholder="ex: 20">
     <label class="afterprice-label">€**</label>
     <input type="text" class="price-input" name="ticket_quantity_2" placeholder="ex: 60">
     <label class="afterprice-label">max</label>
    </div>
    <div class="form-item">
     <label>Ticket 3</label>
     <input type="hidden" name="ticket_id_3" />
     <input type="text" name="ticket_title_3" class="static">
     <input type="text" class="price-input static" name="ticket_price_3">
     <label class="afterprice-label">€**</label>
     <input type="text" class="price-input" name="ticket_quantity_3">
     <label class="afterprice-label">max</label>
    </div>
    <div class="form-text">** A sale commission of 3% (min. 0,5 €) is applied by Klicango. Ex: for a ticket sold 5 €, you will earn 4,50 €; for a ticket sold 30 € you will earn 29,10 €.</div>
    <div class="form-item">
     <label class="long-label">Tickets on sale until</label>
     
     <input type="text" name="tickets_date" id="datepicker-tickets" value="<?php echo ((!empty($node) && !empty($node->field_tickets_date)) ? date('d/m/Y', strtotime($node->field_tickets_date[0]['value'])) : ''); ?>">
    </div>
    <div class="form-item">
     <label class="long-label">Max number of tickets / user</label>
     <select name="tickets_per_user">
      <option value="1" <?php echo ((!empty($node) && !empty($node->field_tickets_per_user) && $node->field_tickets_per_user[0]['value'] == 1) ? 'selected="selected"' : ''); ?>>1</option>
      <option value="2" <?php echo ((!empty($node) && !empty($node->field_tickets_per_user) && $node->field_tickets_per_user[0]['value'] == 2) ? 'selected="selected"' : ''); ?>>2</option>
      <option value="3" <?php echo ((!empty($node) && !empty($node->field_tickets_per_user) && $node->field_tickets_per_user[0]['value'] == 3) ? 'selected="selected"' : ''); ?>>3</option>
      <option value="4" <?php echo ((!empty($node) && !empty($node->field_tickets_per_user) && $node->field_tickets_per_user[0]['value'] == 4) ? 'selected="selected"' : ''); ?>>4</option>
      <option value="5" <?php echo (((!empty($node) && !empty($node->field_tickets_per_user) && $node->field_tickets_per_user[0]['value'] == 5) || empty($node)) ? 'selected="selected"' : ''); ?>>5</option>
      <option value="6" <?php echo ((!empty($node) && !empty($node->field_tickets_per_user) && $node->field_tickets_per_user[0]['value'] == 6) ? 'selected="selected"' : ''); ?>>6</option>
      <option value="7" <?php echo ((!empty($node) && !empty($node->field_tickets_per_user) && $node->field_tickets_per_user[0]['value'] == 7) ? 'selected="selected"' : ''); ?>>7</option>
      <option value="8" <?php echo ((!empty($node) && !empty($node->field_tickets_per_user) && $node->field_tickets_per_user[0]['value'] == 8) ? 'selected="selected"' : ''); ?>>8</option>
      <option value="9" <?php echo ((!empty($node) && !empty($node->field_tickets_per_user) && $node->field_tickets_per_user[0]['value'] == 9) ? 'selected="selected"' : ''); ?>>9</option>
     </select>
    </div>
    <div class="form-submit italic-disclamer-spaced-button">
     <input type="submit" value="Create" id="event-tickets-close">
     <label>By clicking on "Create", I agree to the <a href="/page/conditions-ventes" target="_blank">conditions de ventes</a> for online sales within Klicango</label>
    </div>
  </div>
<?php endif;?>