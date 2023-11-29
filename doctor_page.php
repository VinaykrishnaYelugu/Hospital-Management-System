<?php
  include 'connect.php';
  $D_id = $_GET['D_id'];

  $sql = "select * from `doctors` where D_id='$D_id'";
  $result = mysqli_query($con,$sql);
   
  $name = "Sir/Madam";
  if( $result ){
    $row = mysqli_fetch_assoc($result);
    $name = $row['D_name'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>  DOCTORS CONTROL PAGE </title>
</head>
<body style=" background-image:url(img_13.jpg);  background-size : cover;    width : 100%; ">
      <a href="home.php" class="btn btn-primary m-5"> BACK TO HOME PAGE </a>
      <div class="container" style=" background-color : white; opacity : 0.9; ">
        <?php 
          echo '<h1> WELCOME '.$name.' ...</h1>';
        ?>

         <br /> <br />  <hr color="blue" />
         <h3> All Appointment Details.. </h3>
         <table class="table">
          <tr>
            <th scope="col">Appointment no  </th>
            <th scope="col">Patient Id</th>
            <th scope="col">Receptionist Id</th>
            <th scope="col">Appointment Date</th>
            <th scope="col">Appointment Time</th>
          </tr>

          <?php
            $sql = "select * from `appointments` where Ad_id='$D_id' order by A_no asc";
            $result = mysqli_query($con,$sql);
            if( $result ){
               while(  $row = mysqli_fetch_assoc($result)  ){
                     $A_no = $row['A_no'];
                     $Ar_id = $row['Ar_id'];
                     $Ap_id = $row['Ap_id'];
                     $A_date = $row['A_date'];
                     $A_time = $row['A_time'];
                     echo '
                     <tr>
                        <th scope="row"> '.$A_no.' </th>
                        <td> '.$Ap_id.' </td>
                        <td> '.$Ar_id.' </td>
                        <td> '.$A_date.' </td>
                        <td> '.$A_time.' </td>
                        <td>
                           <button class="btn btn-primary" ><a href="prescription.php?values='.$A_no.','.$D_id.','.$Ap_id.' " class="text-light" > START DIAGNOSIS </a></button>
                        </td>                        
                     </tr>
                     ';
               }
              }
             ?>
         </table>

         <?php
           echo '<a href="app_by_DnT.php?D_id='.$D_id.'" class="btn btn-primary w-100 my-5"> VIEW APPOINTMENTS BY DATE & TIME </a>';
          ?>
       </div>
     </body>
</html>