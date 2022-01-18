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




    $sql = "INSERT INTO `events`(`event_name`, `event_date`,`event_time`, `description`, `picture`, `fk_teamA_Id`, `fk_teamB_Id`, `fk_categoryId`, `fk_locationId`) 
    VALUES ('$name','$date','$$time','$description','$picture','$teamA','$teamB','$category','$location')";

    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "Event was successfully created <br>
            <table class='table w-50'><tr>
            <td> $name </td>
            <td> $date </td>
            <td> $time </td>
            </tr></table><hr>";
    } else {
        $class = "danger";
        $message = "Error while creating Event. Try again: <br>" . $connect->error;;
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
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>

            <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>