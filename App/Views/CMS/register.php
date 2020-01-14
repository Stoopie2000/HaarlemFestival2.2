<?php
    use App\Config;

    require 'inc/header.php';

    // if login than show nav
    if (true) {
        require 'inc/nav.php';
    // require 'inc/account.php';
    } else {
        echo '<div class="navbar1"></div>';
    }
?>

<div class="content">
<div class="container">
    <div class="form" id="register">
        <H1 class="text-center">Register</H1>

        <form action="<?php echo Config::URLROOT; ?>/cms/register" method="post">
            <div class="form-group row">
                <div class="col">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" placeholder="First Name" autofocus value="<?php if (isset($firstName)) echo ($firstName);?>" class="form-control <?php if (isset($firstName)) if ($firstName == "") echo "is-invalid";?>" />
                    <span class="invalid-feedback">Please fill in your first name</span>
                </div>
                <div class="col">
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" placeholder="Last Name" autofocus value="<?php if (isset($lastName)) echo ($lastName);?>" class="form-control <?php if (isset($lastName)) if ($lastName == "") echo "is-invalid";?>" />
                    <span class="invalid-feedback">Please fill in your last name</span>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail">Email address:</label>
                <input type="text" name="email" placeholder="Email address" autofocus value="<?php if (isset($email)) echo ($email);?>" class="form-control <?php if (isset($email)) if ($email == "") echo "is-invalid";?>" />
                <span class="invalid-feedback">Please fill in your email address</span>
            </div>

            <div class="form-group">
                <label for="inputPassword">Password:</label>
                <input type="password" id="inputPassword" name="password" placeholder="Password" class="form-control <?php if (isset($pass_err)) if ($pass_err != "") echo "is-invalid";?>" />
                <span class="invalid-feedback">please fill in a password</span>
            </div>

            <div class="form-group">
                <label for="confpassword">Confirm Password:</label>
                <input type="password" id="inputConfPassword" name="confpassword" placeholder="Confirm password" class="form-control <?php if (isset($confpass_err)) if ($confpass_err != "") echo "is-invalid";?>" />
                <span class="invalid-feedback"><?php if (isset($confpass_err)) echo $confpass_err; ?></span>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary text-center">Register</button>
            </div>

            <div class="form-group">
                <a href="/password/forgot" class="float-left">Forgot password?</a>
                <a href="/password/forgot" class="float-right">No account? Register</a>
            </div>
            
        </form>
    </div>

    <div class="form" id="forgotPass" hidden>
        <H1 class="text-center">Log in</H1>

        <form action="/login/create" method="post">

            <div class="form-group">
                <label for="inputEmail">Email address:3</label>
                <input type="text" name="email" placeholder="Email address" autofocus value="<?php if (isset($username)) echo ($username);?>" class="form-control" />
            </div>

            <div class="form-group">
                <label for="inputPassword">Password:</label>
                <input type="password" id="inputPassword2" name="password" placeholder="Password" class="form-control" />
            </div>

            <div class="checkbox">
            <label>
                <input type="checkbox" name="remember_me" <?php if (isset($remember_me) && $remember_me) {echo ('checked="checked"');} ?> /> Remember me
            </label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary text-center">Log in</button>
            </div>
            <a href="/password/forgot" class="float-left">Forgot password?</a>
            <a href="/password/forgot" class="float-right">No account? Register</a>
        </form>
    </div>
</div>
</div>

<?php
    require 'inc/footer.html';
?>
