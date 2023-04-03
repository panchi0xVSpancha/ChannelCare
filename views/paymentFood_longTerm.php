<!-- load pre assert -->
<?php   require_once ('../config/database.php');
        require_once ('../models/reg_user.php');
        require_once ('../controller/orderCon.php');
?>
<!-- page  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resource/css/nav.css">
    <link rel="stylesheet" href="../resource/css/paymentFoodSlide.css">
    <link rel="stylesheet" href="../resource/css/all.css">
    <link rel="stylesheet" href="../resource/css/paymentFood.css">
    <script src="../resource/js/jquery.js"></script>
    <title>Document</title>
</head>
<body onload="checked('long-term');">


<div class="header">
            <div class="logo">
                 <img src="../resource/img/logo.svg" alt="">
                <h1><small style="font-size: 14px; color:white; font-weight:lighter">   Solution for many problems</small></h1>
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
        <?php include  'paymentFoodSlide.php';?> 
            <div class="subNav" style="visibility:hidden">
                <ul>
                    <div>
                        <div id="noti-longTerm"><h5></h5></div>
                        <li tabindex="0" id="longTerm" title="Log Term " class="subNav-item"><img src="https://img.icons8.com/cute-clipart/40/000000/property-with-timer.png"/></li>
                    </div>
                </ul>
            </div>
            <!-- load data -->
            <?php 
                    $recordsSeritaize=getLongTerm($connection);
                    $ids=unserialize($recordsSeritaize[0]);
                    $data_rows=unserialize($recordsSeritaize[1]);
                    $items=unserialize($recordsSeritaize[2]);
                    // print_r($data_rows);
            ?>

            <div style="overflow-x:hidden ;" id="shortTerm-box" class="pending">
            <div class="title">
                <div class="order-title">
                    <h3>Long Term Orders </h3>
                </div>
                <?php 
                if(!empty($ids)){
                $total='';
                $i=1;
                $x=0;
                $date=0;
            
                foreach($ids as $id){
                ?>
                <div class="box" id="<?php echo $id['order_id'] ?>">
                  
                    <div class="resend " onclick="order('<?php echo $x ?>')">
                    <div class="right"><img src="https://img.icons8.com/color/48/000000/delivery--v2.png"/></div>
                        <div class="letter">
                            <h4>Order ID : <?php echo $id['order_id'] ?> <span class="dot dot1">.</span> <span class="dot dot2">.</span> <span class="dot dot3">.</span> </h4> 
                        </div>
                    </div>
                  <div id="<?php echo $x ?>" class=" longTerm-struct">
                       <div class="longTerm-details">
                        <div style="width: 65%; margin:20px" class="button-pay">
                                <h2 class="order_item order-head">ORDER INFO</h2>
                                <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Order Id  </h4><h4>: <?php echo $id['order_id']; ?></h4></div>
                                <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Order Item  </h4></div>
                                <?php 
                                    foreach($data_rows as $data_row)
                                    {
                                        if($data_row['order_id']==$id['order_id'])
                                        {
                                            $total=$data_row['total'];
                                            $time=$data_row['time'];
                                            $restaurant=$data_row['restaurant'];
                                            $method=$data_row['method'];
                                            $address=$data_row['address'];
                                            $type=$data_row['order_type'];
                                        }
                                            
                                    }
                                    // print_r($item);
                                    foreach($items as $data_row)
                                    {
                                        if($data_row['order_id']==$id['order_id'])
                                        {
                                               echo '<div class="product_item"><h5 class="item">'.$data_row['item_name'].'</h5>';
                                              echo '<h5 class="quantity">Quantity :'.$data_row['quantity'].'</h5></div>';
                                        }
                                    }
                                ?>
                                <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Ordered time </h4><h4>: <?php echo $time ?></h4></div>
                                <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Order Type </h4><h4>: <?php echo $type; ?></h4></div>
                                <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Resturent </h4><h4>: <?php echo $restaurant ?></h4></div>
                                <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Order Address </h4><h4>: <?php echo $address ?></h4></div>
                                <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Payment method </h4><h4>: <?php echo $method; ?></h4></div>
                                <div class="order_item"> <h4 style="width: 150px;text-align:left;color: #101e5a;">Pay amount </h4><h4>: RS <?php echo $total; ?></h4></div>
                                <button style="margin: 10px 0 10px 0;" class="cancel-btn" id="confirm-btn<?php echo $i ?>" >Complete </button>
                            </div>
                            <div class="longTerm-table">
                                <h1>Long term delivery records</h1>
                                <table>
                                        <tr>
                                            <th>Date</th>
                                            <th>Delivery State </th>
                                            <th>Delivered Time</th>
                                            
                                        </tr> 
                                        <?php
                                        
                                            foreach($data_rows as $row)
                                            {
                                                if($row['order_id']==$id['order_id'])
                                                {
                                            ?>
                                            <tr>
                                            
                                                <td><?php echo $row['day']; ?>
                                                <td style="text-align: center;"><button id="stateBtn<?php echo $i ?>" class="longTerm-btn-1">Receive</button></td>
                                                <td id="delivery<?php echo $i ?>"><?php echo $row['deliveredTime']; ?></td>
                                                <script>
                                                    $(document).ready(function () {
                                                            var date='<?php echo $row['day']; ?>';
                                                            var orderId=<?php echo $row['order_id']; ?>;
                                                            var stateBtn=document.getElementById('stateBtn<?php echo $i ?>');

                                                        // load check every date state deliver or not
                                                        $(window).on('load', function () {
                                                           
                                                            $.ajax({
                                                            type: "POST",
                                                            url: "../controller/orderCon.php",
                                                            data:{date:date,orderId:orderId},
                                                            dataType: "json",
                                                            success: function (data) {
                                                               console.log(data);
                                                                if(data.date=='qual' && data.delivery==0 )
                                                                {                                                       
                                                                    stateBtn.style.backgroundColor='#0093FF'; 
                                                                }
                                                                if(data.date=='qual' && data.delivery==1 )
                                                                {                                                       
                                                                    stateBtn.style.backgroundColor='black';  
                                                                    stateBtn.innerHTML='Received';
                                                                    stateBtn.disabled=true;
                                                                }
                                                                if(data.date=='plus')
                                                                {
                                                                    stateBtn.disabled=true;      
                                                                    stateBtn.style.backgroundColor='gray';  
                                                                }
                                                                if(data.delivery==1 && data.date=='minus')
                                                                {
                                                                    stateBtn.disabled=true;      
                                                                    stateBtn.style.backgroundColor='black';  
                                                                }
                                                                if(data.delivery==0 && data.date=='minus')
                                                                {
                                                                    stateBtn.innerHTML='Not Received';
                                                                    stateBtn.disabled=true;
                                                                    stateBtn.style.backgroundColor='black';
                                                                }
                                                                // check all date delivery
                                                                if(data.complete=='incomplete'){
                                                                    document.getElementById('confirm-btn<?php echo $i ?>').style.backgroundColor='gray';
                                                                    document.getElementById('confirm-btn<?php echo $i ?>').disabled=true;
                                                                }
                                                                if(data.complete=='complete'){
                                                                    document.getElementById('confirm-btn<?php echo $i ?>').style.backgroundColor='#0093FF';
                                                                    document.getElementById('confirm-btn<?php echo $i ?>').disabled=false;
                                                                }
                                                            }
                                                            });
                                                      
                                                    });
                                                     
                                                    // click the received button
                                                    $(document).on('click', "#stateBtn<?php echo $i ?>", function(){
                                                        var d = new Date();
                                                        document.querySelector('.orderAccept').classList.add('orderAccept-active');
                                                        document.getElementById('longTermId').innerHTML='['+orderId+']';
                                                        document.getElementById('resTime').innerHTML='['+d.toLocaleString()+']';
                                                        $(document).on('click', "#accept-btn", function(){
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "../controller/orderCon.php",
                                                            data:{dateUp:date,orderIdUp:orderId},
                                                            dataType: "json",
                                                            success: function (data) {
                                                                console.log(data); 
                                                                stateBtn.style.backgroundColor='black';  
                                                                stateBtn.innerHTML='Received';
                                                                stateBtn.disabled=true; 
                                                                document.getElementById('delivery<?php echo $i ?>').innerHTML=data.deliveryTime;  
                                                                document.querySelector('.orderAccept').classList.remove('orderAccept-active');    
                                                            }

                                                        });
                                                    
                                                     });
                                                    });
                                                    // onclick='window.location="../controller/orderCon.php?orderConfirm_id=<?php echo $id["order_id"]; ?>"'
                                                      // click the complete button
                                                      $(document).on('click', "#confirm-btn<?php echo $i ?>", function(){
                                                            var v = new Date();
                                                            document.querySelector('.confirmOrder').classList.add('orderAccept-active');
                                                            document.getElementById('confirmId').innerHTML='[<?php echo $id["order_id"]; ?>]';
                                                            document.getElementById('conTime').innerHTML='['+v.toLocaleString()+']'
                                                      });
                                            });
                                                </script>
                                                
                                            </tr>
                                            <?php $i++; } 

                                            }?>
                                    </table>        
                              </div>
                       </div>
                
                          
         
                  </div>
               
                </div>
                <?php
                }
            $date+=2;
           $x=$x+2; 
        }else{?>
                <div class="empty">
                     <h1> Nothing to show here</h1>
                </div>
          <?php  }        
           
        ?>      
            </div>
        </div>
        </div>
    </div>
    
<!-- click the confirm button then update the database   -->
<script>
     $(document).on('click', "#complete-btn", function(){
         var orderId=document.getElementById('confirmId').innerHTML;
         orderId=orderId.substring(1,11);
        window.location="../controller/orderCon.php?orderConfirm_id="+orderId+"";
    });
</script>

<!-- accept  the each day popup-->
<div class="orderAccept">
    <div class="acceptPop-box">
        <div class="accHeader">
        <div class="iconClose">  <i id="orderIcon" class="fas fa-times fa-2x" onclick="document.querySelector('.orderAccept').classList.remove('orderAccept-active');"></i></div>
        <img src="https://img.icons8.com/pastel-glyph/100/4a90e2/delivery-scooter--v1.png"/>
            <h1>Confirm Your Order Received !</h1>
            <h4 style="margin-top: 20px">Confirm that your longterm order <span id="longTermId" style="color:black"></span> has been received by  <span id="resTime" style="color:black"></span>  </h4>
            <div style="margin-top:30px;">
                    <div style="display: none;" ><h4 id="termType"></h4></div>
            </div>
         <button style="margin: 10px 0 10px 0;" class="accept-btn" id="accept-btn">Confirm</button>
         <button class="cancel-btn" onclick="document.querySelector('.orderAccept').classList.remove('orderAccept-active');">cancel</button>
        </div>
    </div>
</div>

<!-- Order complete  popup -->
<div class="orderAccept confirmOrder">
    <div class="acceptPop-box">
        <div class="accHeader">
        <div class="iconClose">  <i id="orderIcon" class="fas fa-times fa-2x" onclick="document.querySelector('.confirmOrder').classList.remove('orderAccept-active');"></i></div>
        <img src="https://img.icons8.com/material/100/4a90e2/task-completed.png"/>
            <h1>Confirm Your Longterm Order is complete !</h1>
            <h4 style="margin-top: 20px">Confirm that your order <span id="confirmId" style="color:black"></span> has been completed by  <span id="conTime" style="color:black"></span> </h4>
            <div style="margin-top:30px;">
                    <div style="display: none;" ><h4 id="termType"></h4></div>
            </div>
         <button style="margin: 10px 0 10px 0;" class="accept-btn" id="complete-btn">Confirm</button>
         <button class="cancel-btn" onclick="document.querySelector('.confirmOrder').classList.remove('orderAccept-active');">cancel</button>
        </div>
    </div>
</div>

</body>
<script src="../resource/js/timing.js"></script>
<script src="../resource/js/settingOrder.js"></script>
<script src="../resource/js/pendingOrder.js"></script>
<script src="../resource/js/newOrder.js"></script>
<script src="../resource/js/disableBack.js"></script>

</html>