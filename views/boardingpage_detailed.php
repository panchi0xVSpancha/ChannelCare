<?php   require_once ('../config/database.php');
        require_once ('../models/adertisement_model.php');
        require_once ('../models/reg_userIshan.php');
        require_once ('../controller/rateCon.php');
        //session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resource/css/nav.css">
    <link rel="stylesheet" href="../resource/css/footer.css">
    <link rel="stylesheet" href="../resource/css/all.css">
    <link rel="stylesheet" href="../resource/css/slider.css">
    <link rel="stylesheet" href="../resource/css/boardingpage_detailed.css">
    <link rel="stylesheet" href="../resource/css/boardingpage_detailed_rate.css">


 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  
    <title>Boarding details</title>
</head>
<body>
<!-- <div class="page_boarding"> -->
   
<?php include 'nav.php' ?>
<?php
$B_post_id=$_GET['id'];
$student_email=$_SESSION['email'];
$_SESSION['rating_B_post_id']=$B_post_id;
$rating_B_post_id=$_SESSION['rating_B_post_id'];
$boardingpost= advertisement_model::get_B_post_details_byId($B_post_id,$connection);
$boardingpost_d=mysqli_fetch_assoc($boardingpost);
// print_r($boardingpost_d);
// echo " <br /><br />";

$BOid=$boardingpost_d['BOid'];

$boardingpost_owner=advertisement_model::get_B_post_owner_byId($BOid,$connection);
$boardingpost_owner_d=mysqli_fetch_assoc($boardingpost_owner);

// print_r($boardingpost_owner_d);

$dataset=rategetcount($rating_B_post_id,$connection);
//print_r($dataset);
$count=$dataset['count'];
$total=$dataset['total'];
//echo $total;
//echo "gggg";
$avg = '';

if($count != 0){
    if(is_nan(round(($total/$count),1))){
        $avg=0;
    }else{
        $avg=round(($total/$count),1);
    }
}else{
    $avg=0;
}



?>

    <div class="box_outer">
        <!-- <div class="col-7"> -->
            <div class="inner_slider" >

            <h1><?php echo $boardingpost_d['girlsBoys']?>' BOARDING IN <?php echo $boardingpost_d['city']?></h1>
                <h3><?php echo $boardingpost_d['title']?> </h3>
                <span>posted by: <?php echo $boardingpost_owner_d['first_name']?> <?php echo $boardingpost_owner_d['last_name']?> - <?php echo $boardingpost_d['create_time']?></span>

                <div class="pdt-rate">
                                    <div class="pro-rating">
                                        <div class="clearfix rating mart8">
                                            <div class="rating-stars">
                                                <div class="grey-stars"></div>
                                                <div class="filled-stars" style="width:<?php echo $avg * 20; ?>%;"></div>
                                            </div>
                                        </div>
                                    </div>
                </div>
                <div class="rnrn">
                    <a class="rars" href="rate.php"><?php if($count == 0){ echo "No";}else{echo $count;}   ?> Reviews</a>
                                    
                </div>







                


                <div id="content-wrapper">


            <?php 
                
               
                $boardingpost= advertisement_model::get_post_details($B_post_id,$connection);


                if(mysqli_num_rows($boardingpost)>0){
                    while($fetch= mysqli_fetch_all($boardingpost)){

                        //print_r($fetch);

                    //print_r(count($fetch));
                    //print_r($fetch[0][3]);

            ?>

            
                <div class="featured">
                    
                     <img id=featured src="<?php echo $fetch[0][3]; ?>">

                </div>



                <div id="slide-wrapper">
                    <img id="slideLeft" class="arrow" src="../resource/Images/s_image/arrow-left.png">

                     <div id="slider">
                        <img class="thumbnail active" src="<?php echo $fetch[0][3]; ?>">

                        <?php

                            //print_r($fetch);

                            for($a=1;$a < count($fetch);$a++){

                        ?>
                        <img class="thumbnail" src="<?php echo $fetch[$a][3]; ?>">

                        <?php


                        }

                            ?>

                        <!-- <img class="thumbnail" src="../resource/Images/s_image/shoe3.jpg">
                        <img class="thumbnail" src="../resource/Images/s_image/shoe2.jpg">
                        <img class="thumbnail" src="../resource/Images/s_image/shoe3.jpg"> -->


                        <!-- <img class="thumbnail" src="../resource/Images/s_image/preset1.png">
                        <img class="thumbnail" src="../resource/Images/s_image/preset2.jpg"> -->
                        <!-- <img class="thumbnail" src="images/preset3.jpg"> -->
                        <!-- <img class="thumbnail" src="images/preset4.jpg"> -->
                    </div>

                    <img id="slideRight" class="arrow" src="../resource/Images/s_image/arrow-right.png">
                </div>


                <?php

                        
                       
            
} //while close
}else{
?>
<div class="featured">
<img id=featured runat = 'server' src = '<?php echo $boardingpost_d['image']?>' />
</div>
<?php
} // if close



?>

            </div>



                <h3>DETAILS</h3>
                <hr color="#101e5a" />
                <div class="details">
                        <p>Category    : <?php echo $boardingpost_d['category']?></p>
                        <p>Rent for    : <?php echo $boardingpost_d['girlsBoys']?></p>
                        <p>Description : <?php echo $boardingpost_d['description']?></p>
                        <p>Count of Person : <?php echo $boardingpost_d['person_count']?></p>
                        <p>Address : <?php echo $boardingpost_d['house_num']?> , <?php echo $boardingpost_d['lane']?> , <?php echo $boardingpost_d['city']?></p>
                        <p>District : <?php echo $boardingpost_d['district']?></p>

                </div>

                <h3>PAYMENT DETAILS</h3>
                <hr color="#101e5a"/>
                <div class="details">
                        <p>Monthly rental (per person or Renting)    : Rs. <?php echo $boardingpost_d['cost_per_person']?></p>
                        <p>keymoney    : Rs. <?php echo $boardingpost_d['keymoney']?></p>
                        <p>extra details : food will not be provided<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;water and current bill will be included for rent</p>
                </div>
            
              
            </div>
        <!-- </div> -->
        <!-- <div class="resquest" > -->
        <!-- style="margin-bottom: 100px;" -->
        
            <div class="inner_right">
            
            <div class="resquest" >
            <h2 class="price">Rs. <?php echo $boardingpost_d['cost_per_person']?></h2>
                <hr>
                    <div class="expandable">
                        <button class="collapsible">
                        <i class="fas fa-map-marked-alt"></i>
                        <span><?php echo $boardingpost_d['house_num']?></span>, <span><?php echo $boardingpost_d['lane']?></span>, <span><?php echo $boardingpost_d['city']?></span>.</button>
                        <div class="content">
                        
                        <div class="mapouter">
                            <div class="gmap_canvas">
                            <iframe width="500" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=dharmapala%20widyalaya%2Ckottawa&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                <a href="https://www.whatismyip-address.com/divi-discount/"></a>
                            </div>
                            <style>
                                .mapouter{position:relative;text-align:right;height:300px;width:500px;}
                                .gmap_canvas {overflow:hidden;background:none!important;height:300px;width:500px;}
                            </style>
                        </div>
                        
                        </div>
                        <?php 
                                      
                                      $result=reg_userIshan::getReq($connection,$student_email,$B_post_id);
                                      $record=mysqli_fetch_assoc($result);
            
                                    if($record)
                                    {
                                        if($record['isAccept']==0)
                                        {
                                            echo "<script>addEventListener('load',(e)=>{
                                                document.getElementById('demo').disabled=true;
                                                document.getElementById('demo').style.backgroundColor='gray';
            
                                                document.getElementById('demo').value='Pending';
                                                
                                        });
                                        </script>";
                                        }
                                        else if($record['isAccept']==1)
                                        {
            
                                           
                                            echo "<script>addEventListener('load',(e)=>{
                                                document.getElementById('demo').disabled=true;
                                                document.getElementById('demo').style.backgroundColor='2BFF00';
                                                document.getElementById('demo').value='Accepted';
                                               
                                        });
                                        </script>";
                                        }
                                         else if($record['isAccept']==2)
                                        {
            
                                           
                                            echo "<script>addEventListener('load',(e)=>{
                                                document.getElementById('demo').disabled=true;
                                                document.getElementById('demo').style.backgroundColor='red';
                                                document.getElementById('demo').value='Rejected';
                                                
                                        });
                                        </script>";
                                        }
                                       
            
                                    }
            
            ?>

<button class="collapsible">Request<input id='demo1' class='btn6request' type='submit' value='Request'></button>
                        <div class="content">

                             <form action="../controller/SRequestIshan.php" method='post'>
                                <input type="hidden" name="BOid" value="<?php echo $boardingpost_d['BOid']; ?>">
                                <input type="hidden" name="B_post_id" value="<?php echo $boardingpost_d['B_post_id']; ?>">

                                 <textarea rows="4" cols="30" name="comment" placeholder="type your message here. . ."></textarea>
                                <input id='demo' class='btn6request' type='submit'name='send_request' value='Send Request' style='float:right;'onclick="save_changes()">

                             </form>
                       
                        </div>
                        <button class="collapsible">Reviews</button>
                        <div class="content">
                        <!-- <p>Reviews</p> -->
                        <div class="rate-table">

                                        <table>
                    <tbody>
                        <tr>
                            <td >
                                <div class="rnb rv1">
                                    <h3><?php echo $avg; ?>/5.0</h3>
                                </div>
                                <div class="pdt-rate">
                                    <div class="pro-rating">
                                        <div class="clearfix rating mart8">
                                            <div class="rating-stars">
                                                <div class="grey-stars"></div>
                                                <div class="filled-stars" style="width:<?php echo $avg * 20; ?>%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rnrn">
                                    <p class="rars"><?php if($count == 0){ echo "No";}else{echo $count;}   ?> Reviews</p>
                                </div>
                            </td>
                            
                           
                        </tr>
                    </tbody> 
                </table>

</div>
                        <div  class="addrate">

                        <!-- <?php  //echo $B_post_id ?> -->
                        <input type = "button" id="addrate"  value = "Add Reviews" onclick = "window.location = 'rate.php?'"/>
                        </div>
                        <!-- header('Location:../views/postBoarding.php?success&pop=1&amount='.$Aamount.'&lifespan='.$Lifespan); -->
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div> -->
</div>




<!-- </div> -->
<?php include 'footer.php' ?>
</body>
<script type="text/javascript">
    function save_changes() {
  alert("Request is now pending for approval. Please wait for confirmation. Thank you.");
}
</script>


<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}

</script>

<script type="text/javascript">
        let thumbnails = document.getElementsByClassName('thumbnail')

        let activeImages = document.getElementsByClassName('active')

        //console.log(thumbnails.length);
        for (var i = 0; i < thumbnails.length; i++) {



            thumbnails[i].addEventListener('click', function() {
                console.log(activeImages)

                if (activeImages.length > 0) {
                    activeImages[0].classList.remove('active')
                }

                this.classList.add('active')
                document.getElementById('featured').src = this.src
            })
        }
        let buttonRight = document.getElementById('slideRight');
        let buttonLeft = document.getElementById('slideLeft');

        buttonLeft.addEventListener('click', function() {
            document.getElementById('slider').scrollLeft -= 180
        })

        buttonRight.addEventListener('click', function() {
            document.getElementById('slider').scrollLeft += 180
        })
    </script>

<script src="../resource/js/home1.js"></script>
<script src="../resource/js/jquery.js"></script>
</html>