<?php
  include 'connect.php';

    $R_id = $_GET['update_id'];
    $sql = "select * from `receptionists` where R_id=$R_id";
    $result = mysqli_query($con,$sql);

    $row = mysqli_fetch_assoc($result);

    $R_id = $row['R_id'];
    $R_name = $row['R_name'];
    $R_age = $row['R_age'];
    $R_gender = $row['R_gender'];
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> User page </title>
  </head>
  <body style=" background-image:url(img_6.jpg);  background-size : cover;    width : 100%; ">
    <a href="admin_page.php" class="btn btn-primary m-5"> BACK TO ADMIN PAGE </a>
    <div class="container my-5">
        <form method='post'>
            <div class="form-group">
                <label for="id3"> NAME : </label>
                <input type="text" value=<?php echo $R_name ?>  autocomplete="off" placeholder="Enter Receptionist's name" class="form-control" id="id3" name="R_name" aria-describedby="emailHelp" value=<?php $mobile ?> >
            </div>

            <div class="form-group">
                <label for="id5"> AGE : </label>
                <input type="number" value=<?php echo $R_age ?> autocomplete="off" placeholder="Enter Receptionist's Specialization" class="form-control" id="id5" name="R_age" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>

            <div class="form-group">
                <label for="id4"> GENDER : </label>
                <input type="text" value=<?php echo $R_gender?> autocomplete="off" placeholder="Enter Receptionist's gender" class="form-control" id="id4" name="R_gender" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>

        <button type="submit" name="submit" class="btn btn-primary"> UPDATE </button>
        </form>
    </div>

    <?php
    if( isset($_POST['submit'])){
        $R_name = $_POST['R_name'];
        $R_age = $_POST['R_age'];
        $R_gender = $_POST['R_gender'];

        $sql = "update `receptionists` set R_name='$R_name',R_age='$R_age',R_gender='$R_gender' where R_id='$R_id' ;";

        $result = mysqli_query($con,$sql);
        if( $result ){
            // echo "Data inserted successfully !!";
            header('location:admin_page.php');
        }
        else{
            die(mysqli_error($con));
        }
    }
    ?>
  </body>
</html>