<?php if(!empty($content)):?>
  <div id="photo-block">
    <a class="klicango-popup" href="<?php echo $all_photos_link;?>">Photos (<?php echo $photos_count?>)</a>
    <div class="item-list">
      <?php echo $content;?>
    </div>
    <?php if(!empty($more_photos_link)):?>
      <div class="more-link"> 
        <a href="<?php echo $more_photos_link;?>" class="klicango-popup"><?php echo t('more...')?></a>
      </div>
    <?php endif;?>
    
  </div>
<?php endif;?>
