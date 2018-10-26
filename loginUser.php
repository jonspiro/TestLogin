<?php

  require_once 'dbOperations.php';
  $response = array();

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['username']) && isset($_POST['password'])){
          $db = new dbOperations();

          if($db->loginUser($_POST['username'], $_POST['password'])){
              $user = $db->getUsername($_POST['username']);
              $response['error']= false;
              $response['username'] = $user['username'];
          } else {
            $response['error'] = true;
            $response['message'] = "Username or password Incorrect!";
          }
      } else {
            $response['error'] = true;
            $response['message'] = "Enter username and password";
      }
  } else {
          $response['error'] = true;
          $response['message'] = "Invalid Request";
  }
  echo json_encode($response);
  ?>
