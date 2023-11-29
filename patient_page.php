<?php
   include 'connect.php';
   $values2 = explode(",",$_GET["values2"]);
   $P_id = $values2[0];
   $a_no = $values2[1];
   $P_name = "Sir/Madam";

   $sql = "select P_name from `Patients` where P_id='$P_id';";
   $result = mysqli_query($con,$sql);
   if( $result ){
       $row = mysqli_fetch_assoc($result);
       $P_name = $row['P_name'];
   }
   else{ echo "Problem in Query execution"; }

   $form_submit = 0;
   $qty = 0;
   $sql1 = "select * from `doctors`"; // Just for iniliatizing
   $result1 = mysqli_query($con,$sql); //Just for initializing
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> PATIENT PAGE </title>
  </head>
  <body style=" background-image:url(admin_home1.jpg);  background-size : cover;    width : 100%; ">
    <?php echo'<a href="home.php" class="btn btn-primary m-5"> BACK TO HOME PAGE </a>' ?>
    <div class="container my-5" style=" background-color : white; opacity : 0.9; ">
        <?php echo '<h1 style="color:green; text-align:center; fontsize:50px;" > WELCOME '.$P_name.' </h1>'; ?>
    </div>

    <div class="container my-5" style=" background-color : white; opacity : 0.9; ">
        <table class="table">
        <?php echo '<h1 style="color:green; text-align:center; fontsize:50px;" > Your Appointments history </h1>'; ?>
        <?php
            $D_name = "Mr/Mrs_Doctor";

            $sql = "select D_name from `doctors` where D_id=(select Ad_id from `appointments` where  Ap_id='$P_id' and A_no='$a_no');";
            $result = mysqli_query($con,$sql);
            if( $result ){
                $row = mysqli_fetch_assoc($result);
                $D_name = $row['D_name'];
            }
        ?>
        <?php
                $sql= "select * from `appointments` where  Ap_id='$P_id' and A_no='$a_no'";
                $result=mysqli_query($con,$sql);
                if( ($result) ){
                echo '<tr>
                    <th scope="col"> Appointment Number </th>
                    <th scope="col"> Doctor Name </th>
                    <th scope="col"> Appointment Date </th>
                    <th scope="col"> Appointment Time </th>
                </tr>';

                while(  $row = mysqli_fetch_assoc($result)  ){
                        $A_no = $row['A_no'];
                        $A_date = $row['A_date'];
                        $A_time = $row['A_time'];
                        echo '
                        <tr>
                            <th scope="row"> '.$A_no.' </th>
                            <td> '.$D_name.' </td>
                            <td> '.$A_date.' </td>
                            <td> '.$A_time.' </td>
                        </tr>
                        ';
                }
                }
                ?>
            </table>

            <?php
                echo '<a href="print_report.php?values3='.$P_id.','.$a_no.'" class="btn btn-dark"><i class="fa fa-download"></i> Download Report </a> <br>';
                echo '<a href="bill.php?values3= '.$P_id.','.$a_no.' " class="btn btn-primary my-5" > View Bill </a> ';
            ?>
         </div>
  </body>
</html>