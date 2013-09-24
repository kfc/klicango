<?php 
  $author = user_load($uid);
  $photos_num = 0;
  $photos_html = '';
  if(!empty($field_comment_photo)){
    foreach($field_comment_photo as $_photo){
      if(!empty($_photo['filepath'])){
        $photos_html .= '<a href="'.imagecache_create_url('comment_image_big', $_photo['filepath'], FALSE, true).'" rel="lightbox">'.theme_imagecache('comment_image',$_photo['filepath']).'</a>';
        $photos_num++;
      }
    }
  }
  $comment_status = (events_get_event_status_for_user($node->comment_target_nid, $node->uid) == EVENT_STATUS_ACCEPTED ? t('is going') : t('posted a new comment'));
  if($photos_num > 0){
    $comment_status = t('added').' '.$photos_num.' '.($photos_num > 1 ? t('photos') : t('photo'));
  }
                  
?>


<div class="stream-item">
  <div class="person-thumbnail"><?php echo theme_imagecache('user_picture_meta',$author->picture);?></div>
  <div class="stream-item-content">
    <div class="person-name"><?php echo $name;?> <span class="activity_status"><?php echo $comment_status?></span></div>
    <?php if(!empty($photos_num)):?>
      <div class="added-new-photos">
        <?php echo $photos_html?>
      </div>
    <?php endif;?>
    <div class="person-comment"><?php echo $body?></div>
    <div class="person-activity-time"><?php echo format_interval(time()-$created).' '.t('ago');?></div>
  </div>
</div>