<?php
session_start();
require_once 'events/components/db_connect.php';



$sql = "SELECT `events`.`event_name`, `events`.`eventId`, `teama`.`teamA_name`, `teamb`.`teamB_name`, `location`.`location_name`, `category`.`category_name`, `events`.`picture`
FROM `events` 
	LEFT JOIN `teama` ON `events`.`fk_teamA_Id` = `teama`.`teamId` 
	LEFT JOIN `teamb` ON `events`.`fk_teamB_Id` = `teamb`.`teamId` 
	LEFT JOIN `location` ON `events`.`fk_locationId` = `location`.`locationId` 
	LEFT JOIN `category` ON `events`.`fk_categoryId` = `category`.`categoryId` WHERE event_date < CURDATE();";


$result = mysqli_query($connect, $sql);



$eventDiv = "";
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

    $eventDiv .= "
        <div class='card mb-3 mx-auto p-0' style='max-width: 80%;'>
  <div class='row g-0'>
    <div class='col-md-4'>
      <img src='" . $row['picture'] . " ' class='img-fluid rounded-start' alt='...'>
    </div>
    <div class='col-md-8'>
      <div class='card-body'>
          <p class='fs-6 text-end text-warning' >" . $row['category_name'] . "</p>
          <p class='card-title fw-bold fs-2'>" . $row['teamA_name'] . " vs " . $row['teamB_name'] . "</p>
        <p class='card-text'>" . $row['location_name'] . "</p>
        <p class='card-text'>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis aliquam, iusto consequatur amet repellat at.</p>
        <a href='/details.php?eventId=" . $row['eventId'] . "'><button class='btn btn-danger btn-sm' type='button'>Details</button></a>
      </div>
    </div>
  </div>
</div>
";
  };
} else {
  $eventDiv = "<h2>No Events Available</h2>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Former Events</title>
  <?php require_once 'events/components/bootcss.php' ?>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body class="mx-auto">

  <?php require_once 'events/components/_navbar.php' ?>

  <div class="manageEvent mx-auto w-75 mt-3">
    <h2>Former Events</h2>
    <div class="d-flex justify-content-center row g-5 mx-auto">
      <?= $eventDiv; ?>
    </div>


  </div>

  <?php require_once 'events/components/_footer.php' ?>
  <?php require_once 'events/components/bootjs.php' ?>
</body>

</html>