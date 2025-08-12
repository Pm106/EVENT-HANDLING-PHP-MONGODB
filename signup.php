<?php
    require 'connection.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $mobile_number = $_POST['mobile_number'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Username validation
        if (empty($username)) {
            $error = "Username is required";
        } elseif (strlen($username) < 3 || strlen($username) > 20) {
            $error = "Username must be between 3 and 20 characters long";
        } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
            $error = "Username can only contain alphanumeric characters and underscores";
        }

        // Email validation
        if (empty($email)) {
            $error = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
        } elseif (checkEmailExists($email)) {
            $error = "Email is already in use";
        }

        // Mobile number validation
        if (empty($mobile_number)) {
            $error = "Mobile number is required";
        } elseif (strlen($mobile_number) != 10) {
            $error = "Mobile number must be 10 digits long";
        } elseif (!preg_match("/^[0-9]+$/", $mobile_number)) {
            $error = "Mobile number can only contain numeric characters";
        }

        // Password validation
        if (empty($password)) {
            $error = "Password is required";
        } elseif (strlen($password) < 6) {
            $error = "Password must be at least 6 characters long";
        } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/", $password)) {
            $error = "Password must contain at least one uppercase letter, one lowercase letter, and one numeric character";
        }

        // Confirm password validation
        if (empty($confirm_password)) {
            $error = "Confirm password is required";
        } elseif ($password != $confirm_password) {
            $error = "Passwords do not match";
        }

        if (!isset($error)) {
            // Create a new MongoDB connection
            $mongoClient = new MongoDB\Driver\Manager("mongodb://localhost:27017");

            // Create a new collection
            $collection = new MongoDB\Collection($mongoClient, 'M²Event', 'User');

            // Create a new document
            $document = array(
                "username" => $username,
                "email" => $email,
                "mobile_number" => $mobile_number,
                "password" => password_hash($password, PASSWORD_BCRYPT)
            );

            // Insert the document
            $result = $collection->insertOne($document);

            if($result->getInsertedCount() == 1){
                header('location: login.php');
                exit; // add this to prevent further execution
            } else {
                echo "Registration failed!";
            }
        } else {
            echo $error;
        }
    }

    function checkEmailExists($email) {
        // Create a new MongoDB connection
        $mongoClient = new MongoDB\Driver\Manager("mongodb://localhost:27017");

        // Create a new collection
        $collection = new MongoDB\Collection($mongoClient, 'M²Event', 'User');

        // Find the document
        $filter = array("email" => $email);
        $result = $collection->findOne($filter);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
?>

<!-- rest of your HTML code -->
<!DOCTYPE html>
<html>
    <head>
    <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title>M² Event</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <style>
            body {
    background-image: url('img/WhatsApp Image 2025-03-05 at 13.51.51_712b3171.jpg');
    background-size: cover;
    background-position: center;
}

.form-container {
    background-color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px #000000;
    width: 50%;
    margin: 40px auto;
}

.form-container .panel-heading {
    background-color: #182430;
    color: #fff;
    padding: 10px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.form-container .panel-body {
    padding: 20px;
}

.form-container .panel-footer {
    background-color: #182430;
    color: #fff;
    padding: 10px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}
        </style>

    </head>
    <body>
        <div>
            <?php
                require 'header.php';
            ?>
            <div class="form-container">
                    <div class="panel-heading">
                        <h3>SIGNUP</h3>
                    </div>
                    <div class="panel-body">
                    <p>Signup to Book Event.</p>
                        <form method="post" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Username" required="true">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                            </div> 
                            <div class="form-group">
                                <input type="tel" class="form-control" name="mobile_number" placeholder="Mobile Number" required="true">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password(min. 6 characters)" required="true" pattern=".{6,}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="true" pattern=".{6,}">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Sign Up">
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">already have an account yet? <a href="login.php">Login</a></div>
                </div>
            </div>
            <footer class="footer">
               <div class="container">
               <center>
                   <p>Copyright &copy M² Event. All Rights Reserved. | Contact Us: +91 90000 00000</p>
                   <p>This website is developed by MIHIR PATEL</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>