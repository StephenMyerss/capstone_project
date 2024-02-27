<?php

require_once('connect.php'); // Include the connection file

try {
    // Check if the database exists
    $db_exists = mysqli_select_db($conn, $db_name);

    // If the database exists, drop it
    if ($db_exists) {
        $drop_database_query = "DROP DATABASE $db_name";
        if (mysqli_query($conn, $drop_database_query)) {
            echo "Database $db_name dropped successfully.<br>";
        } else {
            throw new Exception("Error dropping database: " . mysqli_error($conn));
        }
    } else {
        echo "Database $db_name does not exist.<br>";
    }
} catch (Exception $e) {
    echo $e->getMessage() . "<br>";
}

require_once('create_tables.php');

?>
