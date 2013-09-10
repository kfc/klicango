<div id="dialog-professional_user_register" title="Sign up pro" width="484">
      <form method="post" action="/user/signup" enctype="multipart/form-data">
    	<div class="form-item long">
    		<label>Name</label>
    		<input type="text" name="name" placeholder="<?php echo t('name of your place')?>" />
    	</div>
    	<div class="form-item field-e-mail">
    		<label>E-mail</label>
    		<input type="text" name="mail" placeholder="<?php echo t('ex: loungebar@gmail.com')?>" />
    	</div>
    	<div class="form-item">
    		<label>Password</label>
    		<input type="password" name="pass" placeholder="<?php echo t('password (6 digits min)')?>"/>
    		<input type="password" name="pass_confirm" placeholder="<?php echo t('password confirmation')?>"/>
    	</div>
    	<div class="form-item long">
    		<label>SIRET</label>
    		<input type="text" name="siret" placeholder="<?php echo t('ex: 53910863900011')?>" />
    	</div>
        <div class="form-item long">
    		<label>Address</label>
    		<input type="text" name="address" placeholder="<?php echo t('ex: 3, rue Barillerie')?>" />
    	</div>
        <div class="form-item">
    		<label>ZIP code</label>
    		<input type="text" name="zip" placeholder="<?php echo t('ex: 06300')?>" />
    	</div>
    	<div class="form-item">
    		<label>Location</label>
    		<select name="country">
                <option value="0">country</option>
                <option value="France">France</option>
    			<option value="Germany">Germany</option>
    			<option value="Spain">Spain</option>
    		</select>
    		<input type="text" name="city" placeholder="<?php echo t('city (ex: Nice)')?>" />
    	</div>
        <div class="form-item short">
    		<label>Phone</label>
    		<input type="text" name="phone" placeholder="<?php echo t('ex: +33 4 94 04 04 04')?>" />
    	</div>
        <div class="form-item">
    		<label>Category</label>
    		<select name="category">
                <option value="0">type</option>
                <option value="Arts/Entertainment">Arts/Entertainment</option>
    			<option value="Nightlife">Nightlife</option>
    			<option value="Pub/bar">Pub/bar</option>
                <option value="Restaurant/Café">Restaurant/Café</option>
                <option value="Association">Association</option>
    		</select>
    		<input type="text" name="category_other" placeholder="<?php echo t('Other')?>" />
    	</div>
    	<div class="form-item profile-links">
            <input type="file" id="field-image-upload" name="files[files-photo]" class="form-file profile-upload" />
            <input type="file" id="field-image-upload" name="files[files-banner]" class="form-file banner-upload" />
    		<!--<a id="add-prof-photo" name="profile_photo" href="">Add profile photo</a>
    		<a id="add-prof-photo" name="banner_photo" href="">Add banner photo</a>-->
    	</div>
    	<div class="form-submit">
    		<label><input type="checkbox" name="conditions" value="agree"/>J’accepte les <a href="">conditions d’utilisation</a> du service</label>
    		<input type="submit" value="Sign up"/>
    	</div>
        <input type="hidden" name="user_type" value="7" />
      </form>
    </div>