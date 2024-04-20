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
        <link href="addPop.css" rel="stylesheet">
        <title>Super Admin</title>

    </head>
    <body class="d-flex flex-column min-vh-100">
    <div id="body-container">
        <div class="container header">
            <header class="d-flex flex-wrap justify-content-center py-3 border-bottom border-dark">
                <div class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <img class="innovation-logo" src="../innovationImages/smrt_logo_light.png" alt="">
                </div>
                <form method="post" action="" class="nav align-items-center">
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

                <h2 class="pt-5 display-5 fw-bold">Companies</h2>

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
                        echo "<td><a href='Company.php?company=" . urlencode($row['CompanyName']) . "' class='custom-link'>" . htmlspecialchars(
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

                    <div class="row justify-content-start pt-3">
                        <div class="col-md-6 d-flex justify-content-start">
                                <div style="display: flex; align-items: center;">
                                    <button id="addButton" class="button-color button-width fs-5 btn btn-primary fw-bold">Add Company</button>
                                </div>
                        </div>
                    </div>

                    <form id="deleteForm" method="post" action="../php_scripts/delete_company.php">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h3 class="pt-3 display-7 fw-bold">Select a Company to Delete</h3>
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


        <div class="container mt-auto">
            <footer class="py-3 my-4 border-top border-dark">
                <p class="text-center text-body-secondary">© 2024 Cameron University Capstone</p>
            </footer>
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

    <div id="addPopup" class="popup" style="display: none;">
        <form id="addForm" method="post" action="../php_scripts/company_submission.php">
            <div class="popup-add-content">
                <p>Add a new company?</p>
                <div class="input-container">
                    <label class="form-label fw-bold" for="companyName">Name</label>
                    <input name="company_name" type="text" class="form-control border-3" id="companyName" required>
                </div>
                <div class="input-container">
                    <label class="form-label fw-bold" for="companyUrl">Url</label>
                    <input name="company_url" type="text" class="form-control border-3" id="companyUrl" required>
                </div>
                <div class="buttons-container">
                    <button name="confirmAdd" id="confirmAdd">Add</button>
                    <button id="cancelAdd">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Function to show the confirmation popup and blur the background
        function showConfirmationPopup($elementID) {
            var confirmationPopup = document.getElementById($elementID);
            var body = document.getElementById('body-container');

            // Add blur class to the body
            body.classList.add('blur');
            confirmationPopup.style.display = 'block';
        }

        // Function to hide the confirmation popup and remove the blur from the background
        function hideConfirmationPopup($elementID) {
            var confirmationPopup = document.getElementById($elementID);
            var body = document.getElementById('body-container');

            // Remove blur class from the body
            body.classList.remove('blur');
            confirmationPopup.style.display = 'none';
        }

        // Add event listener to the delete button to show confirmation popup
        document.getElementById("deleteButton").addEventListener("click", function(event) {
            event.preventDefault();
            showConfirmationPopup("deletePopup");
        });

        // Add event listener to the confirm delete button in the popup
        document.getElementById("confirmDelete").addEventListener("click", function(event) {
            document.getElementById("deleteForm").submit();
        });

        // Add event listener to the cancel delete button
        document.getElementById("cancelDelete").addEventListener("click", function(event) {
            hideConfirmationPopup("deletePopup");
        });

        // Flag to track whether the mouse is down outside the delete popup
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
                hideConfirmationPopup("deletePopup");
            }
            // Reset the flag
            isMouseDownOutsidePopup = false;
        });

        // Flag to track whether the mouse is down outside the add popup
        var isMouseDownOutsideAddPopup = false;

        // Add mousedown event listener to track clicks outside the popup
        document.addEventListener("mousedown", function(event) {
            var addPopup = document.getElementById("addPopup");
            if (addPopup.style.display === "block" && !addPopup.contains(event.target)) {
                isMouseDownOutsideAddPopup = true;
            } else {
                isMouseDownOutsideAddPopup = false;
            }
        });

        // Add mouseup event listener to close the popup when clicking outside of it
        document.addEventListener("mouseup", function(event) {
            var addPopup = document.getElementById("addPopup");
            if (isMouseDownOutsideAddPopup && !addPopup.contains(event.target)) {
                hideConfirmationPopup("addPopup");
            }
            // Reset the flag
            isMouseDownOutsideAddPopup = false;
        });


        // for adding company

        // Add event listener to the add button to show confirmation popup
        document.getElementById("addButton").addEventListener("click", function(event) {
            event.preventDefault();
            showConfirmationPopup("addPopup");
        });

        // Add event listener to the confirm add button in the popup
        document.getElementById("confirmAdd").addEventListener("click", function(event) {
            event.preventDefault();

            // Get the input values
            var companyName = document.getElementById("companyName").value.trim();
            var companyUrl = document.getElementById("companyUrl").value.trim();

            // Check if both fields are filled
            if (companyName === "" || companyUrl === "") {
                alert("Please fill in both fields.");
                return; // Stop further execution
            }

            // Submit the form if both fields are filled
            document.getElementById("addForm").submit();
        });

        // Function to close the add company pop-up
        document.getElementById('cancelAdd').addEventListener('click', function() {
            event.preventDefault();
            hideConfirmationPopup("addPopup");
        });

    </script>

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