<?php

session_start();
require_once  '../events/components/db_connect.php';

if( !isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
   }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once  '../events/components/bootcss.php' ?>
    <title>Create Location</title>
</head>

<body>

    </head>

    <body>
        <fieldset class="mx-auto  mt-5" style="width: 60%;">
            <legend class='h2'>New Location</legend>
            <form action="a_create.php" method="post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Location name</th>
                        <td><input class='form-control' type="text" name="location_name" /></td>
                    </tr>

                    <tr>
                        <th>Street</th>
                        <td><input class='form-control' type="text" name="street" /></td>
                    </tr>
                    <tr>
                        <th>Street number</th>
                        <td><input class='form-control' type="number" min="0" max="5000" style="width: 5rem;" name="street_no" /></td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td><input class='form-control' type="text" name="city" /></td>
                    </tr>

                    <tr>
                        <th>ZIP Code</th>
                        <td><input class='form-control' type="text" name="zip_code" /></td>
                    </tr>
                    <tr>
                        <td><button class='btn btn-success' type="submit"> Save</button></td>
                        <td><a href="index.php"><button class='btn btn-warning' type="button"> Home </button></a></td>
                    </tr>

                </table>
            </form>
        </fieldset>



        <?php require_once  '../events/components/bootjs.php' ?>

    </body>

</html>