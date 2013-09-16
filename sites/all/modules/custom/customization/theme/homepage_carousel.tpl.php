<section id="main-slider">
	<ul>
        <?php foreach ($slides as $slide) : ?>
            <li>
                <img src="<?php echo imagecache_create_url('homepage_carousel', $slide['photo']); ?>" />
    			<div class="slider-text">
                    <img src="<?php echo imagecache_create_url('user_picture_meta', $slide['profile_picture']); ?>" />
    				
    				<div class="profile-name"><?php echo $slide['name']; ?></div>
    				<div class="profile-address"><?php echo $slide['address']; ?> - <?php echo $slide['zip']; ?> <?php echo $slide['city']; ?></div>
    				<div class="profile-link"><?php echo l(t('more...'), 'user/' . $slide['uid']); ?></div>
    			</div>
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