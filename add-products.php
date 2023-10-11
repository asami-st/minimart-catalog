<?php
    session_start();
    require "connection.php";

    // We need to select here on which section the product belongs to
    function getAllSections()
    {
        $conn = connection();               // Connection to the database
        $sql = "SELECT * FROM sections";    //retrieved every records we have in the sections table
        if ($result = $conn->query($sql)) { //execute the query, Note: $result becomes an object it contains many      variables and methods inside
            return $result;                 //return the result when the function is called 
        }else {
            die("Unable to retrieved records" . $conn->error); //display custom error message if there is an error
        }
    }

    if (isset($_POST['btn_add'])) {             // if the btn_add has been clicked
        # received data from the form
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $section_id = $_POST['section_id'];

        //call the function and pass the data
        createProduct($name, $description, $price, $section_id);
    }

    function createProduct($name, $description, $price, $section_id)
    {
        $conn = connection(); //database connection
        $sql = "INSERT INTO products(`name`, `description`, `price`, `section_id`) VALUES ('$name', '$description', '$price', '$section_id')";  // name field: ` , VALUE:' 
        
        //Execute the query above
        if ($conn->query($sql)) {
            header("location: products.php"); // dashboard
            exit;                             // exit the script
        }else {
            die("Error in adding new products. " . $conn->error); //display a custom and actual error massage
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
    <title>New Product</title>
</head>
<body>
    <?php
        include('main-nav.php');
    ?>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <h2 class="fw-light mb-2">New Product</h2>

                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label small fw-bold">Name</label>
                        <input type="text" name="name" id="name" class="form-control" max="50" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label small fw-bold">Description</label>
                        <textarea name="description" id="description" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label small fw-bold">Price</label>
                        <div class="input-group">
                            <div class="input-group-text">$</div>
                            <input type="number" name="price" id="price" step="any" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="section-id" class="form-label">Section</label>
                        <select name="section_id" id="section-id" class="form-select">
                            <option value="" hidden>Select Section</option>
                            <?php
                                $all_sections = getAllSections();
                                while ($section = $all_sections->fetch_assoc()) {
                                    echo "<option value='". $section['id'] ."'>" . $section['name'] ."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <a href="#" class="btn btn-outline-success">Cancel</a>
                    <button type="submit" name="btn_add" class="btn btn-success fw-bold px-5">
                    <i class="fa-solid fa-plus"></i> Add
                    </button>
                </form>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS CDN Link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>