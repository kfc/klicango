<!--<div id="dialog-log_in" class="login-form" title="Login" width="410"> -->
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
<!--<form>
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
    <div class="form-item form-type-checkbox form-item-field-suggestion-und" onclick="$('.facebook-log-in').toggleClass('active');" >
        <input type="checkbox" id="field-pro" name="field-pro" value="1" class="form-checkbox" />
        <label class="option" for="field-pro">Im a pro</label>
    </div>
    
    <div class="form-submit">
        <input type="submit" value="Log in"/>
        <span class="submit-or">or</span>
        <a href="javascript:void(0);" id="signup" onclick="signUp();">Sign up</a>
    </div>
    <?php
      echo fboauth_action_display('connect', '/');
    ?>
  </form>
</div>

<script type="text/javascript">
    function signUp() {
        $('#dialog-log_in').dialog('close'); 
        if($('#field-pro').prop('checked')) {
            showDialog('professional_user_register');
        } else {
            showDialog('end_user_register');
        }
    }
</script>-->


<div id="dialog-sign_up" title="SIGN UP" width="410">
    <form>
        <div class="form-item facebook-log-in active">
           <?php
              echo fboauth_action_display('connect', '/');
            ?>
        </div>

        <div class="or-separator">
            <span>or</span>
        </div>

        <div class="form-item form-type-checkbox form-item-field-suggestion-und">
            <input type="checkbox" id="field-pro" name="field-pro" value="1" class="form-checkbox"> <label class="option" for="field-pro">I'm a pro</label>
        </div>

        <div class="form-submit">
            <a href="javascript:void(0);" id="signup" onclick="signUp();">Sign up</a>
        </div>

        <div class="form-item form-text">
            Some text some text some text some text some text <a href="">some text</a>
        </div>

        <div class="form-item form-sepatrate-text">
            Already have an account? <a href="javascript:void(0);" id="login-link">Log in</a>
        </div>
    </form>
</div>

<script type="text/javascript">
    function signUp() {
        $('#dialog-log_in').dialog('close'); 
        if($('#field-pro').prop('checked')) {
            showDialog('professional_user_register');
        } else {
            showDialog('end_user_register');
        }
    }
    
    $(document).ready(function(){
      $('#field-pro').change(function(){
        $('.facebook-log-in').toggleClass('active');
      });
      $('#login-link').click(function(e) {
        e.preventDefault();
        $("#dialog-sign_up").dialog("close");
        $("#log_in").click();
      });
    });
</script>
