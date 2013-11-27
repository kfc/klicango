<?php 
  global $user;
  if(user_is_anonymous()):
?>

<div id="event-access-denied-page" title="<?php echo t('Event access denied')?>">
  <div class="add-friend-text">
    <?php echo t('Private events are available only for registered users');?>
  </div>
    <div class="person-item">
        <a class="black-button" href="/"><?php echo t('Go to homepage'); ?></a>
    </div>
</div>

<?php else:  ?>

<div id="event-access-denied-page" title="<?php echo t('Event access denied')?>">
  <div class="add-friend-text">
    <?php echo t('You can view only events you are visting or invited to.');?>
  </div>
    <div class="person-item">
        <a class="black-button" href="/user"><?php echo t('View calendar'); ?></a>
    </div>
</div>
<?php endif;?>



