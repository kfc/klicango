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
            En cliquant sur “Sign up with Facebook” ou “Sign up”, j’accepte les <a href="/page/mentions-l%C3%A9gales">conditions générales</a>.
        </div>

        <div class="form-item form-sepatrate-text">
            Already have an account? <a href="javascript:void(0);" id="login-link">Log in</a>
        </div>
    </form>
</div>

<script type="text/javascript">
    function signUp() {
        $('#dialog-log_in').dialog('close');
        $('#dialog-sign_up').dialog('close'); 
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
