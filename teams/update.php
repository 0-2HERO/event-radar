<?php

session_start();

require_once "../events/components/db_connect.php";

if( !isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
   }


if ($_GET['teamId']) {
    $teamId = $_GET['teamId'];
    $sql = "SELECT * FROM teama WHERE teamId = {$teamId}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $team_name = $data['teamA_name'];
        $logo = $data['logo'];
        $category = $data['fk_categoryId'];
    
    }


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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <?php  require_once '../events/components/bootcss.php'?>
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
        <legend class='h2'>Update Team</legend>
        <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Team name</th>
                    <td><input class='form-control' type="text" name="teamA_name" value="<?php echo $team_name ?>" /></td>
                </tr>

                <tr>
                    <th>Logo</th>
                    <td><input class='form-control' type="text" name="logo" value="<?php echo $logo ?>" /></td>
                    
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
                <td> <input type="hidden" name = "teamId"   value="<?php echo $data['teamId'] ?>" /></td>
   
                        <td><button class="btn btn-success"  type= "submit">Save Changes</button ></td>
                       <td><a href= "teams.php"><button class="btn btn-warning" type ="button">Back</button></a></td>
                    </tr>

            </table>
        </form>
    </fieldset>

</body>

</html>