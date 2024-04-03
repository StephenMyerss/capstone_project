<?php

ob_start();
session_start();
include("../database/connect.php");
include("../php_scripts/functions.php");
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Password Reset</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <script src="../js/script.js"></script>
    </head>
<body class="d-flex flex-column min-vh-100">

    <div class="container header">
        <header class="d-flex flex-wrap justify-content-center py-3 border-bottom border-dark">
            <a href="../index.php"
               class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img class="innovation-logo" src="../innovationImages/smrt_logo_light.png"
                     alt="">
            </a>
            <ul class="nav align-items-center">
                <li class="nav-item fs-5"><a href="super_admin_home.php" class="color nav-link" draggable="true">Back to
                        Super Admin</a>
                </li>
            </ul>
        </header>
    </div>

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
?>

<div class="container fs-5 mt-3">
    <div class="login-container">
    <form id="reset-admin-password-form" action="../php_scripts/updateAdminPassword.php" method="post"  onsubmit="return validatePasswords()">

    <input type="hidden" name="adminEmail" value="<?php echo htmlspecialchars($_GET['adminEmail'] ?? ''); ?>">

        <?php
        $adminAndCompany = getAdminAndCompanyNameFromEmail($_GET['adminEmail'] ?? '');

        // Check if admin and company data is retrieved successfully
        if ($adminAndCompany) {
            // Extract admin name and company name from the associative array
            $adminNameFromDatabase = $adminAndCompany['adminName'] ?? '';
            $companyNameFromDatabase = $adminAndCompany['companyName'] ?? '';
        }
    ?>

    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <label class="form-label fw-bold" for="adminName">Admin Name</label>
            <p class="form-control border-3"><?php
                echo $adminNameFromDatabase; ?></p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <label class="form-label fw-bold" for="exampleFormControlSelect1">Company Name</label>
            <p class="form-control border-3"><?php
                echo $companyNameFromDatabase; ?></p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <label class="form-label fw-bold" for="adminEmail">Admin Email</label>
            <p class="form-control border-3"><?php
                echo $_GET['adminEmail'] ?></p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <label class="form-label fw-bold" for="password">Password</label>
            <input type="password" class="form-control border-3" id="password" name="password" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <label class="form-label fw-bold" for="password">Retype Password</label>
            <input type="password" class="form-control border-3" id="password2" name="password2" required>
        </div>
    </div>

    <!-- Add button -->
    <div class="text-center mb-3">
        <button name="resetPasswordAdmin" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold">
            Reset Password
        </button>
    </div>
    </form>
    </div>
    </div>


    <div class="container mt-auto">
        <footer class="py-3 my-4 border-top border-dark">
            <p class="text-center text-body-secondary">© 2024 Cameron University Capstone</p>
        </footer>
    </div>

    <script>
        // Automatically hide success and error messages after 1 second
        setTimeout(function () {
            var successMessage = document.getElementById("successMessage");
            if (successMessage) {
                successMessage.style.display = "none";
            }
            var errorMessage = document.getElementById("errorMessage");
            if (errorMessage) {
                errorMessage.style.display = "none";
            }
        }, 1000);

        // Function to validate password fields
        function validatePasswords() {
            var password1 = document.getElementById("password").value;
            var password2 = document.getElementById("password2").value;

            // Check if passwords match
            if (password1 !== password2) {
                // If passwords don't match, show an error message
                alert("Passwords do not match. Please retype your password.");
                // Prevent form submission
                return false;
            }
            // If passwords match, allow form submission
            return true;
        }
    </script>

    </body>
    </html>

    <?php
    ob_end_flush();
    ?>