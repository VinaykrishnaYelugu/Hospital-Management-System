<?php
  include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>  ADMIN CONTROL PAGE </title>
</head>
<body style=" background-image:url(img_2.jpg);  background-size : cover;    width : 100%; ">
    <a href="home.php" class="btn btn-primary m-5"> BACK TO HOME PAGE </a>
    <div class="container">
        <h2 style="color:blue; font-size:50px; "> DOCTORS SECTION </h2> 

           <a href="add_doctors.php" class="btn btn-primary my-5" > Add new DOCTOR </a>



         <table class="table" style=" background-color : white; opacity : 0.85; ">
          <tr>
            <th scope="col">Doctor-id</th>
            <th scope="col">Doctor-name</th>
            <th scope="col">Gender</th>
            <th scope="col">Specialization</th>
            <th scope="col"> UPDATE/REMOVE </th>
          </tr>

          <?php
            
            $sql = "select * from `doctors`";
            $result = mysqli_query($con,$sql);
            if( $result ){
               while(  $row = mysqli_fetch_assoc($result)  ){
                     $D_id = $row['D_id'];
                     $D_name = $row['D_name'];
                     $D_gender = $row['D_gender'];
                     $Specialization = $row['Specialization'];
                     echo '
                     <tr>
                        <th scope="row"> '.$D_id.' </th>
                        <td> '.$D_name.' </td>
                        <td> '.$D_gender.' </td>
                        <td> '.$Specialization.' </td>
                        <td>
                           <a href="update_doctor.php?update_id= '.$D_id.' " class="btn btn-primary"> Update </a>
                           <a href="delete_doctor.php?delete_id= '.$D_id.' " class="btn btn-danger" > Delete </a>
                        </td>
                     </tr>
                     ';
               }
              }
             ?>
         </table>
    </div>
   <br /> <br /> <br /> <hr color="green" size="30px" />  <br /> <br />
    <div class="container">
        <h2 style="color:blue; font-size:50px; "> RECEPTIONISTS SECTION </h2> 
           <a href="add_receptionists.php" class="btn btn-primary my-5" > Add new RECEPTIONIST </a>


         <table class="table" style=" background-color : white; opacity : 0.85; ">
          <tr>
            <th scope="col">Receptionist-id</th>
            <th scope="col">Receptionist-name</th>
            <th scope="col">AGE</th>
            <th scope="col">Gender</th>
            <th scope="col"> UPDATE/REMOVE </th>
          </tr>

          <?php
            
            $sql = "select * from `receptionists`";
            $result = mysqli_query($con,$sql);
            if( $result ){
               while(  $row = mysqli_fetch_assoc($result)  ){
                     $R_id = $row['R_id'];
                     $R_name = $row['R_name'];
                     $R_age = $row['R_age'];
                     $R_gender = $row['R_gender'];
                     echo '
                     <tr>
                        <th scope="row"> '.$R_id.' </th>
                        <td> '.$R_name.' </td>
                        <td> '.$R_age.' </td>
                        <td> '.$R_gender.' </td>
                        <td>
                           <a href="update_receptionist.php?update_id= '.$R_id.' " class="btn btn-primary" > Update </a>
                           <a href="delete_receptionist.php?delete_id= '.$R_id.' " class="btn btn-danger" > Delete </a>
                        </td>
                     </tr>
                     ';
               }
              }
             ?>
         </table>
    </div>

    <br /> <br /> <br /> <hr color="green" size="30px" />  <br /> <br />
    <div class="container">
        <h2 style="color:blue; font-size:50px; "> MEDICINE STOCK SECTION </h2> 

           <a href="add_medicines.php" class="btn btn-primary my-5" > Add new Medicines </a>


         <table class="table" style=" background-color : white; opacity : 0.85; ">
          <tr>
            <th scope="col">Medicine code</th>
            <th scope="col">Medicine name</th>
            <th scope="col">Medicine cost</th>
            <th scope="col">Medicine company</th>
            <th scope="col">Exp. date</th>
            <th scope="col">Update/Remove medicine stock</th>
         </tr>

          <?php
            
            $sql = "select * from `medicines`";
            $result = mysqli_query($con,$sql);
            if( $result ){
               while(  $row = mysqli_fetch_assoc($result)  ){
                     $M_code = $row['M_code'];
                     $M_name = $row['M_name'];
                     $M_cost = $row['M_cost'];
                     $company = $row['company'];
                     $exp_date = $row['exp_date'];
                     echo '
                     <tr>
                        <th scope="row"> '.$M_code.' </th>
                        <td> '.$M_name.' </td>
                        <td> '.$M_cost.' </td>
                        <td> '.$company.' </td>
                        <td> '.$exp_date.' </td>
                        <td>
                           <a href="update_medicines.php?M_code= '.$M_code.' " class="btn btn-primary" > Update </a>
                           <a href="delete_medicines.php?M_code= '.$M_code.' " class="btn btn-danger" > Delete </a>
                        </td>
                     </tr>
                     ';
               }
              }
             ?>
         </table>
    </div>
</body>
</html>