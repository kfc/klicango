<section id="main-slider">
    <div class="fixed-slide-text">
		<h2><?php echo nl2br(variable_get('carousel_message_title', '')); ?></h2>
		<p><?php echo nl2br(variable_get('carousel_main_message', '')); ?></p>
	</div>
	<ul>
        <?php foreach ($slides as $slide) : ?>
            <li>
                <img src="<?php echo imagecache_create_url('homepage_carousel', $slide['photo']); ?>" />
                <a href="<?php echo url('user/'. $slide['uid'])?>">
    			      <div class="slider-text">
                  
                          <img src="<?php echo imagecache_create_url('user_picture_meta', $slide['profile_picture']); ?>" />
    				      
    				        <div class="profile-name"><?php echo $slide['name']; ?></div>
    				        <div class="profile-address"><?php echo $slide['address']; ?> - <?php echo $slide['zip']; ?> <?php echo $slide['city']; ?></div>
    				        <div class="profile-link"><?php echo t('more...') ?></div>
                  
    			      </div></a>
            </li>
        <?php endforeach; ?>
	</ul>
</section>
<script>
$(function() {
    $("#main-slider ul").carouFredSel({
    	items				: 1,
    	scroll : {
    		items			: 1,
    		duration		: <?php echo variable_get('carousel_duration', 1000); ?>,							
    		pauseOnHover	: true,
            speed			: <?php echo variable_get('carousel_speed', 1250); ?>,
    	}					
    });
});
</script>