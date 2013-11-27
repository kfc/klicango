<div id="invite-friends-form" class="user-<?php echo $user_id; ?> user-friends-list" title="Friends">
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
                  <span class="fb-user" onclick="showFriends(<?php echo $_user->uid; ?>);"><?php echo $_user->friends_count . ' ' . ($_user->friends_count == 1 ? t('friend') : t('friends')); ?></span>
                </div>
                <a onclick="inviteJoinFriendSubmit(this, <?php echo $_user->uid; ?>)" class="invite-friend" href="javascript: void(0);"><?php echo t('Add friend'); ?></a>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
    </form>
</div>