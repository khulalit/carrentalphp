<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Available Cars for Rent</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Available Cars for Rent</h3>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Vehicle Model</th>
                            <th>Vehicle Number</th>
                            <th>Seating Capacity</th>
                            <th>Rent per Day</th>
                            <?php
                            $isCustomerLoggedIn = $_SESSION['userType'] == 'customer'; 
                            if ($isCustomerLoggedIn) {
                                echo "<th>Number of Days</th>";
                                echo "<th>Start Date</th>";
                            }
                            ?>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "../controller/CarController.php";
                        require "../config/database.php";
                        $carController = new CarController($conn);

                        $result = $carController->getAllCars();
                       
                        

                        foreach ($result as $car) {
                            echo "<tr>";
                            echo "<td>" . $car['vehicle_model'] . "</td>";
                            echo "<td>" . $car['vehicle_number'] . "</td>";
                            echo "<td>" . $car['seating_capacity'] . "</td>";
                            echo "<td>" . $car['rent_per_day'] . "</td>";

                            if ($isCustomerLoggedIn) {
                                echo '<td><select class="form-control" name="num_of_days[]" id="noofdays"> ';
                                for ($i = 1; $i <= 30; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                echo '</select></td>';
                                echo '<td><input type="date" class="form-control"  name="start_date[]"/></td>';
                            }

                            if ($isCustomerLoggedIn) {
                                echo '<td><button class="btn btn-primary" id="add-car" value='.$car['car_id'].'>Rent Car</button></td>';
                            } else {
                                echo '<td>Only customers can rent</td>';
                            }

                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        document.querySelector('#add-car')?.addEventListener('click',rentCar);
        function rentCar() {
            const carId = document.querySelector('#add-car').value;
            const noOfDays = document.querySelector('#noofdays').value;
            const startDate = document.querySelector('input[type="date"]').value;
            console.log(noOfDays)
            console.log(startDate)
            <?php
          
            $isCustomerLoggedIn = true; 

            if ($isCustomerLoggedIn) {
                echo 'window.location.href = "rent_car.php?carId=" + carId + "&&no_of_days=" + noOfDays+ "&&startDate=" + startDate;';
            } else {
               
                echo 'window.location.href = "login.html";';
            }
            ?>
        }
    </script>
</body>
</html>
