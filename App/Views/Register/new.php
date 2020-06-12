<?php /** @var User $user */
use App\Models\User;

include(dirname(dirname(__FILE__)) . "/Default/website_head.html")

?>
<body>
<?php include(dirname(dirname(__FILE__)) . "/Default/navigation_new.php") ?>
<div class="food_container">
  <div class="row">
    <div class="col-6 offset-3">
      <h1>Register</h1>
      <form method="post" action="/register/create" id="formSignup">
        <div class="form-group">
          <input id="inputName" name="Name" placeholder="Name" autofocus value="<?php if (!empty($user->name)) {
              echo $user->name;
          } ?>" required class="form-control" />
        </div>
        <div class="form-group">
          <input id="inputEmail" name="Email" placeholder="email address" value=" <?php if (!empty($user->Email)) {
              echo $user->Email;
          } ?> " required type="email" class="form-control" />
        </div>
        <div class="form-group">
          <input type="password" id="inputPassword" name="Password" placeholder="Password" required class="form-control" />
        </div>
        <button type="submit" class="btn btn-primary">Sign up</button>

      </form>
    </div>
  </div>
</div>
</body>
