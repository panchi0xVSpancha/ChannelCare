<?php   require_once ('../config/database.php');
        require_once ('../models/orderModel.php');
        session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resource/css/nav.css">
    <link rel="stylesheet" href="../resource/css/paymentFoodslide.css">
    <link rel="stylesheet" href="../resource/css/all.css">
    <link rel="stylesheet" href="../resource/css/paymentFood.css">
    <title>Document</title>
</head>
<script>
    function orderType(id)
{
    const order=document.getElementById(id);
    const breakfast=document.getElementById('breakfast-box');
    const lunch=document.getElementById('lunch-box');
    const dinner=document.getElementById('dinner-box');
    const longTerm=document.getElementById('longTerm-box');
    if(id=='breakfast')
    {
        breakfast.style.display='block';
        dinner.style.display='none';
        lunch.style.display='none';
        longTerm.style.display='none';
    }else{
      
    }
    if(id=='lunch')
    {
        lunch.style.display='block';
        breakfast.style.display='none';
        dinner.style.display='none';
        longTerm.style.display='none';
    }else{
        
    }
    if(id=='dinner')
    {
        dinner.style.display='block';
        lunch.style.display='none';
        breakfast.style.display='none';
        longTerm.style.display='none';
    }
   
   
    order.style.display='block';
  
}
</script>
<body onload="checked('card');">
<div class="header">
            <div class="logo">
                 <img src="../resource/img/logo.svg" alt="">
                <h1><small style="font-size: 14px; color:white;">   Solution for many problems</small></h1>
            </div>
            
            <div class="sign">
                <?php if(isset($_SESSION['email'])){ 
                   echo '<div class="user"><h4>Hi <span style="color:#FDDB21;font-weight:bold">'.$_SESSION['first_name'].' </span>!</h4></div>'; 
                    ?>

                    <div class="notification">
                        <i class="fa fa-bell fa-lg"></i>
                        <div class="notification-box" >
                            <ul>
                                <li><i class="fas fa-times fa-2x"></i></li>
                                <a href="#"><li>You have notification</li></a>
                                <a href="#"><li>You have notification</li></a>
                                <a href="#"><li>You have notification</li></a>
                                <a href="#"><li>You have notification</li></a>
                                <a href="#"><li>You have notification</li></a>
                            </ul>
                        </div>
                    </div>
                    <div class="profile"><a href="../controller/profile_controlN.php?profile=1"> <i  class="fa fa-user-circle fa-lg"></a></i></div>
           
                 <button onclick="window.location='../controller/logoutController.php'">Sign out <i class="fa fa-sign-out-alt"></i></button>
                <?php } ?>
            </div>
        </div>
    <div class="container">
        <div class="content">
               <?php include 'orderSide.php' ?>  
               <div class="subNav">
                <ul>
                    <div>
                        <div class="count" id="noti-accpetBreakfast"><h5></h5></div>
                        <li tabindex="0" id="breakfast" onclick="orderType(this.id);" title="Breakfast" class="subNav-item"><img src="https://img.icons8.com/cotton/40/000000/toast--v4.png"/></li>
                    </div>
                    <div>
                        <div class="count" id="noti-accpetLunch"><h5></h5></div>
                        <li tabindex="0" id="lunch" onclick="orderType(this.id);" title="Lunch" class="subNav-item"><img src="https://img.icons8.com/cotton/40/000000/breakfast--v1.png"/></li>
                    </div>
                    <div>
                        <div class="count" id="noti-accpetDinner"><h5></h5></div>
                        <li tabindex="0" id="dinner" onclick="orderType(this.id);" title="Dinner" class="subNav-item"><img src="https://img.icons8.com/cotton/40/000000/breakfast--v2.png"/></li>
                    </div>
                </ul>
            </div> 
        <?php 
         $records=unserialize($_GET['record']);
         $new=array_column($records,'order_type');
         ?>  
        <div id="breakfast-box" class="accept">
            <div class="title">
            <div class="order-title">
                    <h3>Card Payment </h3>
                    <!-- <div><h5>1</h5></div> -->
                </div>
                <?php 
                 $i=0;
                 
                 if(in_array('breakfast',$new)){
                    foreach($records as $record)
                    {
                        if($record['order_type']=='breakfast'){?>
                     <div class="box ">
                            <div class="resend "  onclick="order('<?php echo $i ?>')">
                                    <div class="right"><i style="padding: 10px;" class="fas fa-credit-card fa-lg"></i></div>
                                    <div class="letter"><h4>Order Id : <?php echo $record['order_id']; ?></h4></div>
                            </div>
                            <div id="<?php echo $i ?>" class="details-box">
                            <div style="width: 300px;"><img style="width: 200px; margin:20px 30px" src="../resource/img/card.svg" alt=""></div>
                                    
                                <div class="button-pay">
                                <h2 class="order_item order-head">ORDER INFO</h2>
                                    <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Order Id  </h4><h4>: <?php echo $record['order_id']; ?></h4></div>
                                    <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Order Item  </h4></div>
                                    <?php   $getOrder=orderModel::getOrderFoodSupplier($connection,$record['order_id'],1);
                                        while($result=mysqli_fetch_assoc($getOrder))
                                        {
                                            echo '<div class="product_item"><h5  class="item">'.$result['item_name'].'</h5>';
                                            echo '<h5 class="quantity">Quantity :'.$result['quantity'].'</span></h5></div>';
                                            $address=$result['address'];
                                            $email=$result['email'];
                                            $first_name=$result['first_name'];
                                            $last_name=$result['last_name'];
                                            $total=$result['total'];
                                            $phone=$result['phone'];
                                            $method=$result['method'];
                                            $shedule=$result['shedule'];
                                        
                                        }?>
                                    <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Sheduled Time  </h4><h4>: <?php echo  $shedule ?></h4></div>
                                    <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Customer Name  </h4><h4>: <?php echo  $first_name ?></h4></div>
                                    <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Delivery Address </h4><h4>: <?php echo $address ?></h4></div>
                                    <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Contact Number </h4><h4>: <?php echo $phone; ?></h4></div>
                                    <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Pay amount </h4><h4>: RS <?php echo $total; ?></h4></div>
                                    <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Payment method </h4><h4>: <?php echo $method; ?></h4></div>
                             </div>
                            </div>
                    
                         </div>
                <?php    }
                  $i=$i+2;  }
                }   else
                {?>
                    <div class="empty">
                         <h1> Nothing to show here</h1>
                    </div>
              <?php  }
                 ?>              
                                
            </div>
        </div>
        <div id="lunch-box" class="accept none">
            <div class="title">
            <div class="order-title">
                    <h3>Card Payment </h3>
                    <!-- <div><h5>1</h5></div> -->
                </div>
                <?php 
                  $i=0;
                 if(in_array('lunch',$new)){
                    foreach($records as $record)
                    {
                        if($record['order_type']=='lunch'){?>
                     <div class="box " >
                            <div class="resend " onclick="order('<?php echo $i ?>')">
                                    <div class="right"><i style="padding: 10px;" class="fas fa-credit-card fa-lg"></i></div>
                                    <div class="letter"><h4>Order Id : <?php echo $record['order_id']; ?></h4></div>
                            </div>
                            <div id="<?php echo $i ?>" class="details-box">
                            <div style="width: 300px;"><img style="width: 200px; margin:20px 30px" src="../resource/img/card.svg" alt=""></div>
                                    
                                    <div class="button-pay">
                                    <h2 class="order_item order-head">ORDER INFO</h2>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Order Id  </h4><h4>: <?php echo $record['order_id']; ?></h4></div>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Order Item  </h4></div>
                                        <?php   $getOrder=orderModel::getOrderFoodSupplier($connection,$record['order_id'],1);
                                            while($result=mysqli_fetch_assoc($getOrder))
                                            {
                                                echo '<div class="product_item"><h5  class="item">'.$result['item_name'].'</h5>';
                                                echo '<h5 class="quantity">Quantity :'.$result['quantity'].'</span></h5></div>';
                                                $address=$result['address'];
                                                $email=$result['email'];
                                                $first_name=$result['first_name'];
                                                $last_name=$result['last_name'];
                                                $total=$result['total'];
                                                $phone=$result['phone'];
                                                $method=$result['method'];
                                                $shedule=$result['shedule'];
                                            
                                            }?>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Sheduled Time  </h4><h4>: <?php echo  $shedule ?></h4></div>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Customer Name  </h4><h4>: <?php echo  $first_name ?></h4></div>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Delivery Address </h4><h4>: <?php echo $address ?></h4></div>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Contact Number </h4><h4>: <?php echo $phone; ?></h4></div>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Pay amount </h4><h4>: RS <?php echo $total; ?></h4></div>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Payment method </h4><h4>: <?php echo $method; ?></h4></div>
                                 </div>
                            </div>
                    
                         </div>
                <?php    }
                     $i=$i+2; }
                }   else
                {?>
                    <div class="empty">
                         <h1> Nothing to show here</h1>
                    </div>
              <?php  }
                 ?>              
                                
            </div>
        </div>
        <div id="dinner-box" class="accept none">
            <div class="title">
            <div class="order-title">
                    <h3>Card Payment </h3>
                    <!-- <div><h5>1</h5></div> -->
                </div>
                <?php 
                  $i=0;
                 if(in_array('dinner',$new)){
                    foreach($records as $record)
                    {
                        if($record['order_type']=='dinner'){?>
                     <div class="box " >
                            <div class="resend " onclick="order('<?php echo $i ?>')">
                                    <div class="right"><i style="padding: 10px;" class="fas fa-credit-card fa-lg"></i></div>
                                    <div class="letter"><h4>Order Id : <?php echo $record['order_id']; ?></h4></div>
                            </div>
                            <div id="<?php echo $i ?>" class="details-box">
                            <div style="width: 300px;"><img style="width: 200px; margin:20px 30px" src="../resource/img/card.svg" alt=""></div>
                                    
                                    <div class="button-pay">
                                    <h2 class="order_item order-head">ORDER INFO</h2>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Order Id  </h4><h4>: <?php echo $record['order_id']; ?></h4></div>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Order Item  </h4></div>
                                        <?php   $getOrder=orderModel::getOrderFoodSupplier($connection,$record['order_id'],1);
                                            while($result=mysqli_fetch_assoc($getOrder))
                                            {
                                                echo '<div class="product_item"><h5  class="item">'.$result['item_name'].'</h5>';
                                                echo '<h5 class="quantity">Quantity :'.$result['quantity'].'</span></h5></div>';
                                                $address=$result['address'];
                                                $email=$result['email'];
                                                $first_name=$result['first_name'];
                                                $last_name=$result['last_name'];
                                                $total=$result['total'];
                                                $phone=$result['phone'];
                                                $method=$result['method'];
                                                $shedule=$result['shedule'];
                                            
                                            }?>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Sheduled Time  </h4><h4>: <?php echo  $shedule ?></h4></div>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Customer Name  </h4><h4>: <?php echo  $first_name ?></h4></div>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Delivery Address </h4><h4>: <?php echo $address ?></h4></div>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Contact Number </h4><h4>: <?php echo $phone; ?></h4></div>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Pay amount </h4><h4>: RS <?php echo $total; ?></h4></div>
                                        <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Payment method </h4><h4>: <?php echo $method; ?></h4></div>
                                 </div>
                            </div>
                    
                         </div>
                <?php    }
                    $i=$i+2;  }
                }   else
                {?>
                    <div class="empty">
                         <h1> Nothing to show here</h1>
                    </div>
              <?php  }
                 ?>              
                                
            </div>
        </div>
       
        </div>
    </div>
    <!-- <?php include 'footer.php'?> -->
</body>
<script src="../resource/js/timing.js"></script>
<script src="../resource/js/order.js"></script>
<script src="../resource/js/jquery.js"></script>
<script>
        function order(x,y) {  
            var orderDown=document.getElementById(x);
            var btn=document.getElementById(y);
            if(orderDown.style.display=='none' || orderDown.style.display==''){orderDown.style.display='flex';btn.style.visibility='hidden'}
            else{orderDown.style.display='none';btn.style.visibility='visible'}
    }
</script>
</html>