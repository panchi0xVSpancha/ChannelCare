<?php //An

class notificationModel{
    public static function notificationOrderAccept($connection,$email,$title,$discription,$time,$type,$responce)
    {
        $query="INSERT INTO notification (email,title,discription,time,type,responce_url) 
                VALUES('{$email}','{$title}','{$discription}','{$time}','{$type}', '{$responce}')";
         $result=mysqli_query($connection,$query);
    }


    public static function notificationAll($connection,$email)
    {
        $query="SELECT * FROM notification WHERE email='{$email}' ORDER BY seen_state=0 DESC";
        $result=mysqli_query($connection,$query);
            return $result;
    }


    public static function notificationsAll2($connection,$email,$level,$id)
    {
        $query="SELECT * FROM notifications WHERE to_id=$id and to_level='{$level}' ORDER BY is_seen=0 ,sendDateTime DESC";
        $result=mysqli_query($connection,$query);
            return $result;
    }


    public static function notificationSeen($connection,$email,$noId)
    {
        $query="UPDATE notification SET seen_state=1  WHERE email='{$email}' AND noID=$noId";
         $result=mysqli_query($connection,$query);
    }


    public static function notificationResponce($connection,$email,$noId)
    {
        $query="SELECT responce_url FROM notification WHERE email='{$email}' AND noID=$noId";
        $result=mysqli_query($connection,$query);
            return $result;
    }
    

// ****************************************************************************

    public static function insertnotification($connection,$type_number,$from_level,$from_id,$to_level,$to_id,$massageHeader,$massage,$redirect_url)
    {
        $query="INSERT INTO notifications(type_number,from_level,from_id,to_level,to_id,massageHeader,massage,redirect_url)
                VALUES($type_number,'{$from_level}',$from_id,'{$to_level}',$to_id,'{$massageHeader}','{$massage}','{$redirect_url}')";   
        $result=mysqli_query($connection,$query);
            return $result;
    }


    public static function find_levelAndId($connection,$email){
        $query="SELECT * from 
                (SELECT level,email,Bid as id FROM boarder 
                UNION 
                SELECT level,email,BOid as id FROM boardings_owner 
                UNION 
                (SELECT level,email,Reg_id as id FROM student WHERE user_accepted=1)) 
                as U WHERE email='{$email}'";
       $result=mysqli_query($connection,$query);
            return $result;      
    }


    public static function find_FSid_from_fpost($connection,$F_post_id)
    {
        $query="SELECT FSid from food_post WHERE F_post_id=$F_post_id"; 
        $result=mysqli_query($connection,$query);
            return $result;
    }


    public static function resturant_name($connection,$order_id)
    {
        $query="SELECT restaurant FROM food_request WHERE order_id=$order_id";
        $result=mysqli_query($connection,$query);
            return $result;
    }


    public static function notificationSeen_N($connection,$noId)
    {
        $query="UPDATE notifications SET is_seen=1  WHERE notify_id=$noId";
         $result=mysqli_query($connection,$query);
       
    }


    public static function notificationResponce_N($connection,$noId)
    {
        $query="SELECT redirect_url FROM notification WHERE notify_id=$noI";
         $result=mysqli_query($connection,$query);
       return $result;
    }


    public static function delete_notification_by_Id($connection,$notify_id){
        $query="DELETE FROM notifications WHERE notify_id=$notify_id";
         mysqli_query($connection,$query);
    }


    public static function delete_notification_by_orderid($connection,$orderid){
        $query="DELETE FROM notifications WHERE notify_id =(select notify_id FROM notifications WHERE massage LIKE'%$orderid%' and to_level='food_supplier')"; 
         mysqli_query($connection,$query);
    }

    
    public static function delete_pay_notification_by($connection,$orderid){
        $query="DELETE FROM notifications WHERE notify_id =(select notify_id FROM notifications WHERE massage LIKE'%$orderid%' and to_level='food_supplier')";
         mysqli_query($connection,$query);
    }

}



?>