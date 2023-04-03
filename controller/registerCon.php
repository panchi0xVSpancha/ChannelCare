<?php require_once('../config/database.php');
require_once('../models/reg_user.php');
require_once('../config/email.php');
session_start();
?>
<?php

// form validation register 
if (isset($_POST['submit'])) {
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $level = mysqli_real_escape_string($connection, $_POST['level']);
        $errors['eFirst'] = '';
        $errors['eLast'] = '';
        $errors['eAddress'] = '';
        $errors['ePhone'] = '';
        $errors['eEmail'] = '';
        $errors['state'] = 'unsucess';
        if (!isset($first_name) || strlen(trim($first_name)) < 1) //check if the username and password has been entered
        {
                $errors['eFirst'] = '*First name required';
        } elseif (!preg_match(("/^([a-zA-Z']+)$/"), $first_name)) { // preg_match -> check regular expression
                $errors['eFirst'] = '*Invalid first name ';
        }
        if (!isset($last_name) || strlen(trim($last_name)) < 1) {
                $errors['eLast'] = '*Last name required';
        } elseif (!preg_match(("/^([a-zA-Z']+)$/"), $last_name)) { // preg_match -> check regular expression
                $errors['eLast'] = '*Invalid Last name ';
        }

        if (!isset($address) || strlen(trim($address)) < 1) {
                $errors['eAddress'] = '*Address required';
        } 
        // elseif (!preg_match(("/^([a-zA-Z']+)$/"), $address)) { // preg_match -> check regular expression
        //         $errors['eAddress'] = '*Invalid Address ';
        // }

        if (!isset($phone_number) || strlen(trim($phone_number)) < 1) {
                $errors['ePhone'] = '*Phone Number  required';
        } else {
                if (strlen(trim($phone_number)) == 12 || (strlen(trim($phone_number)) == 10)) {
                        //         $result=reg_user::checkNic($nic,$connection);
                        //         if($result->num_rows)
                        //         {
                        //                 $errors['eNic']="NIC already used";
                        //         }
                        //         if(strlen(trim($nic))==10)
                        //         {
                        //                 $intPart=substr($nic,0,8);
                        //                 if(!is_numeric($intPart))
                        //                 {
                        //                         $errors['eNic']="*NIC number is invalid";
                        //                 }
                        //         }
                        //        elseif(strlen(trim($nic))==12)
                        //        {
                        //                 $intPart=substr($nic,0,11);
                        //                 if(!is_numeric($intPart))
                        //                 {
                        //                         $errors['eNic']="*NIC number is invalid";
                        //                 }  
                        //        }
                } else {
                        //   $errors['eNic']="*NIC number is invalid";
                }
        }


        if (!isset($email) || strlen(trim($email)) < 1) {
                $errors['eEmail'] = '*Email address required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['eEmail'] = '*Invalied email address ';
        }
        // finally check email is already used     
        else {
                $user_email = reg_user::checkUser($email, $connection);
                $email_arr = mysqli_fetch_assoc($user_email);
                if (!empty($email_arr)) {
                        $errors['eEmail'] = '*Entered email alredy used ';
                }
        }
        if ($errors['eFirst'] == "" && $errors['eLast'] == "" && $errors['ePhone'] == "" && $errors['eEmail'] == "" && $errors['eAddress'] == "") {
                $errors['state'] = 'sucess';
                $errors['first_name'] = $first_name;
                $errors['last_name'] = $last_name;
                $errors['phone_number'] = $phone_number;
                $errors['email'] = $email;
                $errors['address'] = $address;
                $errors['level'] = $level;
        }

        echo json_encode($errors);
}


if (isset($_POST['savePatient'])) {
        $errors['pass'] = '';
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
        $level = mysqli_real_escape_string($connection, $_POST['level']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $confirmPassword = mysqli_real_escape_string($connection, $_POST['confirmpassword']);
        if (empty($password || $confirmPassword)) // validation of new password
        {
                $errors['pass'] = "*Password requried";
        } elseif ((strlen(trim($password)) < 8)) {
                $errors['pass'] = "*Minimum is 8 charactor ";
        } elseif ($password != $confirmPassword) {
                $errors['pass'] = "*Password must be qual";
        } elseif (!preg_match('/[A-Z]/', $password)) {
                $errors['pass'] = "*Need least one uppercase letter";
        } elseif (!preg_match('/[a-z]/', $password)) {
                $errors['pass'] = "*Need least one lowercase letter*";
        } elseif (!preg_match('/[0-9]/', $password)) {
                $errors['pass'] = "*Need least one number*";
        }
        if ($errors['pass'] == '') {
                $token = bin2hex(random_bytes(50));
                $hash = sha1($password);
                reg_user::patientReg($email, $first_name, $last_name, $address,$phone_number, $hash, $connection);
                // sendRegUser($email,$token,$level);
                // $errors['email'] = $email;
                // $errors['token'] = $token;
                // $errors['level'] = $level;
        }
        echo json_encode($errors);
}
// doctor registertion fiver
if (isset($_POST['saveDoctor'])) {
        $errors = array();
        $errors['specialization'] = '';
        $errors['license'] = '';
        $errors['diploma'] = '';
        $errors['pass'] = '';
        $errors['state'] = 'unsucess';
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
        $level = mysqli_real_escape_string($connection, $_POST['level']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $confirmPassword = mysqli_real_escape_string($connection, $_POST['confirmpassword']);
        $specialization = mysqli_real_escape_string($connection, $_POST['specialization']);
        $license = mysqli_real_escape_string($connection, $_POST['license']);
        $diploma = mysqli_real_escape_string($connection, $_POST['diploma']);


        if (!isset($specialization) || strlen(trim($specialization)) < 1) {
                $errors['specialization'] = '*Specialization required';
        }
        if (!isset($license) || strlen(trim($license)) < 1) {
                $errors['license'] = '*License  required';
        } 
        // elseif (!preg_match('/[0-9]/', $merchant)) {
        //         $errors['merchent'] = '*Invalid merchent Id';
        // }

        if (!isset($diploma) || strlen(trim($diploma)) < 1) {
                $errors['diploma'] = '*Diploma  required';
        } 

        if (empty($password || $confirmPassword)) // validation of new password
        {
                $errors['pass'] = "*Password requried";
        } elseif ((strlen(trim($password)) < 8)) {
                $errors['pass'] = "*Minimum is 8 charactor ";
        } elseif ($password != $confirmPassword) {
                $errors['pass'] = "*Password must be qual";
        } elseif (!preg_match('/[A-Z]/', $password)) {
                $errors['pass'] = "*Need least one uppercase letter";
        } elseif (!preg_match('/[a-z]/', $password)) {
                $errors['pass'] = "*Need least one lowercase letter*";
        } elseif (!preg_match('/[0-9]/', $password)) {
                $errors['pass'] = "*Need least one number*";
        }

        if ($errors['specialization'] == "" && $errors['license'] == "" && $errors['diploma'] == "" && $errors['pass'] == "") {
                $token = bin2hex(random_bytes(50));
                $hash = sha1($password);
                $result = reg_user::doctorReg($email, $first_name, $last_name, $address,$phone_number, $hash,$specialization,$license, $diploma,$connection);
                // sendRegUser($email, $token, $level);
                // $errors['email'] = $email;
                // $errors['token'] = $token;
                // $errors['level'] = $level;
                $errors['state'] = 'sucess';
        }
        echo json_encode($errors);
}

//food supplier registration
if (isset($_POST['submitFood'])) {
        $errors = array();
        $errors['address'] = '';
        $errors['merchant'] = '';
        $errors['pass'] = '';
        $errors['state'] = 'unsucess';
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $nic = mysqli_real_escape_string($connection, $_POST['nic']);
        $level = mysqli_real_escape_string($connection, $_POST['level']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $confirmPassword = mysqli_real_escape_string($connection, $_POST['confirmpassword']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $merchant = mysqli_real_escape_string($connection, $_POST['merchant']);
        if (!isset($address) || strlen(trim($address)) < 1) {
                $errors['address'] = '*Address required';
        }
        if (!isset($merchant) || strlen(trim($merchant)) < 1) {
                $errors['merchant'] = '*merchant required';
        } elseif (!preg_match('/[0-9]/', $merchant)) {
                $errors['merchant'] = '*Invalid merchent Id';
        }
        if (empty($password || $confirmPassword)) // validation of new password
        {
                $errors['pass'] = "*Password requried";
        } elseif ((strlen(trim($password)) < 6)) {
                $errors['pass'] = "*Minimum is 6 charactor ";
        } elseif ($password != $confirmPassword) {
                $errors['pass'] = "*Password must be qual";
        } elseif (!preg_match('/[A-Z]/', $password)) {
                $errors['pass'] = "*Need least one uppercase letter";
        } elseif (!preg_match('/[a-z]/', $password)) {
                $errors['pass'] = "*Need least one lowercase letter*";
        } elseif (!preg_match('/[0-9]/', $password)) {
                $errors['pass'] = "*Need least one number*";
        }

        if ($errors['address'] == "" && $errors['merchant'] == "" && $errors['pass'] == "") {
                $token = bin2hex(random_bytes(50));
                $hash = sha1($password);
                $result = reg_user::foodReg($email, $first_name, $last_name, $nic, $hash, $token, $merchant, $address, $connection);
                // sendRegUser($email,$token,$level);
                $errors['email'] = $email;
                $errors['token'] = $token;
                $errors['level'] = $level;
                $errors['state'] = 'sucess';
        }

        echo json_encode($errors);
}

//resend
if (isset($_POST['resend'])) {
        sendRegUser($_POST['email'], $_POST['token'], $_POST['level']);
        header('Location:../views/emailVerify.php?resend&email=' . $_POST['email'] . '&token=' . $_POST['token'] . '&level=' . $_POST['level']);
}
// check email details and save database 
if (isset($_GET['token']) && isset($_GET['email']) && isset($_GET['level'])) {
        $email = $_GET['email'];
        $level = $_GET['level'];
        $token = $_GET['token'];

        $result = reg_user::getUser($level, $token, $email, $connection);
        if ($result) {
                if (mysqli_num_rows($result) == 1) {
                        $newtoken = bin2hex(random_bytes(50));
                        $accept = reg_user::setApt($email, $level, $newtoken, $connection);
                        if ($accept) {
                                $records = mysqli_fetch_assoc($result);
                                $_SESSION['email'] = $records['email'];
                                $_SESSION['first_name'] = $records['first_name'];
                                $_SESSION['last_name'] = $records['last_name'];
                                $_SESSION['level'] = $records['level'];
                                if ($records['level'] == "student") {
                                        $_SESSION['Reg_id'] = $records['Reg_id'];
                                        // $_SESSION['address']=$records['address'];
                                        header('Location:../views/welcome.php');
                                } elseif ($records['level'] == "boardings_owner") {
                                        $_SESSION['BOid'] = $records['BOid'];
                                        $_SESSION['address'] = $records['address'];
                                        header('Location:../views/welcome.php');
                                } elseif ($records['level'] == "food_supplier") {
                                        $_SESSION['FSid'] = $records['FSid'];
                                        $_SESSION['address'] = $records['address'];
                                        header('Location:../views/welcome.php');
                                }
                        } else {
                                header('Location:../views/expired.php');
                        }
                } else {
                        header('Location:../views/expired.php');
                }
        } else {
                header('Location:../views/expired.php');
        }
}






?>