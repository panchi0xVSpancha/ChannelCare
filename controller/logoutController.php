<?php 
session_start();
unset($_SESSION["email"]);
unset($_SESSION["type"]);
unset($_SESSION["first_name"]);
unset($_SESSION["last_name"]);
unset($_SESSION["address"]);
    session_destroy();
    header('Location:../index.php');


?>