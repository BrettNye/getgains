<?php

class UserDAO{

    function createUser($user){
      require_once('../utilities/connection.php');

      $sql = "INSERT INTO user (username, first_name, last_name, password, email, date_of_birth)
              VALUES
              ('" . $user->getUsername() . "',
              '" . $user->getFirstName() . "',
              '" . $user->getLastName() . "',
              '" . $user->getPassword() . "',
              '" . $user->getEmail() . "', " 
              . $user->getDateOfBirth() . ")";

      if ($conn->query($sql) === TRUE) {
        echo "user created";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
          
      $conn->close();
    }

    function checkLogin($passedinusername, $passedinpassword){
        require_once('../utilities/connection.php');
    
        $user_id = 0;
        $sql = "SELECT user_id FROM user WHERE username = '" . $passedinusername . "' AND password = '" . hash("sha256", trim($passedinpassword)) . "'";
    
        $result = $conn->query($sql);
        
    
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $user_id = $row["user_id"];
          }
        }
        else {
            echo "0 results";
        }
        $conn->close();
        return $user_id;
      }

    function UpdateUserWeight($user_id, $weight){
      require_once('../utilities/connection.php');

      $sql = "UPDATE user SET current_user_weight = $weight WHERE user_id = " . $user_id;

      $result = $conn->query($sql);

      if ($conn->query($sql) === TRUE) {
        echo "weight updated";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $sql = "INSERT INTO weight_log (user_id, weight, current_weight, weight_log_date)
      VALUES
      ( " . $user_id . ", " . $weight . ", true, SYSDATE())";

      if ($conn->query($sql) === TRUE) {
        echo "weight log created";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
                
      $conn->close();
    }

    function getUserWeight($user_id){

      require_once('../getgains/utilities/connection.php');

      $sql = "SELECT current_user_weight FROM user WHERE user_id = " . $user_id;
      
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $current_user_weight = $row["current_user_weight"];
        }
      }
      else {
          echo "0 results";
      }
      $conn->close();
      return $current_user_weight;
    }
    }
?>