<?php
   
  global $user;
  $author = user_load($uid);
  $photos_num = 0;
  $photos_html = '';
  
  $preset = 'comment_image';
  //Check the view for comment
  if(isset($node->view) && $node->view->name == 'nodecomments' && $node->view->current_display == 'block_1'){
    $preset = 'activity_stream_photo'; 
    $max_photos_num = 3; 
  }
  else{
    $max_photos_num = 100;
  }
   $i = 0;
  if(!empty($field_comment_photo)){
    foreach($field_comment_photo as $_photo){  
      if(!empty($_photo['filepath']) && $i++ < $max_photos_num){
        $photos_html .= '<a class="klicango-popup" href="/comment_photo/'.$_photo['uid'].'/'.$_photo['fid'].'" rel="lightbox">'.theme_imagecache($preset,$_photo['filepath']).'</a>';
        //$photos_num++;
      }
    }
  }
  $photos_num = count($field_comment_photo);
  $options = array();
  $comment_status = (events_get_event_status_for_user($node->comment_target_nid, $node->uid) == EVENT_STATUS_ACCEPTED ? t('is going') : t('posted a new comment'));
  if($photos_num > 0){
    $comment_status = t('added').' '.$photos_num.' '.($photos_num > 1 ? t('photos') : t('photo'));
  }
  if(!(arg(1) == 'node' && arg(2) == $node->comment_target_nid)){
    $target_node = node_load($node->comment_target_nid);
    $options = array();
    if(isset($target_node->field_event_type) && !empty($target_node->field_event_type[0]['value']) && $target_node->field_event_type[0]['value'] == 'private'){
      $options['attributes'] = array('class'=> 'private-event-link');
    }
    $comment_status .= ' '.t('in').' '.l($target_node->title,'node/'.$node->comment_target_nid,$options);
  }
  if(!empty($author->first_name) && !empty($author->first_name))
    $name = l($author->first_name.' '.$author->surname,'user/'.$author->uid);  
  if($node->title == '<EventCreated>'){
    $comment_status = 'created new event '.l($target_node->title,'node/'.$node->comment_target_nid,$options);  
  }
?>
   
<div class="stream-item">
  <div class="person-thumbnail"><?php echo theme_imagecache('user_picture_40x40',$author->picture);?></div>
  <div class="stream-item-content">
    <div class="person-name"><?php echo $name;?> <span class="activity_status"><?php echo $comment_status?></span> 
    <?php if( check_comment_delete($node->nid, $node)) : ?>
      <span class="comment-delete-button"><?php echo l('&nbsp;&nbsp;','comment_delete/'.$node->nid,array('html'=>true, 'query'=>drupal_get_destination(), 'attributes'=>array('class'=>'comment-delete-link','onclick'=>'javascript:return confirm("'.t('Delete this comment?\nThis action cannot be undone.').'");')));?></span>
    <?php endif;?>
    </div>
    <div class="person-comment"><?php echo $body?></div>
    <?php if(!empty($photos_num)):?>
      <div class="added-new-photos">
        <?php echo $photos_html?>
      </div>
    <?php endif;?>
    <div class="person-activity-time"><?php echo format_interval(time()-$created,1).' '.t('ago');?></div>
    
  </div>
</div>