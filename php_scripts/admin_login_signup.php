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
            $companyID = rand(1, 10);
            $sql = "INSERT INTO Admin (AdminName, AdminEmail, AdminPassword, CompanyID) VALUES ('admin', '$username', '$hash', $companyID)";

            try {
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $_SESSION["admin_username"] = $_POST["username"] ;
                    $_SESSION["admin_company_id"] = $companyID;
                    $_SESSION["admin_id"] = mysqli_insert_id($conn);
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
                $_SESSION["admin_id"] = $row["AdminID"];
                $_SESSION["admin_company_id"] = $row["CompanyID"];
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
