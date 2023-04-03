<?php
    
    require_once ('../config/database.php');
    require_once ('../models/food_post.php');
    session_start();

   

?>

<?php


if(isset($_POST['submit'])){

    $errors=array(); //create empty array


    $resName=$_POST['resName'];
    if(empty($_POST['resName']) || strlen(trim($_POST['resName']))<1){
        $errors['err1']='*Resturent Name is required';
    }


    $address=$_POST['address'];
    if(empty($_POST['address']) || strlen(trim($_POST['address']))<1){
        $errors['err2']='*Address is required';
    }

    if(!isset($_POST['type'])){
        $errors['err3']='*Select one option';
    }

    if(!isset($_POST['otDeadline'])){
        $errors['err4']='*Select one Ordering Time Deadline';
    }

    $Lifespan=$_POST['Lifespan'];
    //print_r($_POST['Pcount']);
    
    if(empty($Lifespan) || strlen(trim($Lifespan))<1){
        $errors['err5']='*Lifespan is required';
    }else if($Lifespan<30){
        $errors['err6']='*Should be greater than 30 days';
    } 

    if(empty($errors)){

        $resName=$_POST['resName'];
        $address=$_POST['address'];
       
    
        $description=$_POST['description'];

        // $image_name=$_FILES['BCimage']['name'];

        $image_name=$_FILES['image1']['name'];
        if(null==trim($image_name)){
            echo "null";
            $image_name="defaultfp1.png";
        }else{
            echo " have value";
        }
        $image_type=$_FILES['image1']['type'];
        $image_size=$_FILES['image1']['size'];
        $temp_name=$_FILES['image1']['tmp_name'];

        $upload_to='../resource/Images/uploaded_foodpost/';
        

        move_uploaded_file($temp_name, $upload_to . $image_name);

        $type=$_POST['type'];
        $otDeadline=$_POST['otDeadline'];
    
        
        $Lifespan=$_POST['Lifespan'];
        //$Aamount=$_SESSION['result'];
        $Aamount=$_POST['Aamount'];

        //echo $Hnumber;
        $fid=$_SESSION['FSid'];
        echo $fid;
        //$creattime=date('Y-m-d h:i:s');
        $result1=foodSupplierPost::delete_food_post($connection);
        echo $result1;
        foodSupplierPost::foodPost($fid,$resName,$address,$description,$image_name,$type,$otDeadline,$Lifespan,$Aamount,$upload_to,$connection);
//database post id 
        
        header('Location:../views/iteam.php');

        print_r($_POST);

        print_r($_FILES);
        
    }else{
        header('Location:../views/foodPost.php?'.http_build_query(array('param'=>$errors)));
    }
}


?>