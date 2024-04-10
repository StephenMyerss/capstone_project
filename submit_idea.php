<?php

session_start();
include("database/connect.php");
include("php_scripts/functions.php");

// Check if the company name is provided in the URL
if (isset($_GET['company'])) {
    $companyName = $_GET['company'];

    // Check if the provided company name exists in the database
    if (isValidCompany($companyName)) {
        $_SESSION['companyName'] = $companyName;
        // Redirect to home page
        header("Location: index.php");
        exit(); // Stop further execution
    } else {
        $_SESSION['error_message'] = "This Company does not exist. Please use a valid company.";
        // Redirect to an error page if company does not exist
        header("Location: frontend/error_page.php");
        exit(); // Stop further execution
    }
} else {
    $_SESSION['error_message'] = "You do not have correct authorization to access this page.";
    // Redirect to an error page if company name is not provided
    header("Location: frontend/error_page.php");
    exit(); // Stop further execution
}