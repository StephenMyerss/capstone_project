<?php

$ideaID = $_GET['idea_id'] ?? null;

    // Check if IdeaID is provided
    if ($ideaID) {

        // SQL query to retrieve actual idea based on IdeaID
        $sql = "SELECT IdeaSubmission FROM idea WHERE IdeaID = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind the IdeaID parameter
            mysqli_stmt_bind_param($stmt, "s", $ideaID);

            // Execute the query
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            // Check if idea exists
            if (mysqli_num_rows($result) == 1) {
                // Fetch and display idea details
                $row = mysqli_fetch_assoc($result);
                echo "<p class='list-group-item-text'>" . htmlspecialchars($row["IdeaSubmission"]) . "</p>";
            } else {
                // Idea not found
                echo "<p>Idea not found.</p>";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            // Error in preparing SQL statement
            echo "<p>Error in preparing SQL statement.</p>";
        }

    } else {
        // IdeaID not provided
        echo "<p>IdeaID not provided.</p>";
    }
    ?>
