<?php
ob_start();
session_start();
include("../database/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Company</title>
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
            <li class="nav-item fs-5"><a href="super_admin_home.php" class="color nav-link" draggable="true">Back to Super Admin</a>
            </li>
        </ul>
    </header>
</div>

<?php
include("../php_scripts/displaySessionMessage.php");
?>

<div class="container fs-5 mt-3">
    <div class="login-container">
        <form id="add-company-form" action="../php_scripts/company_submission.php" method="post">
            <!-- Input fields for Company name and Url -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold" for="companyName">Name</label>
                    <input name="company_name" type="text" class="form-control border-3" id="companyName" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold" for="companyUrl">Url</label>
                    <input name="company_url" type="text" class="form-control border-3" id="companyUrl" required>
                </div>
            </div>

            <!-- Add button -->
            <div class="text-center mb-3">
                <button name="addCompany" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold">
                    Add Company
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