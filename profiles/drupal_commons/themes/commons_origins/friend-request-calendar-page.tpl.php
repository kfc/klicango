<?php
  profile_load_profile($viewed_user);
  $friends_in_common = klicango_friends_get_friends_in_common($viewed_user->uid);
  $invitations = klicango_friends_get_friends('invitations_sent',null,true);
  if(!in_array($viewed_user->uid, $invitations)){
     $invitations_received = klicango_friends_get_friends('invitations_received',null,true);  
  }
?>

<div id="add-friends-form-user-page" title="<?php echo t((in_array($viewed_user->uid, $invitations_received) ? 'Friend request pending' : 'Send friend request'));?>">
  <div class="add-friend-text">
    <?php if(in_array($viewed_user->uid, $invitations_received)):?>
      <?php echo t('You can only see user\'s calendars of your friends.').t(' Go to friends page to accept or decline the invitation from ').$viewed_user->first_name.' '.$viewed_user->surname;?>
    <?php else:?>
      <?php echo t('You can only see user\'s calendars of your friends. Do you want to send a friend request?');?>
    <?php endif;?>
  </div>
    <div class="person-item">
        <div class="person-thumbnail"><?php echo theme_imagecache('user_picture_meta',$viewed_user->picture);?></div>
        <div class="person-name"><?php echo $viewed_user->first_name.' '.$viewed_user->surname?>
          <span class="fb-user" onclick="showFriendsInCommon(<?php echo $viewed_user->uid;?>)"><?php echo count($friends_in_common).' '.t('friends in common')?></span>
        </div>
        <?php if(in_array($viewed_user->uid, $invitations)):?>
          <a class="action-friend-user-page white-button" title="<?php echo $viewed_user->first_name.' '.$viewed_user->surname?>" id="remove-friend-user-page" href="/removefriend/<?php echo $viewed_user->uid;?>"><?php echo t('Invitation sent'); ?></a>
        <?php elseif(in_array($viewed_user->uid, $invitations_received)):?>  
          <a class="white-button" title="<?php echo $viewed_user->first_name.' '.$viewed_user->surname?>" href="/friends"><?php echo t('Invitation pendind'); ?></a>
        <?php else:?>
          <a class="action-friend-user-page black-button" title="<?php echo $viewed_user->first_name.' '.$viewed_user->surname?>" id="add-friend-user-page" href="/addfriend/<?php echo $viewed_user->uid;?>"><?php echo t('Add friend'); ?></a>
        <?php endif;?>
    </div>
</div>


