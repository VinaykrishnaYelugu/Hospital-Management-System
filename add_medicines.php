<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> MEDICNE STOCK MANAGEMENT </title>
  </head>
  <body style=" background-image:url(img_7.jpg);  background-size : cover;    width : 100%; ">
    <a href="admin_page.php" class="btn btn-primary m-5"> BACK TO ADMIN PAGE </a>
    <div class="container my-5">
        <form method='post'>

            <div class="form-group">
                <input type="text" autocomplete="off" placeholder="Enter Medicine name" class="form-control"  name="M_name" aria-describedby="emailHelp" value=<?php $mobile ?> >
            </div>

            <div class="form-group">
                <input type="number" autocomplete="off" placeholder="Enter Medicine cost" class="form-control"  name="M_cost" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>

            <div class="form-group">
                <input type="text" autocomplete="off" placeholder="Enter Medicine's company" class="form-control"  name="company" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>

            <div class="form-group">
                <input type="text" autocomplete="off" placeholder="Enter Medicine's exp. date" class="form-control"  name="exp_date" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>
            <button type="submit" name="submit" class="btn btn-primary"> ADD TO STOCK  </button>
        </form>

    </div>

    <?php
        include 'connect.php';
        if( isset($_POST['submit'])){
            $M_name = $_POST['M_name'];
            $M_cost = $_POST['M_cost'];
            $company = $_POST['company'];
            $exp_date = $_POST['exp_date'];

            $sql = "insert into `medicines` ( M_name,M_cost,company,exp_date ) values ( '$M_name','$M_cost','$company','$exp_date' );";

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