<?php
require_once  '../../events/components/db_connect.php';
  
if ($_POST) {
    $teama_name = $_POST['teamA_name'];
    $logo = $_POST['logo'];
    $category = $_POST['category_name'];
    $teamId = $_POST['teamId'];


    $sql = "UPDATE `teama` SET `teamA_name`='$team_name',`logo`='$logo',`fk_categoryId`='$category' WHERE teamId = {$teamId}";

        if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "Team was successfully updated";
    } else {
        $class = "danger";
        $message = "Error while updating team : <br>" . $connect->error;
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
    <title>Update Team</title>
    <?php require_once '../../events/components/bootcss.php' ?>
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
    <?php require_once '../../events/components//bootjs.php' ?>
</body>