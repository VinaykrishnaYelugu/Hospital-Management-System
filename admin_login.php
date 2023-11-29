<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> ADMINS LOGIN PAGE </title>
  </head>
  <body style=" background-image:url(admin_home1.jpg);  background-size : cover;    width : 100%; ">
    <a href="home.php" class="btn btn-primary m-5"> BACK TO HOME PAGE </a>
    <div class="container" style=" background-color : white; opacity : 0.9; ">
        <h1 class="text-center" > ENTER ADMIN CREDENTIALS.. </h1>
        <form action="admin_login.php" method="POST">
            <div class="form-group">
                <label for="uname">Id :</label>
                <input type="number" class="form-control" id="uname" placeholder="Enter Admin-Id " name="admin_id" >
            </div>

            <div class="form-group">
                <label for="psword">Password :</label>
                <input type="password" class="form-control" id="psword" placeholder="Enter your paswword" name="admin_password" >
            </div>

            <button type="submit" class="btn btn-primary w-100 my-5"> LOGIN </button>
            <?php
                if( $_SERVER['REQUEST_METHOD']=='POST'){
                    include'connect.php';

                    $admin_id = $_POST['admin_id'];
                    $admin_password = $_POST['admin_password'];

                    $sql = "select * from `admins` where admin_id='$admin_id' and admin_password='$admin_password' ;";

                    $result = mysqli_query($con,$sql);
                    if( $result ){
                        $num = mysqli_num_rows($result);
                        if( $num!=0 ){
                            $success = 1;
                            echo "<div class='alert alert-success ' role='alert'> LOG IN Successfull !!  </div>";
                            header('location:admin_page.php');
                        }
                        else{
                          echo "<div class='alert alert-danger ' role='alert'> Invalid username or passsword !! </div>";
                        }
                    }
                }
            ?>
        </form>
    </div>
  </body>
</html>