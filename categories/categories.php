<?php

session_start();
require_once  '../events/components/db_connect.php';


if( !isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
   }

$sql = "SELECT * FROM `category`";
$result = mysqli_query($connect, $sql);

$catRes = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        $catRes .= "
        <tr>
            <td>" . $row['category_name'] . "</td>
             <td><a href='update.php?categoryId=" . $row['categoryId'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a></td>
            </tr>
        ";
    };
} else {
    $catRes = "<h2>No Categories Available</h2>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <?php require_once  '../events/components/bootcss.php' ?>

</head>

<body>

    <?php require_once '../events/components/_navbar.php' ?>

    <div class="manageCategory mt-3 mx-auto mt-3" style="width: 30%;">
        <div class='mb-3'>

            <a href="createCat.php"><button class='btn btn-primary' type="button">Add Category</button></a>
        </div>
        <p class='h2'>Categories</p>

        <table class='table table-striped'>
            <thead class='table-success'>
                <tr>
                    <th>Category name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?= $catRes; ?>
            </tbody>
        </table>
    </div>

    <?php require_once '../events/components/bootjs.php' ?>
</body>

</html>