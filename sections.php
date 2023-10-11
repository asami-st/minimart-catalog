<?php
    session_start();

    # We need to connect to the database first before we can interact with it
    require "connection.php";

    # Collect the data from the form
    if (isset($_POST['btn_submit'])) {
        $name = $_POST['name'];

        //call a function
        createSection($name);
    }

    function createSection($name)
    {
        //Connection
        $conn = connection(); //the function inside our connection.php        
        $sql = "INSERT INTO sections(`name`) VALUE('$name')"; //Query String

        if ($conn->query($sql)) {               //Execute the query string above
            //refresh the current script
            header("refresh: 0");
        }else {
            die("Error adding new section". $conn->error);
            // If there is an error, do this
            // "error" is ageneric error string holder
        }
    }

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

    if(isset($_POST['btn_delete'])){
        $section_id = $_POST['btn_delete']; // recieved the id of the section to delete
        deleteSection($section_id); //call the function and pass the id
    }

    function deleteSection($section_id)
    {
        $conn = connection(); // connection to the database
        $sql = "DELETE FROM sections WHERE id = $section_id"; // the query string
        if ($conn->query($sql)) {   // execute the query
            header("refresh: 0");
        }else {
            die("Error in deleting section". $conn->error);
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
    <title>Sectioins</title>
</head>
<body>
    <?php
        include('main-nav.php');
    ?>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="fw-light mb-3">Sections</div>

                <div class="mb-4">
                    <!-- Form -->
                    <form action="#" method="post">
                        <div class="row gx-2">
                            <div class="col">
                                <input type="text" name="name" class="form-control" placeholder="Add a new section here..." max="50" required autofocus>
                            </div>
                            <div class="col-auto">
                                <button type="submit" name="btn_submit" class="btn btn-primary w-100 fw-bold"><i class="fa-solid fa-plus"></i> Add</button>
                            </div>
                        </div>
                    </form>
                    <!-- Table -->
                    <table class="table table-sm align-middle text-center mt-3           ">
                        <thead class="table-info">
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $all_sections = getAllSections(); //this the function we created above
                                while ($section = $all_sections->fetch_assoc()) {
                                    # fetch_assoc() -> transform the result into an array
                                    # $section -> becomes an array
                                    // print_r($section); //display the value of the $section array
                            ?>
                                <tr>
                                    <td><?= $section['id'] ?></td>
                                    <td><?= $section['name'] ?></td>
                                    <td>
                                        <form action="#" method="post">
                                            <button type="submit" name="btn_delete" class="btn btn-outline-danger border-0" value="<?=$section['id']?>" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>

                            <?php
                                } // closing while tag
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS CDN Link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>