<?php
require_once  '../events/components/db_connect.php';
  
if ($_POST) {
    $loc_name = $_POST['location_name'];
    $street = $_POST['street'];
    $street_no = $_POST['street_no'];
    $city = $_POST['city'];
    $zip_code = $_POST['zip_code'];
    $locationId = $_POST['locationId'];


    $sql = "UPDATE `location` SET `location_name`='$loc_name',`street`='$street',`street_no`='$street_no',`city`='$city',`zip_code`='$zip_code' WHERE locationId = {$locationId}";

        if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "Location was successfully updated";
    } else {
        $class = "danger";
        $message = "Error while updating location : <br>" . $connect->error;
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
    <title>Update location</title>
    <?php require_once '../events/components/bootcss.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
          
            <a href='../update.php?id=<?= $id; ?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='/events/index.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>
    <?php require_once '../events/components//bootjs.php' ?>
</body>