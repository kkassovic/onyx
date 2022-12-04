<?php
  // Connect file
  // Kassovic Management Services, s.r.o.
  // Create connection

  $con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  mysqli_query($con,"SET NAMES 'utf8'");

  // Check connection MySQL connection

  if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } 
    
    else
    { 
      //echo "Spojenie s databazou TMV... OK<br>";
    }
?>