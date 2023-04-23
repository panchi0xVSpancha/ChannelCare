<?php
require_once('../config/database.php');
require_once('../controller/adminPanelCon.php');
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../resource/css/admin.css">
    <link rel="stylesheet" href="../resource/css/all.css">
    <link rel="stylesheet" href="../resource/css/profile1.css">
    <link rel="stylesheet" href="../resource/css/extra_new.css">

    <title>Document</title>
</head>

<body onload="checked('boarding')">

    <div class="container">

        <div class="wrapper">
            <?php include 'adminSidebar.php' ?>

            <div class="content">

                <!-- <div class="search">
                    <div class="title">
                        <h3>Doctor Details
                        </h3>
                    </div>
                   
                </div> -->
                <div class="middle_b">
                <!-- <h1>Doctor Registration Details<a href="../controller/editprofile_control.php?editprofile=1"><button class="p_edit" name="p_edit" value="Edit"><i class="far fa-edit"></i>Edit</button></a></h1> -->
                    <div class="mid_A">
                        <h3><?php echo $_GET['first_name']; ?> registration details</h3>
                        <hr />
                        <div class="detail_table">

                            <div class="list">
                                <p>
                                <div class="pr_th"><span>First Name</span></div>
                                <div class="pr_td" style="text-transform:capitalize;"> :
                                    <?php echo $_GET['first_name']; ?>
                                </div>
                                </p>
                            </div>
                            <div class="list">
                                <p>
                                <div class="pr_th"><span>Last Name</span></div>
                                <div class="pr_td" style="text-transform:capitalize;">:
                                    <?php echo $_GET['last_name']; ?>
                                </div>
                                </p>
                            </div>
                           



                            <div class="list">
                                <p>
                                <div class="pr_th"><span>Email </span></div>
                                <div class="pr_td">:
                                    <?php echo $_GET['email']; ?>
                                </div>
                                </p>
                            </div>
                            <div class="list">
                                <p>
                                <div class="pr_th"><span>Address</span></div>
                                <div class="pr_td">:
                                    <?php echo $_GET['address']; ?>
                                </div>
                                </p>
                            </div>

                            <div class="list">
                                <p>
                                <div class="pr_th"><span>Phone Number </span></div>
                                <div class="pr_td">:
                                    <?php echo $_GET['phone_number']; ?>
                                </div>
                                </p>
                            </div>
                            <div class="list">
                                <p>
                                <div class="pr_th"><span>Specialize</span></div>
                                <div class="pr_td">:
                                    <?php echo $_GET['specialization']; ?>
                                </div>
                                </p>
                            </div>
                
                            <div class="list">
                                <p>
                                <div class="pr_th"><span>License </span></div>
                                <div class="pr_td">:
                                    <?php echo $_GET['license']; ?>
                                </div>
                                </p>
                            </div>
                            <!-- <div class="list">
                                <p>
                                <div class="pr_th"><span>diploma </span></div>
                                <div class="pr_td">:
                                    <?php echo $_GET['diploma']; ?>
                                </div>
                                </p>
                            </div> -->
                           
                        </div>
                    </div>
                    <div class="mid_B">
                        <!-- <div class="profile_photo"> -->

                        <img src="../resource/Images/cert.png" width=100% height="600" alt="">

                        <!-- </div> -->


                    </div>
                </div>


                <!--                            
                <div class="table">
                    <table>
                        <tr>
                            <th></td>
                            <th>First Name</td>
                            <th>Last Name</td>
                            <th>Email</td>
                            <th>Phone Number</th>
                            <th>Actions</th>
                        </tr>


                        <tr>
                            <td>
                                <?php echo $_GET['first_name']; ?>
                            </td>
                            <td>
                                <?php echo $_GET['first_name']; ?>
                            </td>
                            <td>
                                <?php echo $_GET['last_name']; ?>
                            </td>
                            <td>
                                <?php echo $_GET['email']; ?>
                            </td>
                            <td>
                                <?php echo $_GET['phone_number']; ?>
                            </td>

                            <td>
                                <button type="button" id="btnpay" class=""
                                    onclick=' if(confirm("Are you want to add this doctor to the system ?"))
                                    window.location="../controller/adminPanelCon.php?doctorRequestAccept_id=<?php echo $_GET['phone_number']; ?>"'>
                                    Accept</button>
                                <button type="button" class="btncancel2" style="background-color:rgb(150, 12, 12);"
                                    onclick=' if(confirm("Are you want to reject this doctor registration ?"))
                                    window.location="../controller/adminPanelCon.php?doctorRequestCancel_id=<?php echo $_GET['phone_number']; ?>"'>
                                    Deny</button>

                            </td>

                    </table> -->
                <!-- </div> -->

            </div>
        </div>
    </div>

</body>
<script src="../resource/js/admin.js"></script>
<script src="../resource/js/jquery.js"></script>

</html>