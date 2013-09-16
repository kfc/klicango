<?php if(!empty($content)):?>
  <div id="photo-block">
    <a href="<?php echo url($_GET['q']);?>">Photos (<?php echo $photos_count?>)</a>
    <div class="item-list">
      <?php echo $content;?>
    </div>
    <?php if($photos_count > 7):?>
      <div class="more-link">
        <?php echo l(t('more...'),$_GET['q']);?>
      </div>
    <?php endif;?>
    
  </div>
<?php endif;?>
