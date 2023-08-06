<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Car Rental Agency</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Car Rental Agency</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    if(!$_SESSION['isLoggedin'])  header("Location: login.html");
                    $userType = $_SESSION['userType']; 
                    if ($userType == 'agency') {
                        echo '<li class="nav-item">
                            <a class="nav-link" href="add-car.php">Add Car</a>
                        </li>';
                    }
                    ?>
                </ul>
                <li class="nav-item list-unstyled"><a class="btn btn-danger" type="button" href="handle_logout.php" >
                Logout
                </a></li>
            </div>
            <div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1>Welcome to our Car Rental Agency</h1>
                    <p>View our available cars by going to this link:</p>
                    <a href="home-available-car.php">Available cars</a>
                </div>
            </div>
        </div>
    </main>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
