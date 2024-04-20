<?php
session_start();

include("../database/connect.php");

if (isset($_POST["company_name"]) && isset($_POST["company_url"])) {

    // Get values from the form
    $companyName = $_POST["company_name"];
    $companyUrl = $_POST["company_url"];

    // Check if the Company Name already exists
    $checkCompanyQuery = "SELECT * FROM Company WHERE CompanyName = '$companyName'";
    $checkCompanyResult = mysqli_query($conn, $checkCompanyQuery);

    // Check if the Company URL already exists
    $checkCompanyUrlQuery = "SELECT * FROM Company WHERE CompanyURL = '$companyUrl'";
    $checkCompanyUrlResult = mysqli_query($conn, $checkCompanyQuery);

    if ((mysqli_num_rows($checkCompanyResult) > 0) || (mysqli_num_rows($checkCompanyUrlResult) > 0)) {
        $_SESSION['error_message'] = "Company Name OR URL already exists. Please enter unique Company Name and URL.";
        header("Location: ../frontend/super_admin_home.php");
        exit();
    } else {
        if (!empty($companyName) && filter_var($companyUrl, FILTER_VALIDATE_URL)) {
            insertIntoCompany($companyName, $companyUrl, $conn);
        } else {
            $_SESSION['error_message'] = "Please provide a valid URL.";
            header("Location: ../frontend/super_admin_home.php");
            exit();
        }
    }
}

function insertIntoCompany($companyName, $companyUrl, $conn)
{
    $insertIntoCompanyTable = "INSERT INTO Company (CompanyName, CompanyURL)
        VALUES ('$companyName', '$companyUrl')";

    try {
        mysqli_query($conn, $insertIntoCompanyTable);
        $_SESSION['success_message'] = "Company added successfully.";
        header("Location: ../frontend/super_admin_home.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        echo '<script>alert("Error submitting Company: ' . $e->getMessage() . '");</script>';
    }
}
?>
