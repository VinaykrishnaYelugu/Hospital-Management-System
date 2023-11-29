<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> RECEPTIONISTS DETAILS CONTROL </title>
  </head>
  <body style=" background-image:url(img_1.jpg);  background-size : cover;    width : 100%; ">
    <a href="admin_page.php" class="btn btn-primary m-5"> BACK TO ADMIN PAGE </a>
    <div class="container my-5">
        <form method='post'>

            <div class="form-group">
                <label for="id2"> PASSWORD : </label>
                <input type="password" autocomplete="off" placeholder="Enter Receptionist's password"  class="form-control" id="id2" name="R_password" aria-describedby="emailHelp" value=<?php $email ?> >
            </div>

            <div class="form-group">
                <label for="id3"> NAME : </label>
                <input type="text" autocomplete="off" placeholder="Enter Receptionist's name" class="form-control" id="id3" name="R_name" aria-describedby="emailHelp" value=<?php $mobile ?> >
            </div>

            <div class="form-group">
                <label for="id4">  AGE : </label>
                <input type="number" autocomplete="off" placeholder="Enter Receptionist's age" class="form-control" id="id4" name="R_age" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>

            <div class="form-group">
                <label for="id4"> GENDER : </label>
                <input type="text" autocomplete="off" placeholder="Enter Receptionist's gender" class="form-control" id="id4" name="R_gender" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>

        <button type="submit" name="submit" class="btn btn-primary"> ADD </button>
        </form>
    </div>

    <?php
        include 'connect.php';
        if( isset($_POST['submit'])){
            $R_password = $_POST['R_password'];
            $R_name = $_POST['R_name'];
            $R_age = $_POST['R_age'];
            $R_gender = $_POST['R_gender'];

            $sql = "insert into `receptionists` ( R_password,R_name,R_age,R_gender ) values ( '$R_password','$R_name','$R_age','$R_gender');";

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