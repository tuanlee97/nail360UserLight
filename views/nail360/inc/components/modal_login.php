<!-- Modal Login -->
<div class="modal fade" id="login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content py-3 px-4">
      <div class="modal-login-header">
        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0 text-center">
        <img src-alt="logo nail360" lazy-src="<?php echo $_rootPath ?>/views/nail360/assets/img/logo/svg-logo.svg" />
        <h1 class="mulish-bold h-color login-title">Log In</h1>
        <p class="m-0 lh-16px p-color">Welcome back!</p>
        <p class="m-0 lh-16px p-color">Please enter your details.</p>
        <form class="" id="login-form">
        <div class="my-3">
                <label for="login_email" class="visually-hidden">Email address</label>
                <input type="email" class="form-control radius-300 h50px n360-border-color px-4" name="email" id="login_email" placeholder="name@example.com">
            </div>
            <div class="mt-3">
                <label for="login_password" class="visually-hidden">Password</label>
                <input type="password" class="form-control radius-300 h50px n360-border-color px-4" name="password" id="login_password" placeholder="Password">
            </div>
            <div id="login-invalid-feedback"></div>
            <button type="button" data-bs-toggle="modal" data-bs-target="#forgotpw" class="btn btn-link h-color">Forgot Password?</button>
            <div class="d-flex align-items-center justify-content-center gap-1">
                <span>Don't have an account? </span><button type="button" data-bs-toggle="modal" data-bs-target="#signUp" class="p-0 btn btn-link h-color">Sign Up</button>
            </div>
            <div class="my-3">
                <button type="submit" id="system_login" class="btn bg-main text-white mulish-bold w-100 radius-300 h50px">Continue</button>
            </div>
            <div class="my-3">
                <span class="line">
                    <h2><span>Or</span></h2>
                </span>
            </div>
            <div class="my-3">
            <button type="button" class="text-start ps-4 btn bg-fb text-white mulish-bold w-100 radius-300 h50px"  data-bs-dismiss="modal">
            <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M30.2714 15.7031C30.2714 23.7101 23.7804 30.2011 15.7734 30.2011C7.76638 30.2011 1.27539 23.7101 1.27539 15.7031C1.27539 7.69606 7.76638 1.20508 15.7734 1.20508C23.7804 1.20508 30.2714 7.69606 30.2714 15.7031Z" stroke="white"/>
                <path d="M17.1113 12.4102V10.9738C17.1113 10.2733 17.5782 10.1111 17.9067 10.1111C18.2351 10.1111 19.9209 10.1111 19.9209 10.1111V7.03629L17.1469 7.02441C14.0681 7.02441 13.3677 9.31963 13.3677 10.7878V12.4102H11.5869V14.5788V15.9995H13.3835C13.3835 20.0675 13.3835 24.9746 13.3835 24.9746H16.9727C16.9727 24.9746 16.9727 20.0201 16.9727 15.9995H19.636L19.7666 14.5907L19.9644 12.4102H17.1113Z" fill="white"/>
            </svg>
                Continue With Facebook
            </button>
            </div>
            <div class="my-3">
            <button type="button" class="text-start ps-4 btn bg-gg text-white mulish-bold w-100 radius-300 h50px"  data-bs-dismiss="modal">
            <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M30.2754 15.1162C30.2754 23.1243 23.7835 29.6162 15.7754 29.6162C7.76726 29.6162 1.27539 23.1243 1.27539 15.1162C1.27539 7.10808 7.76726 0.616211 15.7754 0.616211C23.7835 0.616211 30.2754 7.10808 30.2754 15.1162Z" stroke="white"/>
                <path d="M23.5088 14.3566C23.3775 14.3566 23.2463 14.3566 23.115 14.3566C23.115 14.3285 23.115 14.3004 23.115 14.2816C23.115 14.1785 23.115 14.0941 23.115 14.0098C23.115 13.5129 23.1244 13.0066 23.1057 12.5098C23.1057 12.4254 23.0213 12.2848 22.965 12.2754C22.5057 12.2566 22.0557 12.266 21.5682 12.266C21.5682 12.866 21.5682 13.4285 21.5682 14.0098C21.5682 14.1223 21.5682 14.2348 21.5682 14.3473C20.865 14.3473 20.1994 14.3473 19.4775 14.3473C19.4775 14.5066 19.4775 14.6098 19.4775 14.7129C19.4963 15.0879 19.515 15.4723 19.5244 15.8473C19.89 15.8566 20.265 15.8754 20.6307 15.8848C20.94 15.8941 21.2494 15.8848 21.5869 15.8848C21.5869 16.6066 21.5869 17.2723 21.5869 17.9473C22.1025 17.9473 22.5807 17.9473 23.0963 17.9473C23.0963 17.2629 23.0963 16.5973 23.0963 15.8848C23.8088 15.8848 24.4744 15.8848 25.1588 15.8848C25.1588 15.491 25.1588 15.116 25.1588 14.7316C25.1588 14.6098 25.1588 14.4879 25.1588 14.3566C24.615 14.3566 24.0619 14.3566 23.5088 14.3566Z" fill="white"/>
                <path d="M17.5746 14.1786C16.2714 14.1973 14.9683 14.1879 13.6652 14.1879C13.2902 14.1879 12.9152 14.1786 12.5496 14.1973C12.4746 14.1973 12.3527 14.2817 12.3527 14.3379C12.3433 15.0879 12.3433 15.8379 12.3433 16.6348C13.4214 16.6348 14.4621 16.6348 15.5402 16.6348C15.4933 16.7942 15.4746 16.8973 15.4371 17.0098C14.9496 18.4629 13.4496 19.1848 11.8371 18.9223C9.84019 18.5942 8.59332 16.7473 8.94957 14.7411C8.99644 14.4598 9.09019 14.1879 9.20269 13.9348C9.85894 12.4817 11.4996 11.6004 13.1121 11.9567C13.6933 12.0786 14.1808 12.3598 14.6121 12.7348C15.1933 12.1536 15.7558 11.5817 16.3558 10.9723C16.3183 10.9442 16.2621 10.9067 16.2058 10.8598C14.7996 9.66919 13.1777 9.22856 11.3683 9.52856C8.76207 9.95044 6.88707 12.0036 6.46519 14.4036C6.28707 15.4254 6.37144 16.5129 6.78394 17.5723C7.77769 20.1223 10.3371 21.6692 13.0746 21.3692C14.4058 21.2192 15.6058 20.7411 16.5339 19.7473C17.9121 18.2848 18.2589 16.5129 18.0433 14.5723C18.0058 14.2348 17.8746 14.1692 17.5746 14.1786Z" fill="white"/>
            </svg>
                Continue With Google
            </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Sign Up-->
<div class="modal fade" id="signUp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="signUpLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content py-3 px-4">
      <div class="modal-signup-header">
        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0 text-center">
        <img src-alt="logo nail360" lazy-src="<?php echo $_rootPath ?>/views/nail360/assets/img/logo/svg-logo.svg" />
        <h1 class="mulish-bold h-color login-title">Sign Up</h1>
        <p class="m-0 lh-16px p-color">Already have an account?</p>
        <button type="button" data-bs-toggle="modal" data-bs-target="#login" class="btn btn-link h-color">Sign In</button>
        <form class="">
        <div class="my-3">
                <label for="email" class="visually-hidden">Email address</label>
                <input type="email" class="form-control radius-300 h50px n360-border-color px-4" id="email" placeholder="name@example.com">
        </div>
        <div class="my-3">
            <button type="button" class="btn bg-main text-white mulish-bold w-100 radius-300 h50px"  data-bs-dismiss="modal">Continue</button>
        </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- Modal Forgot Password-->
<div class="modal fade" id="forgotpw" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="forgotpwLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="forgotpwLabel">Reset your password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <p>Enter your user account's verified email address and we will send you a password reset link.</p>
       <div class="input-group mb-3">
        <span class="input-group-text bg-main" id="basic-addon1">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path fill="#fff" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
        </span>
        <input type="email" class="form-control" placeholder="name@example.com" aria-label="Email" aria-describedby="basic-addon1">
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-outline-secondary mulish-bold" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn bg-main text-white mulish-bold"  data-bs-dismiss="modal">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path fill="#fff" d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg>
           Send</button>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
  // Handle login form submission with AJAX
  $('#login-form').submit(function(event) {
    event.preventDefault();
    $.ajax({
      url: "<?php echo $_adminApi; ?>/login",
      type: "POST",
      data : $(this).serialize(),
      success: function(response) {
        if( response.error === undefined ){
          document.cookie = 'token='+response.token+'; domain='+window._domain+'; path=/';
          
          // localStorage.setItem('token', response.token);
          // let currentTimeInMilliseconds = Date.now() + (_refreshminutes - 1) * 60 * 1000;
          // localStorage.setItem('refreshToken', currentTimeInMilliseconds);
          window.location.reload();
        }
        else if(response.error !== "")
          alert(response.error)
        },
        error: function(xhr, status, error ) {
          $("#login-invalid-feedback").html(xhr.responseJSON.error);
        }
    });
    return false;   
  });
});

</script>