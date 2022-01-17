
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
            <legend class='h2'>New Category</legend>
            <form action="a_create.php" method="post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Category name</th>
                        <td><input class='form-control' type="text" name="category_name" /></td>
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