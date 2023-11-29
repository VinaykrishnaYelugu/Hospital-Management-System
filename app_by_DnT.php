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
    <title>  APPOINTMENTS BY DATE & TIME </title>
</head>
<body style=" background-image:url(img_14.jpg);  background-size : cover;    width : 100%; ">
        <?php 
          echo '
             <a href="doctor_page.php?D_id='.$D_id.'" class="btn btn-primary m-5"> BACK TO DOCTOR PAGE </a>
             <div class="container">
             <h1> WELCOME '.$name.' ...</h1>
          ';
        ?>

        <?php

           echo '<form action="app_by_DnT.php?D_id='.$D_id.'" method="POST">
            <div class="form-group" >
                <input type="text" class="form-control"  placeholder="Enter date" name="tdate" >
            </div>

            <div class="form-group">
                <input type="text" class="form-control"  placeholder="Enter time" name="ttime" >
            </div>

            <button type="submit" class="btn btn-primary w-100"> SEARCH APPOINTMENTS </button>
            </form>'
            ;


            
            if( $_SERVER['REQUEST_METHOD']=='POST'){
                include'connect.php';

                $date = $_POST['tdate'];
                $time = $_POST['ttime'];

                echo '
                <br /> <br />  <hr color="blue" />
                <h3> Appointment Details on '.$date.' from '.$time.' </h3>
                <table class="table" style=" background-color : white; opacity : 0.85; ">
                        <tr>
                        <th scope="col">Appointment no  </th>
                        <th scope="col">Patient Id</th>
                        <th scope="col">Receptionist Id</th>
                        <th scope="col">Appointment Time</th>
                        </tr>';

                        $sql = "select * from `appointments` where Ad_id='$D_id' and A_date='$date' and A_time>='$time' order by A_time asc;";
                        $result = mysqli_query($con,$sql);
                        if( $result ){
                            while(  $row = mysqli_fetch_assoc($result)  ){
                                    $A_no = $row['A_no'];
                                    $Ar_id = $row['Ar_id'];
                                    $Ap_id = $row['Ap_id'];
                                    $A_time = $row['A_time'];

                                    echo '
                                        <tr>
                                            <th scope="row"> '.$A_no.' </th>
                                            <td> '.$Ap_id.' </td>
                                            <td> '.$Ar_id.' </td>
                                            <td> '.$A_time.' </td>  
                                            <td>
                                                <a href="prescription.php?values='.$A_no.','.$D_id.','.$Ap_id.' " class="btn btn-primary" > START DIAGNOSIS </a>
                                            </td>                     
                                        </tr>
                                    ';
                            }
                        }
                    echo '</table> </div>';
                }
        ?>
     </body>
</html>