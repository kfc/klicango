<div id="dialog-professional_user_register" title="<?php echo (user_is_logged_in()) ? t('My profile pro') : t('Sign up pro'); ?>" width="484">
      <form method="post" action="/user/signup" enctype="multipart/form-data">
    	<div class="form-item long">
    		<label>Name</label>
    		<input type="text" name="name" placeholder="<?php echo t('name of your place')?>" value="<?php echo !(empty($data) && !empty($data->first_name)) ? $data->first_name : ''; ?>" />
    	</div>
    	<div class="form-item field-e-mail">
    		<label>E-mail</label>
    		<input type="text" name="mail" placeholder="<?php echo t('ex: loungebar@gmail.com')?>" value="<?php echo !(empty($data) && !empty($data->mail)) ? $data->mail : ''; ?>" />
    	</div>
    	<div class="form-item">
    		<label>Password</label>
    		<input type="password" name="pass" placeholder="<?php echo t('password (6 digits min)')?>"/>
    		<input type="password" name="pass_confirm" placeholder="<?php echo t('password confirmation')?>"/>
    	</div>
    	<div class="form-item long">
    		<label>SIRET</label>
    		<input type="text" name="siret" placeholder="<?php echo t('ex: 53910863900011')?>" value="<?php echo !(empty($data) && !empty($data->siret)) ? $data->siret : ''; ?>" />
    	</div>
        <div class="form-item long">
    		<label>Address</label>
    		<input type="text" name="address" placeholder="<?php echo t('ex: 3, rue Barillerie')?>" value="<?php echo !(empty($data) && !empty($data->address)) ? $data->address : ''; ?>" />
    	</div>
        <div class="form-item">
    		<label>ZIP code</label>
    		<input type="text" name="zip" placeholder="<?php echo t('ex: 06300')?>" value="<?php echo !(empty($data) && !empty($data->zip)) ? $data->zip : ''; ?>" />
    	</div>
    	<div class="form-item">
    		<label>Location</label>
    		<select name="country" id="country">
                <option value="0">country</option>
                <option value="France">France</option>
    			<option value="Germany">Germany</option>
    			<option value="Spain">Spain</option>
    		</select>
    		<input type="text" name="city" placeholder="<?php echo t('city (ex: Nice)')?>" value="<?php echo !(empty($data) && !empty($data->city)) ? $data->city : ''; ?>" />
    	</div>
        <div class="form-item short">
    		<label>Phone</label>
    		<input type="text" name="phone" placeholder="<?php echo t('ex: +33 4 94 04 04 04')?>" value="<?php echo !(empty($data) && !empty($data->phone)) ? $data->phone : ''; ?>"/>
    	</div>
        <div class="form-item">
    		<label>Category</label>
    		<select name="category" id="category">
                <option value="0">type</option>
                <option value="Arts/Entertainment">Arts/Entertainment</option>
    			<option value="Nightlife">Nightlife</option>
    			<option value="Pub/bar">Pub/bar</option>
                <option value="Restaurant/Café">Restaurant/Café</option>
                <option value="Association">Association</option>
    		</select>
    		<input type="text" name="category_other" placeholder="<?php echo t('Other')?>" value="<?php echo !(empty($data) && !empty($data->category_other)) ? $data->category_other : ''; ?>" />
    	</div>
    	<div class="form-item profile-links">
            <?php if (!user_is_logged_in()) : ?>
                <input type="file" id="field-image-upload" name="files[files-photo]" class="form-file profile-upload" />
                <input type="file" id="field-image-upload" name="files[files-banner]" class="form-file banner-upload" />
    		<?php else : ?>
                <input type="file" id="field-image-upload" name="files[files-photo]" class="form-file profile-upload-update" />
                <input type="file" id="field-image-upload" name="files[files-banner]" class="form-file banner-upload-update" />
            <?php endif; ?>
            <!--<a id="add-prof-photo" name="profile_photo" href="">Add profile photo</a>
    		<a id="add-prof-photo" name="banner_photo" href="">Add banner photo</a>-->
    	</div>
    	<div class="form-submit">
            <?php if (!user_is_logged_in()) : ?>
                <label><input type="checkbox" name="conditions" value="agree"/>J’accepte les <a href="">conditions d’utilisation</a> du service</label>
                <input type="submit" value="Sign up"/>
            <?php else : ?>
                <input type="submit" value="Update"/>
            <?php endif; ?>
    		
    	</div>
        <input type="hidden" name="user_type" value="7" />
      </form>
    </div>
    
    <?php if (user_is_logged_in()) : ?> 
        <script language="javascript">
            $('#category').val('<?php echo $data->category; ?>');
            $('#country').val('<?php echo $data->country; ?>');
        </script>
    <?php endif; ?>