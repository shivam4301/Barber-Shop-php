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
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
            <style>
                .form-group{
                    margin-top: 5px;
                }
            </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <?php 
        
            include_once "navbar.php";
            include "../backend/function.php";
            $staff = get_staff_details();
            $counter=0;
        ?>
        <div class="container">
        <br>
        <a href="" class="btn btn-primary m-5" data-toggle="modal" data-target="#AddEmployee" style="float: right;">+ Add New </a><br>
        
          <h3>Employee List</h3>  

        <table class="table table-striped">
            
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Contact</th>
      <th scope="col">Email</th>
      <th scope="col">Speciality</th>
    </tr>
  </thead>
  <tbody>

     <?php 
        while($row = mysqli_fetch_assoc($staff)){
            
     ?>           
    <tr>
      <th scope="row"><?php echo ++$counter; ?></th>
      <td><?php echo $row['Name'] ?></td>
      <td><?php echo $row['Contact'] ?> </td> 
      <td><?php echo $row['Email'] ?></td>
      <td><?php echo $row['Category'] ?></td>
    </tr>
    <?php 
        }
    ?>
  

    
    
  </tbody>
</table>

        </div>

<!-- Add New Employee Modal -->
<div class="modal fade" id="AddEmployee" tabindex="-1" aria-labelledby="AddEmployee" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="../backend/" method="POST">
            <div class="form-group">
                <label for="FullName">Name</label>
                <input type="text" name="name" class="form-control" required id="FullName">
            </div>
            <div class="row">
                <div class="col-sm">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp">
                            
                        </div>
                </div>
                <div class="col-sm">
                       <div class="form-group">
                            <label for="exampleInputEmail1">Contact Number</label>
                            <input type="tel" class="form-control" name="contact" required id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    <input type="hidden" name="cat" value="RegStaff">
                </div>
            </div>

            <div class="form-group col-12">
                <label for="inputState">Speciality</label>
                <select id="inputState" class="form-control" required name="category">
                    <option selected>Choose Speciality</option>
                    <option>Hair Stylist</option>
                    <option>Skin care Stylist</option>
                </select>
                </div>
                        
            <br>
            
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submit"/>
      </div>
      </form>
    </div>
  </div>
</div>

        
    </body>
</html>