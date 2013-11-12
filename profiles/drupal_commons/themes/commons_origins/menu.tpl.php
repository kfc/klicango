<?php if(user_is_logged_in()) : ?>
	<nav class="main_menu">
		<ul class="menu">
            <?php if(in_array('professional', $user->roles, true)) : ?>
                <li>
                    <a href="/user">Calendar</a>
                </li>
                <li>
                    <a href="/friends">Followers</a>
                </li>
    			<li class="create_event">
    				<a id="create-event-link" href=""><?php echo t('+ Create event');?></a>
    			</li>
            <?php else : ?>
                <li>
    				<a href="/user">Calendar</a>
    			</li>
    			<li>
    				<a href="/friends">Friends</a>
                    <?php echo (!empty($menu_stats['friends_pending']) && $menu_stats['friends_pending']) ? '<span class="counter">' . $menu_stats['friends_pending'] . '</span>' : ''; ?>    				
    			</li>
    			<li>
    				<a href="/public">Public events</a>
    				<?php echo (!empty($menu_stats['public_pending']) && $menu_stats['public_pending']) ? '<span class="counter">' . $menu_stats['public_pending'] . '</span>' : ''; ?>
    			</li>
                <li>
    				<a href="/private">Private events</a>
    				<?php echo (!empty($menu_stats['private_pending']) && $menu_stats['private_pending']) ? '<span class="counter">' . $menu_stats['private_pending'] . '</span>' : ''; ?>
    			</li>
    			<li class="create_event">
    				<a id="create-event-link" href=""><?php echo t('+ Create event');?></a>
    			</li>
            <?php endif; ?>
		</ul>
	</nav>

    <?php 
        global $user;
        profile_load_profile($user);
        
        $adv = advanced_profile_load($user->uid);
        
    ?>  
    
    <div id="auth-block">
		<div class="accaunt-thumbnail"><a href=""><img src="<?php echo imagecache_create_url('profile_picture_small', $user->picture); ?>" /></a></div>
		<div class="accaunt-name">
			<a href=""><?php echo $user->first_name; ?></a>
			<div id="accaunt-menu">
				<ul>
					<li><a href="" class="popup" id="<?php echo (in_array('professional', $user->roles, true)) ? 'professional_user_register' : 'end_user_register' ?>">My profile</a></li>
					<li><a href="/user?q=logout">Log out</a></li>
				</ul>
			</div>
		</div>
		
	</div>
    
<?php
    else :
?>
    <nav class="main_menu">
		<ul class="menu">
			<li>
				<a href="/">Home</a>
			</li>
            <li>
				<a href="">Public events</a>
			</li>
		</ul>
	</nav>
	
	<div id="auth-block">
		<a class="popup" id="log_in" href="">LOGIN</a>
	</div>
<?php
    endif;
?>