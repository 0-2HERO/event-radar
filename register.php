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
<?php require_once 'events/components/bootcss.php'?>
</head>
<body>
<div class="container">
  <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
           <h2>Sign Up.</h2>
           <hr/>
           <?php
           if (isset($errMSG)) {
           ?>
           <div class="alert alert-<?php echo $errTyp ?>" >
                        <p><?php echo $errMSG; ?></p>
                        
           </div>

           <?php
           }
           ?>

           

           
           <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value ="<?php echo $email ?>"  />
              <span  class="text-danger"> <?php echo $emailError; ?> </span>
           <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15"  />
              <span class="text-danger"> <?php echo $passError; ?> </span>
           <hr/>
           <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
           <hr/>
           <a href="login.php">Sign in Here...</a>
  </form>
  </div>
  <?php require_once 'events/components/bootjs.php'?>
</body>
</html>