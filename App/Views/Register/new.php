<?php /** @var User $user */
use App\Models\User;

?>
<form method="post" action="/register/create" id="formSignup">

    <div class="form-group">
        <label for="inputName">Name</label>
        <input id="inputName" name="Name" placeholder="Name" autofocus value="<?php if (!empty($user->name)) {
    echo $user->name;
} ?>" required class="form-control" />
    </div>
    <div class="form-group">
        <label for="inputEmail">Email address</label>
        <input id="inputEmail" name="Email" placeholder="email address" value=" <?php if (!empty($user->Email)) {
    echo $user->Email;
} ?> " required type="email" class="form-control" />
    </div>
    <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" id="inputPassword" name="password" placeholder="Password" required class="form-control" />
    </div>
    <button type="submit" class="btn btn-default">Sign up</button>

</form>