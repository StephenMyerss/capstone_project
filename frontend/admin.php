<?php
ob_start();
session_start();
include("../database/connect.php");
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <title>Admin</title>
    </head>
    <body class="d-flex flex-column min-vh-100">
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-dark">
            <div class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img class="innovation-logo" src="../innovationImages/smrt_logo_light.png" alt="">
            </div>
            <form method="post" action="">
                <ul class="nav align-items-center">
                    <li class="nav-item fs-5">
                        <button name="logout" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold">
                            Logout
                        </button>
                    </li>
                </ul>
            </form>
    </header>
</div>



    <div class="container fs-4 ">
        <div class="text-center justify-content-center border-dark">
            <h1 class="display-4 fw-bold text-body-emphasis">Admin: <?php echo $_SESSION["admin_username"] ?></h1>
<!--                <h1 class="display-4 fw-bold text-body-emphasis">Admin ID: --><?php //echo $_SESSION["admin_id"] ?><!--</h1>-->
<!--                <h1 class="display-4 fw-bold text-body-emphasis">Admin C ID: --><?php //echo $_SESSION["admin_company_id"] ?><!--</h1>-->
        </div>
        <h2 class="mb-4 display-5 fw-bold">User Posts </h2>

        <form method="get" action="admin.php">

            <input type="hidden" name="admin_company_id" value="<?php echo $_SESSION["admin_company_id"]; ?>">
            <div class="mb-3">
                <label for="startDate">Start Date:</label>
                <div class="input-group">
                    <input type="date" id="startDate" name="startDate" class="form-control fs-4" value="<?php echo isset($_GET['startDate']) ? htmlspecialchars($_GET['startDate']) : ''; ?>">
                    <div class="input-group-append">
                        <button class="fs-4 btn button-color" type="button" id="clearStartDateBtn">Clear</button>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="endDate">End Date:</label>
                <div class="input-group">
                    <input type="date" id="endDate" name="endDate" class="form-control fs-4" value="<?php echo isset($_GET['endDate']) ? htmlspecialchars($_GET['endDate']) : ''; ?>">
                    <div class="input-group-append">
                        <button class="fs-4 btn button-color" type="button" id="clearEndDateBtn">Clear</button>
                    </div>
                </div>
            </div>

            <div class="text-center py-3">
                <button name="submit" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold"">Filter</button>
            </div>
        </form>

        <div id="ideaList" class="list-group">
            <!-- Ideas will be dynamically populated here -->
            <?php
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

<script>
    document.getElementById('clearStartDateBtn').addEventListener('click', function() {
        document.getElementById('startDate').value = ''; // Clear the startDate input
    });
    document.getElementById('clearEndDateBtn').addEventListener('click', function() {
        document.getElementById('endDate').value = ''; // Clear the startDate input
    });
</script>

<?php
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}
ob_end_flush();
?>