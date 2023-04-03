<?php 

class orderModel{

    // order insert to table
    public static function food_request($Fpid,$email,$address,$first_name,$last_name,$order_id,$order_type,$term,$shedule,$total,$phone,$method,$time,$expireTime,$name,$connection)
    {
        $query="INSERT INTO food_request (F_post_id,email,address,first_name,last_name,is_accepted,total,phone,method,time,expireTime,restaurant,order_id,order_type,term,shedule) 
        VALUES('{$Fpid}','{$email}','{$address}','{$first_name}','{$last_name}',0,'{$total}','{$phone}','{$method}','{$time}','{$expireTime}','{$name}','{$order_id}','{$order_type}','{$term}','{$shedule}') LIMIT 1";
         $result=mysqli_query($connection,$query);
    }
    // order food item insert to table
    public static function food_item($item_name,$quantity,$order_id,$connection)
    {
        $query="INSERT INTO order_item (item_name,quantity,order_id) 
        VALUES('{$item_name}','{$quantity}','{$order_id}')";
         $result=mysqli_query($connection,$query);
    }
    // get order details
    public static function getOrderAll($connection,$email,$isAccept){
        $query="SELECT * FROM food_request,order_item WHERE food_request.is_accepted=$isAccept AND food_request.email='{$email}' AND food_request.order_id=order_item.order_id ORDER BY food_request.order_id DESC";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    // get distinct order id term
    public static function getOrderById($connection,$email,$isAccept){
        $query="SELECT DISTINCT  order_id,term FROM food_request WHERE is_accepted=$isAccept AND email='{$email}' ORDER BY order_id DESC";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    // order accept function
    public static function accept($order_id,$is_accepted,$expireTime,$connection)
    {
       $query="UPDATE food_request SET is_accepted=$is_accepted , expireTime='{$expireTime}' WHERE order_id=$order_id ";
       $result_set=mysqli_query($connection,$query);
       return $result_set;
    }
    // get food post id
    public static function getFPID($fpid,$connection)
    {
        $query="SELECT FSid FROM food_post WHERE F_post_id=$fpid";
        $result_set=mysqli_query($connection,$query);
        return $result_set;
    }

 // get merchent id 
    public static function getMerchaint($fsid,$connection)
    {
        $query="SELECT merchent_id FROM food_supplier WHERE FSid=$fsid";
        $result_set=mysqli_query($connection,$query);
        return $result_set;
    }


    // cancel order 
    public static function remove($order_id,$connection)
    {
       $query="UPDATE food_request SET is_accepted=5 WHERE order_id=$order_id ";
       $result_set=mysqli_query($connection,$query);
       return $result_set;
    }
    // order cancel user
    public static function requestOrderDelete($connection,$order_id){
        $query="Update food_request SET is_accepted=2 WHERE order_id='{$order_id}'";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    
    //  accept order pending for payment
    public static function paymentOrder($connection,$order_id){
        $query="Update food_request SET is_accepted=3 WHERE order_id='{$order_id}'";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    // order complete
    public static function requestOrderConfirm($connection,$time,$order_id){
        $query="Update food_request SET is_accepted=4, deliveredTime='{$time}' WHERE order_id='{$order_id}'";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    // select food post id
    public static function getPostFoodSupplier($connection,$FSid){
        $query="SELECT F_post_id FROM food_post WHERE FSid=$FSid ";
        $result=mysqli_query($connection,$query);
        return $result;
    }

    public static function getOrderIDFoodSupplier($connection,$F_post_id,$is_accepted){
        $query="SELECT DISTINCT order_id,order_type,term FROM food_request WHERE F_post_id=$F_post_id AND is_accepted=$is_accepted ORDER BY order_id DESC";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    public static function getOrderIDFoodSupplierLong($connection,$F_post_id,$is_accepted){
        $query="SELECT DISTINCT order_id,order_type FROM food_request WHERE F_post_id=$F_post_id AND term='longTerm' AND is_accepted=$is_accepted ORDER BY order_id DESC";
        $result=mysqli_query($connection,$query);
        return $result;
    }

    public static function getOrderFoodSupplier($connection,$order_id,$is_accepted){
        $query="SELECT * FROM food_request,order_item WHERE order_item.order_id='{$order_id}' AND food_request.order_id=order_item.order_id AND  food_request.is_accepted=$is_accepted ORDER BY order_item.order_id DESC";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    public static function getOrderFoodSupplierTerm($connection,$order_id,$is_accepted,$term){
        $query="SELECT * FROM food_request,order_item WHERE order_item.order_id='{$order_id}' AND food_request.order_id=order_item.order_id AND  food_request.is_accepted=$is_accepted AND food_request.term='{$term}' ORDER BY order_item.order_id DESC";
        $result=mysqli_query($connection,$query);
        return $result;
    }
   
    // check available
    public static function checkAvailable($fsid,$connection){
        $query="SELECT available FROM food_supplier WHERE FSid=$fsid";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    // change available
    public static function available($fsid,$state,$connection)
    {
        $query="UPDATE food_supplier SET  available=$state  WHERE FSid=$fsid";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    // delete order based on requst id
    public static function deleteRequest($id,$connection)
    {
        $query="DELETE FROM food_request WHERE request_id='{$id}'";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    // delect order based on order id
    public static function deleteOrder($id,$connection)
    {
        $query="DELETE FROM food_request WHERE order_id='{$id}'";
        $result=mysqli_query($connection,$query);
        return $result;
    }

    public static function getCountDown($connection,$order_id){
        $query="SELECT * FROM food_request WHERE order_id=$order_id LIMIT 1";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    //  order count
    public static function OrderCount($connection,$email,$state){
        $query="SELECT DISTINCT order_id,term FROM food_request WHERE email='{$email}' AND is_accepted=$state";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    // long term table add
    public static function addLongTerm($connection,$day,$order_id){
        $query="INSERT INTO longterm(day,order_id) VALUES ('{$day}','{$order_id}')";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    public static function getLongTermID($connection,$email){
        $query="SELECT DISTINCT order_id FROM food_request WHERE email='{$email}' AND term='longTerm' AND food_request.is_accepted=3 ";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    public static function getLongTerm($connection,$email){
        $query="SELECT * FROM food_request,longterm WHERE food_request.order_id=longterm.order_id  AND food_request.is_accepted=3  AND email='{$email}'";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    // get date of long term food supplier side
    public static function getLongTermSupplier($connection,$Fpid){
        $query="SELECT * FROM food_request,longterm WHERE food_request.order_id=longterm.order_id  AND food_request.is_accepted=3  AND food_request.F_post_id='{$Fpid}'";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    //customer side
    public static function getLongTermFood($connection,$email){
        $query="SELECT * FROM food_request,order_item WHERE food_request.order_id=order_item.order_id AND food_request.is_accepted=3  AND food_request.email='{$email}'";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    // food supplier side
    public static function getLongTermFoodSupplier($connection,$Fpid){
        $query="SELECT * FROM food_request,order_item WHERE food_request.order_id=order_item.order_id AND food_request.is_accepted=3  AND food_request.F_post_id='{$Fpid}'";
        $result=mysqli_query($connection,$query);
        return $result;
    }

    public static function checkLongTermState($connection,$orderId,$date){
        $query="SELECT * FROM longterm WHERE order_id=$orderId AND day='{$date}'  LIMIT 1";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    // get last date of longterm food delivery
    public static function longTermLast($connection,$orderId){
        $query="SELECT day FROM longterm WHERE order_id=$orderId ORDER BY day DESC LIMIT 1";
        $result=mysqli_query($connection,$query);
        return $result;
    }
    
    //  update the long term table
    public static function updateLongTermState($connection,$orderId,$date,$time){
        $query="UPDATE longterm SET delivery_state=1,deliveredTime='{$time}' WHERE order_id=$orderId AND day='{$date}'";
        $result=mysqli_query($connection,$query);
        return $result;
    }

    //  check food suoplier is available
    public static function checkAvailableUser($connection,$pid){
        $query="SELECT f.available FROM food_supplier f,food_post p WHERE p.F_post_id=$pid AND f.FSid=p.FSid";
        $result=mysqli_query($connection,$query);
        return $result;
    }

    //check term of food post
    public static function checkTerm($connection,$pid){
        $query="SELECT type FROM food_post WHERE F_post_id=$pid";
        $result=mysqli_query($connection,$query);
        return $result;
    }

    // check term of food request
    public static function checkTermOrder($connection,$order_id){
        $query="SELECT term FROM food_request WHERE order_id=$order_id";
        $result=mysqli_query($connection,$query);
        return $result;
    }

    
}