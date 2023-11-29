<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> RECEPTIONISTS LOGIN PAGE </title>
  </head>
  <body style=" background-image:url(img_8.jpg);  background-size : cover;    width : 100%; ">
    <a href="home.php" class="btn btn-primary m-5"> BACK TO HOME PAGE </a>
    <div class="container" style=" background-color : white; opacity : 0.85; ">
        <h1 class="text-center" > ENTER RECEPTIONIST'S CREDENTIALS.. </h1>
        <form action="receptionist_login.php" method="POST">
            <div class="form-group">
                <label for="uname">Id :</label>
                <input type="number" class="form-control" id="uname" placeholder="Enter Receptionist's-Id " name="receptionist_id" >
            </div>

            <div class="form-group">
                <label for="psword">Password :</label>
                <input type="password" class="form-control" id="psword" placeholder="Enter Receptionist's-Password" name="receptionist_password" >
            </div>

            <button type="submit" class="btn btn-primary w-100 my-5"> LOGIN </button>
            <?php
                if( $_SERVER['REQUEST_METHOD']=='POST'){
                    include'connect.php';

                    $receptionist_id = $_POST['receptionist_id'];
                    $receptionist_password = $_POST['receptionist_password'];

                    $sql = "select * from `receptionists` where R_id='$receptionist_id' and R_password='$receptionist_password' ;";

                    $result = mysqli_query($con,$sql);
                    if( $result ){
                        $num = mysqli_num_rows($result);
                        if( $num!=0 ){
                            $success = 1;
                            echo "<div class='alert alert-success' role='alert'> LOG IN Successfull !!  </div>";
                            echo '<a href="receptionist_page.php?r_id='.$receptionist_id.'" class="btn btn-primary my-5"> GO TO RECEPTIONIST PAGE </a>';
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