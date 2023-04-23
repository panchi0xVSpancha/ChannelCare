<?php
require_once ('../config/database.php');
require_once ('../controller/adminPanelCon.php');
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resource/css/all.css">
    <link rel="stylesheet" href="../resource/css/admin.css">
    <title>Document</title>
</head>
<body onload="checked('user')">
    <div class="container">
        <div class="wrapper">
       <?php include 'adminSidebar.php' ?>
      
        <div class="content">
            <div class="search">
               <div class="title"><h3>Doctors</h3></div> 
               <button onclick="window.location='adminDoctor.php';" type="button">Show All</button>
               <div class="search-bar">
                   <form action="adminDoctor.php" method="post">
                       <input name="word" type="text" placeholder="Search">
                       <button name="search" type="submit"><i class="fa fa-search fa-lg"></i></button>
                   </form>
               </div>
            </div>
            <div class="table">
                <table>
                    <tr>
                        <th>Id</td>
                        <th>First Name</td>
                        <th>Last Name</td>
                        <th>Email</td>
                        <th>Phone Number</th>
                    </tr>
                    <?php if(isset($_POST['search']))
                    {
                        $word=$_POST['word'];
                        $id=intval($_POST['word']);
                        $word.='%';
                        
                        $result=doctorSearchDetails($id,$word,1,$connection);
                        foreach($result as $row){
                            ?> 
                          <tr>
                              <td><?php echo $row['doctor_id']; ?></td>
                              <td><?php echo $row['first_name']; ?></td>
                              <td><?php echo $row['last_name']; ?></td>
                              <td><?php echo $row['email']; ?></td>
                              <td><?php echo $row['phone_number']; ?></td>
                          <?php
                         }
                    }
                    else{ 
                        $result=doctorDetails($connection,1);
                        foreach($result as $row){
                       ?> 
                   
                     <tr>
                         <td><?php echo $row['doctor_id']; ?></td>
                         <td><?php echo $row['first_name']; ?></td>
                         <td><?php echo $row['last_name']; ?></td>
                         <td><?php echo $row['email']; ?></td>
                         <td><?php echo $row['phone_number']; ?></td>
                     </tr>
                     <?php
                    }
                }
                    ?>
                </table>
            </div>
        </div>
        </div>
        <?php include 'adminBlockpop.php' ?>
        <?php include 'adminAcceptpop.php' ?>
    </div>
    <script src="../resource/js/jquery.js"></script>
    <script src="../resource/js/admin.js"></script>
   
 
</body>
</html>

