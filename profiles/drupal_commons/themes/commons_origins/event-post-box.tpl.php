<div class="post-box">
  <form action="/event_post_comment" id="comment-post-form" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="comment_target_nid" value="<?php echo arg(1);?>">
    <div class="comment-post-file">
      <div class="post-box-title"><label><?php echo t('Post comment');?> | </label></div>
      <div id="filesContainer">
        <input type="file" id="comment-files" name="files[]" class="form-file profile-upload" multiple="multiple">
      </div>
    </div>
    <div class="comment-post-body">
      <div class="textareaWrapper">
        <span class="comment-post-submit-wrapper">
          <a href="#" title="Add comment" id="comment-post-submit"><img src="/profiles/drupal_commons/themes/commons_origins/images/enter-icon.png" ></a>
        </span>
        <div class="textareaEl"><textarea name="comment_body" id="comment-post-body"></textarea></div>
        <div class="bottom"></div>
      </div>
    </div>
  </form>
</div>