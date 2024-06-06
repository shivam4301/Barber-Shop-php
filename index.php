<?php 
    include_once "./backend/db.php";
    include "./backend/function.php";
    $error="";
    $msg="";

    if(isset($_POST['submit'])){

        if($_POST['cat'] == 'sendMsg'){
           
            $name = $_POST['msgName'];
            $email = $_POST['msgEmail'];
            $contact = $_POST['msgContact'];
            $msg = $_POST['msgMessage'];
            if(send_msg($name, $email , $contact , $msg)){
                echo "Your message send successfully to admin. Thank you.";
                echo "you will be redirect shortly";
                header("refresh:3;url=../index.php");    
            }else{
                $error = "internal error while sending message please try again. Thank you";
            }           
        }

        else if($_POST['cat'] == 'regUser'){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $p1 = $_POST['p1'];
            $p2 = $_POST['p2'];
            $profile_ = $_FILES ['profile']['name'];
            $tmp_image = $_FILES ['profile']['tmp_name']; 
            $imageSize = $_FILES ['profile']['size']; 
            
        
            if(strlen($fname) < 3 ){
                $error="Fistname is too short!";
            }else if(strlen($lname) < 3){
                $error = "Lastname is too short!";
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error = "Email is not valid";
            }else if(is_exist_user($email)){
                $error = "Email id is already registered with system";
            }else if(strlen($p1)<5){
                $error = "password is too short. password should contain 5 character";
            }else if($p1 !== $p2){
                $error = "password is not matching";
            }else if(strlen($contact) < 7){
                $error = "contact number is too short";
            }else if($imageSize > 1048576){
                $error = "*image must be less than 1MB";
            }else{
                if($imageSize == 0){
                    $image = "profile.jpg";
                }else{
                    $image = uniqid() . $profile_;
                }
                
                if(reg_new_user($fname, $lname, $email, $contact, md5($p1), $image)){
                    if(move_uploaded_file($tmp_image, "data/images/profile/$image")) {
                    
                        echo "you will be redirect shortly";
                        echo "<script> alert('successfully registerd. Please login to continue'); </script>";
                        // header("refresh:3;url=./index.php");   
                    }
                    echo "<script> alert('successfully registerd. Please login to continue'); </script>";
                    echo "You are successfully registered. Welcome to our website.";
                    // header("refresh:3;url=./index.php");

                }
            }

            
        }

        else if($_GET['cat'] == 'getMsg'){
            print_r(get_msg());
        }



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
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Alertify-->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <!-- <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> -->
        <style>
            .form-group{
                margin-top: 5px;
            }
        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <!-- <img src="assets/img/navbar-logo.svg" alt="..." /> -->
                <a class="navbar-brand" style="font-family: Jua;" href="#page-top">Barber Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="#login" data-toggle="modal" data-target="#LoginModal">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="" data-toggle="modal" data-target="#RegisterModal">Register</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
         
            <div class="container">
                <div class="masthead-subheading">Welcome To Our World!</div>
                <div class="masthead-heading text-uppercase">Come get shaped up</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Services</h2>
                    <h3 class="section-subheading text-muted">We provide following services.</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <!-- <i class="fas fa-circle fa-stack-2x text-primary"></i> -->
                            <i> <img src="assets/hair-cut-tool.png" height="100px" width="100px"></i>
                        </span>
                        <h4 class="my-3">Hair style</h4>
                        <p class="text-muted">We are the best and well known for hair style. We offer trending hair style and also helps you to choose best according to your face structure. </p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <!-- <i class="fas fa-circle fa-stack-2x text-primary"></i> -->
                            <i> <img src="assets/hair-care.png" height="100px" width="100px"></i>
                        </span>
                        <h4 class="my-3">Hair Color</h4>
                        <p class="text-muted">We have variety of hair color avaibale in our store you can also choose from most famous and realiable brand for hair color. </p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <!-- <i class="fas fa-circle fa-stack-2x text-primary"></i> -->
                            <i> <img src="assets/skin-care.png" height="100px" width="100px"></i>
                        </span>
                        <h4 class="my-3">Facial treatment</h4>
                        <p class="text-muted">We have professional & experienced staff to provide best result for your skin. </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Portfolio</h2>
                    <h3 class="section-subheading text-muted">Highlight of our recent work.</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/1.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Threads</div>
                                <div class="portfolio-caption-subheading text-muted">Starting from $25</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 2-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/2.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Explore</div>
                                <div class="portfolio-caption-subheading text-muted">Starting from $50</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 3-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal3">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/3.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Finish</div>
                                <div class="portfolio-caption-subheading text-muted">Starting from $55</div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">About</h2>
                    <h3 class="section-subheading text-muted">Our History</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/a2.jpeg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>1980</h4>
                                <h4 class="subheading">Our Humble Beginnings</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Started as a first hair cutting shop in Port Arthur now known as Thunder bay.  </p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/a1.jpeg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2010</h4>
                                <h4 class="subheading">A new era start</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Everything getting modernise so we had latest equipment at that time. </p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/a3.jpeg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2015</h4>
                                <h4 class="subheading">Transition to various Service</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Till now we only offer hair styling, from 2015 we started facial & hair treatment. </p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/3.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2022</h4>
                                <h4 class="subheading">In Present</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">We have all the modern technology to get you new look.</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Be Part
                                <br />
                                Of Our
                                <br />
                                Story!
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                    <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/1.jpg" alt="..." />
                            <h4>Parveen Anand</h4>
                            <p class="text-muted">Hair color specialist</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Twitter Profile"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/2.jpg" alt="..." />
                            <h4>Diana Petersen</h4>
                            <p class="text-muted">Skin specialist</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Twitter Profile"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/3.jpg" alt="..." />
                            <h4>Larry Parker</h4>
                            <p class="text-muted">Hair style specialist</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Twitter Profile"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">Meet our new specialize team.</p></div>
                </div>
            </div>
        </section>
        
        <!-- Contact-->
        <section class="page-section" id="contact" > 
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                    <p style="color: white; font-style: italic;">If you have any message/concern/feedback write it here it will be helpful for us to serve you better.</p>
                </div>
                <form id="contactForm" method="POST" action="./backend/" data-sb-form-api-token="">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" id="name" name="msgName" type="text" placeholder="Your Name *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" id="email" name="msgEmail" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <input class="form-control" id="phone" type="tel" name="msgContact" placeholder="Your Phone *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>

                                <input type="hidden" name="cat" value="sendMsg">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" id="message" name="msgMessage" placeholder="Your Message *" data-sb-validations="required"></textarea>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            
                        </div>
                    </div>
                   
                    <!-- <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div> -->
                    <!-- Submit Button-->
                    <div class="text-center"><input type="submit" class="btn btn-primary btn-xl text-uppercase" id="submitButton" name="submit" /></div>
                </form>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Barber Shop-2022</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-twitter"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a> 
                        <a class="link-dark text-decoration-none me-3" href="#!">Terms of Use</a> 
                        <a class="link-dark text-decoration-none" href=""data-toggle="modal" data-target="#AdminModal">Admin</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Hair Style</h2>
                                    <p class="item-intro text-muted">Trending Hairstyle</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/1.jpg" alt="..." />
                                    <p></p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Mike
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Hairstyle,trending
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 2 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Hair Color</h2>
                                    <p class="item-intro text-muted">Recently done hair color</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/2.jpg" alt="..." />
                                    <p></p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Hanna
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Hair-color
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 3 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Face Treatment</h2>
                                    <p class="item-intro text-muted">Acne removal treatment</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/3.jpg" alt="..." />
                                    <p></p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong>Client:</strong>
                                            Ashley
                                        </li>
                                        <li>
                                            <strong>Category:</strong>
                                            Facial-treatment
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Login Model -->
  
  <!-- Modal -->

  <!-- LoginModal -->
  <div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="./backend/" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" name="logEmail" required id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <input type="hidden" name="cat" value="login"> 
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" name="logPassword" required id="exampleInputPassword1">
                </div>

                <br>
                <div class="form-group" style="text-align: center;">
                    <input type="submit" class="btn btn-primary" value="Login" name="submit" />
                </div>
            </form>  
        </div>
        <div class="modal-footer">
            <a href="" style="float: left; padding: 5px;" data-dismiss="modal" data-toggle="modal" data-target="#RegisterModal">Don't have account?</a>  
        </div>
        
      </div>
    </div>
  </div>


  <!-- Register Modal -->
  <div class="modal fade" id="RegisterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Register Yourself </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="index.php" method="post" enctype="multipart/form-data">
                  
                <div class="form-group">
                    <img id="blah" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="your image" style="max-width:100px; max-height:100px; border-radius: 50%;" />
                    <input type="file" name="profile" accept="image/png, image/jpeg" onchange="readURL(this);" >
                    
                </div>    

                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="inpfname">First Name</label>
                            <input type="text" class="form-control" name="fname" required id="inpfname" >
                        </div>    
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="inplname">Last Name</label>
                            <input type="text" class="form-control" name="lname" required id="inplname" >
                        </div>
                    </div>
                </div>
                
               

                <div class="form-group">
                  <label for="InputEmail">Email address</label>
                  <input type="email" class="form-control" name="email" required id="InputEmail" >
                </div>
                <div class="form-group">
                    <label for="inpContact">Contact Number</label>
                    <input type="tel" class="form-control" name="contact" required id="inpContact">
                </div>

                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="p1" required id="exampleInputPassword1">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" class="form-control" name="p2" required id="exampleInputPassword1">
                        </div>
                    </div>
                </div>

                            <input type="hidden" name="cat" value="regUser">
                <br>
                <div class="form-group" style="text-align: center;">
                    <input type="submit" class="btn btn-primary" name="submit" value="Register"/>
                </div>
            </form>  
        </div>
        <div class="modal-footer">
            <a href="#" style="float: left; padding: 5px;" data-dismiss="modal" data-toggle="modal" data-target="#LoginModal">Already have account?</a>  
        </div>
        
      </div>
    </div>
  </div>

  <!-- Admin Login -->
  <div class="modal fade" id="AdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Admin-Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="./backend/" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" name="logEmailAdmin" required id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <input type="hidden" name="cat" value="loginAdmin"> 
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" name="logPasswordAdmin" required id="exampleInputPassword1">
                </div>

                <br>
                <div class="form-group" style="text-align: center;">
                    <input type="submit" class="btn btn-primary" value="Login" name="submit" />
                </div>
            </form>  
        </div>
        
        
      </div>
    </div>
  </div>

<script>

<?php 
if($error !== ""){
    echo "alertify.set('notifier','position', 'top-right');
    alertify.error('$error');";
}else if($msg !== ""){
    echo "alertify.set('notifier','position', 'top-right');
    alertify.success('$msg');";
}


?>


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
</script>
        
    </body>
</html>