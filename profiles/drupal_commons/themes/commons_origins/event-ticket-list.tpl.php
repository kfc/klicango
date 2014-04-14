<?php $owner = unserialize($event->data);?>
<div class="content-no-sb">
   <div class="tickets-list-top">
      <div class="col">
         <div class="col-content">
            <div class="image-section">
               <span class="image"><?php if(!empty($event->picture)) :?><img src="<?php echo imagecache_create_url('profile_picture_big', $event->picture); ?>" width="58" height="58"><?php endif; ?></span>
               <span class="text"><?php echo(!empty($owner['first_name']) ? $owner['first_name'] : '');?> <br /><strong><?php echo(!empty($owner['city']) ? $owner['city'] : '');?></strong></span>
            </div>
            <div class="tickets-logo"><img src="<?php echo base_path() . path_to_theme(); ?>/images/tickets_logo.gif" width="155" height="27"></div>
         </div>
      </div>
      <div class="col">
         <div class="col-content">
            <div class="tickets-top-time">
                <?php
                   $output_date = $start_date = $end_date = ''; 
                    if(!empty($event->field_date)){
                      $start_date = strtotime($event->field_date[0]['value']);
                      $end_date = strtotime($event->field_date[0]['value2']);  
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
            <div class="tickets-top-address">
               <span><?php echo(!empty($event->field_location) ? $event->field_location[0]['value'] : '');?><span><br />
               <span class="contact-info">
               <?php if(!empty($event->field_event_contact_phone[0]['value'])) :?>tel: <?php echo $event->field_event_contact_phone[0]['value'];?><br /><?php endif; ?>
               <?php if(!empty($event->field_event_email[0]['value'])) :?>email: <?php echo $event->field_event_email[0]['value'];?><?php endif; ?>
               </span>
            </div>
         </div>
      </div>
      <div class="col col-double">
         <h2><?php echo l($event->title , 'node/' . $event->nid); ?></h2>
         <div class="price-block t-price">
            <div class="col">
               <div class="col-content">
                  <?php echo t('Total:');?>
               </div>
            </div>
            <div class="col">
               <div class="col-content">
                  <?php echo $total['total'];?> &euro;
               </div>
            </div>
         </div>
         <div class="price-block t-price">
            <div class="col">
               <div class="col-content">
                  <?php echo t('Total collected:');?>
               </div>
            </div>
            <div class="col">
               <div class="col-content">
                  <?php echo $total['collected'];?> &euro;
               </div>
            </div>
         </div>         
         <div class="price-block t-people">
            <div class="col">
               <div class="col-content">
                    <a class="going-users-link" id="event_<?php echo $event->nid;?>" href="javascript: void(0);"><?php echo t('People going:');?></a> 
               </div>
            </div>
            <div class="col">
               <div class="col-content">
                  <?php echo count($people_going['going']); ?>
               </div>
            </div>
         </div>
         <?php foreach($tickets_sold as $ticket_sold):?>
         <div class="price-block t-tickets-sold">
            <div class="col">
               <div class="col-content">
                  <?php echo $ticket_sold['title']; ?> (<?php echo $ticket_sold['price']; ?>&euro;)
               </div>
            </div>
            <div class="col">
               <div class="col-content">
                  <?php echo $ticket_sold['qty_total']; ?>
               </div>
            </div>
         </div>
         <?php endforeach; ?>
         <?php if(($total['total'] - $total['collected']) > 0):?>
         <div class="result-link"><a href="#" class="red-button" id="collect-money"><?php echo ('collect money'); ?></a></div>
         <?php endif;?>
      </div>
   </div>
   <?php if($tickets):?>
   <div class="tickets-table-wrapper">
      <div class="tickets-table-head">
         <span class="table-column last-name"><?php echo t('Last name'); ?></span>
         <span class="table-column first-name"><?php echo t('First name'); ?></span>
         <span class="table-column email"><?php echo t('Email'); ?></span>
         <span class="table-column ticket"><?php echo t('Ticket'); ?></span>
         <span class="table-column anchor"><?php echo '#'; ?></span>
         <span class="table-column sale-date"><?php echo t('Sale date'); ?></span>
         <span class="borders"></span>
      </div>
      <ul class="tickets-table">
      <?php foreach($tickets as $ticket): ?>
         <li id="payment-id-<?php echo $ticket['payment_id']; ?>">
            <span class="table-column last-name"><?php echo (!empty($ticket['customer']->surname)) ? $ticket['customer']->surname : '-'; ?></span>
            <span class="table-column first-name"><?php echo (!empty($ticket['customer']->first_name)) ? $ticket['customer']->first_name : '-'; ?></span>
            <span class="table-column email"><?php echo (!empty($ticket['customer']->mail)) ? $ticket['customer']->mail : '-'; ?></span>   
            <span class="table-column ticket"><?php echo $ticket['title']; ?> (<?php echo $ticket['price']; ?>&euro;)</span>
            <span class="table-column anchor"><?php echo $ticket['quantity']; ?></span> 
            <span class="table-column sale-date"><?php echo date('d/m/Y', $ticket['response_time']); ?></span>
         </li>   
      <?php endforeach;?>
      </ul>
   </div>
       <?php if (!empty($pager)) : ?>
       <div class="tickets-pager-wrapper">
        <?php echo $pager; ?>
       </div>
       <?php endif;?>
   <?php endif;?>
</div>

<div id="collect-money-message" title="<?php echo t('Collect money confirmation'); ?>">
    <div class="form-text" style="margin-bottom: 0px;"><?php echo t(variable_get('collect_money_confirmation')); ?></div>
    <a href="javascript: void(0);" class="collect-money-proceed black-button" onclick="proceedCollectMoneySubmit(this, <?php echo $event->nid; ?>)"><?php echo t('Proceed'); ?></a>
</div>