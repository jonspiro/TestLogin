<?php
 require_once 'dbOperations.php';
 $db = new dbOperations();
 $response = array();

   if($db->peekAtFriends()) {

      $rows = $db->fetchFriends();

        $friends['fullname']= $rows['firstname']." ".$friend['surname'];
        $friends ['phonenum']= $rows['phone_number'];
      //  $friends['phonenum'] = $rows['phone_number'];
        array_push($response , $friends);
      

  } else {
    $response['error'] = true;
    $response['message'] = "You have no friends in Your list";
  }
  echo json_encode($response);
  ?>
