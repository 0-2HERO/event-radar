<?php
session_start();
require_once 'components/db_connect.php';

if( !isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
   }

if ($_GET["eventId"]) {
    $eventId = $_GET["eventId"];
    $sql = "SELECT * FROM events WHERE eventId = {$eventId}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data["event_name"];
        $date = $data["event_date"];
        $time = $data["event_time"];
        $description = $data["description"];
        $teamA = $data["fk_teamA_Id"];
        $teamB = $data["fk_teamB_Id"];
        $picture = $data["picture"];
        $category = $data["fk_categoryId"];
        $location = $data["fk_locationId"];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Event</title>
    <?php require_once "components/bootcss.php" ?>
    <style type="text/css">
        fieldset {
            margin-top: 100px;
            width: 60%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }
    
</style>
</head>

<body>


 

        <div class="mt-5 mx-auto" >
            <fieldset class="mx-auto">
                <legend class="h2 mb-3"> Delete request <img class="img-thumbnail rounded-circle"  src="<?php echo $picture ?>" alt="<?php echo $name ?>"></legend>
                <h5 class="mb-5 ">You have selected the data below:</h5>
                    <table class="table w-75 mt-3 text-center">
                        <tr>
                            <td><h4 ><?php echo  $name ?></h4></td>
                        </tr>
                    </table>
                    <h5 class="mt-4 ">Do you really want to delete this event? </h5>
                    <form class="mt-3" action="actions/a_delete.php" method="post">
                        <input type="hidden" name="eventId" value="<?php echo $eventId ?>" />
                        <input type="hidden" name="picture" value="<?php echo $picture ?>" />
                        <button class="btn btn-danger" type="submit"> Yes, delete it! </button>

                    <a href="../index.php"><button class="btn btn-warning text-decoration-none" type="button"> No, go back! </button></a>
                    </form>
            </fieldset>
        </div>


    <?php require_once "components/bootjs.php" ?>
</body>

</html>