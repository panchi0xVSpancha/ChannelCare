<?php 

class reg_user{
    // patient registration fiver
    public static function patientReg($email,$first_name,$last_name,$address,$phone_number,$password,$connection)
    {
       // $query="INSERT INTO admin (email,first_name,last_name,address,phone_number,password,type) VALUES('{$email}','{$first_name}','{$last_name}','{$address}','{$phone_number}','{$password}','admin')";
        $query="INSERT INTO patient (email,first_name,last_name,address,phone_number,password,type,user_accepted) VALUES('{$email}','{$first_name}','{$last_name}','{$address}','{$phone_number}','{$password}','patient',1)";
        mysqli_query($connection,$query);
    }

// doctor registration 
    public static function doctorReg($email,$first_name,$last_name,$address,$phone_number,$password,$specialization,$license,$diploma,$connection)
    {
        $query="INSERT INTO doctor (email,first_name,last_name,address,phone_number,password,type,specialization,license,diploma) VALUES('{$email}','{$first_name}','{$last_name}','{$address}','{$phone_number}','{$password}','doctor','{$specialization}','{$license}','{$diploma}')";
        $result_set=mysqli_query($connection,$query);
        return$result_set;
    }

    // food supplier registration
    public static function foodReg($email,$first_name,$last_name,$nic,$password,$token,$merchent,$address,$connection)
    {
        $query="INSERT INTO food_supplier (email,first_name,last_name,NIC,password,token,address,merchent_id) VALUES('{$email}','{$first_name}','{$last_name}','{$nic}','{$password}','{$token}','{$address}','{$merchent}')";
        $result_set=mysqli_query($connection,$query);
        return$result_set;
    }
    // check the email email already used
    public static function checkUser($email,$connection)
    {
        $query="SELECT email FROM patient  WHERE email='{$email}'
         UNION SELECT email FROM doctor  WHERE email='{$email}'
         UNION SELECT email FROM admin  WHERE email='{$email}' LIMIT 1";
         $result_set=mysqli_query($connection,$query);
         return  $result_set;
    }
    // nic validation
    public static function checkNic($nic,$connection)
    {
        $query="SELECT NIC FROM boardings_owner  WHERE NIC='{$nic}'
         UNION SELECT NIC FROM food_supplier  WHERE NIC='{$nic}'
         UNiON SELECT NIC FROM boarder  WHERE NIC='{$nic}' LIMIT 1";
         $result_set=mysqli_query($connection,$query);
         return  $result_set;
    }
    // user accept
    public static function setApt($email,$level,$newtoken,$connection)
    {
        $query="UPDATE $level SET user_accepted=1,token='{$newtoken}' WHERE email='{$email}' ";
        $result_set=mysqli_query($connection,$query);
        return $result_set;
        //return $result_set;
    }

    // user login
    public static function loging($email,$password,$connection)
    {
        $query="SELECT type,email,first_name,last_name,address FROM  patient WHERE email='$email' AND password='$password' AND user_accepted=1
        UNION SELECT type,email,first_name,last_name,address FROM  doctor WHERE email='$email' AND password='$password' AND user_accepted=1
        UNION SELECT type,email,first_name,last_name,address FROM admin  WHERE email='$email' AND password='$password'  AND user_accepted=1
        LIMIT 1 ";
        $result_set=mysqli_query($connection,$query);
        return  $result_set;
    }
//  get the id 
     public static function getId($type, $email,$connection)
     {
       $query="SELECT * FROM $type WHERE email='{$email}'";
       $result_set=mysqli_query($connection,$query);
       return  $result_set;
     }

    //   forgot password get user
     public static function getUser($level,$token, $email,$connection)
     {
     $query="SELECT * FROM $level WHERE email='{$email}' AND token='{$token}'";
       $result_set=mysqli_query($connection,$query);
       return  $result_set;
     }
    

    public function forgotPassword($email,$connection)
    {
        $query="SELECT token,email FROM  boarder WHERE email='$email'  
        UNION SELECT token,email FROM  boardings_owner WHERE email='$email'  
        UNION SELECT token,email FROM  student WHERE email='$email'
        UNION SELECT token,email FROM  food_supplier WHERE email='$email'
                 LIMIT 1 ";
        $result_set=mysqli_query($connection,$query);
        return $result_set; 
    }   

    public static function newPassword($token,$connection)
    {
        $query="SELECT email,level FROM boarder WHERE token='{$token}' 
        UNION SELECT email,level FROM boardings_owner WHERE token='{$token}'
        UNION SELECT email,level FROM food_supplier WHERE token='{$token}'
        UNION SELECT email,level FROM student WHERE token='{$token}'
         LIMIT 1";
        $result_set=mysqli_query($connection,$query);
        return $result_set; 
    }   

    public function savePassword($newtoken,$email,$password,$level,$connection)
    {
        $query="UPDATE $level SET password='{$password}',token='{$newtoken}' WHERE email='{$email}'  ";
        $result_set=mysqli_query($connection,$query);
        return $result_set;
    }   

    public static function getProduct($connection){
        $query="SELECT * FROM product ORDER BY id ASC";// where ekak danna post_id ekata adaala products enna
        $result=mysqli_query($connection,$query);
        return $result;
    }

   
    public static function getOrder($connection,$order_id){
        // echo $order_id;
        $query="SELECT * FROM food_request WHERE order_id='{$order_id}'";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    public static function getOrdId($connection)
    {
       $query="SELECT DISTINCT  order_id FROM food_request WHERE is_accepted=0";
       $result=mysqli_query($connection,$query);
       return $result;
    }

    

    
    public static function getProductsByPostid($F_post_id,$connection){
        $query="SELECT * FROM product WHERE F_post_id = $F_post_id";// where ekak danna post_id ekata adaala products enna
        //SELECT * FROM product WHERE 'F-post-id'=3 ORDER BY id ASC
        //SELECT * FROM `product` WHERE `F-post-id` = 3
        $result=mysqli_query($connection,$query);
        return $result;
    }


    
   
}


?>