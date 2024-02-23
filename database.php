<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";

// Desired database name
$desired_db_name = "innovationhub";

// Create a temporary connection without specifying a database
$temp_conn = mysqli_connect($db_server, $db_user, $db_pass);

// Check connection
if ($temp_conn) {
    // Check if the desired database exists
    $result = mysqli_query($temp_conn, "SHOW DATABASES LIKE '$desired_db_name'");

    if (mysqli_num_rows($result) > 0) {
        // Use the desired database if it exists
        $db_name = $desired_db_name;
    } else {
        // Create the desired database if it doesn't exist
        $create_db_query = "CREATE DATABASE $desired_db_name";

        if (mysqli_query($temp_conn, $create_db_query)) {
            echo "Database '$desired_db_name' created successfully<br>";
            $db_name = $desired_db_name;
        } else {
            echo "Error creating database: " . mysqli_error($temp_conn) . "<br>";
            // Use a default database name or handle the error as needed
            $db_name = "default_database";
        }
    }

    // Close the temporary connection
    mysqli_close($temp_conn);
} else {
    die("Connection failed: " . mysqli_connect_error());
}

// Now, $db_name contains the dynamic database name
// Use $db_name in your subsequent connection or queries
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>