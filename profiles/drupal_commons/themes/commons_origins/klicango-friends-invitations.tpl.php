<?php 
  global $user; 
?>

<?php if(!empty($users)) : ?>
  <div id="new-friends-list">
  	<div class="list-item">
  		<table>
  			<tbody>
  			<?php foreach ($users as $friend) : ?>
                  <tr>
      				<td class="col-1">
      					<a href="/user/<?php echo $friend->uid; ?>"><img alt="" src="<?php echo imagecache_create_url('profile_picture_big', $friend->picture); ?>"></a>
      				</td>
      				<td class="col-2">
      					<a href="/user/<?php echo $friend->uid; ?>" class="person-name"><?php echo $friend->first_name . ' ' . $friend->surname ?></a> 
                <?php if (in_array('individual', $user->roles)) : ?>
                  <?php echo t('wants to be your friend'); ?>
                <?php else : ?>
                  <?php echo t('is a new follower'); ?>
                <?php endif; ?>
      				</td>
      				<td class="col-3">
                <?php if (in_array('individual', $user->roles)) : ?>
        					<div class="decline"><a href="javascript:void(0);" id="user_<?php echo $friend->uid;?>" onclick="declineFriend(<?php echo $friend->uid; ?>)"><?php echo t('Decline'); ?></a></div>
        					<div class="accept"><a href="javascript:void(0);" class="add-user-link" id="user_<?php echo $friend->uid;?>" onclick="acceptFriend(<?php echo $friend->uid; ?>)"><?php echo t('Accept'); ?></a></div>
                <?php endif; ?>
      				</td>
  			    </tr>
              <?php endforeach; ?>
              </tbody>
  		</table>
  	</div>
  
  </div>
<?php else : ?>
<div style="margin-bottom: 10px;">
</div>
<?php endif; ?>
