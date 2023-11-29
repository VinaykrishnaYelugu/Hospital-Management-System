<?php
   include 'connect.php';
   $values = explode(",",$_GET["values"]);
   $Da_no = $values[0];
   $Dd_id = $values[1];
   $Dp_id = $values[2];

   $form_submit = 0;
   $disease = "";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> MEDICINE PRESCRIPTION </title>
  </head>
  <body style=" background-image:url(img_15.jpg);  background-size : cover;    width : 100%; ">
    <?php   echo '<a href="doctor_page.php?D_id='.$Dd_id.'" class="btn btn-primary m-5"> BACK TO DOCTOR PAGE </a>'; ?>
    <div class="container my-5" 
style=" background-color : white; opacity : 0.85; ">
        <h1 style="color:green; text-align:center; fontsize:50px;" > Enter patient's Disease... </h1>
        <form method='post'>
            <div class="form-group">
                <input type="text" autocomplete="off" placeholder="Enter diseaese name"  class="form-control"  name="disease" aria-describedby="emailHelp" value=<?php $email ?> >
            </div>
        <button type="submit" name="submit" class="btn btn-primary my-5"> CONTINUE </button>
        </form>
        <?php
            include 'connect.php';
            if( isset($_POST['submit'])){
                $disease = $_POST['disease'];
                $form_submit = 1;
            }
            else{ $form_submit = 0; }
        ?>
    </div>

    <div class="container my-5" 
style=" background-color : white; opacity : 0.85; ">
        <table class="table">
          <?php
                $sql = "select * from `medicines`";
                $result = mysqli_query($con,$sql);
                if( ($result) && ($form_submit==1)){
                  echo '<tr>
                  <th scope="col">Medicine code</th>
                  <th scope="col">Medicine name</th>
                  <th scope="col">Medicine cost</th>
                  <th scope="col">Medicine company</th>
                  <th scope="col">Exp. date</th>
                </tr>';
                  while(  $row = mysqli_fetch_assoc($result)  ){
                        $M_code = $row['M_code'];
                        $M_name = $row['M_name'];
                        $M_cost = $row['M_cost'];
                        $company = $row['company'];
                        $exp_date = $row['exp_date'];
                        echo '
                        <tr>
                            <th scope="row"> '.$M_code.' </th>
                            <td> '.$M_name.' </td>
                            <td> '.$M_cost.' </td>
                            <td> '.$company.' </td>
                            <td> '.$exp_date.' </td>
                            <td>
                              <a href="prescribe_medicines.php?value1= '.$Da_no.','.$Dd_id.','.$Dp_id.','.$M_code.','.$M_name.','.$disease.' " class="btn btn-primary" > Prescribe </a>
                            </td>
                        </tr>
                        ';
                  }
                  }
                ?>
        </table>
    </div>

  </body>
</html>