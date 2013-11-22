<?php
   
  global $user;
  $author = user_load($uid);
  $photos_num = 0;
  $photos_html = '';
  
  $preset = 'comment_image';
  //Check the view for comment
  if(isset($node->view) && $node->view->name == 'nodecomments' && $node->view->current_display == 'block_1'){
    $preset = 'activity_stream_photo';  
  }
  else{
  }
  
  if(!empty($field_comment_photo)){
    foreach($field_comment_photo as $_photo){
      if(!empty($_photo['filepath'])){
        $photos_html .= '<a class="klicango-popup" href="/comment_photo/'.$nid.'/'.$_photo['fid'].'" rel="lightbox">'.theme_imagecache($preset,$_photo['filepath']).'</a>';
        $photos_num++;
      }
    }
  }
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
  if(!empty($user_info->first_name) && !empty($user_info->first_name))
    $name = l($user_info->first_name.' '.$user_info->surname,'user/'.$user_info->uid);  
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