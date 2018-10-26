<?php
  class dbConnect {
   private $con;

   function __construct(){

   }
   function connect(){
   include_once 'dbConfig.php';
   $this->con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

   if (mysqli_connect_errno()){
        echo "Connection to database failed".mysqli_connect_err();
   }
   return $this->con;
   }
  }
  ?>
