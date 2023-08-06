<?php

require_once '../model/CarModel.php';
require '../config/database.php';

class CarController {
    private $carModel;

    public function __construct($conn) {
        $this->carModel = new CarModel($conn);
    }

    public function addCar($vehicleModel, $vehicleNumber, $seatCapacity, $rent) {


        $result = $this->carModel->addCar($vehicleModel, $vehicleNumber, $seatCapacity, $rent);

        return $result; 
    }

    public function getAllCars() {
        $cars = $this->carModel->getAllCar();

        if ($cars) {
            return $cars;
        } else {
            return false; 
        }
    }
    public function  bookCar($carId, $noOfDays, $startDate) {
        $result = $this->carModel->rentCar($carId, $noOfDays, $startDate);

        return $result; 
    }

}

?>
