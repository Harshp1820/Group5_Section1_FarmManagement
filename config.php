<?php
session_start();
// Connect to database
   $conn = mysqli_connect("localhost", "root", "Database_root", "farmer");
   
   // Check connection
   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }  
?>