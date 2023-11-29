<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> DOCTORS DETAILS CONTROL </title>
  </head>
  <body style=" background-image:url(img_4.jpg);  background-size : cover;    width : 100%; ">
    <div class="container my-5" >
        <form method='post'>

            <div class="form-group">
                <label for="id2"> PASSWORD : </label>
                <input type="password" autocomplete="off" placeholder="Enter doctor's password"  class="form-control" id="id2" name="D_password" aria-describedby="emailHelp" value=<?php $email ?> >
            </div>

            <div class="form-group">
                <label for="id3"> NAME : </label>
                <input type="text" autocomplete="off" placeholder="Enter doctor's name" class="form-control" id="id3" name="D_name" aria-describedby="emailHelp" value=<?php $mobile ?> >
            </div>

            <div class="form-group">
                <label for="id4"> GENDER : </label>
                <input type="text" autocomplete="off" placeholder="Enter doctor's gender" class="form-control" id="id4" name="D_gender" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>

            <div class="form-group">
                <label for="id5"> SPECIALIZATION : </label>
                <input type="text" autocomplete="off" placeholder="Enter doctor's Specialization" class="form-control" id="id5" name="Specialization" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>
        <button type="submit" name="submit" class="btn btn-primary"> ADD </button>
        </form>
    </div>

    <?php
        include 'connect.php';
        if( isset($_POST['submit'])){
            $D_password = $_POST['D_password'];
            $D_name = $_POST['D_name'];
            $D_gender = $_POST['D_gender'];
            $Specialization = $_POST['Specialization'];

            $sql = "insert into `doctors` ( D_password,D_name,D_gender,Specialization ) values ( '$D_password','$D_name','$D_gender', '$Specialization');";

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