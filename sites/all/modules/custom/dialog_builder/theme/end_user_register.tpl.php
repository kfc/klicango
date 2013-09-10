<div id="dialog-end_user_register" title="Sign up" width="484">
      <form method="post" action="/user/signup" enctype="multipart/form-data">
    	<div class="form-item">
    		<label>Name</label>
    		<input type="text" name="name" placeholder="<?php echo t('first name')?>" />
    		<input type="text" name="surname" placeholder="<?php echo t('last name')?>" />
    	</div>
    	<div class="form-item field-e-mail">
    		<label>E-mail</label>
    		<input type="text" name="mail" placeholder="<?php echo t('ex: sophie@gmail.com')?>" />
    	</div>
    	<div class="form-item">
    		<label>Password</label>
    		<input type="password" name="pass" placeholder="<?php echo t('password (6 digits min)')?>"/>
    		<input type="password" name="pass_confirm" placeholder="<?php echo t('password confirmation')?>"/>
    	</div>
    	<div class="form-item">
    		<label>Identity</label>
    		<select name="sex">
                <option value="0">sex</option>
    			<option value="male">male</option>
    			<option value="female">female</option>
    		</select>
    		<input type="text" name="birthday" placeholder="<?php echo t('birthday (ex: 17/12/1993)')?>" />
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
    	<div class="form-item">
    		<label>University</label>
    		<input type="text" name="university" placeholder="<?php echo t('name (ex: ESPEME)')?>" />
    		<select name="degree">
    			<option value="0">degree</option>
    			<option value="L1">L1</option>
                <option value="L2">L2</option>
                <option value="L3">L3</option>
                <option value="M1">M1</option>
                <option value="M2">M2</option>
    		</select>
    	</div>
    	<div class="form-item profile-links">
    		<!--<a id="add-prof-photo" name="photo" href="">Add profile photo</a>-->
            <input type="file" id="field-image-upload" name="files[files-photo]" class="form-file profile-upload" />
    		<a id="add-friends" name="friends" href="">Add friends</a>
    	</div>
    	<div class="form-submit">
    		<label><input type="checkbox" name="conditions" value="agree" class="error"/>J’accepte les <a href="">conditions d’utilisation</a> du service</label>
    		<input type="submit" value="Sign up"/>
    	</div>
        <input type="hidden" name="user_type" value="6" />
      </form>
    </div>