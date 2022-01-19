<?php

session_start();
require_once 'components/db_connect.php';

if( !isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
   }


if ($_GET['eventId']) {
    $eventId = $_GET['eventId'];
    $sql = "SELECT * FROM events WHERE eventId = {$eventId}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data['event_name'];
        $date = $data['event_date'];
        $time = $data['event_time'];
        $description = $data['description'];
        $teamA = $data['fk_teamA_Id'];
        $teamB = $data['fk_teamB_Id'];
        $picture = $data['picture'];
        $category = $data['fk_categoryId'];
        $location = $data['fk_locationId'];
     

        $resultList = mysqli_query($connect, "SELECT * FROM category");
        $categoryList = "";
        if (mysqli_num_rows($resultList) > 0) {
            while ($row = $resultList->fetch_array(MYSQLI_ASSOC)) {
                if ($row['categoryId'] == $category) {
                    $categoryList .= "<option selected value='{$row['categoryId']}'>{$row['category_name']}</option>";
                } else {
                    $categoryList .= "<option value='{$row['categoryId']}'>{$row['category_name']}</option>";
                }
            }
        } else {
            $categoryList = "<li>There are no categories available</li>";
        }
    } else {
        header("location: error.php");
    }
} 

$resultList = mysqli_query($connect, "SELECT * FROM teama");
$teamAlist = "";
if (mysqli_num_rows($resultList) > 0) {
    while ($row = $resultList->fetch_array(MYSQLI_ASSOC)) {
        if ($row['teamId'] == $teamA) {
            $teamAlist .= "<option selected value='{$row['teamId']}'>{$row['teamA_name']}</option>";
        } else {
            $teamAlist .= "<option value='{$row['teamId']}'>{$row['teamA_name']}</option>";
        }
    }
} else {
    $teamAlist = "<li>There are no categories available</li>";
}

$resultList = mysqli_query($connect, "SELECT * FROM teamb ");
$teamBlist = "";
if (mysqli_num_rows($resultList) > 0) {
    while ($row = $resultList->fetch_array(MYSQLI_ASSOC)) {
        if ($row['teamId'] == $teamB) {
            $teamBlist .= "<option selected value='{$row['teamId']}'>{$row['teamB_name']}</option>";
        } else {
            $teamBlist .= "<option value='{$row['teamId']}'>{$row['teamB_name']}</option>";
        }
    }
} else {
    $teamBlist = "<li>There are no categories available</li>";
}

$resultList = mysqli_query($connect, "SELECT * FROM location");
$locationList = "";
if (mysqli_num_rows($resultList) > 0) {
    while ($row = $resultList->fetch_array(MYSQLI_ASSOC)) {
        if ($row['locationId'] == $location) {
            $locationList .= "<option selected value='{$row['locationId']}'>{$row['location_name']}</option>";
        } else {
            $locationList .= "<option value='{$row['locationId']}'>{$row['location_name']}</option>";
        }
    }
} else {
    $locationList = "<li>There are no categories available</li>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <?php  require_once 'components/bootcss.php'?>
</head>

    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }
    
</style>
<body>

    <fieldset>
        <legend class='h2'>Update Event<img class='img-thumbnail rounded-circle' src='<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
        <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Event name</th>
                    <td><input class='form-control' type="text" name="event_name" placeholder="Event Name" value="<?php echo $name ?>" /></td>
                </tr>

                <tr>
                    <th>Event date</th>
                    <td><input class='form-control' type="date" name="event_date" value="<?php echo $date ?>" /></td>
                    
                </tr>
                <tr>
                    <th>Time</th>
                    <td><input class='form-control' type="time" name="event_time" value="<?php echo $time ?>" /></td>
                    
                </tr>

                <tr>
                    <th>Event description</th>
                    <td><input class='form-control' type="text" name="description" value="<?php echo $description ?>" /></td>
                </tr>

                <tr>
                    <th> Event picture </th>
                    <td><input class='form-control' type="text" name="picture" value="<?php echo $picture ?>" /></td>
                </tr>
                <tr>
                    <th>Team A </th>
                    <td>
                        <select class="form-select" name="teamA_name" aria-label="Default select example">
                            <?php echo $teamAlist; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Team B </th>
                    <td>
                        <select class="form-select" name="teamB_name" aria-label="Default select example">
                            <?php echo $teamBlist; ?>
                        </select>
                    </td>
                </tr>


                <tr>
                    <th>Category </th>
                    <td>
                        <select class="form-select" name="category_name" aria-label="Default select example">
                            <?php echo $categoryList; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Location </th>
                    <td>
                        <select class="form-select" name="location_name" aria-label="Default select example">
                            <?php echo $locationList; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                <td> <input   type = "hidden"   name = "eventId"   value="<?php echo $data['eventId'] ?>" /></td>

                        <input type = "hidden" name= "picture" value = "<?php echo $data['picture'] ?>" />
                        <td><button class="btn btn-success"  type= "submit">Save Changes</button ></td>
                       <td><a href= "index.php"><button class="btn btn-warning" type ="button">Back</button></a></td>
                    </tr>

            </table>
        </form>
    </fieldset>


    <?php  require_once 'components/_footer.php'?>
    <?php  require_once 'components/bootjs.php'?>
</body>

</html>