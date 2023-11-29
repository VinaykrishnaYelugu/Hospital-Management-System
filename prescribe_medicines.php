<?php
   include 'connect.php';
   $value1 = explode(",",$_GET["value1"]);
   $Da_no = $value1[0];
   $Dd_id = $value1[1];
   $Dp_id = $value1[2];
   $M_code = $value1[3];
   $M_name = $value1[4];
   $disease = $value1[5];


   $form_submit = 0;
   $qty = 0;
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
  <body style=" background-image:url(img_2.jpg);  background-size : cover;    width : 100%; ">
    <?php echo'<a href="prescription.php?values='.$Da_no.','.$Dd_id.','.$Dp_id.' " class="btn btn-primary m-5"> BACK TO PRESCRIPTION PAGE </a>'; ?>
    <div class="container my-5" style=" background-color : white; opacity : 0.85; ">
        <h1 style="color:green; text-align:center; fontsize:50px;" > Enter quantity... </h1>
        <form method='post'>
            <div class="form-group">
                <input type="number" autocomplete="off" placeholder="Enter Quantity.."  class="form-control"  name="qty" aria-describedby="emailHelp" value=<?php $email ?> >
            </div>
        <button type="submit" name="submit" class="btn btn-primary my-5"> ADD </button>
        </form>
        <?php
            include 'connect.php';
            if( isset($_POST['submit'])){
                $qty = $_POST['qty'];
                $form_submit = 1;
            }
            else{ $form_submit = 0; }
        ?>
    </div>

    <div class="container my-5" style=" background-color : white; opacity : 0.85; " >
        <table class="table">
          <?php
                $i_qty = 0;
                $sql= "select * from `decides`";
                $result=mysqli_query($con,$sql);
                while( $i_qty < $qty )
                {
                    $sql = "insert into `decides` ( Da_no , Dd_id ,Dp_id, Dm_code ,disease ) values ( '$Da_no','$Dd_id','$Dp_id','$M_code','$disease' );";
                    $result = mysqli_query($con,$sql);
                    if( !$result ){
                        echo "Problem in software !!";
                        break;
                    }
                    $i_qty++;

                }

                if( ($result) && ($form_submit==1)){
                  echo '<tr>
                  <th scope="col">Medicine code</th>
                  <th scope="col">Medicine name</th>
                  <th scope="col">Quantity</th>
                </tr>';
                  $sql = "select d.Dm_code as 'medicine_code',d.Da_no,m.M_name as 'medicine_name',count(d.Dm_code) as 'qty0'  from `decides` d,`medicines` m  where d.Dm_code=m.M_code and d.Da_no='$Da_no' group by d.Dm_code ;";
                  $result = mysqli_query($con,$sql);
                  while(  $row = mysqli_fetch_assoc($result)  ){
                        $Dm_code = $row['medicine_code'];
                        $Dm_name = $row['medicine_name'];
                        $qty0 = $row['qty0'];
                        echo '
                        <tr>
                            <th scope="row"> '.$Dm_code.' </th>
                            <td> '.$Dm_name.' </td>
                            <td> '.$qty0.' </td>
                        </tr>
                        ';
                  }
                  }
                ?>
            </table>
            <?php 
            echo '<a href="prescription.php?values= '.$Da_no.','.$Dd_id.','.$Dp_id.' " class="btn btn-primary my-5" > Back to continue adding medcines </a></button>';
            ?>
    </div>

  </body>
</html>