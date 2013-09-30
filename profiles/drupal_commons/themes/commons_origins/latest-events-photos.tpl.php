<?php
  if(!empty($photos)):?>
  <div id="last-parties-photos">
    <h2><?php echo t('Latest Events Photos')?></h2>
      <div class="item-list">
        <?php foreach($photos as $nid => $_info):?>  
          <div class="item">
          <div class="party-thumbnail"><?php echo (!empty($_info['event_image']) ? theme_imagecache('user_picture_meta',$_info['event_image']) : '')?></div>
          <div class="party-n-d-l">
            <?php $date = date('M d', strtotime($_info['event_date'])); ?>
            <a href="<?php echo url('node/'.$nid)?>" class="party-link"><?php echo $_info['node_title']?></a><span class="party-date">, <?php echo $date?> </span>
            <span class="party-photos-link">(<a href=""><?php echo count($_info['photos']).' '.t('photo(s)')?></a>)</span>
          </div>
          <div class="parties-photos-block">
            <?php 
            $_info['photos'] = array_slice($_info['photos'],0,$photos_count, true);
            $fids = array_keys($_info['photos']);
            foreach($_info['photos'] as $_fid => $_photo_data): ?>
            <a class="<?php echo ($_fid == ($fids[$photos_count-1]) ? 'last' : '')?>" href="<?php echo imagecache_create_url('comment_image_big', $_photo_data['filepath'], FALSE, true)?>" rel="lightbox">
              <?php echo theme_imagecache('event_latest_photo',$_photo_data['filepath'])?></a>
            <?php endforeach;?>
          </div>
        
        <?php endforeach;?>
      </div>
  </div>
<?php endif;?>
