<?php
    include("../database/connect.php");
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <title>Login</title>
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
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-dark">
            <a href="../index.php"
               class="d-flex align-items-center mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img class="innovation-logo" src="../innovationImages/smrt_logo_light.png" alt="">
            </a>
            <ul class="nav align-items-center">
                <li class="nav-item fs-5"><a href="../index.php" class="color nav-link" draggable="true">Back to
                        home</a></li>
            </ul>
        </header>
    </div>
    <div class="container fs-5">
        <div class="login-container">
            <h2 class="mb-4">Admin Login</h2>
            <form id="loginForm" action="<?php
            echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control border-3" id="username" name="username" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control border-3" id="password" name="password" required>
                </div>
                <div class="form-group form-check mb-3">
                    <input type="checkbox" class="form-check-input border-4" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <div class="text-center mb-3">
                    <button name="login" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold">
                        Login
                    </button>
                </div>
                <div class="text-center">
                    <button name="signup" type="submit" class="button-color button-width fs-5 btn btn-primary fw-bold">
                        Sign Up
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="container mt-auto">
        <footer class="py-3 my-4 border-top border-dark ">
            <p class="text-center text-body-secondary">© 2024 Cameron University Capstone</p>
        </footer>
    </div>
    </body>
    </html>


<?php
if (isset($_POST["signup"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username) || empty($password)) {
        echo "Please enter both username and password";
    } else {
        // Check if the username already exists
        $checkUsernameQuery = "SELECT * FROM Admin WHERE AdminEmail = '$username'";
        $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);

        if (mysqli_num_rows($checkUsernameResult) > 0) {
            echo "Username already exists. Please choose a different username.";
        } else {
            // If the username doesn't exist, proceed with registration
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO Admin (AdminEmail, AdminPassword) VALUES ('$username', '$hash')";

            try {
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $_SESSION["admin_username"] = $_POST["username"] ;;
                    header("Location: admin.php");
                } else {
                    echo "Registration failed. Please try again.";
                }
            } catch (mysqli_sql_exception $e) {
                echo "Registration failed. Please try again later." . "<br>" . $e->getMessage();
            }
        }
    }
}
?>


<?php
if (isset($_POST["login"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username) || empty($password)) {
        echo "Please enter both username and password";
    } else {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM Admin WHERE AdminEmail = ? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        // $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($row = mysqli_fetch_assoc($result)) {
            // Verify the password using password_verify()
            if (password_verify($password, $row['AdminPassword'])) {
                $_SESSION["admin_username"] = $_POST["username"];
                header("Location: admin.php");
            } else {
                echo "Invalid password" . "<br>" . "<br>";
                // rest is all for test
                echo "Stored Hash: " . $row['AdminPassword'] . "<br>";
                echo "User Input: " . $password . "<br>";
                echo "Generated Hash: " . password_hash($password, PASSWORD_DEFAULT) . "<br>";
            }
        } else {
            echo "Invalid username";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>