<?php
session_start();
include("../database/connect.php");

if (isset($_POST['resetPasswordAdmin'])) {
    // Get the admin email from the submitted form
    $adminEmail = $_POST['adminEmail'] ?? '';
    // Get the new password from the submitted form
    $newPassword = $_POST['password'] ?? '';

    // Encrypt the new password
    $encryptedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Query to update the admin's password based on the email
    $query = "UPDATE Admin SET AdminPassword = '$encryptedPassword' WHERE AdminEmail = '$adminEmail'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Password updated successfully
        $_SESSION['success_message'] = "Password updated successfully!";
        header("Location: ../frontend/password_reset.php?adminEmail=" . urlencode($adminEmail));
        exit();
    } else {
        // Password update failed
        $_SESSION['error_message'] = "Sorry, could not update Password!";
        header("Location: ../frontend/password_reset.php?adminEmail=" . urlencode($adminEmail));
        exit();
    }
}