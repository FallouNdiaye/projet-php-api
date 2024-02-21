<?php
   $host="localhost";
   $username="root";
   $password="";
   $dbname="phptutorial";

   $conn=mysqli_connect($host, $username, $password, $dbname);
   if(!$conn){
    die("Connexion failed:".mysqli_connect_error());
   }


?>