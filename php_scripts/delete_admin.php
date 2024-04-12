<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../database/connect.php");

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $companyName = $_POST["companyName"] ?? null;

    // Check if the Admin email is provided
    if (isset($_POST["adminEmail"])) {
        // Get the selected company name from the form data
        $adminEmail = $_POST["adminEmail"];

        deleteAdmin($adminEmail);
        $_SESSION['success_message'] = $adminEmail . " deleted successfully.";

        if (isset($companyName)) {
            header("Location: ../frontend/company.php?company=". urlencode($companyName));
            exit();
        }
        header("Location: ../frontend/super_admin_home.php");
        exit();
    }
}

// Function to delete provided admin along with their comment from the database
function deleteAdmin($adminEmail) {

    global $conn; // Access the database connection within the function

    $query0 = "DELETE FROM comment WHERE AdminID in (SELECT AdminID FROM admin WHERE AdminEmail = '$adminEmail')";
    if(!mysqli_query($conn, $query0)){
        echo "Unable to delete Comments from " . $adminEmail . ".";
    };

    $query1 = "DELETE FROM admin WHERE AdminEmail = '$adminEmail'";
    if(!mysqli_query($conn, $query1)){
        echo "Unable to delete " . $adminEmail . ".";
    };

}

?>

