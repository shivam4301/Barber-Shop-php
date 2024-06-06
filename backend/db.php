<?php 

$conn = mysqli_connect("localhost","root","","BarberShop");

if(!$conn){
    echo "Error whiling connecting database!" .  mysqli_connect_error();
}


?>