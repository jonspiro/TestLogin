<?php

  require_once 'dbOperations.php';
  $response = array();

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
      if(
        isset($_POST['firstname']) && isset($_POST['surname']) && isset($_POST['phonenum'])
    ){
        $db = new dbOperations();

        if($db->addFriend(
          $_POST['firstname'], $_POST['surname'], $_POST['phonenum']
        )){
        $response['error'] = false;
        $response['message'] = "Friend added!";
        } else {
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
