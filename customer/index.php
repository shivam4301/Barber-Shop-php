<?php 
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
        <link rel="icon" type="image/x-icon" href="assets/barberIcon.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <!-- <script src="js/scripts.js"></script> -->
        <!-- <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> -->
        <style>
            .card:hover{
                background-color: #f0f0f0;
                box-shadow: 10px 10px 5px lightblue;
            }

       


        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <?php 
        
            include_once "navbar.php";
            include "../backend/function.php";
            $data = get_user_appointment(date("Y-m-d"),$_SESSION['email']);
            $services = array("Hair Cutting","Hair Styling","Skin Treatment");
            $timeSlot = array("12:00 PM to 01:00 PM","01:00 PM to 02:00 PM","02:00 PM to 03:00 PM","03:00 PM to 04:00 PM","04:00 PM to 05:00 PM");
            
        ?>
        



        <div class="container home-content mt-4">
            <h2 style="font-family:Jua;">Welcome <?php echo $_SESSION['user']; ?></h2>
            
            <h4 class="text-center mt-3 mb-3">Upcoming Appointment</h4>
            
                    
                
            <div class="row ">
            <?php while($row = mysqli_fetch_assoc($data)){ ?>
                <div class="col-sm d-flex justify-content-center">
                    <div class="card mb-3  text-center" style="width: 18rem; border-radius: 25px; padding: 10px;">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $services[$row['Service']]; ?></h5>
                          <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['Date'] . "<br>" . $timeSlot[$row['TimeSlot']] ?> </h6>
                          <p class="card-text"><?php echo $row['Note']; ?></p>
                          <!-- <a href="#" class="btn btn-primary">Modify</a>
                          <a href="#" class="btn btn-danger">Cancel</a> -->
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>    

        </div>




    </body>
</html>
    