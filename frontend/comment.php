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
    <!-- Header Section -->
    <div class="container header">
        <header class="d-flex flex-wrap justify-content-center py-3 border-bottom border-dark">
            <div class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img class="innovation-logo" src="../innovationImages/smrt_logo_light.png" alt="">
            </div>
            <form method="post" action="">
                <ul class="nav align-items-center">
                    <li class="nav-item fs-5"><a href="admin.php" class="button-color button-width-admin btn btn-primary fs-5 fw-bold" draggable="true">Back to Admin home</a></li>
                </ul>
            </form>
        </header>
    </div>

    <!-- Main Content Section -->
    <div class="container fs-4">
        <div class="text-center justify-content-center border-dark">
            <h1 class="display-4 fw-bold text-body-emphasis">Admin: <?php echo $_SESSION["admin_username"] ?></h1>
        </div>
        <h2 class="text-center justify-content-center mb-4 display-5 fw-bold">Idea</h2>

        <!-- Display success and error messages -->
        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<div id="successMessage" class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']); // Clear the message after displaying it
        }

        if (isset($_SESSION['error_message'])) {
            echo '<div id="errorMessage" class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); // Clear the message after displaying it
        }
        ?>

        <!-- Idea Section -->
        <div id="idea">
            <?php include("../php_scripts/get_idea.php"); ?>
        </div>
    </div>

   
    <!-- Comment Section -->
    <div class="comment-section container mt-5">
        <h2 class="mb-4">Admin Comments</h2>

        <!-- Display existing comments -->
        <?php include("../php_scripts/get_comments.php"); ?>

        <!-- Comment Form -->
        <br>
        <form id="comment-form" action="../php_scripts/comment_submission.php?idea_id=<?php echo htmlspecialchars($_GET['idea_id']); ?>" method="post">
            <!-- Hidden fields for admin details -->
            <input type="hidden" name="admin_username" value="<?php echo htmlspecialchars($_SESSION["admin_username"]); ?>">
            <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($_SESSION["admin_id"]); ?>">
            <!-- Comment text area -->
            <textarea name="comment_text" id="comment_text" rows="6" class="form-control mb-3" placeholder="Write your comment here..."></textarea>
            <!-- Submit button -->
            <button name="commentSubmit" type="submit" class="btn btn-primary fw-bold">Post Comment</button>
        </form>
    </div>

   

    <!-- JavaScript to hide messages after 1 second -->
    <script>
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
 
 <!-- Footer Section -->
 <div class="container mt-auto">
        <footer class="py-3 my-4 border-top border-dark">
            <p class="text-center text-body-secondary">© 2024 Cameron University Capstone</p>
        </footer>
</div>

</body>
</html>

<?php
ob_end_flush();
?>
