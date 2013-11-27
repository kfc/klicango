<?php foreach ($users as $user) : ?>
    <div class="person-item">
        <div class="person-thumbnail"><a href="<?php echo url('user/' . $user->uid); ?>"><img src="<?php echo imagecache_create_url('facebook_image_size', $user->picture); ?>"/></a></div>
        <div class="person-name"><a href="<?php echo url('user/' . $user->uid); ?>">
          <?php echo $user->first_name . ' ' . $user->surname; ?></a><span class="fb-user" onclick="showFriends(<?php echo $user->uid; ?>);">
          <?php echo $user->friends_count . ' ' . ($user->friends_count == 1 ? t('friend') : t('friends')); ?></span>
        </div>
    </div>
<?php endforeach; ?>