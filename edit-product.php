<?php
    require "connection.php";
    
    $id = $_GET['id']; //retrieved the product id from the url bar.そのまま$_GET['id']で用いることも可。variableを設定したほうが使いやすい。

    //call the function
    $product = getProduct($id);

    function getProduct($id){
        $conn = connection(); //connection to our database
        $sql = "SELECT * FROM products WHERE id = $id";

        if ($result = $conn->query($sql)) {
            return $result->fetch_assoc(); //return the results in an associative array
        }else {
            die("Error in retrieving product details." . $conn->error);
        }
    }

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

    if (isset($_POST['btn_update'])) {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $section_id = $_POST['section_id'];
        
        //call the updateProduct() function and pass the data as parameteres
        updateProduct($id, $name, $description, $price, $section_id);
    }
    
    function updateProduct($id, $name, $description, $price, $section_id)
    {
        $conn = connection();
        $sql = "UPDATE products SET `name` = '$name', `description` =  '$description', `price` = $price, `section_id` = $section_id WHERE id = $id";

        //execute the query
        if($conn->query($sql)){
            //If no error during the execution of the query, do this
            header("location: products.php"); //dashboard
            exit;
        }else {
            die("Error in updation product details. " . $conn->error);
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
    <title>Edit Product</title>
</head>
<body>
    <main class="row justify-content-center">
        <div class="col-4">
            <h2 class="fw-light mb-3">Edit Product</h2>

            <form action="#" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold small">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?=$product['name']?>" max="50" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label small fw-bold">Description</label>
                    <textarea name="description" id="description" rows="5" class="form-control" required><?=$product['description']?></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label-small-fw-bold">Price</label>
                    <input type="number" name="price" id="price" step="any" class="form-control" value="<?=$product['price']?>" required>                       
                </div>
                <div class="mb-4">
                    <label for="section" class="form-label small fw-bold">section</label>
                    <select name="section_id" id="section-id" class="form-select">
                            <option value="" hidden>Select Section</option>
                            <?php
                                $all_sections = getAllSections();
                                while ($section = $all_sections->fetch_assoc()) {
                                    if ($section['id'] == $product['section_id']) {
                                        echo "<option value='". $section['id'] ."' selected>" . $section['name'] ."</option>";
                                    }
                                    else {
                                    echo "<option value='". $section['id'] ."'>" . $section['name'] ."</option>";
                                    }
                                }
                            ?>
                    </select>
                </div>
                <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" name="btn_update" class="btn btn-secondary fw-bold"><i class="fa-solid fa-check"></i> Save Changes</button>
            </form>
        </div>
    </main>


    <!-- Bootstrap JS CDN Link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>