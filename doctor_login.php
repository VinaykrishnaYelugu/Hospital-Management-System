<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> DOCTORS LOGIN PAGE </title>
  </head>
  <body style=" background-image:url(img_12.jpg);  background-size : cover;    width : 100%; ">
    <a href="home.php" class="btn btn-primary m-5"> BACK TO HOME PAGE </a>
    <div class="container">
        <h1 class="text-center" > ENTER DOCTOR'S CREDENTIALS.. </h1>
        <form action="doctor_login.php" method="POST">
            <div class="form-group">
                <input type="number" class="form-control"  placeholder="Enter DOCTOR's-Id " name="D_id" >
            </div>

            <div class="form-group">
                <input type="password" class="form-control"  placeholder="Enter DOCTOR's-Password" name="D_password" >
            </div>

            <button type="submit" class="btn btn-primary w-100"> LOGIN </button>
            <?php
                if( $_SERVER['REQUEST_METHOD']=='POST'){
                    include'connect.php';

                    $D_id = $_POST['D_id'];
                    $D_password = $_POST['D_password'];

                    $sql = "select * from `doctors` where D_id='$D_id' and D_password='$D_password' ;";

                    $result = mysqli_query($con,$sql);
                    if( $result ){
                        $num = mysqli_num_rows($result);
                        if( $num!=0 ){
                            $success = 1;
                            echo "<div class='alert alert-success' role='alert'> LOG IN Successfull !!  </div>";
                            echo '<a href="doctor_page.php?D_id='.$D_id.'" class="btn btn-primary"> GO TO DOCTORS PAGE </a>';
                        }
                        else{
                          echo "<div class='alert alert-danger' role='alert'> Invalid user-id or passsword !! </div>";
                        }
                    }
                }
            ?>
        </form>
    </div>
  </body>
</html>