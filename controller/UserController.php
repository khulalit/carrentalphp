<?php

require_once '../model/UserModel.php';
require '../config/database.php';

class UserController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new UserModel($conn);
    }

    public function registerUser($username, $password, $email, $user_type, $address, $phone_number) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $result = $this->userModel->createUser($username, $hashedPassword, $email, $user_type, $address, $phone_number);

        return $result; 
    }

    public function loginUser($username, $password) {
        $user = $this->userModel->getUserByUsername($username);

        if ($user ) {
            echo $user['password'].'<br>';
            echo $password."<br>";
            if(password_verify('password', $user['password'])){

                return $user;
            }else {
                echo 'password is wrong.';
            }
            
        } else {
            echo 'no user';
            return false; 
        }
    }

}

?>
