<?php //An

class profile_modelN{

    public static function getprofile_image($connection,$level,$email)
    {
        $query="SELECT profileimage FROM {$level} 
                WHERE email='{$email}';";
       return mysqli_query($connection,$query);
    }


    public static function get_user_details_boarder($connection,$level,$email)
    {
        $query="SELECT Bid,email,first_name,last_name,level,address,location_link,NIC,image,institute,gender,telephone,profileimage
                FROM {$level} 
                WHERE email='{$email}';";
       return mysqli_query($connection,$query);
    }


    public static function get_user_details($connection,$level,$email)
    {
        $query="SELECT email,first_name,last_name,level,NIC,address,profileimage
                FROM {$level} 
                WHERE email='{$email}';";
       return mysqli_query($connection,$query);
    }


    public static function parent_details($connection,$Bid)
    {
        $query="SELECT * FROM boarderparent 
                WHERE Bid={$Bid};";
       return mysqli_query($connection,$query);
    }


    public static function update_password($connection,$level,$email,$new_password,$current_password)
    {
        $query="UPDATE {$level} SET password='{$new_password}'  
                WHERE email='{$email}' and password='{$current_password}';";
       $out=mysqli_query($connection,$query);
       $x=mysqli_affected_rows($connection);
       if($x==0){
               return 0;
       }else if($x==1){
               return 1;
       }else{
               return 9999;
       }
       
    }

    
    public static function upload_profileimage($connection,$email,$level,$imagepath)
    {
        $query="UPDATE $level SET profileimage ='{$imagepath}' 
        WHERE email='{$email}' ";
       return mysqli_query($connection,$query);
    }


}
?>