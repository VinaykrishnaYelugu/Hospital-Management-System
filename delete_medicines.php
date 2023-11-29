<?php
   include 'connect.php';

   if( isset($_GET['M_code']) ){
     $M_code = $_GET['M_code'];


     $sql = "delete from `medicines` where M_code=$M_code";
     $result = mysqli_query($con,$sql);

     if( $result ){
        echo "Deleted successfully";
        header('location:admin_page.php');
     }
     else{
        die( mysqli_error($con) );
     }
   }
?>