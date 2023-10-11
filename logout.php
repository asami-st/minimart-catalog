<?php
    session_start();    //start the session

    session_unset();    //unset or free up the session when we click the logout button
    session_destroy();  //destroy or delete the session variables in the computer's memory when we clicked logout button

    //after destroying/unsetting the session variables
    //redirect the user to the login page
    header("location: index.php");
    exit;