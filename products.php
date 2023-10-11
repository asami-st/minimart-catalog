<?php
    session_start(); //start the session
    require "connection.php";

    //ログインしてないとproduct.phpに行けないようにする。
    if(!isset($_SESSION['id'])){// if not login, then redirect
        // redirect to the login page
        // header("location: index.php");
        header("location: index.php");
    }

    function getAllProducts()
    {
        $conn = connection();

        // two tables combine //id, price= number ->no need ``
        $sql = "SELECT products.id AS id, products.name AS `name`, products.description AS  `description`, products.price AS price, sections.name AS `section` FROM products INNER JOIN sections ON products.section_id = sections.id ORDER BY products.id";


        if($result = $conn->query($sql)){
            return $result;
        }else {
            die("Error in retrieving all the products" . $conn->error);
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
    <title>Dashboard</title>
</head>
<body>
    <?php
        include('main-nav.php');
    ?>
    <main class="container">
        <div class="row mb-4 mt-3">
            <div class="col">
                <h2 class="fw-light">Products</h2>
            </div>
            <div class="col text-end">
                <a href="add-products.php" class="btn btn-success"><i class="fa-solid fa-circle-plus"></i> New Product</a>
            </div>
        </div>

        <table class="table table-hover align-middle border">
            <thead class="small table-success">
                <tr>
                    <th>ID</th>
                    <th style="width: 250px;">NAME</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>SECTION</th>
                    <th style="width: 95px;"></th>
                </tr>           
            </thead>
            <tbody>
                <?php
                    $all_products = getAllProducts();
                    while ($product = $all_products->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?=$product['id']?></td>
                        <td><?=$product['name']?></td>
                        <td><?=$product['description']?></td>
                        <td><?=$product['price']?></td>
                        <td><?=$product['section']?></td>
                        <td>
                            <a href="edit-product.php?id=<?=$product['id']?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                            <a href="delete-product.php?id=<?=$product['id']?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </main>

    <!-- Bootstrap JS CDN Link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>