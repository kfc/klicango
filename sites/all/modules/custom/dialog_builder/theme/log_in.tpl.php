<div id="dialog-log_in" title="LOGIN" width="410">
    <form>
          <?php
            echo fboauth_action_display('connect', '/');
          ?>
        
        <div class="or-separator">
            <span>or</span>
        </div>

        <div class="form-item placeholder">
            <input type="text" name="name" placeholder="Email">
        </div>

        <div class="clearfix"></div>

        <div class="form-item placeholder">
            <input type="password" name="pass" placeholder="Password">
        </div>

        <div class="clearfix"></div>

        <div class="form-item login-links">
            <!--<a id="forgot-pass" href="" name="forgot-pass">Forgot your password?</a>-->
        </div>
        
        <div class="form-submit">
            <input type="submit" value="Log in">
        </div>

        <div class="form-item form-text">
            En cliquant sur “Log with Facebook” ou “Log in”, j’accepte les  <a href="/page/mentions-l%C3%A9gales">conditions générales</a>.
        </div>

        <div class="form-item form-sepatrate-text">
            Don’t have an account? <a href="javascript:void(0)" id="signup-link">Sign up</a>
        </div>
    </form>
</div>
<script type="text/javascript">
  $('#signup-link').click(function(e) {
    e.preventDefault();
    $("#dialog-log_in").dialog("close");
    $("#sign_up").click();
  });
</script>