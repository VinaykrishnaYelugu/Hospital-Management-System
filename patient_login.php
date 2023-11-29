<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> PATIENT LOGIN PAGE </title>
  </head>
  <body style=" background-image:url(add_doctor1.jpg);  background-size : cover;    width : 100%; ">
    <a href="home.php" class="btn btn-primary m-5"> BACK TO HOME PAGE </a>
    <div class="container" style=" background-color : white; opacity : 0.85; " >
        <h1 class="text-center" > ENTER PATIENT'S CREDENTIALS.. </h1>
        <form action="patient_login.php" method="POST">
           <div class="form-group">
                <input type="number" class="form-control"  placeholder="Enter PATIENT's Appointment number  " name="A_no" >
            </div>

            <div class="form-group">
                <input type="number" class="form-control"  placeholder="Enter PATIENT's-Id " name="P_id" >
            </div>

            <div class="form-group">
                <input type="password" class="form-control"  placeholder="Enter PATIENT's-Password" name="P_password" >
            </div>

            <button type="submit" class="btn btn-primary w-100 my-5"> LOGIN </button>
            <?php
                if( $_SERVER['REQUEST_METHOD']=='POST'){
                    include'connect.php';
                    $A_no = $_POST['A_no'];
                    $P_id = $_POST['P_id'];
                    $P_password = $_POST['P_password'];

                    $sql = "select * from `patients` where P_id='$P_id' and P_password='$P_password' ;";
                    $sql1 = "select * from `appointments` where Ap_id='$P_id' and A_no='$A_no' ;";

                    $result = mysqli_query($con,$sql);
                    $result1 = mysqli_query($con,$sql1);
                    if( $result && $result1 ){
                        $num = mysqli_num_rows($result);
                        $num1 = mysqli_num_rows($result1);
                        if( $num!=0 && $num1!=0 ){
                            $success = 1;
                            echo "<div class='alert alert-success' role='alert'> LOG IN Successfull !!  </div>";
                            echo '<a href="patient_page.php?values2='.$P_id.','.$A_no.'" class="btn btn-primary my-5"> GO TO PATIENT PAGE </a>';
                        }
                        else{
                          echo "<div class='alert alert-danger' role='alert'> Invalid A_no or user-id or passsword !! </div>";
                        }
                    }
                }
            ?>
        </form>
    </div>
  </body>
</html>