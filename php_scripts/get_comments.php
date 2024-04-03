<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <style>
        /* CSS code goes here */
        .comment-section {
            margin-top: 20px;
        }

        .comment {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 10px;
        }

        .comment-text {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .comment-author {
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
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

        // Check if comments exist
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='comment-section'>";
            // Loop through all comments
            while ($row = mysqli_fetch_assoc($result)) {
                // Display each comment with author
                echo "<div class='comment'>";
                echo "<p class='comment-text'>" . htmlspecialchars($row["CommentSubmission"]) . "</p>";
                echo "<p class='comment-author'>- " . htmlspecialchars($row["AdminEmail"]) . "</p>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            // Comment not found
            echo "<p class='error-message'>No comments found.</p>";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        // Error in preparing SQL statement
        echo "<p class='error-message'>Error in preparing SQL statement.</p>";
    }
    ?>
</body>
</html>
