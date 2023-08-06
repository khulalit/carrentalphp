<?php
    session_start();
    require "../controller/CarController.php";
    require "../config/database.php";
    $carId =  $_GET['carId'];
    $noOfDays =  $_GET['no_of_days'];
    $startDate =  $_GET['startDate'];
    if(!$_SESSION['isLoggedin'])
    {   
        // header("Location: login.html");
        exit;
        if($_SESSION['userType'] !== 'customer')
        {
            echo ' not loggedin ';
            // header("Location: login.html");
            exit;
        }
    }
    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        if($_SESSION['isLoggedin'])
        {
            if($_SESSION['userType'] == 'customer'){

                $carId =  $_GET['carId'];
                $noOfDays =  $_GET['no_of_days'];
                $startDate =  $_GET['startDate'];

                $carController = new CarController($conn);

                $result = $carController->bookCar($carId, $noOfDays, $startDate);

                header("Location: dashboard.php");

            } else  echo "you are not allowed to perform this function";
        }

    }