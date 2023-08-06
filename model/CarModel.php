<?php
class CarModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addCar($vehicleModel, $vehicleNumber, $seatCapacity, $rent) {

        // $agencyId = $_SESSION['agencyId']
        $userId = $_SESSION['userId'];
        $sql = "select agency_id from car_rental_agencies where user_id = $userId;";
        $result = $this->conn->query($sql);

        if(!$result) {
            echo 'result false';
            exit; 
            return false;
        }
        $result = $result->fetch_assoc();
        $agencyId = $result['agency_id'];

        $sql = "INSERT INTO cars (agency_id, vehicle_model, vehicle_number, seating_capacity, rent_per_day ) VALUES ( $agencyId, '$vehicleModel', '$vehicleNumber', '$seatCapacity', $rent)";

        $result = $this->conn->query($sql);

        if ($result) {
            // echo $result;
            $this->conn->close();
            return true; // Success
        } else {
            echo 'Error: ' . $this->conn->error;
            exit;
            return false; // Failure
        }

    }

    public function getAllCar(){
        $sql = "select cars.car_id, vehicle_model,vehicle_number , seating_capacity , rent_per_day  from cars, bookings where cars.car_id <> bookings.car_id or DATE_ADD(start_date, INTERVAL 1 DAY) < CURDATE();";
        $result = $this->conn->query($sql);

        if(!$result) {
            echo 'result false';
            exit; 
            return false;
        }
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function rentCar($carId, $noOfDays, $startDate) {
        session_start();
        $userId = $_SESSION['userId'];
        $sql = "select customer_id from customers where user_id = $userId;";
        $result = $this->conn->query($sql);

        if(!$result) {
            echo 'result false';
            exit; 
            return false;
        }
        $result = $result->fetch_assoc();
        $customerId = $result['customer_id'];

        $sql = "INSERT INTO bookings (customer_id, car_id, start_date, number_of_days) VALUES ( $customerId, '$carId', '$startDate', '$noOfDays')";

        $result = $this->conn->query($sql);

        if ($result) {
            // echo $result;
            $this->conn->close();
            return true; // Success
        } else {
      
            echo 'Error: ' . $this->conn->error;
            exit;
            return false; 
        }
    }

}
?>
