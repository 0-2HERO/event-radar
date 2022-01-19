<?php
session_start();
require_once 'events/components/db_connect.php';

$connect = new PDO("mysql:host=localhost;dbname=eventradar", "root", "");
$query = " SELECT DISTINCT category_name FROM category ORDER BY category_name ASC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <?php require_once 'events/components/bootcss.php' ?>
  <link rel="stylesheet" href="css/styles.css">


</head>

<body class="m-auto">
 
  <?php require_once 'events/components/_navbar.php' ?>


  <h2 class="text-center my-5">Events</h2><br />
  <section>
  <div class="container mt-5 mb-5" id="page-container">


    <div class="d-flex justify-content-around">

      <div>
        <label for="multi_search_filter">Filter by Category</label>
        <select class="form-select  selectpicker" name="multi_search_filter" id="multi_search_filter" aria-label="Default select example" style="width: 12rem;">
          <?php
          foreach ($result as $row) {
            echo '<option value="' . $row["category_name"] . '">' . $row["category_name"] . '</option>';
          }
          ?>
        </select>
        <input type="hidden" name="hidden_category" id="hidden_category" />
      </div>
      <span class="py-3">

        <button class="button btn btn-danger" onClick="history.go(0);">Reset filter</button>
      </span>
    </div>

    <table>
      <tbody></tbody>
    </table>

  </div>
  </section>
  <?php require_once 'events/components/_footer.php' ?>
  <?php require_once 'events/components/bootjs.php' ?>
  <?php require_once 'events/components/functions.php' ?>
  
</body>

</html>