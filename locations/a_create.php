<?php
require_once "../events/components/db_connect.php";


if ($_POST) {
    $loc_name = $_POST['location_name'];
    $street = $_POST['street'];
    $street_no = $_POST['street_no'];
    $city = $_POST['city'];
    $zip_code = $_POST['zip_code'];


    $sql = "INSERT INTO `location`(`location_name`, `street`, `street_no`, `city`, `zip_code`) VALUES ('$loc_name','$street','$street_no','$city','$zip_code')";

    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "Location was successfully created <br>
            <table class='table w-50'>
            <tr>
            <td> $loc_name </td>
             </tr>
            </table>
            <hr>";
    } else {
        $class = "danger";
        $message = "Error while creating location. Try again: <br>" . $connect->error;;
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
    <?php require_once  '../events/components/bootcss.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <a href=/events/index.php><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>

    <?php require_once  '../events/components/bootjs.php' ?>
</body>

</html>