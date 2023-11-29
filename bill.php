<?php
   include 'connect.php';
   $values3 = explode(",",$_GET["values3"]);
   $P_id = $values3[0];
   $a_no = $values3[1];
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

    <title> BILL SECTION </title>
  </head>
  <body style=" background-image:url(img_6.jpg);  background-size : cover;    width : 100%; ">
    <?php  echo '<button class="btn btn-primary my-5" ><a href="patient_page.php?values2='.$P_id.','.$a_no.' " class="text-light" > Back to Patient Page </a></button>';  ?>
    <div class="container my-5" style=" background-color : white; opacity : 0.9; ">
        <?php echo '<h1 style="color:green; text-align:center; fontsize:50px;" > WELCOME '.$P_name.' </h1>'; ?>
    </div>

    <div class="container my-5" style=" background-color : white; opacity : 0.9; ">
        <table class="table">
        <?php echo '<h1 style="color:green; text-align:center; fontsize:50px;" > Your Bill </h1>'; ?>
        <?php
               $sql = "select d.Dm_code as 'medicine_code',d.Da_no,m.M_name as 'medicine_name',count(d.Dm_code) as 'Quantity', sum(m.M_cost) as 'Individual Medicine cost'  from `decides` d,`medicines` m  where d.Dm_code=m.M_code and d.Da_no='$a_no' group by d.Dm_code ;";
               $result=mysqli_query($con,$sql);
                if( ($result) ){
                echo '<tr>
                    <th scope="col"> Medicine code </th>
                    <th scope="col"> Medicine Name </th>
                    <th scope="col"> Quantity </th>
                    <th scope="col"> Individual Medicine Cost </th>
                </tr>';

                while(  $row = mysqli_fetch_assoc($result)  ){
                        $m_code = $row['medicine_code'];
                        $m_name = $row['medicine_name'];
                        $qty = $row['Quantity'];
                        $each_cost = $row['Individual Medicine cost'];
                        
                        echo '
                        <tr>
                            <th scope="row"> '.$m_code.' </th>
                            <td> '.$m_name.' </td>
                            <td> '.$qty.' </td>
                            <td> '.$each_cost.' </td>
                        </tr>
                        ';
                }
                }
                ?>
            </table>
         </div>

         <div class="container my-5">
         <?php
                $sql = "select sum(m.M_cost) as 'Total Bill'  from `decides` d,`medicines` m  where d.Dm_code=m.M_code and d.Da_no='$a_no';";
                $result = mysqli_query($con,$sql);
                if( $result ){
                    $row = mysqli_fetch_assoc($result);
                    $total_bill = $row['Total Bill'];
                    echo '<h3 style="color:black; text-align:center; fontsize:10px;"> GST : '.(0.18*$total_bill).' </h3>';
                    $total_bill = $total_bill + (0.18*$total_bill);
                    echo '<h2 style="color:maroon; text-align:center; fontsize:40px; border:blue; background-color:yellow;"> Total Bill : '.$total_bill.' </h2>';
                }
                else { echo " Problem in software "; }
            ?>
         <?php
              echo '<a href="print_bill.php?values3='.$P_id.','.$a_no.'" class="btn btn-dark"><i class="fa fa-download"></i> Download Bill </a>';
         ?>
         </div>

  </body>
</html>