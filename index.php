<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bodima-Accomadation Management System</title>
    <link rel="stylesheet" href="resource/css/new_home.css">
    <link rel="stylesheet" href="resource/css/all.css">
    <link rel="stylesheet" href="resource/css/liveSupport.css" >
    </head>

<body >
<div class="container" id="container">

    <!-- upper header -->
        <div class="header">
            <div class="logo">
                <img src="resource/img/logo.svg" alt="">
                <h1><small style="font-size: 14px; color:white;font-weight:normal">   Solutions for many problems</small></h1>
            </div>
            <div class="sign">
                
                <?php if(!isset($_SESSION['email'])){?>
                    <button onclick="window.location='views/register.php'">Sign Up <i class="fas fa-user-plus"></i></button>
                    <button onclick="window.location='controller/logingController.php?click1'">Sign In <i class="fa fa-sign-in-alt"></i></button>
                    <?php }?>
                <?php if(isset($_SESSION['email'])){ 
                  echo '<div class="user"><h4>Hi <span style="color:#FDDB21;font-weight:bold">'.$_SESSION['first_name'].' </span>!</h4></div>'; 
                    ?>
                    
                    <div class="notification">
                        <i class="fa fa-bell fa-lg"></i>
                        <div class="notification-box">
                            <ul class="notifi-record">
                            </ul>
                        </div>
                    </div>
                    <div class="profile"><a href="controller/profile_controlN.php?profile=1"> <i class="fa fa-user-circle fa-lg"></i></a></div>
                <?php
                    
                    if($_SESSION['type']=='admin'){?> <button onclick="window.location='controller/adminPanelCon.php?admin'"><i class="fas fa-cogs"></i> Dash Board </button>&nbsp<?php }
                    ?>
                    <button onclick="window.location='controller/logoutController.php'">Sign out <i class="fa fa-sign-out-alt"></i></button>
                <?php } ?> 
           
            </div>
        </div>
        <!-- Navi bar  -->
        <div class="nav">
                <div class="burger">
                        <div>
                            <div class="line1"></div>
                            <div class="line2"></div>
                            <div class="line3"></div>
                        </div>
                    </div>
            <ul class="nav_bar">
                <li style="background-color: #07113d;" class="nav_item " onclick="window.location='#'"><i class=" fa fa-home"></i> Home</li>
                <li class="nav_item " onclick="window.location='views/boardings_live.php'"><i class="fa fa-bed"></i> Boardings</li>
                <li class="nav_item " onclick="window.location='views/foodpostviewN.php'"><i class="fas fa-hamburger"></i> Order Food</li>
                <li class="nav_item " onclick="window.location='views/about.php'"><i class="fa fa-address-card"></i> About us</li>
                <li class="nav_item " onclick="window.location='views/contact_us.php'"><i class="fa fa-address-book"></i> Contact Us</li>
            </ul>
        </div>

        <!-- Slide bar -->
        <div class="slide-nav">
            <ul><?php if(isset($_SESSION['email'])){?> 
                    <li onclick="window.location='controller/profile_controlN.php?profile=1'">Profile</li>

                    
                    <?php  if($_SESSION['type']=='patient'){?>
                      <li onclick='window.location="views/orders.php"'>Orders </li>
                    <?php } ?>
                    <?php if($_SESSION['type']=='doctor'){?>
                      
                      
                      <li onclick='window.location="views/myBoardingReqIshan_New.php"'>My Requests</li>
                      
                   <?php } ?>
                   <?php if($_SESSION['type']=='patient'){?>
                      <li onclick='window.location="views/pendingReqIshan_New.php"'>Boarding Request </li>
                      
                      
                   <?php } ?>
                   <?php if($_SESSION['type']=='doctor' || $_SESSION['type']=='patient'){?>
                    <li onclick='window.location="views/paymentFood_pending.php"'>My food Orders</li>
                    <?php } ?>
                    <li onclick='window.location="controller/logoutController.php"'>Log out</li>
                <?php } else{?>
                    <h4>Plase sign in first to system.</h4>
                        <h3 class="nav-sign" onclick="window.location='views/user_loging.php'">Sign in </h3>
                        
                <?php } ?>
                </ul>
        </div>

        <!-- Home page sider -->
        <section>
            <div class="slider">
               <div class="myslider fade" style="display: block;">
                    <div class="txt">
                        <div class="section1-header title1">
                            <div>
                                <h2 >Welcome to</h2>
                                <h2 class="welcome-msg">Bodima</h2>
                            </div>
                       </div>
                    </div>
                    <img style="width: 860px;" src="resource/img/slide/3.png" alt="">
               </div>
               <div class="myslider fade">
                   <div class="txt">
                        <div class="section1-header title2">
                            <div>
                                <h2>Find Boarding</h2>
                                <h3>Find a Safe </h3>
                                <h3>Place</h3>
                                <!-- <?php if(!isset($_SESSION['email'])){ ?> <button onclick="window.location='views/register.php'">Register</button><?php } ?> -->
                            
                            </div>
                       </div>
                    </div>
                    <img style="width: 860px;" src="resource/img/slide/1 (2).png" alt="">
               </div>
               <div class="myslider fade">
                    <div class="txt">
                        <div class="section1-header title3">
                            <div>
                                <h2>Order Food</h2>
                                <h3>Order from   </h3>
                                <h3>your favorite Restaurent</h3>
                                <!-- <?php if(!isset($_SESSION['email'])){ ?> <button onclick="window.location='views/register.php'">Register</button><?php } ?> -->
                            
                            </div>
                       </div>
                    </div>
                    <img  style="width: 860px;" src="resource/img/slide/1 (3).png" alt="">
               </div>
               <div class="myslider fade">
                        <div class="txt">
                        <div class="section1-header title4">
                            <div>
                                <!-- <h2>Connect With Close</h2> -->
                                <h3>Download Our </h3>
                                <h3>Android Application</h3>
                               <!-- <button onclick="window.location='views/register.php'">Download</button> -->
                            
                            </div>
                       </div>
                    </div>
                    <img style="width: 860px;" src="resource/img/slide/1 (4).png" alt="">
               </div>
                <a class="prev" onclick="plusSlides(-1)">&#10094</a>
                <a class="next" onclick="plusSlides(1)" >&#10095</a>
                <div class="dotsbox" style="text-align: center;">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                    <span class="dot" onclick="currentSlide(4)"></span>
                    <span class="dot" onclick="currentSlide(5)"></span>
                </div>
            </div>
        </section>


        <div class="section2">
            <div class="section2-header">
               <div>
                 <h2>Bodima</h2>
                 <div class="component">
                     <div class="find">
                        <h1>To <b style="color: blue;">F</b>ind</h1>
                        <img src="resource/img/find.svg" alt="">
                        <p>Finding a boarding place hard for you. We are giving easy way to you find a boarding place </p>
                     </div>
                     <div class="boarding">
                        <h1>To <b style="color: blue;">P</b>ost</h1>
                        <img src="resource/img/post.svg" alt="">
                        <p>Have you boarding with 0 income ? You want to turn it to incoming source. That is the place you need . Place your ads here. </p>

                     </div>
                     <div class="delivery">
                        
                        <h1>To <b style="color: blue;">D</b>elivery</h1>
                        <img src="resource/img/delivery.svg" alt="">
                        <p> Have you resturent , Can you delivery orders for customer. Can you win customer trust. You can post our system</p>
                     </div>
                 </div>
               </div>
            </div>
        </div>
        <div class="section3">
            <!-- <img src="resource/img/hostel-img1.jpg" alt=""> -->
        </div>
        <div class="section4">
            <!-- <img src="resource/img/hostel-img1.jpg" alt=""> -->
            <div class="section4-header">
               <div>
                 <h2>SEARCH BOARDING</h2>
                 <!-- <h3>Services</h3> -->
                 <div class="component">
                     <div class="keymoney">
                        <h1>Key Money <b style="color: blue;">P</b>ayment</h1>
                        <img src="resource/img/key.svg" alt="">
                        <p>You can pay your key money online . We provide that service for you. If you get a boarding place using this platform then you can use this feature </p>
                     </div>
                     <div class="free">
                        <h1>Monthly <b style="color: blue;">P</b>ayment</h1>
                        <img src="resource/img/month.svg" alt="">
                        <p>Also you can pay your month payment to boarding owner using this system. System will notified you in payment day. And you can see your payment history </p>
                        <p></p>
                     </div>
                     <div class="order">
                        <h1>Order <b style="color: blue;">F</b>ood</h1>
                        <img src="resource/img/order.svg" alt="">
                        <p>Is buying food is hard for you. Do you want to find food delivary. This is the best platform for you.</p>
                     </div>
                 </div>
               </div>
            </div>
        </div>
        <div class="section5">
        </div>
        <div class="section6">
            <!-- <img src="resource/img/hostel-img1.jpg" alt=""> -->
            <div class="section6-header">
               <div>
                 <h2>POST YOUR PLACE</h2>
                 <!-- <h3>Services</h3> -->
                 <div class="component">
                     <div class="post">
                        <h1>Post <b style="color: blue;">A</b>ds</h1>
                        <img src="resource/img/ads.svg" alt="">
                        <p>Do you want to find customers. We provide that service for you. Post your place here and deal with customers online </p>
                     </div>
                     <div class="boarder">
                        <h1>Boarder <b style="color: blue;">M</b>anage</h1>
                        <img src="resource/img/manage.svg" alt="">
                        <p>Are you thinking about easy way to manage your boarded people. This is the best solution. manage every details,payments via Bodima App. </p>
                        <p></p>
                     </div>
                     <div class="order-b">
                        <h1>Order <b style="color: blue;">F</b>ood</h1>
                        <img src="resource/img/order.svg" alt="">
                        <p>Is buying food is hard for you. Do you want to find food delivary. This is the best platform fr you.</p>
                     </div>
                 </div>
               </div>
            </div>
        </div>
        <div class="section7">
        </div>
        <div class="section8">
            <!-- <img src="resource/img/hostel-img1.jpg" alt=""> -->
            <div class="section8-header">
               <div>
                 <h2>POST YOUR RESTURENT</h2>
                 <!-- <h3>Services</h3> -->
                 <div class="component">
                     <div class="post-a">
                        <h1>Post <b style="color: blue;">A</b>ds</h1>
                        <img src="resource/img/ads.svg" alt="">
                        <p>Do you want to find customers for your food service. Post your food service here and deal with customers online </p>
                     </div>
                     <div class="get">
                        <h1>Get <b style="color: blue;">O</b>rders</h1>
                        <img src="resource/img/item.svg" alt="">
                        <p>Take your orders online. It is okay to be a small business. this is your time to grow your customers online.</p>
                        <p></p>
                     </div>
                     <div class="grow">
                        <h1>Grow Your <b style="color: blue;">B</b>usiness</h1>
                        <img src="resource/img/grow.svg" alt="">
                        <p>Earn with selling your home made food, Yes! your idea is not only a dream. Advertise and Start small.Grow your business with us</p>
                     </div>
                 </div>
               </div>
            </div>
        </div>
        <?php include '../bodima-app/views/footer.php' ?>
</div>
       <!-- live support  -->
       <?php include ("views/liveSupport.php"); ?>
</body>
<script src="resource/js/jquery.js"></script>
<script src="resource/js/home1.js"></script>
<script src="resource/js/new_home.js"></script>
<script src="resource/js/slider.js"></script>
<script src="resource/js/notification_new.js"></script>
<script src="resource/js/chat.js"></script>

</html>