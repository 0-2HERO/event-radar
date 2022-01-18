<?php
require_once "../../events/components/db_connect.php";


if ($_POST) {
    $team_name = $_POST['teamA_name'];
    $logo = $_POST['logo'];
    $category = $_POST['category_name'];


    $sql = "INSERT INTO `teama`(`teamA_name`, `logo`, `fk_categoryId`) VALUES ('$team_name','$logo','$category')";

    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "Event was successfully created <br>
            <table class='table w-50'>
            <tr>
            <td> $team_name </td>
             </tr>
            </table>
            <hr>";
    } else {
        $class = "danger";
        $message = "Error while creating Team. Try again: <br>" . $connect->error;;
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
    <?php require_once  '../../events/components/bootcss.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <a href="../createTeamB.php"><button class='btn btn-success' type="button"> Create Team B </button></a>
            <a href=/events/index.php><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
        </div>

        <?php require_once  '../../events/components/bootjs.php' ?>
</body>

</html>