<?php
session_start();

require_once "../events/components/db_connect.php";

if( !isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
   }


$sql = "SELECT `teama`.*, `category`.`category_name`
FROM `teama` 
	LEFT JOIN `category` ON `teama`.`fk_categoryId` = `category`.`categoryId`;";
$result = mysqli_query($connect ,$sql);

$teamRes = "";
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        
        $teamRes .= "
        <tr>
            <td><img class='img-thumbnail' src='" .$row['logo']. "'> </td>
            <td>" .$row['teamA_name']."</td>
            <td>" .$row['category_name']."</td>
            <td><a href='update.php?teamId=" .$row['teamId']."'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a></td>
            </tr>
        ";
    };
} else {
    $teamRes = "<h2>No Team Available</h2>";
}


$sql = "SELECT `teamb`.*, `category`.`category_name`
FROM `teamb` 
	LEFT JOIN `category` ON `teamb`.`fk_categoryId` = `category`.`categoryId`;";
$result = mysqli_query($connect ,$sql);

$teamB = "";
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        
        $teamB .= "
        <tr>
            <td><img class='img-thumbnail' src='" .$row['logo']. "'> </td>
            <td>" .$row['teamB_name']."</td>
            <td>" .$row['category_name']."</td>
            <td><a href='updateB.php?teamId=" .$row['teamId']."'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a></td>
            </tr>
        ";
    };
} else {
    $teamRes = "<h2>No Team Available</h2>";
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

    <style>
         .img-thumbnail {
               width: 70px  !important;
               height: 70px !important;
           }
    </style>
</head>

<body>

<?php  require_once '../events/components/_navbar.php'?>

<div class="manageTeam w-75 mt-3 mx-auto mt-3">   
            <div class='mb-3'>

                <a href= "createTeam.php" ><button class='btn btn-primary'type= "button" >Add Team </button></a>
           </div>
           <p class='h2'>Team A</p>

            <table class='table table-striped' >
               <thead class= 'table-primary'>
                   <tr>

                        <th>Logo</th>
                        <th>Team A name</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
               </thead >
               <tbody>
               <?= $teamRes;?>
                </tbody>
           </table>
       </div>

<div class="manageTeam w-75 mt-5 mx-auto">   
            <div class='mb-3'>

                <a href= "createTeamB.php" ><button class='btn btn-primary'type= "button" >Add Team </button></a>
           </div>
           <p class='h2'>Opponent team</p>

            <table class='table table-striped' >
               <thead class= 'table-danger'>
                   <tr>

                        <th>Logo</th>
                        <th>Team A name</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
               </thead >
               <tbody>
               <?= $teamB;?>
                </tbody>
           </table>
       </div>
 
    
<?php  require_once '../events/components/bootjs.php'?>
</body>
</html>



