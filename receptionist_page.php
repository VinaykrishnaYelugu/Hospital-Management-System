<?php
  include 'connect.php';
  $r_id = $_GET['r_id'];

  $sql = "select * from `receptionists` where R_id='$r_id'";
  $result = mysqli_query($con,$sql);
   
  $name = "Sir/Madam";
  if( $result ){
    $row = mysqli_fetch_assoc($result);
    $name = $row['R_name'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>  RCEPTIONISTS CONTROL PAGE </title>
</head>
<body style=" background-image:url(img_9.jpg);  background-size : cover;    width : 100%; ">
      <a href="home.php" class="btn btn-primary m-5"> BACK TO HOME PAGE </a>
      <div class="container" 
style=" background-color : white; opacity : 0.9; ">
        <?php 
          echo '<h1> WELCOME '.$name.' ...</h1>';
          echo '
          <a href="add_patient.php?r_id='.$r_id.'" class="btn btn-primary my-5 w-100" > BOOK NEW APPOINTMENT </a>
          ';
        ?>

         <h3> All Appointment Details.. </h3>
         <table class="table">
          <tr>
            <th scope="col">Appointment no  </th>
            <th scope="col">Doctor Id  </th>
            <th scope="col">Patient Id</th>
            <th scope="col">Receptionist Id</th>
            <th scope="col">Appointment Date</th>
            <th scope="col">Appointment Time</th>
          </tr>

          <?php
            $sql = "select * from `appointments` order by A_no desc";
            $result = mysqli_query($con,$sql);
            if( $result ){
               while(  $row = mysqli_fetch_assoc($result)  ){
                     $A_no = $row['A_no'];
                     $Ad_id = $row['Ad_id'];
                     $Ar_id = $row['Ar_id'];
                     $Ap_id = $row['Ap_id'];
                     $A_date = $row['A_date'];
                     $A_time = $row['A_time'];
                     echo '
                     <tr>
                        <th scope="row"> '.$A_no.' </th>
                        <td> '.$Ad_id.' </td>
                        <td> '.$Ap_id.' </td>
                        <td> '.$Ar_id.' </td>
                        <td> '.$A_date.' </td>
                        <td> '.$A_time.' </td>
                     </tr>
                     ';
               }
              }
             ?>
         </table>
    </div>
</body>
</html>