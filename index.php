<?php
    require "connection.php";

    if (isset($_POST['btn_login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
   
        //call the login method
        login($username, $password);
    }

    function login($username, $password)
    {
        $conn = connection();
        $sql = "SELECT * FROM users WHERE username = '$username'";

        if ($result = $conn->query($sql)) {
            //checck if the username exits
            if ($result->num_rows == 1) { //if its equal to 1, the username exists
                // if true, then do this
                $user = $result->fetch_assoc();

                //check the password, it is matched with the password it matched withe the password
                //that is already in the database
                if (password_verify($password, $user['password'])) { //True or False
                    ### If it matched, then initialize SESSION variables ###
                    session_start(); //start the session
                    $_SESSION['id']           = $user['id'];
                    $_SESSION['username']     = $user['username'];
                    $_SESSION['fullname']     = $user['first_name'] . " ". $user['last_name'];
                    # Note: the scope of session variables are global, meaning that these session variables are available or accessible in any part of your application

                    //redirect the user to the dashboard
                    header("location: products.php");
                    exit;
                }else {
                    echo "<div class='alert alert-danger'>Incorrect Password</div>";
                }
            }else {
                echo "<div class='alert alert-danger'>Username not found</div>";
            }
        }else {
            die("Error retrieving the user. " . $conn->error);
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
    <title>Login</title>
</head>
<body class="bg-light">
    <div style="height: 100vh;">
        <div class="row h-100 m-0">
            <div class="card mx-auto w-25 my-auto p-0">
                <div class="card-header text-primary bg-white">
                    <h1 class="card-title text-center mb-0">Minimart Catalog</h1>
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label small fw-bold">Username</label>
                            <input type="text" name="username" id="username" class="form-control" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <button type="submit" name="btn_login" class="btn btn-primary w-100">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="sign-up.php" class="small">Create account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS CDN Link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>