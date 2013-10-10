<?php if(!empty($users)) : ?>
<div id="new-friends-list">
	<div class="list-item">
		<table>
			<tbody>
			<?php foreach ($users as $user) : ?>
                <tr>
    				<td class="col-1">
    					<a href="/user/<?php echo $user->uid; ?>"><img alt="" src="<?php echo imagecache_create_url('profile_picture_big', $user->picture); ?>"></a>
    				</td>
    				<td class="col-2">
    					<a href="/user/<?php echo $user->uid; ?>" class="person-name"><?php echo $user->first_name . ' ' . $user->surname ?></a> <?php echo t('wants to be your friend'); ?>
    				</td>
    				<td class="col-3">
    					<div class="decline"><a href="javascript:void(0);" id="user_<?php echo $user->uid;?>" onclick="declineFriend(<?php echo $user->uid; ?>)"><?php echo t('Decline'); ?></a></div>
    					<div class="accept"><a href="javascript:void(0);" class="add-user-link" id="user_<?php echo $user->uid;?>" onclick="acceptFriend(<?php echo $user->uid; ?>)"><?php echo t('Accept'); ?></a></div>
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
