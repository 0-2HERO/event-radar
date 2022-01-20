<?php 

$hostname = "127.0.0.1"; //173.212.235.205
$username = "root"; // alexanda_alex
$password = ""; //eventradar1
$dbname = "eventradar"; //alexanda_eventradar

$connect = mysqli_connect($hostname, $username, $password, $dbname);

if(mysqli_connect_error()){
    die("Connection failed");
} 

//else {
  //  echo "Successfully Connected";
//}

?>