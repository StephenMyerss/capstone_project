<?php
include("../database/connect.php");

$sql = "SELECT * FROM idea";
$result = $conn->query($sql);

// Open a file for writing
$file = fopen("output.html", "w");

// Write HTML content to the file
fwrite($file, "<table>");

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Write row data to the file
        fwrite($file, "<tr>");
        fwrite($file, "<td>" . htmlspecialchars($row["InnovatorFirstName"]) . "</td>");
        fwrite($file, "<td>" . htmlspecialchars($row["InnovatorLastName"]) . "</td>");
        // making idea_id url only for admins but static for superadmins
        fwrite($file, isset($_SESSION["company_id"]) ?
            "<td>" . htmlspecialchars($row["IdeaID"]) . "</td>" :
            "<td><a href='../frontend/comment.php?idea_id=" . urlencode($row["IdeaID"]) . "'>" . htmlspecialchars($row["IdeaID"]) . "</a></td>");
        fwrite($file, "<td>" . htmlspecialchars($row["SubmissionDate"]) . "</td>");
        fwrite($file, "<td>" . htmlspecialchars($row["IdeaSubmission"]) . "</td>");
        fwrite($file, "</tr>");
    }
}

// Close the table and file
fwrite($file, "</table>");
fclose($file);


?>
