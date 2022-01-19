<?php
require_once  '../events/components/db_connect.php';

if ($_POST) {
    $cat_name = $_POST['category_name'];
    $categoryId = $_POST['categoryId'];


    $sql = "UPDATE `category` SET `category_name`='$cat_name' WHERE categoryId = {$categoryId}";

    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "Category was successfully updated";
    } else {
        $class = "danger";
        $message = "Error while updating category : <br>" . $connect->error;
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
    <?php require_once '../events/components/_footer.php' ?>
    <?php require_once '../events/components//bootjs.php' ?>
</body>