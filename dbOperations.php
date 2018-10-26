<?php
  class dbOperations {
  private $con;

  function __construct() {
    require_once 'dbConnect.php';
    $db = new dbConnect();

    $this->con = $db->connect();
   }

   public function registerUser($username,$password) {
     if($this->duplicateHandler($username)){
                return 0;
     } else {
            $encryptedpassword = md5($username.$password);
            $stmt = $this->con->prepare("INSERT INTO login (username, password) VALUES (?, ?);");
            $stmt->bind_param("ss",$username, $encryptedpassword);

            if($stmt->execute()){
                  return 1;
            } else {
                  return 2;
                }
          }
    }

   private function duplicateHandler($username) {
     $stmt = $this->con->prepare("SELECT username from login WHERE username = ?");
     $stmt->bind_param("s", $username);
     $stmt->execute();
     $stmt->store_result();
     return $stmt->num_rows > 0;
   }

   public function loginUser($username, $password) {
     $encryptedpassword = md5($username.$password);
     $stmt = $this->con->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
     $stmt->bind_param("ss",$username,$encryptedpassword);
     $stmt->execute();
     $stmt->store_result();
     return $stmt->num_rows > 0;
   }

   public function getUsername($username) {
     $stmt = $this->con->prepare("SELECT * FROM login WHERE username = ?");
     $stmt->bind_param("s",$username);
     $stmt->execute();
     return $stmt->get_result()->fetch_assoc();
   }

   public function addFriend($firstname,$surname,$phonenum) {
            $stmt = $this->con->prepare("INSERT INTO myghanafriends (firstname, surname, phone_number) VALUES (?, ?,?);");
            $stmt->bind_param("sss",$firstname, $surname, $phonenum);
            if($stmt->execute()){
                  return true;
            } else {
                  return false;
                }
            }
   public function peekAtFriends() {
     $stmt = $this->con->prepare("SELECT * FROM myghanafriends;");
     $stmt->execute();
     $stmt->store_result();
     return $stmt->num_rows > 0;
   }

   public function fetchFriends(){
            $stmt = $this->con->prepare("SELECT firstname, surname, phone_number FROM myghanafriends;");
            $stmt->execute();
            return $stmt->get_result()->fetch_array();
      }

  }
?>
