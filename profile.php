<?php
    session_start();
    require "connection.php";

    //call the function
    $user = getUser();

    function getUser()
    {
        $conn = connection();
        $id = $_SESSION['id']; //came from login function
        $sql = "SELECT * FROM users WHERE id = $id";

        if ($result = $conn->query($sql)) {
            return $result->fetch_assoc();
        }else {
            die("Error in retrieving user details. " . $conn->error);
        }

    }
    
    if (isset($_POST['btn_upload_photo'])) { //check if the button is clicked
        $id = $_SESSION['id']; //ID of the currently logged-in user
        $photo_name = $_FILES['photo']['name']; //$_FILES[][]  //array
        //$_FILES['photo'] -> refers to the input field name
        //$_FILES['name'] -> refers to the name of the file itself

        $photo_tmp = $_FILES['photo']['tmp_name'];
        //$_FILES['photo'] --> refers to the input field name
        //$_FILES['tmp_name'] --> refers to the temporary memory inside our computer wich our image is temporary save.(we cannnot see/only uploading files)                   

        //call the updatePhoto function
        updatePhoto($id, $photo_name, $photo_tmp);
    }

    function updatePhoto($id, $photo_name, $photo_tmp)
    {
        $conn = connection(); //connect to the database
        $sql = "UPDATE users SET photo = '$photo_name' WHERE id = $id";

        if ($conn->query($sql)) {
            $destination = "assets/images/$photo_name";
            move_uploaded_file($photo_tmp, $destination);
            header("refresh: 0");
        }else {
            die("Error in moving the photo. " . $conn->error);
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
    
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Profile Page</title>
</head>
<body>
    <?php
        include('main-nav.php');
    ?>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-3">
                <?php
                    if ($user['photo']) { //check if there is a photo provided
                ?>
                    <!-- Display the photo if available -->
                    <img src="assets/images/<?= $user['photo']?>" alt="<?= $user['photo'] ?>" class="ms-5 profile-photo">
                <?php
                    }else {
                ?>
                    <!-- Display the fontawesome icon -->
                    <i class="fa-solid fa-user d-block text-center profile-icon"></i>
                <?php
                    }
                ?>

                <div class="mt-2 mb-3 text-center">
                    <p class="h4 mb-0"><?=$user['username']?></p>
                    <p><?=$user['first_name'] ."". $user['last_name']?></p>
                </div>

                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <input type="file" name="photo" id="photo" class="form-control">
                        <button type="submit" name="btn_upload_photo" class="btn btn-outline-secondary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <!-- Bootstrap JS CDN Link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>