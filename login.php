<?php
ob_start(); // Start output buffering

require 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validate username
    if (empty($username)) {
        $error = "Username is required";
    } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        $error = "Username can only contain letters, numbers, and underscores";
    }

    // Validate password
    if (empty($password)) {
        $error = "Password is required";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long";
    }

    // Validate role
    if (empty($role)) {
        $error = "Role is required";
    } elseif (!in_array($role, array('admin', 'user'))) {
        $error = "Invalid role";
    }

    // If no errors, proceed with login logic
    if (!isset($error)) {
        // Login logic here
        if ($role == 'admin') {
            $collection = $db->selectCollection('admins');
            $filter = ['username' => $username];
            $admin = $collection->findOne($filter);
            if ($admin) {
                $stored_password = $admin['password'];
                if (password_verify($password, $stored_password)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $role;
                    header('Location: Ahome.php'); // Redirect to Ahome.php
                    exit(); // Terminate the script immediately
                } else {
                    $error = "Invalid username or password";
                }
            } else {
                $error = "Invalid username or password";
            }
        } elseif ($role == 'user') {
            $collection = $db->selectCollection('User');
            $filter = ['username' => $username];
            $User = $collection->findOne($filter);
            if ($User) {
                $stored_password = $User['password'];
                if (password_verify($password, $stored_password)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $role;
                    header('Location: Uhome.php'); // Redirect to Uhome.php
                    exit(); // Terminate the script immediately
                } else {
                    $error = "Invalid username or password";
                }
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Invalid role";
        }
    }

    if (isset($error)) {
        echo "<script>alert('$error');</script>";
    }
}
?>

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
            <br><br><br>
            <div class="form-container">
                    <div class="panel-heading">
                        <h3>LOGIN</h3>
                    </div>
                            <div class="panel-body">
                                <p>Login to Book Event.</p>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Password(min. 6 characters)" pattern=".{6,}" required>
                                    </div>
                                    <div class="form-group">
                                    <select class="form-control" id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="admin">admin</option>
                    <option value="user">User</option>
                </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Login" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">Don't have an account yet? <a href="signup.php">Register</a></div>
                        </div>
                    </div>
                </div>
           </div>
           <br><br><br><br><br>
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