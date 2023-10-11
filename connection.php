<?php
    function connection(){
        $server_name = "localhost"; //127.0.0.1
        $username = "root"; // this is the username by default
        $password = ""; //leave empty for windows, and add 'root' if you are using MAC
        $db_name = "minimart_catalog";

        //Create the connection
        $conn = new mysqli($server_name, $username, $password, $db_name);
        # $conn = is now holding our connection to the database
        # $conn -> is an object
        # mysqli() -> is a class (it contains methods/functions and variables inside)
        # mysqli() -> is an improved version of mysql(). i stands for improve.

        //Check the connection
        if ($conn->connect_error) { // if this is true, then there is error in the connection
            // if true that there is an error, then do this
            die("Connection to the database failed.".$conn->connect_error);
            # die() -> will terminate the current script 
        }else {
            // If there is no error in the connection
            return $conn; //We will this object later on
        }

        # Note: the arrow ( -> )is called object operator (the object is on the left side of the operant)
        # connect_error --- contains the a string value of the error
    }

?>