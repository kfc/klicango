<div id="invite-friends-form" class="user-<?php echo $user_id; ?> user-friends-list" title="Friends in common">
    <form id="invite-friends">
        <div class="scroll-pane" id="user_<?php echo $user_id; ?>">
          <?php if (!empty($users)) :?>
            <?php foreach ($users as $_user) : ?>
              <div class="person-item">
                <div class="person-thumbnail">
                  <a href="<?php echo url('user/' . $_user->uid); ?>">
                    <img src="<?php echo $_user->picture_url; ?>" />
                  </a>
                </div>
                <div class="person-name">
                  <a href="<?php echo url('user/' . $_user->uid); ?>"><?php echo $_user->name; ?></a>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
    </form>
</div>