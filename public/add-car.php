<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Rental Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php
        require "../controller/CarController.php";
        require "../config/database.php";

        if(!$_SESSION['isLoggedin'])
        {   
            header("Location: login.html");
            exit;
            if($_SESSION['userType'] !== 'agency')
            {
                header("Location: login.html");
                exit;
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if($_SESSION['isLoggedin'])
            {
                if($_SESSION['userType'] == 'agency'){
                    $model = $_POST["model"];
                    $vehicle_number = $_POST["vehicle_number"];
                    $rent = $_POST["rent_per_day"];
                    $seating = $_POST["seating_capacity"];

                    $carController = new CarController($conn);

                    $result = $carController->addCar($model, $vehicle_number, $seating, $rent);



                    echo $result;
                    echo 'done being redirected';
                    // sleep(200);

                    header("Location: dashboard.php");
    
                    exit;
                } echo "you are not allowed to perform this function";
            }

        } 
    ?>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Enter Vehicle Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="form-group">
                                <label for="model">Vehicle Model:</label>
                                <input type="text" class="form-control" id="model" name="model" required>
                            </div>
                            <div class="form-group">
                                <label for="vehicle_number">Vehicle Number:</label>
                                <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" required>
                            </div>
                            <div class="form-group">
                                <label for="seating_capacity">Seating Capacity:</label>
                                <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" required>
                            </div>
                            <div class="form-group">
                                <label for="rent_per_day">Rent per Day (in rupees):</label>
                                <input type="number" class="form-control" id="rent_per_day" name="rent_per_day" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
