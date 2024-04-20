<?php

ob_start();
session_start();
include("../database/connect.php");
include("../php_scripts/functions.php");
?>

<?php
$adminAndCompany = getAdminAndCompanyNameFromEmail($_GET['adminEmail'] ?? '');

// Check if admin and company data is retrieved successfully
if ($adminAndCompany) {
    // Extract admin name and company name from the associative array
    $adminNameFromDatabase = $adminAndCompany['adminName'] ?? '';
    $companyNameFromDatabase = $adminAndCompany['companyName'] ?? '';
} else {
    echo "Unable to get admin and company name.";
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Password Reset</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <link href="stylePop.css" rel="stylesheet">
        <link href="addPop.css" rel="stylesheet">
        <script src="../js/script.js"></script>
    </head>
    <body class="d-flex flex-column min-vh-100">

        <div id="body-container">
            <div class="container header">
                <header class="d-flex flex-wrap justify-content-center py-3 border-bottom border-dark">
                    <a href="super_admin_home.php"
                       class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                        <img class="innovation-logo" src="../innovationImages/smrt_logo_light.png"
                             alt="">
                    </a>
                    <ul class="nav align-items-center">
                        <li class="nav-item fs-5">
                            <a href="company.php?company=<?php
                            echo urlencode($companyNameFromDatabase); ?>" class="color nav-link" draggable="true">Back to
                                Admin</a>
                        </li>
                    </ul>
                </header>
            </div>

            <?php
            include("../php_scripts/displaySessionMessage.php");
            ?>

            <div class="container fs-5 mt-3">
                <div class="login-container">
                    <form id="resetAdminPassword" action="../php_scripts/updateAdminPassword.php" method="post"
                          onsubmit="return validatePasswords()">

                        <input type="hidden" name="adminEmail" value="<?php
                        echo htmlspecialchars($_GET['adminEmail'] ?? ''); ?>">

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <label class="form-label fw-bold" for="adminName">Admin Name</label>
                                <p class="form-control border-3 transparent-field"><?php echo $adminNameFromDatabase; ?></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <label class="form-label fw-bold" for="exampleFormControlSelect1">Company Name</label>
                                <p class="form-control border-3 transparent-field"><?php echo $companyNameFromDatabase; ?></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <label class="form-label fw-bold" for="adminEmail">Admin Email</label>
                                <p class="form-control border-3 transparent-field"><?php echo $_GET['adminEmail'] ?></p>
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
                            <button name="resetPasswordAdmin" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold">Reset Password</button>
                        </div>
                    </form>
                    <!-- Delete Admin Form -->
                    <form id="deleteAdminForm" action="../php_scripts/delete_admin.php" method="post">
                        <input type="hidden" name="adminEmail" value="<?php echo htmlspecialchars($_GET['adminEmail'] ?? ''); ?>">
                        <input type="hidden" name="companyName" value="<?php echo $companyNameFromDatabase; ?>">
                        <div class="text-center mb-3">
                            <button id="deleteButton" class="delete-button-color button-width fs-5 btn btn-primary fw-bold">Delete Admin</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="container mt-auto">
                <footer class="py-3 my-4 border-top border-dark">
                    <p class="text-center text-body-secondary">© 2024 Cameron University Capstone</p>
                </footer>
            </div>

        </div>

        <div id="deletePopup" class="popup" style="display: none;">
            <div class="popup-content">
                <p>Do you want to delete <?php echo $adminNameFromDatabase; ?>? </p>
                <span>All the comments made by <?php echo $adminNameFromDatabase; ?> will also be <span style="color: #da0d25;">deleted!</span></span><br>
                <div class="buttons-container">
                    <button id="confirmDelete">Delete</button>
                    <button id="cancelDelete">Cancel</button>
                </div>
            </div>
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

            // Function to show the confirmation popup and blur the background
            function showConfirmationPopup() {
                var confirmationPopup = document.getElementById("deletePopup");
                var body = document.getElementById('body-container');

                // Add blur class to the body
                body.classList.add('blur');
                confirmationPopup.style.display = 'block';
            }

            // Function to hide the confirmation popup and remove the blur from the background
            function hideConfirmationPopup() {
                var confirmationPopup = document.getElementById("deletePopup");
                var body = document.getElementById('body-container');

                // Remove blur class from the body
                body.classList.remove('blur');
                confirmationPopup.style.display = 'none';
            }

            // Add event listener to the delete button to show confirmation popup
            document.getElementById("deleteButton").addEventListener("click", function(event) {
                event.preventDefault();
                showConfirmationPopup();
            });

            // Add event listener to the confirm delete button in the popup
            document.getElementById("confirmDelete").addEventListener("click", function(event) {
                document.getElementById("deleteAdminForm").submit();
            });

            // Add event listener to the cancel delete button
            document.getElementById("cancelDelete").addEventListener("click", function(event) {
                hideConfirmationPopup();
            });

            // Flag to track whether the mouse is down outside the popup
            var isMouseDownOutsidePopup = false;

            // Add mousedown event listener to track clicks outside the popup
            document.addEventListener("mousedown", function(event) {
                var deletePopup = document.getElementById("deletePopup");
                if (deletePopup.style.display === "block" && !deletePopup.contains(event.target)) {
                    isMouseDownOutsidePopup = true;
                } else {
                    isMouseDownOutsidePopup = false;
                }
            });

            // Add mouseup event listener to close the popup when clicking outside of it
            document.addEventListener("mouseup", function(event) {
                var deletePopup = document.getElementById("deletePopup");
                if (isMouseDownOutsidePopup && !deletePopup.contains(event.target)) {
                    hideConfirmationPopup();
                }
                // Reset the flag
                isMouseDownOutsidePopup = false;
            });

        </script>
    </body>
    </html>

<?php
ob_end_flush();
?>