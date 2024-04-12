<?php
if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
}
include("../database/connect.php");

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the company name is provided
    if (isset($_POST["deleteCompany"])) {
        // Get the selected company name from the form data
        $companyName = $_POST["deleteCompany"];

        deleteCompany($companyName);
        $_SESSION['success_message'] = $companyName . " deleted successfully.";
        header("Location: ../frontend/super_admin_home.php");
        exit();
    }
}

// Function to delete provided company along with associated data from the database
function deleteCompany($companyName) {

    global $conn; // Access the database connection within the function
    $companyId = getCompanyIdUsingName($companyName);

    $query0 = "DELETE FROM comment WHERE AdminID in (SELECT AdminID FROM admin WHERE CompanyID = '$companyId')";
    if(!mysqli_query($conn, $query0)){
        echo "Unable to delete Comments from " . $companyName . " admins.";
    };

    $query1 = "DELETE FROM idea WHERE CompanyID = '$companyId'";
    if(!mysqli_query($conn, $query1)){
        echo "Unable to delete Ideas for " . $companyName . ".";
    };

    $query2 = "DELETE FROM innovator WHERE CompanyID = '$companyId'";
    if(!mysqli_query($conn, $query2)){
        echo "Unable to delete Innovators for " . $companyName . ".";
    };

    $query3 = "DELETE FROM admin WHERE CompanyID = '$companyId'";
    if(!mysqli_query($conn, $query3)){
        echo "Unable to delete Admins for " . $companyName . ".";
    };

    $query4 = "DELETE FROM company WHERE CompanyID = '$companyId'";
    if(!mysqli_query($conn, $query4)){
        echo "Unable to delete " . $companyName . " company.";
    };

}

function getCompanyIdUsingName($companyName) {
    global $conn;

    $fetchID = mysqli_query($conn, "SELECT CompanyID FROM Company WHERE CompanyName = '$companyName'");

    if (mysqli_num_rows($fetchID) == 1) {
        // Company with the given name exists

        // Fetch the result as an associative array
        $row = mysqli_fetch_assoc($fetchID);
        // Get the CompanyID from the fetched row
        return $row['CompanyID'];
    } else {
        return null;
    }
}

?>

