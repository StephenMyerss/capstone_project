<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innovation Hub</title>
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
            <li class="nav-item fs-5">
                <a href="#" onclick="goBack()" class="color nav-link" draggable="true">Back</a>
            </li>
        </ul>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </header>
</div>

<div class="container">
    <div class="px-4 my-5 text-center">
        <img class="custom-rounded img-fluid d-block mx-auto mb-4" src="../innovationImages/smrt_logo_dark.png" alt="" width="250" height="250" style="opacity: 0.8;">
    </div>
</div>

<?php
// Display error message if exists
if (isset($_SESSION['error_message'])) {
    echo '<div id="errorMessage" class="error-message" style="text-align: center; color: #da0d25; font-weight: bold; font-size: 25px; text-decoration: underline;">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']); // Clear the message after displaying it
} else {
    echo '<div id="errorMessage" class="error-message" style="text-align: center; color: #da0d25; font-weight: bold; font-size: 25px; text-decoration: underline;">' . "Error Messages" . '</div>';
}
?>

<div class="container mt-auto">
    <footer class="py-3 my-4 border-top border-dark">
        <p class="text-center text-body-secondary">© 2024 Cameron University Capstone</p>
    </footer>
</div>
</body>
</html>
