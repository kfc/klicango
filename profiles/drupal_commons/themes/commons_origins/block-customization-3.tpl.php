<?php global $user;
$user_id = arg(1);
$viewed_user = user_load($user_id);
profile_load_profile($viewed_user);
$advanced_profile = advanced_profile_load($user_id);
?>
<?php if(in_array('individual', $viewed_user->roles)):?>
  <!--<div id="private-account-info">
    <div class="account-info-thumb"><img src="/<?php echo $viewed_user->picture?>" height="59"></div>
    <div class="account-info-name"><?php if(isset($viewed_user->first_name)) echo $viewed_user->first_name?> <?php if(isset($viewed_user->surname)) echo $viewed_user->surname?></div>
    <div class="account-info-city"><?php if(isset($viewed_user->city)) echo $viewed_user->city?> <?php if(isset($viewed_user->country)) echo ', '.$viewed_user->country?></div>
  </div>-->
  <div id="profile_info">
      <div class="first-column public-event-col private">
        <div class="profile-info">
          <div class="profile-thumbnail"><?php echo theme_imagecache('user_picture_meta', $viewed_user->picture);?></div>
          <div class="profile-name"><?php if(isset($viewed_user->first_name)) echo $viewed_user->first_name?> <?php if(isset($viewed_user->surname)) echo $viewed_user->surname?></div>
          <div class="profile-city"><?php if(isset($viewed_user->city)) echo $viewed_user->city?><?php if(isset($viewed_user->country)) echo ', '.$viewed_user->country?></div>
        </div>
      </div>
      <?php if ($viewed_user->uid != $user->uid) : ?>
        <?php if(klicango_friends_are_friends($user->uid, $viewed_user->uid) && klicango_friends_invitation_sent($user->uid, $viewed_user->uid)):?>
            <div class="i-like-this-place"><?php echo l(t('I\'m a friend'),'removefriend/'.$viewed_user->uid, array('attributes'=>array('class'=>'follow-user-action','id'=>'unfollow-user-calendar', 'title'=>($viewed_user->first_name.' '.$viewed_user->surname))))?></div>
        <?php elseif (klicango_friends_invitation_sent($user->uid, $viewed_user->uid)) : ?>
            <div class="i-like-this-place"><?php echo l(t('Invitation pending'),'removefriend/'.$viewed_user->uid, array('attributes'=>array('class'=>'follow-user-action','id'=>'unfollow-user-calendar', 'title'=>($viewed_user->first_name.' '.$viewed_user->surname))))?></div>
        <?php else : ?>
            <div class="follow-this-place"><?php echo l(t('Add as friend'),'addfriend/'.$viewed_user->uid, array('attributes'=>array('class'=>'follow-user-action','id'=>'follow-user-calendar', 'title'=>($viewed_user->first_name.' '.$viewed_user->surname))))?></div>
        <?php endif; ?>
      <?php endif; ?>
      <!--<div class="i-like-this-place"><a href="">I like this place</a></div>-->
    </div>
<?php elseif(in_array('professional',$viewed_user->roles)): ?>
  <div class="location-calendar-top-banner">
    <?php if (sizeof($advanced_profile) > 1) : ?>
          <script>
            $(function() {
                $(".location-calendar-top-banner ul").carouFredSel({
                	items				: 1,
                	scroll : {
                		items			: 1,
                		duration		: 1000,							
                		pauseOnHover	: true,
                        speed			: 1000,
                	}					
                });
            });
          </script>
          <ul>
            <?php foreach($advanced_profile as $photo) : ?>
                <?php echo '<li>' . theme_imagecache('event_image',$photo['photo']) . '</li>'; ?>
            <?php endforeach; ?>
          </ul>
      <?php else : ?>
        <?php echo theme_imagecache('event_image',(!empty($advanced_profile['photo']) ? $advanced_profile['photo'] : $advanced_profile[0]['photo']));?>
      <?php endif; ?>
  </div>
  <div id="profile_info">
      <div class="first-column public-event-col">
        <div class="profile-info">
          <div class="profile-thumbnail"><?php echo theme_imagecache('user_picture_meta', $viewed_user->picture);?></div>
          <div class="profile-name"><?php echo $viewed_user->first_name;?></div>
          <div class="profile-city"><?php echo $viewed_user->city;?></div>
        </div>
      </div>
      <div class="second-column public-event-col">
        <div class="public-event-address"><?php echo $viewed_user->address?> <br> <?php echo $viewed_user->zip?> <?php echo $viewed_user->city?></div>
        <?php if (!empty($viewed_user->phone) || !empty($viewed_user->mail)) : ?>
            <div class="public-event-contacts">
            <?php if (!empty($viewed_user->phone)) : ?>
                tel: <?php echo $viewed_user->phone?> <br>
            <?php endif; ?>
            <?php if (!empty($viewed_user->mail)) : ?>
                email: <?php echo l($viewed_user->mail, 'mailto:'.$viewed_user->mail)?>
             <?php endif; ?>
            </div>
        <?php endif; ?>
      </div>
      <?php if($user->uid != $viewed_user->uid):?>
        <div class="public-actions">
        <?php if(klicango_friends_are_friends($user->uid, $viewed_user->uid)):?>
          <div class="i-like-this-place"><?php echo l(t('I like this place'),'unfollow/'.$viewed_user->uid,array('attributes'=>array('class'=>'follow-place-action','id'=>'follow-place-calendar')))?></div>
        <?php else:?>
          <div class="add-to-calendar"><?php echo l(t('Follow this place'),'follow/'.$viewed_user->uid, array('attributes'=>array('class'=>'follow-place-action','id'=>'unfollow-place-calendar')))?></div>
        <?php endif;?>  
      <?php endif;?> 
      </div>  
    </div>
<?php endif;?>