<?php
    require "../controller/UserController.php";
    require "../config/database.php";
    session_start();
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $password = $_POST["password"];
        $email = $_POST["email"];

        $userController = new UserController($conn);

        $result = $userController->loginUser($email, $password);
        if($result){
            
            $_SESSION['isLoggedin'] = true;
            $_SESSION['userType'] = $result['user_type'];
            $_SESSION['userId'] = $result['user_id'];
            echo "logged in ";
            echo '<br> <a href="dashboard.php">Dashboard</a>';
 
        }
        else echo "login again"; 

    }