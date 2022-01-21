<?php
session_start();
require_once "events/components/db_connect.php";

 $insertCat = $insertLoc = $insertA = $insertB = "";

if (isset($_POST['category']) && isset($_POST['location']) && isset($_POST['teamA']) && isset($_POST['teamB']) ) {
   
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $location = mysqli_real_escape_string($connect, $_POST['location']);
    $teamA = mysqli_real_escape_string($connect, $_POST['teamA']);
    $teamB = mysqli_real_escape_string($connect, $_POST['teamB']);
   
   
    if ($category == "all") {
        $insertCat = " 1 ";
    }  else {
        $insertCat = " categoryId='$category' ";
    }

    if ($location == "all") {
        $insertLoc = " 1 ";
    }  else {
        $insertLoc = " fk_locationId='$location' ";
    }
    if ($teamA == "all") {
        $insertA = " 1 ";
    }  else {
        $insertA = " fk_teamA_Id='$teamA' ";
    }
    if ($teamB == "all") {
        $insertB = " 1 ";
    }  else {
        $insertB = " fk_teamB_Id='$teamB' ";
    }
    $sql = "SELECT `events`.*, `category`.*, `location`.`locationId`, `location`.`location_name`, `teama`.`teamId`, `teama`.`teamA_name`, `teamb`.`teamId`, `teamb`.`teamB_name`
    FROM `events` 
        LEFT JOIN `category` ON `events`.`fk_categoryId` = `category`.`categoryId` 
        LEFT JOIN `location` ON `events`.`fk_locationId` = `location`.`locationId` 
        LEFT JOIN `teama` ON `events`.`fk_teamA_Id` = `teama`.`teamId` 
        LEFT JOIN `teamb` ON `events`.`fk_teamB_Id` = `teamb`.`teamId` WHERE " . $insertCat . "AND" . $insertLoc . "AND" . $insertA . "AND" . $insertB . ";";
    $recbdy = "";


    $res = mysqli_query($connect, $sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
             $recbdy .= 
             "
          
            <div class='card mb-3 events-card border-0 mx-auto p-0 mt-5' style='max-width: 100%;'>
      <div class='row g-0'>
        <div class='col-md-4'>
          <img src='" . $row['picture'] . " ' class='img-fluid rounded-start' alt='event image' style='min-width: 100%;
          min-height: 80%'>
        </div>
        <div class='col-md-8'>
          <div class='card-body'>
              <p class='fs-6 text-end text-warning' >" . $row['category_name'] . " </p>
              <p class='card-title fs-2 fw-bold text-dark'>" . $row['teamA_name'] . " vs " . $row['teamB_name'] . "</p>
              <span> <p class='card-text fw-bold text-primary'>" . $row['event_name'] . "</p> " . $row['location_name'] . " </span>
            <p class='card-text'>" . $row['description'] . "</p>
            <a href='details.php?eventId=" . $row['eventId'] . "'><button class='btn btn-danger btn-sm' type='button'>Details</button></a>
          </div>
        </div>
      </div>
    </div>
    ";
        }
    }
    echo $recbdy;
}