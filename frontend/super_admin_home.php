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
        <link href="stylePop.css" rel="stylesheet">
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
                    echo "<td><a href='Company.php?company=" . urlencode($row['CompanyName']) . "'>" . htmlspecialchars(
                            $row['CompanyName']
                        ) . "</a></td>";
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

            <div class="container">
                <div class="row justify-content-start mt-5">
                    <div class="col-md-6 d-flex justify-content-start">
                        <a href="add_company.php" class="color nav-link fs-5" draggable="true">Add Company</a>
                    </div>
                </div>

                <form id="deleteForm" method="post" action="../php_scripts/delete_company.php">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label" for="exampleFormControlSelect1">Select a Company to Delete</label>
                            <div style="display: flex; align-items: center;">
                                <select class="form-control border-3" id="exampleFormControlSelect1" name="deleteCompany" style="margin-right: 10px;">
                                    <?php generateCompanyOptions(); ?>
                                </select>
                                <button id="deleteButton" class="delete-button-color button-width fs-5 btn btn-primary fw-bold">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div id="deletePopup" class="popup" style="display: none;">
        <div class="popup-content">
            <p>Delete this company?</p>
            <span>All the ideas, innovators, admins, and their comments for this company will also be <span style="color: #da0d25;">deleted!</span></span><br>
            <div class="buttons-container">
                <button id="confirmDelete">Delete</button>
                <button id="cancelDelete">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        // Function to show the confirmation popup
        function showConfirmationPopup() {
            document.getElementById("deletePopup").style.display = "block";
        }

        // Function to hide the confirmation popup
        function hideConfirmationPopup() {
            document.getElementById("deletePopup").style.display = "none";
        }

        // Add event listener to the delete button to show confirmation popup
        document.getElementById("deleteButton").addEventListener("click", function(event) {
            event.preventDefault();
            showConfirmationPopup();
        });

        // Add event listener to the confirm delete button in the popup
        document.getElementById("confirmDelete").addEventListener("click", function(event) {
            document.getElementById("deleteForm").submit();
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

    <div class="container mt-auto">
        <footer class="py-3 my-4 border-top border-dark">
            <p class="text-center text-body-secondary">© 2024 Cameron University Capstone</p>
        </footer>
    </div>

    </body>
    </html>

<?php
include("../php_scripts/delete_company.php"); // Include the delete company file
?>

<?php
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: ../super_admin.php");
    exit();
}
ob_end_flush();
?>