<?php
session_start();
include("../database/connect.php");
include("functions.php");

if (isset($_POST["addAdmin"])) {
    $adminName = filter_input(INPUT_POST, "adminName", FILTER_SANITIZE_SPECIAL_CHARS);
    $adminEmail = filter_input(INPUT_POST, "adminEmail", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $companyName = $_POST["company"];

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM Admin WHERE AdminEmail = '$adminEmail'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        $_SESSION['error_message'] = "Admin Email already exists. Please use a different email.";
        header("Location: ../frontend/add_admin.php");
        exit();
    } else {
        // If the email doesn't exist, proceed with registration
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $companyID = getCompanyIdFromName($companyName);

        $sql = "INSERT INTO Admin (AdminName, AdminEmail, AdminPassword, CompanyID) VALUES ('$adminName', '$adminEmail', '$hash', $companyID)";

        try {
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $_SESSION['success_message'] = "Admin added successfully.";
                header("Location: ../frontend/add_admin.php");
                exit();
            } else {
                echo "Registration failed. Please try again.";
            }
        } catch (mysqli_sql_exception $e) {
            echo "Registration failed. Please try again later." . "<br>" . $e->getMessage();
        }
    }
}
?>
