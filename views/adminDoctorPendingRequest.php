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
    <link rel="stylesheet" type="text/css" href="../resource/css/boarding_request_B.css">

    <title>Document</title>
</head>

<body onload="checked('boarding')">

    <div class="container">

        <div class="wrapper">
            <?php include 'adminSidebar.php' ?>

            <div class="content">
                <div class="search">
                    <div class="title">
                        <h3>Doctor Pending Requests
                        </h3>
                    </div>
                    <button onclick="window.location='adminDoctorPendingRequest.php';" type="button">Show All</button>
                    <div class="search-bar">
                        <form action="adminDoctorPendingRequest.php" method="post">
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
                            <th>Other Details</th>
                            <th>Actions</th>
                        </tr>
                        <?php if (isset($_POST['search'])) {
                            $word = $_POST['word'];
                            $id = intval($_POST['word']);
                            $word .= '%';

                            $result = doctorSearchDetails($id, $word, 0, $connection);
                            foreach ($result as $row) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['doctor_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['first_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['last_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['phone_number']; ?>
                                    </td>
                                    <td>
                                        <button type="button" id="btnpay" class=""
                             
                                        onclick='window.location="adminViewDoctorOtherDetails.php?first_name=<?php echo $row['first_name']; ?> &last_name=<?php echo $row['last_name']; ?> &email= <?php echo $row['email']; ?> &phone_number=<?php echo $row['phone_number']; ?> &address=<?php echo $row['address']; ?> &specialization=<?php echo $row['specialization']; ?> &license=<?php echo $row['license']; ?> &diploma=<?php echo $row['diploma']; ?> "'>
                                                    View</button>
                                            </td>
                                            <td>
                                                <button type="button" id="btnpay" class=""
                                                    onclick=' if(confirm("Are you want to add this doctor to the system ?"))
                                    window.location="../controller/adminPanelCon.php?doctorRequestAccept_id=<?php echo $row['doctor_id']; ?>"'>
                                                    Accept</button>
                                                <button type="button" class="btncancel2" style="background-color:rgb(150, 12, 12);"
                                                    onclick=' if(confirm("Are you want to reject this doctor registration ?"))
                                    window.location="../controller/adminPanelCon.php?doctorRequestCancel_id=<?php echo $row['doctor_id']; ?>"'>
                                                    Deny</button>


                                    </td>
                                    </tr>
                                    <?php
                            }
                        } else {
                            $result = doctorDetails($connection, 0);
                            foreach ($result as $row) {
                                ?>

                                <tr>
                                    <td>
                                        <?php echo $row['doctor_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['first_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['last_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['phone_number']; ?>
                                    </td>
                                    <td>
                                    <button type="button" id="btnpay" class=""
                             
                                    onclick='window.location="adminViewDoctorOtherDetails.php?first_name=<?php echo $row['first_name']; ?> &last_name=<?php echo $row['last_name']; ?> &email= <?php echo $row['email']; ?> &phone_number=<?php echo $row['phone_number']; ?>  &address=<?php echo $row['address']; ?> &specialization=<?php echo $row['specialization']; ?> &license=<?php echo $row['license']; ?> &diploma=<?php echo $row['diploma']; ?> "'>
                                     View</button>
                                            </td>
                                            <td>
                                                <button type="button" id="btnpay" class=""
                                                    onclick=' if(confirm("Are you want to add this doctor to the system ?"))
                                    window.location="../controller/adminPanelCon.php?doctorRequestAccept_id=<?php echo $row['doctor_id']; ?>"'>
                                                    Accept</button>
                                                <button type="button" class="btncancel2" style="background-color:rgb(150, 12, 12);"
                                                    onclick=' if(confirm("Are you want to reject this doctor registration ?"))
                                    window.location="../controller/adminPanelCon.php?doctorRequestCancel_id=<?php echo $row['doctor_id']; ?>"'>
                                                    Deny</button>

                                                <!-- <a style="color: red; cursor: pointer;"
                                            onclick=' popBlock(<?php echo $row["doctor_id"]; ?>,"
                                    <?php echo $row["email"]; ?>","
                                    <?php echo $row["type"]; ?>");'>Deny</a>
                                    <a style="color: green; cursor: pointer;"
                                        onclick='unBlock(<?php echo $row["doctor_id"]; ?>,"<?php echo $row["email"]; ?>","<?php echo $row["type"]; ?>");'>Accept</a>
                                    -->

                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>
<script src="../resource/js/admin.js"></script>
<script src="../resource/js/jquery.js"></script>

</html>