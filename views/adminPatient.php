<?php
require_once ('../controller/adminPanelCon.php');
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../resource/css/admin.css">
    <link rel="stylesheet" href="../resource/css/all.css">
    <title>Document</title>
</head>
<body onload="checked('user')">

    <div class="container">
        <div class="wrapper">
        <?php include 'adminSidebar.php' ?>
      
        <div class="content">
            <div class="search">
               <div class="title"><h3>Patients</h3></div> 
               <button onclick="window.location='adminPatient.php';" type="button">Show All</button>
               <div class="search-bar">
                   <form action="adminPatient.php" method="post">
                       <input name="word" type="text" placeholder="Search">
                       <button name="search" type="submit"><i class="fa fa-search fa-lg"></i></button>
                   </form>
               </div>
            </div>
            <div class="table">
                <table>
                    <tr>
                        <th>Reg Id</td>
                        <th>First Name</td>
                        <th>Last Name</td>
                        <th>Email</td>
                        <th>Phone Number</th>
                        <th>Address</th>
                       
                    </tr>

                    <!-- user search the word  -->
                    <?php
                    $i=0;
                    if(isset($_POST['search']))
                    {
                        $word=$_POST['word'];
                        $id=intval($_POST['word']);  // integer value of variable
                        $word.='%';
                        $result=patientSearchDetails($id,$word,1,$connection);
                       foreach($result as $row){
                            ?> 
                          <tr>
                              <td><?php echo $row['patient_id']; ?></td>
                              <td><?php echo $row['first_name']; ?></td>
                              <td><?php echo $row['last_name']; ?></td>
                              <td><?php echo $row['email']; ?></td>
                              <td><?php echo $row['phone_number']; ?></td>
                              <td><?php echo $row['address']; ?></td>
                          </tr>
                         
                          <?php
                         $i++;}
                    }
                    //  user get all details about student
                    else{ 
                        $patientDetails=patientDetails($connection,1);
                    foreach($patientDetails as $row){      
                       ?> 
                
                     <tr>
                         <td><?php echo $row['patient_id']; ?></td>
                         <td><?php echo $row['first_name']; ?></td>
                         <td><?php echo $row['last_name']; ?></td>
                         <td><?php echo $row['email']; ?></td>
                         <td><?php echo $row['phone_number']; ?></td>
                         <td><?php echo $row['address']; ?></td>
                  
                     </tr>
                     
                     <?php
                    $i++;}
                }
                    ?>
                </table>
            </div>
        </div>
        </div>
    </div>
    <?php include "adminAcceptpop.php" ?> 
    <?php include 'adminBlockpop.php' ?>
</body>
    <script src="../resource/js/admin.js"></script>
    <script src="../resource/js/jquery.js"></script>
    <script src="../resource/js/student.js"></script>

</html>

