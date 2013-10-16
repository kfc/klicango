<?php foreach ($users as $user) : ?>
    <div class="person-item">
        <div class="person-thumbnail"><a href="javascript: void(0);"><img src="https://graph.facebook.com/<?php echo $user['facebook_id']; ?>/picture"/></a></div>
        <div class="person-name"><a href="javascript: void(0);"><?php echo $user['name']; ?></a><span class="fb-user"><?php echo t('Friend on facebook'); ?></span></div>
    </div>
<?php endforeach; ?>