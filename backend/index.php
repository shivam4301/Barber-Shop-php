<?php 
    include_once "db.php";
    include "function.php";


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

            }           
        }else if($_POST['cat'] == 'login'){
              $email = $_POST['logEmail'];
              $password = $_POST['logPassword'];
            if(login($email, md5($password))){
                $_SESSION['email'] = $email;
                echo "loging in...";
                echo "you will be redirect shortly";
                header("refresh:3;url=../customer"); 
            }else{
                echo "emailId or password incorrect! Please try again!";
                header("refresh:2;url=../index.php");
            }

        }else if($_POST['cat'] == 'RegStaff'){
               $name = $_POST['name'];
               $email = $_POST['email'];
               $contact = $_POST['contact'];
               $category = $_POST['category'];

               if(!reg_new_staff($name,$email,$contact,$category)){
                    echo "Error while adding new employee";
                    header("Location: ../admin/index.php");
               }else{
                    header("Location: ../admin/staff.php");

               }
        }else if($_POST['cat'] == 'AddAppointment'){
            session_start();
            $date = $_POST['appDate'];
            $service = $_POST['service'];
            $time = $_POST['time'];
            $user = $_SESSION['email'];
            $a = $_POST['a'];
            $note = $_POST['note'];
       
        
            if(book_appointment($user,$date,$service,$time,$note)){
                if(update_timeslot($date, $a ))
                {   
                    echo "Appointment booked.";
                    header("refresh:3; url= ../customer/index.php");
                    
                }
                
            }else{
                echo "Error while booking appointment";
                header("refresh:3; url= ../customer/index.php");
            }
        }else if($_POST['cat']=="loginAdmin"){
            $email = $_POST['logEmailAdmin'];
            $password = $_POST['logPasswordAdmin'];
            if(!login_admin($email,md5($password))){
                echo "Login Faild..";
                header("refresh:1; url= ../index.php");
            }else{
                echo "Welcome Admin";
                header("refresh:1; url= ../admin/index.php");
            }
        }

        

    }

?>