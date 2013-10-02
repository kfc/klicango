<?php global $user;
$user_id = arg(1);
$viewed_user = user_load($user_id);
$advanced_profile = advanced_profile_load($user_id);
?>
<?php if(in_array('individual', $user->roles)):?>
  <div id="private-account-info">
    <div class="account-info-thumb"><img src="/<?php echo $viewed_user->picture?>" height="59"></div>
    <div class="account-info-name"><?php if(isset($viewed_user->first_name)) echo $viewed_user->first_name?> <?php if(isset($viewed_user->surname)) echo $viewed_user->surname?></div>
    <div class="account-info-city"><?php if(isset($viewed_user->city)) echo $viewed_user->city?><?php if(isset($viewed_user->country)) echo ', '.$viewed_user->country?></div>
  </div>
<?php elseif(in_array('professional',$viewed_user->roles)):?>
  <div class="location-calendar-top-banner">
    <?php echo theme_imagecache('event_image',(!empty($advanced_profile['photo']) ? $advanced_profile['photo'] : $advanced_profile[0]['photo']));?>
  </div>
  <div id="profile_info">
      <div class="first-column public-event-col">
        <div class="profile-info">
          <div class="profile-thumbnail"><?php echo theme_imagecache('user_picture_meta', $viewed_user->picture);?></div>
          <div class="profile-name"><?php echo $viewed_user->profile_name;?></div>
          <div class="profile-city"><?php echo $viewed_user->profile_location;?></div>
        </div>
      </div>
      <div class="second-column public-event-col">
        <div class="public-event-address">3, rue Barillerie <br> 06300 Nice</div>
        <div class="public-event-contacts">tel: 04 18 41 02 79 <br> email: loungebar@gmail.com</div>
      </div>
      <!--<div class="i-like-this-place"><a href="">I like this place</a></div>-->
    </div>
<?php endif;?>