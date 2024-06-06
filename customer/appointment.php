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
        <link rel="icon" type="image/x-icon" href="../assets/barberIcon.png" />
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
        <!-- <script src="../js/scripts.js"></script> -->
        <!-- <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> -->

        <script>
           var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
            document.cookie = "todayDate" + "=" + today + ";";

            // console.log(today);
         
        </script> 
        <style>
            .card{
                border-radius: 25px;
                padding: 5px;
                height: 100%;
            }
        </style>


    </head>
    <body id="page-top">
        <!-- Navigation-->
        <?php 
        
            include_once "navbar.php";
            include "../backend/function.php";
          
            function getData(){
        
             

                if(!isset($_GET['Date'])){
                    $today = date("Y-m-d");
                }else{
                  $today = $_GET['Date'];
                }
                $app = get_appointment_data($today);
              
                      if(mysqli_num_rows($app)!=1){
                            if(set_new_date($today)){
                              $app = get_appointment_data($today);
                              $data= mysqli_fetch_assoc($app);
                              $a = $data['Available']; 
                              return $a;
                              
                            }
                        }else{
                              $data= mysqli_fetch_assoc($app);
                              $a = $data['Available']; 
                              return $a;
                              
                        }
              }
        ?>

<script>



  
</script>
   <!-- Appointment Content -->
    <div class="container">
            <h5 class="mt-4">What service you would like to book today?</h5>

            <div class="row p-5">
                <div class="col-sm mb-4">
                    <div class="card" style="width: 18rem;">
                        
                        <div class="card-body">
                          <h5 class="card-title">Need Hair styling</h5>
                          <p class="card-text">We have professional team of hair styling which definatly gives you a better look you wanted to..</p>
                          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Book it now!</a>
                        </div>
                      </div>
                </div>

                <div class="col-sm mb-4">
                    <div class="card" style="width: 18rem;">
                        
                        <div class="card-body">
                          <h5 class="card-title">Want to colour your hair?</h5>
                          <p class="card-text">We have variety of hair color available from the famous brand you love.</p>
                          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Book it now!</a>
                        </div>
                      </div>
                </div>

                <div class="col-sm mb-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">Do you have acne or any skin problem?</h5>
                          <p class="card-text">Don't worry we'll take care of your skin and we guarantee that our treatment gives 100% of result within 30 days.</p>
                          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Book it now!</a>
                        </div>
                      </div>
                </div>
            </div>
<input type="hidden" name="todayDate" id="todayDate">
<!-- Appointment modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Appointment Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="../backend/" method="POST">
  <div class="form-row">
    <div class="form-group col-sm">
      <label for="inputEmail4">Date</label>
      <input type="date" name="date" class="form-control" onchange="DateChange();"   id="dateSelect">
    </div>

    <div class="form-group col-sm mt-2">
      <label >Note</label>
      <textarea name="note" class="form-control"  cols="2" rows="2"></textarea>
      
      
    </div>
    
    <div class="form-group col-sm mt-2">
    <select class="form-select" id="service" name="service" aria-label="Default select example" onchange="myFunction()">
          <option selected>Select Service</option>
          <option value="0">Hair Cutting</option>
          <option value="1">Hair Styling</option>
          <option value="2">Skin Treatment</option>
    </select>
    </div> 
    <div class="form-group col-sm mt-2">
    <select class="form-select" id="time" name="time" aria-label="Default select example" onchange="selectedTime()">
          <option selected>Select Time</option>
          
    </select>
    </div> 
  </div>
      </div>
       <input type="hidden" name="appDate" id="appDate">     
      <input type="hidden" name="cat" value="AddAppointment"/>
      <input type="hidden" name="a" id='ftime' >
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" onclick="finalCall()" name="submit" value="Book" />
      </div>
    </div>
  </div>
</form>
</div>
    </div>

<script>
  document.getElementById("appDate").value = localStorage.getItem('tempTime');
  var a = <?php echo getData();?>;
  console.log(a);
 
  $('#exampleModal').modal('show');
  
  document.getElementById("todayDate").value = today;
  document.getElementById("dateSelect").value = "<?php if(isset($_GET['Date'])){ echo $_GET['Date']; }?>";

  
  function DateChange(){
    console.log("heyyyy");

    var d = document.getElementById("dateSelect").value;
    document.cookie = "todayDate" + "=" + d + ";";
    localStorage.setItem('tempTime',d);
    document.getElementById("appDate").value = localStorage.getItem('tempTime');

    window.location.href = "http://"+location.host+"/finalproject/customer/appointment.php?Date="+d+" ";

    $('#exampleModal').modal('show');
    a = <?php if(isset($_GET['Date'])){ echo getData();} else{ echo getData();} ?>;
    console.log(d);
    console.log(a);
  }

  var timeSlot = ["12:00 PM to 01:00 PM",
                  "01:00 PM to 02:00 PM",                
                  "02:00 PM to 03:00 PM",
                  "03:00 PM to 04:00 PM",
                  "04:00 PM to 05:00 PM"
                ];
  

  var selectedService,selectedSlot;

  function selectedTime(){
    var e = document.getElementById("time");
    var strUser = e.value;
    selectedSlot = strUser;  
    console.log(strUser);
    finalCall();
  }

  function finalCall(){
    console.log(a);
    console.log("Service is " + selectedService + " Time is: " + selectedSlot);
    console.log("Before" + a[selectedService]);
    a[selectedService][selectedSlot] = 1;
    console.log("After" + a[selectedService]);

    console.log(a);   
    var finalArray = JSON.stringify(a);
    document.getElementById("ftime").value = finalArray;
    localStorage.setItem('time',finalArray);
  }

function myFunction() {
  // console.log(Array.isArray(a));
  console.log(Array.from(a));
  document.getElementById('time').innerText = null;   

  var x = document.getElementById("service").value;
  var s = document.getElementById("time");
  
  var option = document.createElement("option");
  option.setAttribute("value", "00");
  var t = document.createTextNode("Select Time");
  option.appendChild(t);
  s.appendChild(option);

  selectedService = x;

  for (let index = 0; index < 5; index++) {
      if(a[x][index]==0){
        console.log(timeSlot[index]);
        var option = document.createElement("option");
        option.setAttribute("value", index);
        var t = document.createTextNode(timeSlot[index]);
        option.appendChild(t);
        s.appendChild(option);
      }
  }

}
    // var MinDate = new Date().toISOString().split('T')[0];
    document.getElementById("dateSelect").setAttribute('min', today);
    
</script>

</body>
</html>