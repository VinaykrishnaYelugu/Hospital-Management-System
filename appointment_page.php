<?php
   include 'connect.php';
   $values = explode(",",$_GET["variables"]);
   $Ar_id = $values[0];
   $Ap_id = $values[1];

   $sql = "select * from `doctors`";
   $result = mysqli_query($con,$sql);
   $view = 0;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> APPOINTMET MAKING CONTROL </title>
  </head>
  <body style=" background-image:url(img_11.jpg);  background-size : cover;    width : 100%; ">
    <div class="container my-5" style=" background-color : white; opacity : 0.85; ">
         <br> <br>
        <form method="post">
            <div class="form-group">
                <input type="text" autocomplete="off" placeholder="Enter specialization.."  class="form-control " id="id1" name="special" aria-describedby="emailHelp" value=<?php $email ?> >
                <button type="submit" name="submit1" class="btn btn-primary my-5"> SEARCH DOCTORS DETAILS BY SPECIALIZATION </button>
            </div>
        </form>

        <?php
            include 'connect.php';
            if( isset($_POST['submit1'])){
                $special = $_POST['special'];

                $sql = "select * from `doctors` where Specialization='$special';";
                $result = mysqli_query($con,$sql);
                $view = 1;
            }
        ?>


          <?php
            if( $result && $view ){
                echo '
                <table class="table">
                    <tr>
                    <th scope="col">Doctor-id</th>
                    <th scope="col">Doctor-name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Specialization</th>
                    </tr>';
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
                            </tr>
                            ';
                    }
            }
                echo'</table>';
          ?>
    </div>
     <br /> <br /> <br />
     <hr color=blue />
     <br /> <br /> <br />

    <div class="container my-5" style=" background-color : white; opacity : 0.85; ">
        <h1 style="color:green; text-align:center; fontsize:50px;" > Enter Appointment Deatils.. </h1>
        <form method='post'>
            <div class="form-group">
                <input type="number" autocomplete="off" placeholder="Enter doctor-id for appointment"  class="form-control" id="id2" name="Ad_id" aria-describedby="emailHelp" value=<?php $email ?> >
            </div>

            <div class="form-group">
                <input type="text" autocomplete="off" placeholder="Enter Appointment date" class="form-control" id="id4" name="A_date" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>

            <div class="form-group">
                <input type="text" autocomplete="off" placeholder="Enter Appointment time" class="form-control" id="id5" name="A_time" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>
        <button type="submit" name="submit" class="btn btn-primary my-5"> ADD </button>
        </form>
    </div>

    <?php
        include 'connect.php';
        if( isset($_POST['submit'])){
            $Ad_id = $_POST['Ad_id'];
            $A_date = $_POST['A_date'];
            $A_time = $_POST['A_time'];

            $sql = "insert into `appointments` ( Ad_id, Ap_id, Ar_id, A_date, A_time ) values ( '$Ad_id','$Ap_id','$Ar_id', '$A_date','$A_time');";

           $result = mysqli_query($con,$sql);
            if( $result ){
                echo "<div class='alert alert-success' role='alert'> Appointment Booked Successfully !!  </div>";
                echo '<a href="receptionist_page.php?r_id='.$Ar_id.'" class="btn btn-primary m-5"> BACK TO RECEPTIONIST PAGE </a>';
            }
            else{
                echo "<div class='alert alert-danger' role='alert'> Problem in Software !! </div>";
                die(mysqli_error($con));
            }
        }
    ?>

  </body>
</html>