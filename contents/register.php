<?php include '../inc/header.php' ?>
<?php


$name = $email = $password = $confirm_password = '';
$err_name = $err_email = $err_password = $err_confirm_password = $err_pass = '';

if (isset($_POST['submit'])) {
    //name 

    if (empty($_POST['name'])) {
        $err_name = "Please Put in your name";
    } else {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    // email

    if (empty($_POST['email'])) {
        $err_email = "Please put in your email";
    } elseif ($conn->errno === 1062) {
        $err_email = "Email already taken";
    } else {
        $email =  filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }

    //password
    if (empty($_POST['password'])) {
        $err_password = "Please put in your password";
    } else {
        if (strlen($_POST['password']) < 8) {
            $err_password = "* Password must be at least 8 characters";
        } else {
            $password = htmlspecialchars($_POST['password']);
        }
    }

    //confirm password

    if (empty($_POST['confirm_password'])) {
        $err_confirm_password = "Please put in confirm password";
    } else {
        $confirm_password =  htmlspecialchars($_POST['confirm_password']);
    }

    //two password verification

    if ($password != $confirm_password) {
        $err_pass = "Passwords does not match!";
    }

    if (empty($err_name) && empty($err_email) && empty($err_pass) && empty($err_confirm_password)  && empty($err_password)) {
        $ins = "insert into `admins` (name, email, password) values ('$name', '$email', '$password')";
        $result = $conn->query($ins);
        if ($result) {
            $message = "Another Admin added successfully!";
            // header('Location: index.php');
        } else {
            $message = 'Error: ' . $conn->error;
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Create Account</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <?php if (!empty($message)) : ?>
                        <div class="bg-success text-center text-white" style="background-color: green; color: white; text-align: center; width: 100%;"><?php echo $message; ?></div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" id="inputFirstName" value="<?php echo $name ?>" type="text" name="name" placeholder="Enter your first name" />
                                <label for="inputFirstName">First name</label>
                            </div>
                            <div style="color: red; font-size: 10px;"><?php echo $err_name; ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control" id="disabledInput" type="text" placeholder="Enter your last name" disabled />
                                <label for="inputLastName">Last name</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputEmail" type="email" value="<?php echo $email ?>" name="email" placeholder="name@example.com" />
                        <label for="inputEmail">Email address</label>
                        <div style="color: red; font-size: 10px;"><?php echo $err_email; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control myinput" id="inputPassword" name="password" type="password" placeholder="Create a password" />
                                <label for="inputPassword">Password</label>
                            </div>
                            <div style="color: red; font-size: 10px;"><?php echo $err_password; ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" id="inputPasswordConfirm" name="confirm_password" type="password" placeholder="Confirm password" />
                                <label for="inputPasswordConfirm">Confirm Password</label>

                            </div>
                            <div style="color: red; font-size: 10px;"><?php echo $err_confirm_password; ?></div>
                            <!-- An element to toggle between password visibility -->
                            <input type="checkbox" id="check"> Show Password
                        </div>
                    </div>
                    <?php if ($password != $confirm_password) : ?>
                        <div style="color: red;  font-size: 10px;"><?php echo $err_pass; ?></div>
                    <?php endif; ?>
                    <div class="mt-4 mb-0">
                        <div class="d-grid"><input class="btn btn-primary btn-block" value="Create Account" type="submit" name="submit"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php include '../inc/footer.php' ?>