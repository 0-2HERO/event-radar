<?php
session_start();
require_once "events/components/db_connect.php";


if (isset($_SESSION['user'])) {
    header("Location: ../events/index.php");
    exit;
 }
 
 
 
 
 $error = false;
 $email = $password = $emailError = $passError = '';
 
 if (isset($_POST['btn-login'])) {
 
    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
 
    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs
 
    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }
 
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }
 
    // if there's no error, continue to login
    if (!$error) {
 
        $password = hash('sha256', $pass); // password hashing
 
        $sql = "SELECT userId, password, status FROM user WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        if ($count == 1 && $row['password'] == $password) {
            if($row['status'] == 'user'){
            $_SESSION['user'] = $row['userId'];          
            header( "Location: ../events/index.php");}
    
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
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
 <?php require_once 'events/components/bootcss.php'?>
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


.bg-imagetwo {
    background-color: #0B0D4B;
    background-size:cover;
    background-position:center;
    min-width: 55%;
    
}
</style>
 <body>


 <div class="container-fluid">
                <div class="row no-gutter">
                    <div class="col-md-7 d-none d-md-flex bg-image d-flex justify-content-center align-items-center">
                       <h1 class="text-danger display-4">Eventradar</h1>
                    </div>
                    <div class="col-md-5 bg-light">
                        <div class="login d-flex align-items-center py-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7 col-xl-6 mx-auto">
                                        <h3 class="display-4">Sign in</h3> <br>
                                        <form class="w-50" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" >
            <?php
            if (isset($errMSG)) {
                echo $errMSG;
            }
            ?>
          <div class="form-group mb-3"> <input type="email" autocomplete="off" name="email" class="form-control  rounded-pill border-0 shadow-sm px-4 " placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" /> <span class="text-danger"><?php echo $emailError; ?></span> </div>
                                            <div class="form-group mb-3"> <input type="password" name="pass" class="form-control rounded-pill border-0 shadow-sm px-4 text-danger" placeholder="Your Password" maxlength="15" /> <br> <span class="text-danger"><?php echo $passError; ?></span> </div>
                                            <div class="custom-control custom-checkbox mb-3"> <button class="btn btn-block btn-primary" type="submit" name="btn-login">Sign In</button></div>
                                            <div class="text-center d-flex justify-content-between mt-4">
                                                <p> OR &nbsp<a href="register.php" class="font-italic text-muted"> <u>Create Account</u></a></p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 </body>
 </html>


 