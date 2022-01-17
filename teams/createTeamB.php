<?php

require_once "../events/components/db_connect.php";

$category = "";

$resultCat = mysqli_query($connect, "SELECT * FROM category");

while ($row = $resultCat->fetch_array(MYSQLI_ASSOC)) {

    $category .=
        "<option value='{$row['categoryId']}'>{$row['category_name']}</option>";
}







?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once  '../events/components/bootcss.php' ?>
    <title>Document</title>
</head>

<body>

    </head>

    <body>
        <fieldset class="mx-auto  mt-5" style="width: 60%;">
            <legend class='h2'>New Team</legend>
            <form action="actions/b_create.php" method="post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Team B name</th>
                        <td><input class='form-control' type="text" name="teamB_name" /></td>
                    </tr>

                    <tr>
                        <th>Team logo</th>
                        <td><input class='form-control' type="text" name="logo" /></td>
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
                        <td><button class='btn btn-success' type="submit">Save</button></td>
                        <td><a href="/events/index.php"><button class='btn btn-warning' type="button"> Home </button></a></td>
                    </tr>

                </table>
            </form>
        </fieldset>



        <?php require_once  '../events/components/bootjs.php' ?>

    </body>

</html>