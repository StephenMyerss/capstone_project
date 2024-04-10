<?php
session_start();

include("../database/connect.php");

if (isset($_POST["addCompany"])) {

    // Get values from the form
    $companyName = $_POST["company_name"];
    $companyUrl = $_POST["company_url"];

    // Check if the Company Name already exists
    $checkCompanyQuery = "SELECT * FROM Company WHERE CompanyName = '$companyName'";
    $checkCompanyResult = mysqli_query($conn, $checkCompanyQuery);

    if (mysqli_num_rows($checkCompanyResult) > 0) {
        $_SESSION['error_message'] = "Company Name already exists. Please add a different Company Name.";
        header("Location: ../frontend/add_company.php");
        exit();
    } else {
        if (!empty($companyName) && filter_var($companyUrl, FILTER_VALIDATE_URL)) {
            insertIntoCompany($companyName, $companyUrl, $conn);
        } else {
            $_SESSION['error_message'] = "Please provide a valid URL.";
            header("Location: ../frontend/add_company.php");
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
        header("Location: ../frontend/add_company.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        echo '<script>alert("Error submitting Company: ' . $e->getMessage() . '");</script>';
    }
}
?>
