<?php
session_start(); // start a new session or continues the previous

if (isset($_SESSION['user']) != "") {
    header("Location: events/index.php"); // redirects to home.php
}

require_once "events/components/db_connect.php";
$error = false;
$email =  $pass = '';
$emailError =  $passError = '';
if (isset($_POST['btn-signup'])) {



    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);


    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);



    //basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {
        // checks whether the email exists or not
        $query = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }

    // password validation
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter password.";
    } else if (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }

    // password hashing for security
    $password = hash('sha256', $pass);
    // if there's no error, continue to signup
    if (!$error) {

        $query = "INSERT INTO user(email, password)
                 VALUES('$email','$password')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
        }
    }
}


mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration System</title>
    <?php require_once 'events/components/bootcss.php' ?>
</head>
<style>
    .login, 
.image {
    min-height: 100vh
}

.bg-image {
    background-color: #0B0D4B;
    background-size: cover;
    background-position: center;
    min-width: 55%;
}
/* form log in  */



</style>
<body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-md-7 d-none d-md-flex bg-image d-flex justify-content-center align-items-center">
            <h1 class="text-danger display-4">Eventradar</h1>
            </div>
            
            <div class="col-md-5 bg-light">
                <div class="login d-flex align-items-center  py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-xl-6 mx-auto">
                                <h3 class="display-4">Register</h3> <br>
                                <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">

                                    <?php
                                    if (isset($errMSG)) {
                                    ?>
                                        <div class="alert alert-<?php echo $errTyp ?>">
                                            <p><?php echo $errMSG; ?></p>

                                        </div>

                                    <?php
                                    }
                                    ?>



                                    <div class="form-group mb-3">

                                        <input type="email" name="email" class="form-control rounded-pill" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
                                        <span class="text-danger"> <?php echo $emailError; ?> </span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" name="pass" class="form-control rounded-pill" placeholder="Enter Password" maxlength="15" />
                                        <span class="text-danger"> <?php echo $passError; ?> </span>
                                        <hr />
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3"> <button type="submit" class="btn btn-block btn-danger rounded-3" name="btn-signup">Create account</button></div>
                                    <div class="text-center d-flex justify-content-between mt-4">
                                        <p> OR &nbsp<a href="login.php" class="font-italic text-muted"> <u>Sign In</u></a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php require_once 'events/components/bootjs.php' ?>
</body>

</html>