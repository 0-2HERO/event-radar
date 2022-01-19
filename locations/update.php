<?php
session_start();
require_once  '../events/components/db_connect.php';

if( !isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
   }

if ($_GET['locationId']) {
    $locationId = $_GET['locationId'];
    $sql = "SELECT * FROM location WHERE locationId = {$locationId}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $loc_name = $data['location_name'];
        $street = $data['street'];
        $street_no = $data['street_no'];
        $city = $data['city'];
        $zip_code = $data['zip_code'];
    
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Location</title>
    <?php  require_once '../events/components/bootcss.php'?>
    <link rel="stylesheet" href="/css/styles.css">
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

<?php require_once '../events/components/_navbar.php' ?>
    <fieldset class="fieldset-forms">
        <legend class='h2'>Update Location</legend>
        <form action="a_update.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Location name</th>
                    <td><input class='form-control' type="text" name="location_name" value="<?php echo $loc_name ?>" /></td>
                </tr>

                <tr>
                    <th>Street</th>
                    <td><input class='form-control' type="text" name="street" value="<?php echo $street ?>" /></td>
                    
                </tr>
                <tr>
                    <th>Street no.</th>
                    <td><input class='form-control' type="number" name="street_no"  min="0" max="5000" style="width: 5rem;" value="<?php echo $street_no ?>" /></td>
                    
                </tr>

                <tr>
                    <th>City</th>
                    <td><input class='form-control' type="text" name="city" value="<?php echo $city ?>" /></td>
                </tr>

                <tr>
                    <th>ZIP Code</th>
                    <td><input class='form-control' type="text" name="zip_code" value="<?php echo $zip_code ?>" /></td>
                </tr>
                <tr>
                <td> <input type="hidden" name = "locationId"   value="<?php echo $data['locationId'] ?>" /></td>
   
                        <td><button class="btn btn-success"  type= "submit">Save Changes</button ></td>
                       <td><a href= "locations.php"><button class="btn btn-warning" type ="button">Back</button></a></td>
                    </tr>

            </table>
        </form>
    </fieldset>


    <?php require_once '../events/components/_footer.php' ?>
    <?php require_once '../events/components/bootjs.php' ?>
</body>

</html>