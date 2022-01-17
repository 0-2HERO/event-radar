<?php
require_once  '../events/components/db_connect.php';


$sql = "SELECT * FROM `location`";
$result = mysqli_query($connect ,$sql);

$locRes = "";
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        
        $locRes .= "
        <tr>
            <td>" .$row['location_name']."</td>
            <td>" .$row['street']."</td>
            <td>" .$row['street_no']."</td>
            <td>" .$row['city']."</td>
            <td>" .$row['zip_code']."</td>
             <td><a href='update.php?locationId=" .$row['locationId']."'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a></td>
            </tr>
        ";
    };
} else {
    $locRes = "<h2>No Locations Available</h2>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locations</title>
    <?php require_once  '../events/components/bootcss.php' ?>

</head>

<body>

<?php  require_once '../events/components/_navbar.php'?>

<div class="manageLocation w-75 mt-3 mx-auto mt-3">   
            <div class='mb-3'>

                <a href= "createLoc.php" ><button class='btn btn-primary'type= "button" >Add Location</button></a>
           </div>
           <p class='h2'>Locations</p>

            <table class='table table-striped' >
               <thead class= 'table-success'>
                   <tr>

                        <th>Location</ th>
                        <th>Street name</th>
                        <th>street no.</th>
                        <th>City</th>
                        <th>ZIP Code</th>
                        <th>Action</th>
                    </tr>
               </thead >
               <tbody>
               <?= $locRes;?>
                </tbody>
           </table>
       </div>
 
    
<?php  require_once '../events/components/bootjs.php'?>
</body>
</html>



