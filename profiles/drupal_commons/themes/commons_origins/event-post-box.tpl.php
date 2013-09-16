<div class="post-box">
  <form action="/event_post_comment" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="comment_target_nid" value="<?php echo arg(1);?>">
    <div class="post-box-title"><label><?php echo t('Post comment');?> | </label><a id="comment_add_photo_link" href=""><?php echo t('Add photo');?></a></div>
    <div id="filesContainer">
    </div>
    <input type="text" name="comment_body">
  </form>
</div>