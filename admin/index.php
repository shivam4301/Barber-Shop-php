<?php 
session_start();
if(!isset($_SESSION['admin'])){
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

        <link rel="stylesheet" href="../css/datatable.css">
        <script src="../js/jQuery.js"></script>
        <script src="../js/dataTable.js"></script>
    
   
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <?php 
        
            include_once "navbar.php";
            include "../backend/function.php";
            $data = get_admin_appointment();
            $services = array("Hair Cutting","Hair Styling","Skin Treatment");
            $timeSlot = array("12:00 PM to 01:00 PM","01:00 PM to 02:00 PM","02:00 PM to 03:00 PM","03:00 PM to 04:00 PM","04:00 PM to 05:00 PM");
        ?>

        <div class="container mt-5">
        <h3 class="mb-3">Appointment List</h3>
        <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Date</th>
                <th>Note</th>
                <th>Service</th>
                <th>Time Slot</th>
            </tr>
        </thead>
        <tbody> 
            <?php while($row= mysqli_fetch_assoc($data)){ ?>
            <tr>
                <td><?php echo $row['Fname']." " . $row['Lname'] ?></td>
                <td><?php echo $row['Contact'] ?></td>
                <td><?php echo $row['Date'] ?></td>
                <td><?php echo $row['Note'] ?></td>
                <td><?php echo $services[$row['Service']]; ?></td>
                <td><?php echo $timeSlot[$row['TimeSlot']]; ?></td>
            </tr>
            <?php } ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Date</th>
                <th>Note</th>
                <th>Service</th>
                <th>Time Slot</th>
            </tr>
        </tfoot>
    </table>



        </div>
        
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
            order: [[3, 'desc']],});
        });
    </script>
        
    </body>
</html>