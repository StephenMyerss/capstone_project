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
