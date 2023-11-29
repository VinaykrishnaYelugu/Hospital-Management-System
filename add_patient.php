<?php
  include 'connect.php';
  $r_id = $_GET['r_id'];
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> PATIENT DETAILS CONTROL </title>
  </head>
  <body style=" background-image:url(img_10.jpg);  background-size : cover;    width : 100%; ">
    <?php
      echo  '<a href="receptionist_page.php?r_id='.$r_id.'" class="btn btn-primary m-5"> BACK TO RECEPTIONIST PAGE </a>';
    ?>
    <div class="container my-5" style=" background-color : white; opacity : 0.9; ">
        <form method='post'>

             <h1> Enter Patient Details.. </h1>
            <div class="form-group">
                <label for="id2"> PASSWORD : </label>
                <input type="password" autocomplete="off" placeholder="Suggest patient's Password"  class="form-control" id="id2" name="P_password" aria-describedby="emailHelp" value=<?php $email ?> >
            </div>

            <div class="form-group">
                <label for="id3"> NAME : </label>
                <input type="text" autocomplete="off" placeholder="Enter Patient's Name" class="form-control" id="id3" name="P_name" aria-describedby="emailHelp" value=<?php $mobile ?> >
            </div>

            <div class="form-group">
                <label for="id5"> AGE : </label>
                <input type="number" autocomplete="off" placeholder="Enter Patient's Age" class="form-control" id="id5" name="P_age" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>

            <div class="form-group">
                <label for="id4"> GENDER : </label>
                <input type="text" autocomplete="off" placeholder="Enter Patient's gender" class="form-control" id="id4" name="P_gender" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>
        <button type="submit" name="submit" class="btn btn-primary my-5"> ADD </button>
        </form>
    </div>

    <div class="container my-5">
        <?php
            include 'connect.php';
            if( isset($_POST['submit']))
            {
                $P_password = $_POST['P_password'];
                $P_name = $_POST['P_name'];
                $P_gender = $_POST['P_gender'];
                $P_age = $_POST['P_age'];

                $sql = "insert into `patients` ( P_password,P_name,P_age,P_gender ) values ( '$P_password','$P_name','$P_age','$P_gender');";

                $result = mysqli_query($con,$sql);
                if( $result ){
                    echo "<div class='container my-5'> <div class='alert alert-success' role='alert'> Patient Details are RECORDED !! CONTINUE to complete Appointment booking </div> </div>";
                    $sql = "select * from `patients` where P_id=(select max(P_id) from `patients`);";
                    $result = mysqli_query($con,$sql);
                    if( $result ){
                        $row = mysqli_fetch_assoc($result);
                        $P_id = $row['P_id'];
                        echo '<a href="appointment_page.php?variables='.$r_id.','.$P_id.'" class="btn btn-primary w-100"> CONTINUE BOOKING </a>';
                    }
                    else{ echo "Problem in query"; }
                }
                else{   
                    die(mysqli_error($con));
                }
            }
        ?>
    </div>

  </body>
</html>