<?php
session_start();
require_once 'events/components/db_connect.php';

if (isset($_SESSION['user'])) {
    header("Location: ../events/index.php");
    exit;
 }

         if ($_GET['eventId']) {
            $eventId = $_GET['eventId'];
            $sql = "SELECT `events`.*, `category`.*, `location`.*, `teama`.*, `teamb`.*
            FROM `events` 
                LEFT JOIN `category` ON `events`.`fk_categoryId` = `category`.`categoryId` 
                LEFT JOIN `location` ON `events`.`fk_locationId` = `location`.`locationId` 
                LEFT JOIN `teama` ON `events`.`fk_teamA_Id` = `teama`.`teamId` 
                LEFT JOIN `teamb` ON `events`.`fk_teamB_Id` = `teamb`.`teamId` WHERE eventId = {$eventId}";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) == 1) {
                $data = mysqli_fetch_assoc($result);
                $name = $data['event_name'];
                $date = $data['event_date'];
                $time = $data['event_time'];
                $description = $data['description'];
                $teamA = $data['teamA_name'];
                $teamB = $data['teamB_name'];
                $picture = $data['picture'];
                $category = $data['category_name'];
                $location = $data['location_name'];
                $street = $data['street'];
                $streetNo = $data['street_no'];
                $city = $data['city'];
                $zipCode = $data['zip_code'];
         $result = mysqli_query($connect ,$sql);


            }}
  
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $name; ?></title>
    <?php require_once 'events/components/bootcss.php' ?>
    <link rel="stylesheet" href="css/styles.css">
    
</head>

<body>
<?php  require_once 'events/components/_navbar.php'?>

<div class='container mt-5'>
        <h2><?php echo $category ?> team details</h2> 
    </div>
    <div class='container mt-5' id='detail'>
        <div class='row g-5'>
            <div class='col-lg-6 col-md-6 col-sm-12'>
                <div class='card border-0'>
                    <img src='<?php echo $picture ?>' class='card-img-top'>
                    <div class='card-body'>
                        <h1 class='card-title text-center fw-lighter'><?php echo $teamA ?> vs <?php echo $teamB ?></h1>
                        <h4 class='card-subtitle mb-2 mt-3 fw-normal'><?php echo $location ?></h4>
                        <p class='card-subtitle mb-2 mt-3 fw-light'><?php echo $date ?> <?php echo $time ?></p>
                        <p class='card-subtitle mb-2 mt-3'><?php echo $street ?> <?php echo $streetNo ?></p>
                        <p class='card-subtitle mb-2 mt-3'><?php echo $city ?> <?php echo $zipCode ?></p>
                        <h5 class='card-text'>Description:</h5>
                        <p class='card-text fw-lighter'><?php echo $description ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div> 


    <?php require_once 'events/components/_footer.php' ?>           
    <?php require_once 'events/components/bootjs.php' ?>

 
</body>

</html>
