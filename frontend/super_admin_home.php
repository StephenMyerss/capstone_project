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
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <title>Super Admin</title>
    </head>
    <body class="d-flex flex-column min-vh-100">
    <div class="container header">
        <header class="d-flex flex-wrap justify-content-center py-3 border-bottom border-dark">
            <div class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img class="innovation-logo" src="../innovationImages/smrt_logo_light.png" alt="">
            </div>
            <form method="post" action="">
                <ul class="nav align-items-center">
                    <li class="nav-item fs-5">
                        <button name="logout" type="submit"
                                class="button-color button-width fs-5 btn btn-primary fw-bold">
                            Logout
                        </button>
                    </li>
                </ul>
            </form>
        </header>
    </div>

    <div class="container">
        <div class="container fs-4 ">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-md-6 d-flex justify-content-end">
                        <a href="add_company.php" class="color nav-link fs-5" draggable="true">Add Company</a>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-6 d-flex justify-content-end">
                        <a href="add_admin.php" class="color nav-link fs-5" draggable="true">Add Admin</a>
                    </div>
                </div>
            </div>

            <h2 class="mb-4 display-5 fw-bold">Companies</h2>

            <?php

            // Query to fetch all company names
            $fetchData = mysqli_query($conn, "SELECT CompanyName FROM Company");

            // Check if any records are returned
            if (mysqli_num_rows($fetchData) > 0) {
                echo '<div class="container">';
                echo '<div class="row">';

                // Loop through each row and fetch company names
                $count = 0;
                while ($row = mysqli_fetch_assoc($fetchData)) {
                    // Output each company name in a column
                    if ($count % 3 == 0 && $count > 0) {
                        echo '</div><div class="row">';
                    }
                    echo '<div class="col-md-4">';
                    echo $row['CompanyName'];
                    echo '</div>';
                    $count++;
                }

                echo '</div>';
                echo '</div>';
            } else {
                // If no records found
                echo 'No companies found';
            }
            ?>

            <form method="get" action="super_admin_home.php">

                <div class="row justify-content-start mt-5">
                    <div class="col-md-6 ml-auto fs-5 form-group">
                        <label class="fw-bold" for="exampleFormControlSelect1">Admins From</label>
                        <select class="form-control border-3" id="exampleFormControlSelect1" name="company">
                            <?php generateCompanyOptions(); ?>
                        </select>
                    </div>
                </div>

                <div class="text-center py-3">
                    <button name="submit" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold"
                    ">Filter</button>
                </div>
            </form>

            <div id="adminList" class="list-group">
                <?php filterAdminsBasedOnCompany($_GET['company'] ?? null); ?>
            </div>

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