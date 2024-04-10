<?php

// Display success message if exists
if (isset($_SESSION['success_message'])) {
    echo '<div id="successMessage" class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']); // Clear the message after displaying it
}

// Display error message if exists
if (isset($_SESSION['error_message'])) {
    echo '<div id="errorMessage" class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']); // Clear the message after displaying it
}
