<?php

session_start();
require_once  '../events/components/db_connect.php';

if( !isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
   }

if ($_GET['categoryId']) {
    $categoryId = $_GET['categoryId'];
    $sql = "SELECT * FROM category WHERE categoryId = {$categoryId}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $loc_name = $data['category_name'];
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update category</title>
    <?php  require_once '../events/components/bootcss.php'?>
    <link rel="stylesheet" href="/css/styles.css">
</head>

    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 10rem;
            width: 60%;
            margin-bottom: 20rem;
        }
</style>
<body>
<?php require_once  '../events/components/_navbar.php' ?>

    <fieldset>
        <legend class='h2'>Update category</legend>
        <form action="a_update.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>category name</th>
                    <td><input class='form-control' type="text" name="category_name" value="<?php echo $loc_name ?>" /></td>
                </tr>
                <tr>
                <td> <input type="hidden" name = "categoryId"   value="<?php echo $data['categoryId'] ?>" /></td>
   
                        <td><button class="btn btn-success"  type= "submit">Save Changes</button ></td>
                       <td><a href= "categories.php"><button class="btn btn-warning" type ="button">Back</button></a></td>
                    </tr>

            </table>
        </form>
    </fieldset>


    <?php require_once  '../events/components/_footer.php' ?>
    <?php require_once  '../events/components/bootjs.php' ?>
</body>

</html>