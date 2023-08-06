<?php
class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createUser($username, $password, $email, $user_type, $address, $phone_number ) {

        $sql = "Select * from users where email = '$email'";
        $result = $this->conn->query($sql);
        $userId = '';

        if(!$result) {
            echo 'result false';
            exit; 
            return false;
        }
        echo ' result no false <br>';

        $sql = "INSERT INTO users (email, password, user_type) VALUES ( '$email', '$password', '$user_type')";
        $result = $this->conn->query($sql);

        if ($result) {
            echo $result;
            // $this->conn->close();
            // return true; // Success
        } else {
 
            echo 'Error: ' . $this->conn->error;
            exit;
            return false; 
        }

        $query = "SELECT user_id FROM users WHERE email = '$email'";

 
        $result = $this->conn->query($query);
        echo ' fetcing the eslutl';

  
        if ($result && $result->num_rows > 0) {
          
            $row = $result->fetch_assoc();
            $userId = $row['user_id'];
            echo "User ID: " . $userId;
        } else {
           
            echo "User not found.";
            return false;
        }

        echo $userId;
        
        if($user_type == '1'){
            
            $sql = "INSERT INTO customers (user_id, full_name, phone_number, address) VALUES ( '$userId', '$username','$phone_number', '$address')";
            $result = $this->conn->query($sql);
    
            if ($result) {
                echo $result;
                $this->conn->close();
                echo '<script>window.alert("User has created")</script>';
                return true; 
            } else {
                
                echo 'Error: ' . $this->conn->error;
                exit;
                return false; 
            }

        }
        else if($user_type == '2'){
            
            $sql = "INSERT INTO car_rental_agencies (user_id, agency_name, phone_number, address) VALUES ( '$userId', '$username','$phone_number', '$address')";
            $result = $this->conn->query($sql);
    
            if ($result) {
                echo $result;
                $this->conn->close();
                echo '<script>window.alert("User has created")</script>';
                return true; 
            } else {
                
                echo 'Error: ' . $this->conn->error;
                exit;
                return false; 
            }

        }
    }


    public function getUserByUsername($email) {

        $sql = "Select * from users where email = '$email'";
        $result = $this->conn->query($sql);

        if($result && $result->num_rows > 0) return $result->fetch_assoc();
        else return false;
    }

}
?>
