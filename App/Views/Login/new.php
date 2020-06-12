<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
    <?php include(dirname(dirname(__FILE__)) . "/Default/website_head.html");?>
</head>
<body id="loginAndRegisterPage" >
<?php include(dirname(dirname(__FILE__)) . "/Default/navigation_new.php") ?>
<div class="food_container">
    <div class="row mb-3">
        <div class="col-8 offset-2">
            <h1 class="h1">Log in</h1>
        </div>
    </div>
    <div class="row">
      <div class="col-4 offset-2 login-container ">
          <p><b>Existing users</b></p>
          <form action="/login/create" method="post">
              <div class="form-group">
                  <input type="text" name="Email" placeholder="Email address" autofocus required value="<?php if (isset($email)) {
                      echo($email);
                  }?>" class="form-control" />
              </div>
              <div class="form-group">
                  <input type="password" id="inputPassword" name="Password" placeholder="Password" class="form-control" required/>
                  <a class="small" href="/password/forgot">Forgot password?</a>
              </div>
              <div class="checkbox">
                  <label>
                      <input type="checkbox" name="Remember_me" <?php if (isset($remember_me) && $remember_me) {
                          echo('checked="checked"');
                      } ?> /> Remember me
                  </label>
              </div>
              <button type="submit" class="btn btn-primary float-right">Log in</button>
          </form>
      </div>
        <div class="col-4 register-container">
            <p><b>Don't have an account yet?</b><br>Create one to order tickets!</p>
            <form method="post" action="/register/create" id="formSignup">
                <div class="form-group">
                    <input id="inputName" name="Name" placeholder="Full name" value="<?php if (!empty($user->Name)) {
                        echo $user->Name;
                    } ?>" required class="form-control" />
                </div>
                <div class="form-group">
                    <input id="inputEmail" name="Email" placeholder="Email address" value=" <?php if (!empty($user->Email)) {
                        echo $user->Email;
                    } ?> " required type="email" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="password" id="inputPassword" name="Password" placeholder="Password" required class="form-control" />
                </div>

                <!--Start Google Captcha-->
                <div class="g-recaptcha" data-sitekey="6Le3qKMZAAAAAK96RVEhDBukCzpYbq8cPo6xffnZ"></div>
                <br/>
                <!--End Google Captcha-->

                <button  type="submit" class="btn btn-secondary float-right">Sign up</button>
            </form>
        </div>
    </div>
</div>
<?php include_once (__DIR__ . "/../Default/flash_alerts.php")?>
</body>
</html>

<script rel="script" src="/js/disableButton.js"></script>