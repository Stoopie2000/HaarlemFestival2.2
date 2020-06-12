<?php
    use App\Config;

    require 'inc/header.php';

    echo '<div class="navbar1"></div>';
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
                <input type="text" name="email" placeholder="Email address" autofocus value="<?php if (isset($email)) echo ($email);?>" class="form-control <?php if (isset($email_err)) if ($email_err != "") echo "is-invalid";?>" />
                <span class="invalid-feedback"><?php if (isset($email_err)) echo $email_err; ?></span>
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
                <a href="<?php echo Config::URLROOT; ?>/cms/login" class="float-left">Already have a account? login</a>
            </div>
            
        </form>
    </div>
    <?php
        if (isset($user_err)) {
            echo "<script type='text/javascript'>alert('";
            foreach ($user_err as $error) {
                echo "* " . $error . "\\n";
            }
            echo "');</script>";
        }
    ?>
</div>

<?php
    require 'inc/footer.html';
?>
