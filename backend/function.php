<?php 

include_once "db.php";

function is_exist_user($email){
    include "db.php";
    $rsEmails = mysqli_query($conn,"Select * from users where Email='$email'");
    $numEmails = mysqli_num_rows($rsEmails);
    if($numEmails > 0){
        return true;
    }else{
        return false;
    }
}

function login($email,$password){
  include("db.php");
  $sql = "select * from users where email='$email' AND password = '$password'";
  $result = mysqli_query($conn,$sql);
  $is_exist = mysqli_num_rows($result);
  if ($is_exist > 0) {
    $row = mysqli_fetch_assoc($result);
    if($email === $row['Email'] && $password === $row['Password']){
      session_start();
      $_SESSION['user'] = $row['Fname'] ."". $row['Lname'];
      $_COOKIE['todayDate'] = date("Y-m-d");
      return true;
    }else{
      return false;
    }
  }else{
    return false;
  }

}

function reg_new_user($fname, $lname, $email, $contact, $p1, $image){
    include("db.php");
    $sql = "INSERT INTO `users`(`Fname`, `Lname`, `Email`, `Contact`, `Password`, `Image`) VALUES 
    ('$fname','$lname','$email','$contact','$p1','$image')";
     if(mysqli_query($conn, $sql)){return true;}else{return false;}
}

function reg_new_staff($name, $email, $contact, $category){
    include("db.php");
    $sql = "INSERT INTO `staff`(`Name`, `Email`, `Contact`, `Category`) VALUES ('$name','$email','$contact','$category')";
    if(mysqli_query($conn,$sql)){
      return true;
    }else{
      return false;
    }
}

function get_staff_details(){
  include("db.php");
  $sql = "SELECT * FROM staff";
  $result = mysqli_query($conn,$sql);
  // $data = mysqli_fetch_assoc($result);
  return $result;
}

function get_msg(){

    include("db.php");
    $sql = "SELECT * FROM `messages` ORDER BY ID DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
         return $result;
    } else {
       return 0;
    }
      
      mysqli_close($conn);


}

function send_msg($name, $email , $contact , $msg){
    include("db.php");
    $sql = "INSERT INTO `messages`(`Name`, `Email`, `Contact`, `Msg`) VALUES ('$name','$email','$contact','$msg')";

    if (mysqli_query($conn, $sql)) {
        return true;
      } else {
        return false;
      }
      
      mysqli_close($conn);

}

function get_user_details($email){
    include("db.php");
    $sql = "select * from users where email = '$email'";
    $result = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($result);
    return $data;
}

function update_user_details($fname, $lname, $email, $contact, $password,$image){
    include("db.php");
    if($password !=0){
      $sql = "UPDATE `users` SET `Fname`='$fname',`Lname`='$lname',`Contact`='$contact',`Password`='$password',`Image`='$image' WHERE `Email`='$email'";
    }else{
      $sql = "UPDATE `users` SET `Fname`='$fname',`Lname`='$lname',`Contact`='$contact',`Image`='$image' WHERE `Email`='$email'";
    }
    
    if(mysqli_query($conn,$sql)){
      return true;
    }else{
      return false;
    }

    
}

function get_appointment_data($date){
  include("db.php");
  $sql = "SELECT * FROM `availability` WHERE `Date` = '$date'";
  $result = mysqli_query($conn,$sql);
  return $result;
}

function set_new_date($date){
  include("db.php");
  $tmp = '[[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]]';
  $sql = "INSERT INTO `availability`(`Available`, `Date`) VALUES ('$tmp','$date')";
  if(mysqli_query($conn,$sql)){
    return true;
  }else {
    return false;
  }
}

function get_user_appointment($date, $user){
  include("db.php");
  $sql = "SELECT * FROM `appointment` where `Date` >= '$date' AND `userID` = '$user' ";
  $result = mysqli_query($conn,$sql);
  return $result;
}

function book_appointment($user, $date, $service, $time, $note){
  include("db.php");
  $sql = "INSERT INTO `appointment`( `userID`, `Date`,`Note`, `Service`, `TimeSlot`) VALUES ('$user','$date','$note','$service','$time')";
  if(mysqli_query($conn,$sql)){
    return true;
  }else{
    return false;
  }

}

function update_timeslot($date,$time){
  include("db.php");
  echo $date;
  $sql = "SELECT * from `availability` WHERE `Date` = '$date' ";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_num_rows($result);
  if($row > 0){
    $sql = "UPDATE `availability` SET `Available`='$time'  WHERE `Date` = '$date' ";
    if(mysqli_query($conn,$sql)){
      return true;
    }else {
      return false;
    }
  }else{
    $time = "[[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]]";
    $sql = "INSERT INTO `availability` (`Available`, `Date`) VALUES ('$time','$date')";
    $result = mysqli_query($conn,$sql);
    if($result){return true;}else{echo mysqli_error($conn);  return false;}
  }
  
}

function get_user_history($email){
  include("db.php");
  $sql = "SELECT * FROM `appointment` where `userID` = '$email' ORDER By `Date` DESC ";
  $result = mysqli_query($conn,$sql);
  return $result;
}

function get_admin_appointment(){
  include("db.php");
  $sql = "SELECT A.Fname , A.Lname, A.Contact, B.Date, B.Note, B.Service, B.TimeSlot FROM users A INNER JOIN appointment B ON A.Email = B.userID ORDER BY `Date` DESC;";
  $result = mysqli_query($conn,$sql);
  return $result;
}

function login_admin($email,$password){
  include("db.php");
  $sql = "select * from admin where Email='$email' AND Password = '$password'";
  $result = mysqli_query($conn,$sql);
  $is_exist = mysqli_num_rows($result);
  if ($is_exist > 0) {
    $row = mysqli_fetch_assoc($result);
    if($email === $row['Email'] && $password === $row['Password']){
      session_start();
      $_SESSION['admin'] = $row['Email'];
      return true;
    }else{
      return false;
    }
  }else{
    return false;
  }
}

?>