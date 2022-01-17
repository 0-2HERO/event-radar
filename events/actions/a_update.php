<?php
require_once '../components/db_connect.php';
  
if ($_POST) {
    $name = $_POST['event_name'];
    $date = $_POST['event_date'];
    $time = $_POST['event_time'];
    $description = $_POST['description'];
    $teamA = $_POST['teamA_name'];
    $teamB = $_POST['teamB_name'];
    $picture = $_POST['picture'];
    $category = $_POST['category_name'];
    $location = $_POST['location_name'];
    $eventId = $_POST['eventId'];

    



    $sql = "UPDATE `events` SET `event_name`='$name',`event_date`='$event_date',`event_time`='$event_time',`description`='$description',`picture`='$picture',`fk_teamA_Id`='$teamA',`fk_teamB_Id`='$teamB',`fk_categoryId`='$category',`fk_locationId`='$location' WHERE eventId = {$eventId}";

        if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . $connect->error;
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../components/bootcss.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
          
            <a href='../update.php?id=<?= $id; ?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>
    <?php require_once '../components/bootjs.php' ?>
</body>