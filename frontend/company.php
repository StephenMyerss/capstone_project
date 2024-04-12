<?php
session_start();
include("../database/connect.php");
include("../php_scripts/functions.php");
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <script src="../js/script.js"></script>
        <title>Company Home</title>
        <style>
            .login-container {
                max-width: 400px;
                margin: 100px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body class="d-flex flex-column min-vh-100">
    <div class="container header">
        <header class="d-flex flex-wrap justify-content-center py-3 border-bottom border-dark">
            <div class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img class="innovation-logo" src="../innovationImages/smrt_logo_light.png" alt="">
            </div>
            <ul class="nav align-items-center">
                <li class="nav-item fs-5">
                    <a href="super_admin_home.php" class="color nav-link" draggable="true">Back to Home</a>
                </li>
            </ul>
        </header>
    </div>

    <?php $companyName = $_GET['company'] ?? '' ?>

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

    <div class="container">

        <div class="container fs-4 ">
            <h2 class="py-3 mb-4 display-5 fw-bold">Admins From <?php echo $companyName ?> </h2>

            <div id="adminList" class="list-group">
                <?php filterAdminsBasedOnCompany($_GET['company'] ?? null); ?>
            </div>
        </div>

        <div class="col-md-6 d-flex justify-content-start mt-3">
            <a href="add_admin.php?company=<?php echo urlencode($companyName); ?>" class="color nav-link fs-5" draggable="true">Add Admin</a>
        </div>

        <div id="ideaList" class="list-group mt-3">
            <span style="font-weight: bold; font-size: 25px;">Ideas</span>
            <!-- Ideas will be dynamically populated here -->
            <?php
            $_SESSION["company_id"] = getCompanyIdFromName($companyName);
            include("../php_scripts/admin_page.php"); // Include the PHP script to generate ideas
            ?>

        </div>

    </div>

    <div class="container mt-auto">
        <footer class="py-3 my-4 border-top border-dark">
            <p class="text-center text-body-secondary">© 2024 Cameron University Capstone</p>
        </footer>
    </div>

    </body>
</html>

<?php
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}
ob_end_flush();
?>

?>

