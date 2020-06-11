<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Log in</title>
</head>
<body>
<h1>Log in</h1>

<form action="/login/create" method="post">

  <div class="form-group">
    <label for="inputEmail">Email address</label>
    <input type="text" name="Email" placeholder="Email address" autofocus value="<?php if (isset($username)) {
    echo($username);
}?>" class="form-control" />
  </div>
  <div class="form-group">
    <label for="inputPassword">Password</label>
    <input type="password" id="inputPassword" name="Password" placeholder="Password" class="form-control" />
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="Remember_me" <?php if (isset($remember_me) && $remember_me) {
    echo('checked="checked"');
} ?> /> Remember me
    </label>
  </div>

  <button type="submit" class="btn btn-default">Log in</button>
  <a href="/password/forgot">Forgot password?</a>

    <a href="/register/new">No account? Register here!</a>
</form>
</body>
</html>