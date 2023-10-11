<?php
    require "connection.php";

    if (isset($_POST['btn_signup'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        //check if the password and the confirm_password is equal
        if ($password == $confirm_password) {
            //if equal, the call the function that will insert the data into the users table
            createUser($first_name, $last_name, $username, $password);
        }else {
            echo "<p class='alert alert-danger'>Password and confirm password do not matched</p>";
        }
    }

    function createUser($first_name, $last_name, $username, $password)
    {
        $conn = connection();
        $password = password_hash($password, PASSWORD_DEFAULT); // will return a hased password
        $sql = "INSERT INTO users (`first_name`, `last_name`,`username`,`password`) VALUES('$first_name', '$last_name', '$username', '$password')";

        // execute the query string
        if ($conn->query($sql)) {
            //if no error, do this
            header("location: index.php"); // we will create index.php after we are done with register
            exit;
        }else {
            //if there is an error, do this
            die("There is an error signing up. " . $conn->error);
        }
    }

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Reister</title>
</head>
<body class="bg-light">
    <div style="height: 100vh;">
        <div class="row h-100 m-0">
            <div class="card mx-auto w-25 my-auto p-0">
                <div class="card-header text-success">
                    <h1 class="card-title h2 mb-0">Create Your Account</h1>
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <div class="mb-3">
                            <label for="first-name" class="form-lebel small fw-bold">First Name</label>
                            <input type="text" name="first_name" id="first-name" class="form-control" maxlength="50" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="last-name" class="form-label small fw-bold">Last Name</label>
                            <input type="text" name="last_name" id="last-name" class="form-control" maxlength="50" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label small fw-bold">Username</label>
                            <input type="text" name="username" id="username" class="form-control" maxlength="15" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold">Password</label>
                            <input type="password" name="password" id="password" class="form-control mb-2" required>
                        </div>
                        <div class="mb-5">
                            <label for="confirm-password" class="form-label small fw-bold">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm-password" class="form-control" required>
                        </div>
                        <button type="submit" name="btn_signup" class="btn btn-success w-100">Sign Up</button>
                    </form>
                    <div class="text-center p3">
                        <p class="small">Already have an account? <a href="index.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS CDN Link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>