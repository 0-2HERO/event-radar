<?php

//fetch.php

$connect = new PDO("mysql:host=localhost;dbname=eventradar", "root", "");


if($_POST["query"] != '')
{
 $search_array = explode(",", $_POST["query"]);
 $search_text = "'" . implode("', '", $search_array) . "'";
 $query = "SELECT `events`.`event_name`, `events`.`eventId`, `teama`.`teamA_name`, `teamb`.`teamB_name`, `location`.`location_name`, `category`.`category_name`, `events`.`picture`
 FROM `events` 
     LEFT JOIN `teama` ON `events`.`fk_teamA_Id` = `teama`.`teamId` 
     LEFT JOIN `teamb` ON `events`.`fk_teamB_Id` = `teamb`.`teamId` 
     LEFT JOIN `location` ON `events`.`fk_locationId` = `location`.`locationId` 
     LEFT JOIN `category` ON `events`.`fk_categoryId` = `category`.`categoryId`
 WHERE category_name IN (".$search_text.") 
 ORDER BY categoryId DESC";
}
else
{
 $query = "SELECT `events`.`event_name`, `events`.`eventId`, `teama`.`teamA_name`, `teamb`.`teamB_name`, `location`.`location_name`, `category`.`category_name`, `events`.`picture`
 FROM `events` 
     LEFT JOIN `teama` ON `events`.`fk_teamA_Id` = `teama`.`teamId` 
     LEFT JOIN `teamb` ON `events`.`fk_teamB_Id` = `teamb`.`teamId` 
     LEFT JOIN `location` ON `events`.`fk_locationId` = `location`.`locationId` 
     LEFT JOIN `category` ON `events`.`fk_categoryId` = `category`.`categoryId`;";
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output = '';

if($total_row > 0)
{
 foreach($result as $row)
 {
  $output .= "
  <div class='card mb-3 events-card border-0 mx-auto p-0 mt-5' style='max-width: 80%;'>
  <div class='row g-0'>
    <div class='col-md-4'>
      <img src='" . $row['picture'] . " ' class='img-fluid rounded-start' alt='event image'>
    </div>
    <div class='col-md-8'>
      <div class='card-body'>
          <p class='fs-6 text-end text-warning' >" . $row['category_name'] . "</p>
          <p class='card-title fs-2 fw-bold text-dark'>" . $row['teamA_name'] . " vs " . $row['teamB_name'] . "</p>
        <p class='card-text'>" . $row['location_name'] . "</p>
        <p class='card-text'>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis aliquam, iusto consequatur amet repellat at.</p>
        <a href='details.php?eventId=" . $row['eventId'] . "'><button class='btn btn-danger btn-sm' type='button'>Details</button></a>
      </div>
    </div>
  </div>
</div>
  ";
 }
}
else
{
 $output .= "
 <tr>
  <td  align='center'><p>No Data Found</p></td>
 </tr>
 ";
}

echo $output;


?>