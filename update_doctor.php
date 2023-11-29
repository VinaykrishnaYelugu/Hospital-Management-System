<?php
  include 'connect.php';

    $D_id = $_GET['update_id'];
    $sql = "select * from `doctors` where D_id=$D_id";
    $result = mysqli_query($con,$sql);

    $row = mysqli_fetch_assoc($result);

    $D_id = $row['D_id'];
    $D_name = $row['D_name'];
    $D_gender = $row['D_gender'];
    $Specialization = $row['Specialization'];
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
  <body style=" background-image:url(img_3.jpg);  background-size : cover;    width : 100%; ">
    <a href="admin_page.php" class="btn btn-primary m-5"> BACK TO ADMIN PAGE </a>
    <div class="container my-5" style=" background-color : white; opacity : 0.9; " >
        <form method='post'>
            <div class="form-group">
                <label for="id3"> NAME : </label>
                <input type="text" value=<?php echo $D_name ?>  autocomplete="off" placeholder="Enter doctor's name" class="form-control" id="id3" name="D_name" aria-describedby="emailHelp" value=<?php $mobile ?> >
            </div>

            <div class="form-group">
                <label for="id4"> GENDER : </label>
                <input type="text" value=<?php echo $D_gender?> autocomplete="off" placeholder="Enter doctor's gender" class="form-control" id="id4" name="D_gender" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>

            <div class="form-group">
                <label for="id5"> SPECIALIZATION : </label>
                <input type="text" value=<?php echo $Specialization ?> autocomplete="off" placeholder="Enter doctor's Specialization" class="form-control" id="id5" name="Specialization" aria-describedby="emailHelp" value=<?php $password ?> >
            </div>
        <button type="submit" name="submit" class="btn btn-primary my-5"> UPDATE </button>
        </form>
    </div>

    <?php
    if( isset($_POST['submit'])){
        $D_name = $_POST['D_name'];
        $D_gender = $_POST['D_gender'];
        $Specialization = $_POST['Specialization'];

        $sql = "update `doctors` set D_name='$D_name',D_gender='$D_gender',Specialization='$Specialization' where D_id='$D_id' ;";

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