<div id="dialog-log_in" class="login-form" title="Login" width="410">
<!--  <form>
	<div class="form-item">
		<label>Login</label>
		<input type="text" name="name" id="field-name"/>
	</div>
	
	<div class="form-item">
		<label>Password</label>
		<input type="password" name="pass" id="field-pass" />
	</div>
	
	<div class="form-submit">
		<input type="submit" value="Log in"/>
	</div>
  </form> -->
  <form>
    <div class="form-item placeholder">
		<input type="text" name="name"  placeholder="Email"/>
	</div>
	<div class="clearfix"></div>
	<div class="form-item placeholder">
		<input type="password" name="pass" placeholder="Password"/>
	</div>
	<div class="clearfix"></div>
	<div class="form-item login-links">
		<a id="forgot-pass" href="">Forgot your password?</a>
	</div>
	<div class="form-item form-type-checkbox form-item-field-suggestion-und">
		<input type="checkbox" id="field-pro" name="field-pro" value="1" class="form-checkbox" />
		<label class="option" for="field-pro">I’m a pro</label>
	</div>
	
	<div class="form-submit">
		<input type="submit" value="Log in"/>
		<span class="submit-or">or</span>
		<a href="javascript:void(0);" id="signup" onclick="signUp();">Sign up</a>
	</div>
	<div class="form-item facebook-log-in">
		<a href="">Log with Facebook</a>
	</div>
  </form>
</div>

<script type="text/javascript">
    function signUp() {
        $('#dialog-log_in').dialog('close'); 
        if($('#field-pro').prop('checked')) {
            $('#professional_user_register').click();
        } else {
            $('#end_user_register').click();
        }
          
    }
</script>