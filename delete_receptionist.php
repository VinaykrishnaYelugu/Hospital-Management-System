<?php
   include 'connect.php';

   if( isset($_GET['delete_id']) ){
     $id = $_GET['delete_id'];


     $sql = "delete from `receptionists` where R_id=$id";
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