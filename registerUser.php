<?php

  require_once 'dbOperations.php';
  $response = array();

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
      if(
        isset($_POST['username']) && isset($_POST['password'])
    ){
        $db = new dbOperations();

        $result = $db->registerUser(
              $_POST['username'], $_POST['password']
        );

      if($result == 1){
          $response['error'] = false;
          $response['message'] = "Registration Successful";
      } else if($result == 0){
        $response['error'] = true;
        $response['message'] = "Username not available";
      }else {
          $response['error'] = true;
          $response['message'] = "An error occured. Try again.";
        }

    } else {
          $response['error'] = true;
          $response['message'] = "All fields required";
    }

  } else {
          $response['error'] = true;
          $response['message'] = "Invalid Request";
  }
  echo json_encode($response);
?>
