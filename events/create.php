<?php

require_once 'components/db_connect.php';

$category = "";
$teamA = "";
$teamB = "";
$location = "";

$resultCat = mysqli_query($connect, "SELECT * FROM category");

while ($row = $resultCat->fetch_array(MYSQLI_ASSOC)) {

    $category .=
        "<option value='{$row['categoryId']}'>{$row['category_name']}</option>";
}


$resultTeam = mysqli_query($connect, "SELECT `teama`.*
FROM `teama`;");

while ($row = $resultTeam->fetch_array(MYSQLI_ASSOC)) {

    $teamA .=
        "<option value='{$row['teamId']}'>{$row['teamA_name']}</option>";
}


$resultTeam = mysqli_query($connect, "SELECT `teamb`.*
FROM `teamb`;");

while ($row = $resultTeam->fetch_array(MYSQLI_ASSOC)) {

    $teamB .=
        "<option value='{$row['teamId']}'>{$row['teamB_name']}</option>";
}



$resultLoc = mysqli_query($connect, "SELECT * FROM `location`");

while ($row = $resultLoc->fetch_array(MYSQLI_ASSOC)) {

    $location .=
        "<option value='{$row['locationId']}'>{$row['location_name']}</option>";
}
var_dump($teamA);
var_dump($teamB)

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once  'components/bootcss.php' ?>
    <title>Document</title>
</head>

<body>

    </head>

    <body>
        <fieldset class="mx-auto  mt-5" style="width: 60%;">
            <legend class='h2'>New Event</legend>
            <form action="actions/a_create.php" method="post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Event name</th>
                        <td><input class='form-control' type="text" name="event_name" placeholder="Event Name" /></td>
                    </tr>

                    <tr>
                        <th>Event date</th>
                        <td><input class='form-control' type="date" name="event_date" /></td>
                    </tr>
                    <tr>
                        <th>Event time</th>
                        <td><input class='form-control' type="time" name="event_time" /></td>
                    </tr>

                    <tr>
                        <th>Event description</th>
                        <td><input class='form-control' type="text" name="description" /></td>
                    </tr>

                    <tr>
                        <th> Event picture </th>
                        <td><input class='form-control' type="text" name="picture" /></td>
                    </tr>
                    <tr>
                        <th>Team A </th>
                        <td>
                            <select class="form-select" name="teamA_name" aria-label="Default select example">
                                <?php echo $teamA; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Team B </th>
                        <td>
                            <select class="form-select" name="teamB_name" aria-label="Default select example">
                                <?php echo $teamB; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Category </th>
                        <td>
                            <select class="form-select" name="category_name" aria-label="Default select example">
                                <?php echo $category; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Location </th>
                        <td>
                            <select class="form-select" name="location_name" aria-label="Default select example">
                                <?php echo $location; ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><button class='btn btn-success' type="submit">Save</button></td>
                        <td><a href="index.php"><button class='btn btn-warning' type="button"> Home </button></a></td>
                    </tr>

                </table>
            </form>
        </fieldset>

        <?php require_once  'components/bootjs.php' ?>

    </body>

</html>