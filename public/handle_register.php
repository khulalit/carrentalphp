<?php
    require "../controller/UserController.php";
    require "../config/database.php";
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $username = $_POST["full_name"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $user_type = $_POST["user_type"];
        $address = $_POST["address"];
        $phone_number = $_POST["phone_number"];

        $userController = new UserController($conn);

        $result = $userController->registerUser($username, $password,$email,  $user_type, $address, $phone_number);



        echo $result;
        echo 'done being redirected';
        // sleep(200);

        header("Location: login.html");
 
        exit;

    }