<?php require_once('../config/database.php');
require_once('../models/reg_user.php'); //
require_once('../models/StudentRequestIshan.php');
session_start();
?>

<?php

if (isset($_GET['click1'])) // check the sign in button click
{
        header('Location:../views/user_loging.php');
}
?>

<?php
if (isset($_POST['submit'])) {
        $errors = array(); //create empty array
        if (!isset($_POST['username']) || strlen(trim($_POST['username'])) < 1) //check if the username and password has been entered
        {
                $errors[] = 'Username is Missing / Invalid';
        }
        if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1) {
                $errors[] = 'Password is Missing / Invalid';
        }

        //check if there are any errors in the form
        if (empty($errors)) {
                //save username and password into variables
                //protect the our database  becauses  can be change sql query in database
                $useremail = mysqli_real_escape_string($connection, $_POST['username']);
                $password = mysqli_real_escape_string($connection, $_POST['password']);
                $hash = sha1($password);
                //$user=new reg_user();
                $result = reg_user::loging($useremail, $hash, $connection);
                //prepare database query
                if ($result) {


                        ///set the timeout

                        //   $selectDate=StudentRequestIshan::selectReqTime($connection);
                        //   if ($selectDate) {
                        //     while($row=mysqli_fetch_assoc($selectDate))
                        // {
                        //     $reqDate=$row['date'];
                        //     $expireDateS= date('Y-m-d H:i:s',strtotime('+1 day',strtotime($reqDate)));
                        //     $currentTimeS=date('Y-m-d H:i:s');
                        //     $expireDateValue=strtotime($expireDateS);
                        //     $currentTimeValue=strtotime($currentTimeS);

                        //     if ($currentTimeValue>=$expireDateValue) {

                        //      // StudentRequestIshan::updateReqTimeOut($connection);
                        //        $query="UPDATE 
                        //       request
                        //       SET 
                        //       isAccept=6
                        //       WHERE isAccept IN (0,1)";
                        //       $result=mysqli_query($connection,$query);

                        //     }

                        // }
                        //   }






                        //query successful
                        //check if the user is valid
                        if (mysqli_num_rows($result) == 1) {
                                $record = mysqli_fetch_assoc($result);
                                // if($record['user_accepted']==1){

                                echo $record;
                                $_SESSION['email'] = $record['email'];
                                $_SESSION['type'] = $record['type'];
                                $_SESSION['first_name'] = $record['first_name'];
                                $_SESSION['last_name'] = $record['last_name'];
                                $_SESSION['address'] = $record['address'];
                                $ID = reg_user::getId($record['type'], $record['email'], $connection);
                                $user_id = mysqli_fetch_assoc($ID);

                                if ($record['type'] == "patient") {
                                        $_SESSION['patient_id'] = $user_id['patient_id'];
                                        header('Location:../index.php');
                                        // header('Location:../views/register.php');
                                } elseif ($record['type'] == "doctor") {
                                        $_SESSION['doctor_id'] = $user_id['doctor_id'];
                                        // header('Location:../views/register.php');
                                        header('Location:../index.php');
                                } elseif ($record['type'] == "admin") {
                                        $_SESSION['admin_id'] = $user_id['admin_id'];
                                        header('Location:../index.php');
                                }
                                // elseif($record['level']=="boardings_owner")
                                // {
                                //         $_SESSION['BOid']=$user_id['BOid'];

                                //         header('Location:../index.php');
                                // }
                                // elseif($record['level']=="food_supplier") 
                                // {
                                // $_SESSION['FSid']=$user_id['FSid'];
                                // header('Location:../index.php');
                                // }
                                // }elseif($record['user_accepted']==2)
                                // {
                                //         header('Location:../views/blockPage.php');
                                // }
                                // elseif($record['user_accepted']==0)
                                // {
                                //         header('Location:../views/notConfirm.php');
                                //  }


                                //elseif($record['user_accepted']==6 AND $record['user_accepted']==6 )
                                // {
                                //    if($record['level']=="student")
                                //         {
                                //         $_SESSION['Reg_id']=$user_id['Reg_id'];
                                //         header('Location:../index.php');
                                //         }

                                // }

                        } else {
                                header('Location:../views/user_loging.php?errors=' . 'errors');
                        }

                } else {
                        header('Location:../views/user_loging.php?errors=' . 'errors');
                }

        } else {
                header('Location:../views/user_loging.php?errors=' . 'errors');
        }
}

?>