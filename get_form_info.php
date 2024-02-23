<?php
$server_name="localhost";
$username="root";
$password="";
$database_name ="innovationhub";

// Check connection
try
{
    $conn = new PDO("mysql:host=$server_name; dbname=$database_name", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['save']))
    {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Table name is entry_details
        // Column names are: first_name, last_name, gender, email, mobile
        $sql_query = "INSERT INTO entry_details (first_name, last_name, gender, email, mobile)
        VALUES (:first_name, :last_name, :gender, :email, :phone)";

        $stmt = $conn->prepare($sql_query);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);

        // Execute the query 
        if($stmt->execute())
        {
            echo "Innovation Submmitted Succesfully!";
        }
        else
        {
            echo "Error: " . $sql . $e->getMessage();
        }
    }
}
catch(PDOExecption $e)
{
        echo "Connection Failec: " . $e->getessage();
        die();
}



