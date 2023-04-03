<?php session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	 <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	 <title>profile</title>
	 <link rel="stylesheet" href="../resource/css/new_home.css">
	 <link rel="stylesheet" href="../resource/css/all.css">
	 <link rel="stylesheet" href="../resource/css/sidebar2.css">
	 
   
	 <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
     <script src="https://kit.fontawesome.com/a076d05399.js"></script>
	 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/vquery/5.0.1/v.min.js" integrity="sha512-JTaEfpc0EjojckV4ObScEHC2yHkDKUXEC5xO4Yb8upLDUR/2clSQKloqw6Ocp66a7dW689eKo0b/KC9C+T6osg==" crossorigin="anonymous"></script>
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
    <link rel="stylesheet" href="../resource/css/profile1.css">
    <link rel="stylesheet" href="../resource/css/editprofile1.css">
    <link rel="stylesheet" href="../resource/css/extra.css">

    
</head>

 <body>
<div class="backblur" id="backblur">
 <?php require "header1.php"?>
	 <div class="container1">
     	
     <div class="container2">
        <div class="sidebar_b">
        <?php require "sidebar1.php"?>	
        </div>

        <?php  $Userdata=unserialize($_GET['user']);

                $first_name=$Userdata['first_name'];
                $last_name=$Userdata['last_name'];
                $email=$Userdata['email'];
                $address=$Userdata['address'];
                $profileimage=$Userdata['profileimage'];
                $nic=$Userdata['NIC'];

                if($_SESSION['level']=='boarder'){

                    $Bid=$Userdata['Bid'];
                    $nic_image=$Userdata['image'];
                    if($Userdata['gender']=='Boy'){
                        $gender='Male';
                        }else{
                        $gender='Female';
                        }
                    $institute=$Userdata['institute'];
                    $telephone=$Userdata['telephone'];

                }


                    $summary=unserialize($_GET['summary']);
                    $summary1=$summary[0];
                    $summary2=$summary[1];
                    $summary3=$summary[2];  
                    // print_r($summary); 

        ?>
<?php  if($_SESSION['level']=="food_supplier"){
                          $level_name = 'Food supplier';}

                elseif($_SESSION['level']=="boarder"){
                          $level_name = 'Boarder';}

                elseif($_SESSION['level']=="boardings_owner"){
                          $level_name = 'Boardings Owner';}

                elseif($_SESSION['level']=="administrator"){
                          $level_name = 'Administrator';}
                          else{
                          $level_name = 'User';}
          ?>



        <div class="middle_b">
          <h1>edit &nbsp;Profile</h1>
              <div class="mid_A">
                <h3>Account Information</h3>
                <hr/>
                <form action="../controller/editprofile_control.php" method="post"> 
                        <p>
                            <div class="edit_lable">                            
                            <div class="labal"><span>First Name</span> &nbsp; :</div> 
                            <div class="animate_inupt">
                                <input type="text" id="fname" name="first_name" value='<?php echo $first_name ?>'>
                            </div>
                            </div>
                        </p>
                        <p>
                            <div class="edit_lable">
                            <div class="labal"><span>Last Name</span> &nbsp;&nbsp;: </div>
                            <div class="animate_inupt">
                                <input type="text" id="lname" name="last_name" value='<?php echo $last_name ?>'>
                            </div>
                            </div>
                        </p>
                        <p>
                            <div class="edit_lable">
                            <div class="labal"><span>Address</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</div> 
                            <div class="animate_inupt">
                                <textarea id="subject" name="address" placeholder='<?php echo $address ?>' style="height:50px"><?php echo $address ?></textarea>
                            </div>
                            </div>
                        </p>

                        <?php  if($_SESSION['level']=='boarder'){
                                echo 
                        '<p>
                            <div class="edit_lable">
                            <div class="labal"><span>Contact </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </div>
                            <div class="animate_inupt">
                                <input type="text" id="contactno" name="contactno" value="'.$telephone.'">
                            </div>
                            </div> 
                        </p>'

                    ;} ?>


                        <p>
                            <div class="edit_lable">
                            <span>Email </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;<?php echo $email ?> </p>
                            </div>
                        </p>
                        <p>
                            
                            <div class="edit_lable">
                            <span>User Type </span>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $level_name ?> </p>
                            </div>
                        </p>
                            
                            <div class="edit_lable">
                                <div class="submit_button">
                                <input type="reset" name="discard_btn" value="discard" onclick="discard()">
                                <input type="submit" name="editprofile_btn" value="Save Changes" onclick="save_changes()">
                                </div>
                            </div>
              </form>
                    
                    </br></br>

                    <div class="change_password">
                    <form id="changeform" name='changeform' action='../controller/editprofile_control.php?changepwd=1' method="post" onSubmit="return isvalid();">
                        <h3>Change Password</h3>
                        <hr/>
                        
                            <div class="edit_lable">                            
                                <div class="labal"><span>Current Password</span> &nbsp; :</div> 
                                <div class="animate_inupt">
                                    <input type="password" id="current_password" name="current_password" value=''>
                                </div>
                            </div>
                        
                        
                            <div class="edit_lable">                            
                                <div class="labal"><span>New Password</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</div> 
                                <div class="animate_inupt">
                                    <input type="password" id="new_password" name="new_password" value=''>
                                </div>
                            </div>
                        
                        
                            <div class="edit_lable">                            
                                <div class="labal"><span>Confirm Password</span>  :</div> 
                                <div class="animate_inupt">
                                    <input type="password" id="confirm_password" name="confirm_password" value=''>
                                </div>
                            </div>
                        
                            <div class="edit_lable">
                                <div class="submit_button">
                                <input type="submit" name="password_change_btn" value="Change Password">
                                </div>
                            </div>
                            
                        </form>
                    </div>
              </div>
              <div class="mid_B">
                <div class="profile_photo">
                  <img src="<?php echo $profileimage ?>" class="profile_img" alt="">
                  <a onclick="toggle()"><div class="edit_pic" ><i class="fas fa-camera"></i></div></a>
                </div>
                <div class="prof_info">
                  <h2><?php echo ''.$_SESSION['first_name'].'&nbsp;  '.$_SESSION['last_name']?></h2>
                  <p> <?php echo $level_name?></p>
                </div>


<!-- ******************summary dash board of the profile********************* -->
                
<?php 
                if($_SESSION['level']=='student'){

                  echo '<div class="status">
                  <div class="statbox">
                    <div class="vertical_bar"></div>
                              <div class="info">
                                <div class="name">Requests</div>
                                <div class="num"><div>'.$summary1['requests'].'</div></div>
                              </div>
                    <div class="vertical_bar"></div>
                              <div class="info">
                                <div class="name">Accepted</div>
                                <div class="num"><div>'.$summary2['accepted'].'</div></div>
                              </div>
                    <div class="vertical_bar"></div>
                              <div class="info">
                                <div class="name">Notifications</div>
                                <div class="num"><div>'.$summary3['notification'].'</div></div>
                              </div>
                    <div class="vertical_bar"></div>
                  </div>
                </div>';

                }else if($_SESSION['level']=='boarder'){
                  
                    echo '<div class="status">
                    <div class="statbox">
                      <div class="vertical_bar"></div>
                                <div class="info">
                                  <div class="name">Due Payments</div>
                                  <div class="num"><div>0</div></div>
                                </div>
                      <div class="vertical_bar"></div>
                                <div class="info">
                                  <div class="name">Notifications</div>
                                  <div class="num"><div>'.$summary3['notification'].'</div></div>
                                </div>
                      <div class="vertical_bar"></div>
                                <div class="info">
                                  <div class="name">Current orders</div>
                                  <div class="num"><div>'.$summary2['delivaring'].'</div></div>
                                </div>
                      <div class="vertical_bar"></div>
                    </div>
                  </div>';

                }else if($_SESSION['level']=='boardings_owner'){

                  echo '<div class="status">
                  <div class="statbox">
                    <div class="vertical_bar"></div>
                              <div class="info">
                                <div class="name">New Requests</div>
                                <div class="num"><div>'.$summary1['newRequest'].'</div></div>
                              </div>
                    <div class="vertical_bar"></div>
                              <div class="info">
                                <div class="name">Boarders</div>
                                <div class="num"><div>'.$summary2['boarders'].'</div></div>
                              </div>
                    <div class="vertical_bar"></div>
                              <div class="info">
                                <div class="name">Notifications</div>
                                <div class="num"><div>'.$summary3['notification'].'</div></div>
                              </div>
                    <div class="vertical_bar"></div>
                  </div>
                </div>';

                }else if($_SESSION['level']=='food_supplier'){

                  echo '<div class="status">
                  <div class="statbox">
                    <div class="vertical_bar"></div>
                              <div class="info">
                                <div class="name">New Orders<br><br></div>
                                <div class="num"><div>'.$summary1['new_order'].'</div></div>
                              </div>
                    <div class="vertical_bar"></div>
                              <div class="info">
                                <div class="name"><center>Currently<br>Active Orders</center></div>
                                <div class="num"><div>'.$summary2['to_deliver'].'</div></div>
                              </div>
                    <div class="vertical_bar"></div>
                              <div class="info">
                                <div class="name">Notification<br><br></div>
                                <div class="num"><div>'.$summary3['notification'].'</div></div>
                              </div>
                    <div class="vertical_bar"></div>
                  </div>
                </div>';

                }else{
                  echo '';
                } 
                
                ?>


                
              </div>
        </div>
        
    </div>

</div>
</div>	

<div class="outerbx" id="outerbx">
	<h2>Upload Profile Image</h2>
	<hr/>

	<div class="drag">

		<div class="dragbox">
		<p>Drop Image Here</p>
        </div>
 
		<form action="../controller/editprofile_control.php" method="post" enctype="multipart/form-data">
  <br/>
  <input type="file" name="fileToUpload" id="fileToUpload"><br/><br/>
  <input type="submit" value="Upload Image" name="submit">
 
</form>
	</div>
</div>
     
     



	 <script>
    // $('.btn').click(function(){
    //   $(this).toggleClass("click");
      $('.sidebar').toggleClass("show");
    // });
      $('.profile-btn').click(function(){
        $('nav ul .profile-show').toggleClass("show");
        $('nav ul .first').toggleClass("rotate");
      });
      $('.serv-btn').click(function(){
        $('nav ul .serv-show').toggleClass("show1");
        $('nav ul .second').toggleClass("rotate");
      });

      $('nav ul .open-show').toggleClass("show1");

      $('nav ul li').click(function(){
        $(this).addClass("active").siblings().removeClass("active");
      });
    </script>


    <script>
    function discard() {
    alert("This will ignore the changes you made!");
    }

    function save_changes() {
    alert("Do you want to save changes of your profile?");
    }

    function toggle(){
        var backblur=document.getElementById('backblur');
        backblur.classList.toggle('active');
        var outerbx=document.getElementById('outerbx');
        outerbx.classList.toggle('active');
    }

   

    

    // function change_password() {
    // if(isvalid()==true){
    // alert("Are you sure you want to change password? ");
    //     return true;
    // }else{
    //     document.getElementById("myForm").action = "/action_page.php";
    //     }
    // }

function isvalid(){
    if((document.changeform.current_password.value)=='') {
        alert("current password field is empty!");
        return false;
    } else if(document.changeform.new_password.value=='') {
        alert("new password field is empty!");
        return false;
    }else if(document.changeform.confirm_password.value==''){
        alert("confirm password field is empty!");
        return false;
    }else if(document.changeform.new_password.value!=document.changeform.confirm_password.value){
        alert("confirm password does not match with new pasword!");
        return false;
    }else{
        
        // document.getElementById("changeform").action = "../controller/editprofile_control.php?changepwd=1";
        return true;
    }
}

    </script>

</body>
</html>

    