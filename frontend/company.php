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
        </header>
    </div>

    <div class="container">
        <div class="container fs-4 ">

            <h2 class="mb-4 display-5 fw-bold">Companies</h2>

            <h2 class="py-3 mb-4 display-5 fw-bold">Admins From</h2>
            <div class="container">
                <form method="get" action="super_admin_home.php">

                    <div class="row justify-content-center mb-5">
                        <div class="col-md-6 fs-5">
                            <!-- <label class="fw-bold" for="exampleFormControlSelect1">Admins From</label> -->

                            <select class="form-control border-3" id="exampleFormControlSelect1" name="company">
                                <?php generateCompanyOptions(); ?>
                            </select>
                        </div>
                        <div class="col-md-6 fs-5">
                            <button name="submit" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold">
                                Filter</button>
                        </div>
                    </div>


                </form>
            </div>

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

?>
