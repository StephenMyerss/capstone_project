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

    <div class="container header">
        <header class="d-flex flex-wrap justify-content-center py-3 border-bottom border-dark">
            <div class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img class="innovation-logo" src="../innovationImages/smrt_logo_light.png" alt="">
            </div>
            <form method="post" action="">
                <ul class="nav align-items-center">
                    <li class="nav-item fs-5"><a href="admin.php" class="color nav-link" draggable="true">Back to Admin home</a>
                    </li>
                </ul>
            </form>
    </header>
</div>

    <div class="container fs-4 ">
        <div class="text-center justify-content-center border-dark">
            <h1 class="display-4 fw-bold text-body-emphasis">Admin: <?php echo $_SESSION["admin_username"] ?></h1>
<!--            <h1 class="display-4 fw-bold text-body-emphasis">Admin ID: --><?php //echo $_SESSION["admin_id"] ?><!--</h1>-->
<!--            <h1 class="display-4 fw-bold text-body-emphasis">Idea ID: --><?php //echo $_GET['idea_id'] ?><!--</h1>-->
        </div>
        <h2 class="text-center justify-content-center mb-4 display-5 fw-bold">Idea</h2>

        <?php
        // Display success message if exists
        if (isset($_SESSION['success_message'])) {
            echo '<div id="successMessage" class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']); // Clear the message after displaying it
        }

        // Display error message if exists
        if (isset($_SESSION['error_message'])) {
            echo '<div id="errorMessage" class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); // Clear the message after displaying it
        }
        ?>

        <div id="idea">
            <!-- Idea will be dynamically populated here -->
            <?php
            include("../php_scripts/get_idea.php");
            ?>
        </div>
    </div>

    <div class="comment-section">
        <h2>Comment</h2>

        <!-- Comments will be dynamically populated here -->
        <?php
        include("../php_scripts/get_comments.php");
        ?>

        <form id="comment-form" action="../php_scripts/comment_submission.php?idea_id=<?php echo htmlspecialchars($_GET['idea_id']); ?>" method="post">

<!--            passing values that will be needed for saving comment as hidden fields-->

            <input type="hidden" name="admin_username" value="<?php echo htmlspecialchars($_SESSION["admin_username"]); ?>">
            <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($_SESSION["admin_id"]); ?>">
<!--            <input type="hidden" name="idea_id" value="--><?php //echo htmlspecialchars($_GET['idea_id']); ?><!--">-->
            <textarea name="comment_text" id="comment_text" rows="6" cols="100" style="margin: 0 auto;" placeholder="Write your comment here..."></textarea>
            <button name="commentSubmit" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold">Post Comment
            </button>
        </form>
    </div>

<div class="container mt-auto">
    <footer class="py-3 my-4 border-top border-dark">
        <p class="text-center text-body-secondary">© 2024 Cameron University Capstone</p>
    </footer>
</div>

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

    </body>
    </html>

<?php
ob_end_flush();
?>