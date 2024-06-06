<?php 
$error="";
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barber Shop</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/barberIcon.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="../css/user-profile.css">
        <!-- Alertify-->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <script src ="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">
        </script>
        <script>
                console.log(localStorage.getItem('msg'));
            if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }

        </script>
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        
    </head>
    <body id="page-top">
        <?php 
            include_once "navbar.php";
            include "../backend/function.php";
            $services = array("Hair Cutting","Hair Styling","Skin Treatment");
            $user = get_user_details($_SESSION['email']);        
            $history = get_user_history($_SESSION['email']);
        ?>


        <div class="container">
        <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <form action="profile.php" id="profileForm" method="post" enctype="multipart/form-data" autocomplete="off">
                <img class="rounded-circle mt-5" height="150px" width="100%" id="blah" style="max-width:150px; max-height:150px; border-radius: 50%; overflow:hidden;" src="<?php echo "../data/images/profile/" . $user['Image'] ?>"> <br>
                <span class="font-weight-bold"><?php echo $user['Fname'] ." ". $user['Lname'] ?></span> <br>
                <span class="text-black-50"><?php echo $user['Email']; ?></span>
                <label for="profile" class="btn btn-warning mt-2">Upload new Image</label>
                <input type="file" id="profile" name="profile" onchange="readURL(this);"  style="display: none;">
            </div>
           
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-1">
                    <div class="col-md-6"><label class="labels">First Name</label><input type="text" name="fname" class="form-control" placeholder="first name" value="<?php echo $user['Fname'] ?>"></div>
                    <div class="col-md-6"><label class="labels">Last Name</label><input type="text" name="lname" class="form-control" value="<?php echo $user['Lname'] ?>" placeholder="last name"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Contact Number</label><input type="tel" name="contact" class="form-control" placeholder="contact number" value="<?php echo $user['Contact'] ?>"></div>
                    <div class="col-md-12"><label class="labels">Email ID</label><input type="text" name="email" class="form-control" placeholder="enter email id" readonly value="<?php echo $user['Email'] ?>"></div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-6"><label class="labels">New Password</label><input type="password" name="p1" class="form-control" placeholder="new password" value=""></div>
                    <div class="col-md-6"><label class="labels">Confirm Password</label><input type="password" name="p2" class="form-control" value="" placeholder="confirm password"></div>
                </div>
                <input type="hidden" name="cat" value="updateUser">
                <div class="mt-5 text-center">
                    <input class="btn btn-primary" type="submit" name="submit" value="Update Profile"/>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><h4 class="text-right">History</h4></div><br>
                <div class="col-md-12"> 
                    <div class="list-group">
                        <?php while($row = mysqli_fetch_assoc($history)) { ?>
                        <a href="#" class="list-group-item list-group-item-action"><?php echo $services[$row['Service']]."-" .$row['Date'];?></a>
                        <?php } ?>
                        
                    </div>
                </div> <br>
                <h3 id="notification"></h3>
                <!-- <h3 class="notification" id="msgText" style="color: green;"><?php //$msg = "<script>if(localStorage.getItem('msg')!=null){document.writeln(localStorage.getItem('msg'));}else{document.writeln(0);} </script>"; if($msg==0){echo $msg;}  ?> </h3> -->
                <!-- <h3 class="notification" id="alertText" style="color: red;"><?php //$error =  "<script>document.writeln(localStorage.getItem('alert')); </script>"; if($error !=null || $error != ""){echo $error;} ?> </h3> -->
            </div>
            
        </div>

        
        
    </div>
    
</div>

</div>
</div>
</div>

<?php 

$error="";
$msg="";

if(isset($_POST['submit'])){
    if($_POST['cat'] === 'updateUser'){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $p1 = $_POST['p1'];
        $p2 = $_POST['p2'];

        if ($_FILES['profile']['size'] != 0 )
        {
            $profile_ = $_FILES ['profile']['name'];
            $tmp_image = $_FILES ['profile']['tmp_name']; 
            $imageSize = $_FILES ['profile']['size']; 
        }else{
            $imageSize = 0;
        }
        
       
    
        if(strlen($fname) < 3 ){
            $error="Fistname is too short!";
        }else if(strlen($lname) < 3){
            $error = "Lastname is too short!"; 
        }else if(strlen($p1)>0 && strlen($p1)<5){
            $error = "password is too short. password should contain 5 character";
        }else if($p1 !== $p2){
            $error = "password is not matching";
        }else if(strlen($contact) < 7){
            $error = "contact number is too short";
        }else if($imageSize > 1048576){
            $error = "*image must be less than 1MB";
        }else{
            if($imageSize == 0){
                $image = $user['Image'];
            }else{
                $image = uniqid() . $profile_;
            }
            if(strlen($p1) == 0){
                
                if(update_user_details($fname, $lname, $email, $contact, 0,$image)){
                        $msg= "Your details update successfully!";
                        echo "<script> document.getElementById('blah').src= ''; </script>";
                        echo "<script> localStorage.setItem('msg', '$msg');  </script>";
                        echo "<script> localStorage.setItem('alert', '$error');  </script>";
                        $_POST['cat']="";
                        $_POST['submit']="";
                        echo "<script> location.reload(); </script>";
                        if($imageSize>0){
                            if(!move_uploaded_file($tmp_image, "../data/images/profile/$image")) {
                                echo "<script> alert('image not uoloaded'); </script>";
                            }
                        }
                    
                }
            }else{
                if(update_user_details($fname, $lname, $email, $contact, md5($p1),$image)){
                    $msg= "Your details update successfully!";
                    echo "<script> document.getElementById('blah').src= ''; </script>";
                    echo "<script> localStorage.setItem('msg', '$msg');  </script>";
                    echo "<script> localStorage.setItem('alert', '$error');  </script>";
                    $_POST['cat']="";
                    $_POST['submit']="";
                       
                    if(move_uploaded_file($tmp_image, "../data/images/profile/$image")) {
                        
                        echo "<script> alert('image upload faild'); </script>";
                        
                    }
                }
            }

            if($error !== ""){
                echo "alertify.set('notifier','position', 'top-right');
                alertify.error('$error');";
            }
            if($msg !== ""){
                echo "alertify.set('notifier','position', 'top-right');
                alertify.success('$msg');";
            }
        } 


    }
}


?>

<script>
   setTimeout(function(){ 
    localStorage.removeItem('msg');
    localStorage.removeItem('alert');
    document.getElementById("notification").innerHTML = "";
    
    }, 3000);
</script>

<script>

function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
                
               
  
            }
        }

       

        if(localStorage.getItem('msg')!=null)
        {
            // document.writeln(localStorage.getItem('msg'));
            document.getElementById("notification").innerHTML  = localStorage.getItem('msg');
        }
        else
        {
            // document.writeln('NULL');
            // document.getElementById("notification").innerHTML  = "NULL";
        }


</script>







    </body>

</html>