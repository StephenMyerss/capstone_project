<?php

$ideaId = $_GET['idea_id'] ?? null;
$sql = "SELECT Comment.CommentSubmission, Admin.AdminEmail FROM Comment JOIN Admin ON Comment.AdminID = Admin.AdminID WHERE IdeaID = ? ORDER BY Comment.commentID DESC";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    // Bind the idea ID parameter
    mysqli_stmt_bind_param($stmt, "i", $ideaId);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if comments exists
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Comment</th><th>Author</th></tr>";
        // Loop through all comments
        while ($row = mysqli_fetch_assoc($result)) {
            // Display each comment with author
            echo "<tr>";
            echo "<td style='text-align: center;'>" . htmlspecialchars($row["CommentSubmission"]) . "</td>";
            echo "<td style='text-align: center;'>" . htmlspecialchars($row["AdminEmail"]) . "</td>";
            echo "</tr>";
        }
    } else {
        // Comment not found
        echo "<p>Comment not found.</p>";
    }

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    // Error in preparing SQL statement
    echo "<p>Error in preparing SQL statement.</p>";
}

?>