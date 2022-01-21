<?php
session_start();
require_once "events/components/db_connect.php";





$recbdy = "";

$recbdy = $resCat = $resLoc = $resA = $resB = "";

/* $maxcal = 2000; */

$sql = "SELECT `events`.`event_name`, `events`.`eventId`, `events`.`description` , `events`.`event_date` ,`events`.`event_time`,`teama`.`teamA_name`, `teamb`.`teamB_name`, `location`.`location_name`, `category`.`category_name`, `events`.`picture`
FROM `events` 
    LEFT JOIN `teama` ON `events`.`fk_teamA_Id` = `teama`.`teamId` 
    LEFT JOIN `teamb` ON `events`.`fk_teamB_Id` = `teamb`.`teamId` 
    LEFT JOIN `location` ON `events`.`fk_locationId` = `location`.`locationId` 
    LEFT JOIN `category` ON `events`.`fk_categoryId` = `category`.`categoryId`";
$res = mysqli_query($connect, $sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
        $recbdy .= "
       
       
        <div class='card mb-3 events-card border-0 mx-auto p-0 mt-5' style='max-width: 100%;'>
  <div class='row g-0'>
    <div class='col-md-4'>
      <img src='" . $row['picture'] . " ' class='img-fluid rounded-start' alt='event image' style='min-width: 100%;
      min-height: 80%'>
    </div>
    <div class='col-md-8'>
      <div class='card-body'>
          <p class='fs-6 text-end text-warning' >" . $row['category_name'] . "</p>
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

$sql2 = "SELECT `categoryId`, `category_name` FROM `category`;";
$result2 = mysqli_query($connect, $sql2);
if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
        $resCat .= "<option value='{$row2['categoryId']}'>" . $row2['category_name'] . "</option>";
    }
}
$sql3 = "SELECT `locationId`, `location_name` FROM `location`;";
$result3 = mysqli_query($connect, $sql3);
if ($result3->num_rows > 0) {
    while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)) {
        $resLoc .= "<option value='{$row3['locationId']}'>" . $row3['location_name'] . "</option>";
    }
}
$sql4 = "SELECT `teamId`, `teamA_name` FROM `teama`;";
$result4 = mysqli_query($connect, $sql4);
if ($result4->num_rows > 0) {
    while ($row4 = $result4->fetch_array(MYSQLI_ASSOC)) {
        $resA .= "<option value='{$row4['teamId']}'>" . $row4['teamA_name'] . "</option>";
    }
}
$sql5 = "SELECT `teamId`, `teamB_name` FROM `teamb`;";
$result5 = mysqli_query($connect, $sql5);
if ($result5->num_rows > 0) {
    while ($row5 = $result5->fetch_array(MYSQLI_ASSOC)) {
        $resB .= "<option value='{$row5['teamId']}'>" . $row5['teamB_name'] . "</option>";
    }
}



mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <?php require_once 'events/components/bootcss.php' ?>
    <link rel="stylesheet" href="css/styles.css">
    <style>
     
    </style>
</head>

<body class="">
    <?php require_once 'events/components/_navbar.php' ?>

    <div class="px-4 pt-5 my-5 text-center border-bottom">
    <h1 class="display-6 fw-bold">Calendar for sport events</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Events may be added to the calendar and categorized based on sports, teams and event location</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
      <p class="lead mb-4">User login credientals: user@mail.com password:123456</p>
      </div>
    </div>
    <div class="overflow-hidden" style="max-height: 30vh;">
      <div class="container px-5">
        <img src="https://user-images.githubusercontent.com/64213996/150086679-5ce71073-ad77-441d-a11d-1f9332fa535b.png" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
      </div>
    </div>
  </div>


   
    <h2 class="text-center my-5">Events</h2>
    <section class="container">
        <div class="row gx-5 ">
            <div class="col-md-3 h-50  pb-2 ">
                <legend class="lead fs-4">Filter options</legend>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                    
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-select">
                        <?php echo $resCat; ?>
                        <option value="all" selected>All</option>

                    </select>
                    <label for="location">Location</label>
                    <select name="location" id="location" class="form-select">
                        <?php echo $resLoc; ?>
                        <option value="all" selected>All</option>

                    </select>
                    </select>
                    <label for="teamA">Team A</label>
                    <select name="teamA" id="teamA" class="form-select">
                        <?php echo $resA; ?>
                        <option value="all" selected>All</option>

                    </select>
                    <label for="teamB">Team B</label>
                    <select name="teamB" id="teamB" class="form-select">
                        <?php echo $resB; ?>
                        <option value="all" selected>All</option>

                    </select>
                  
                    <button name="submit" id="filter-button" class="btn btn-primary  mt-2" type="submit"> Apply Filter</button>
                </form>
            </div>
            <div class="col-md-9">
                <div class="row gy-3" id="events">
                    <?php echo $recbdy; ?>

                </div>
            </div>

        </div>

    </section>


    <?php require_once 'events/components/bootjs.php' ?>
  
    <script>
        
        document.getElementById("filter-button").addEventListener("click", recFilter);
        function recFilter(e) {
            e.preventDefault();
         
            let category = document.getElementById("category").value;
            let location = document.getElementById("location").value;
            let teamA = document.getElementById("teamA").value;
            let teamB = document.getElementById("teamB").value;
            let params = `&category=${category}&location=${location}&teamA=${teamA}&teamB=${teamB}`;
            let request = new XMLHttpRequest(); //creating new request

            request.open("POST", "fetch.php", true); //connecting to the process.php file

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.onload = function() {
                if (this.status == 200) {
                    document.getElementById("events").innerHTML = this.responseText;

                }
            }
            request.send(params);
        }
    </script>

   <?php require_once 'events/components/bootjs.php' ?>
   <?php require_once 'events/components/_footer.php' ?>
</body>

</html>