<?php
     $con = new mysqli('localhost','root','','hms_db');
    //  if( $con ){
    //     echo "Connection established";
    //  }
    if( !$con ){
        die(mysqli_error($con));
    }
?>