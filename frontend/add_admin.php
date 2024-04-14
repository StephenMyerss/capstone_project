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
    <title>Add Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="../js/script.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">

<div class="container header">
    <header class="d-flex flex-wrap justify-content-center py-3 border-bottom border-dark">
        <a href="super_admin_home.php"
           class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img class="innovation-logo" src="../innovationImages/smrt_logo_light.png"
                 alt="">
        </a>
        <ul class="nav align-items-center">
            <li class="nav-item fs-5">
                <a href="company.php?company=<?php echo urlencode($_GET['company']); ?>" class="button-color button-width fs-5 btn btn-primary fw-bold" draggable="true">Back to Admin</a>
            </li>
        </ul>
    </header>
</div>

<?php
include("../php_scripts/displaySessionMessage.php");
?>

<script>
    // Automatically hide success and error messages after 1 second
    setTimeout(function() {
        var successMessage = document.getElementById("successMessage");
        if (successMessage) {
            successMessage.style.display = "none";
        }
        var errorMessage = document.getElementById("errorMessage");
        if (errorMessage) {
            errorMessage.style.display = "none";
        }
    }, 1000);
</script>

<div class="container fs-5 mt-3">
    <div class="login-container">
        <form id="add-admin-form" action="../php_scripts/admin_submission.php" method="post">
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <label class="form-label fw-bold" for="exampleFormControlSelect1">Company Name</label>
                    <p class="form-control border-3" style="background-color: #e9ecef; color: #6c757d; cursor: not-allowed;">
                        <?php echo $_GET['company'] ?? '' ?></p>
                    <!-- Hidden input field to pass the company name -->
                    <input type="hidden" name="companyName" value="<?php echo $_GET['company'] ?? '' ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <label class="form-label fw-bold" for="adminName">Admin Name</label>
                    <input type="text" class="form-control border-3" id="adminName" name="adminName" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <label class="form-label fw-bold" for="adminEmail">Admin Email</label>
                    <input type="email" class="form-control border-3" id="adminEmail" name="adminEmail" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 offset-md-3">
                    <label class="form-label fw-bold" for="password">Password</label>
                    <input type="password" class="form-control border-3" id="password" name="password" required>
                </div>
            </div>

            <!-- Add button -->
            <div class="text-center mb-3">
                <button name="addAdmin" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold">
                    Add Admin
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

<!--script to hide the session message after 1 sec-->
<script src="../js/script.js"></script>

</body>
</html>

<?php
ob_end_flush();
?>