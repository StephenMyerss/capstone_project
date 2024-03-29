<?php

include("../database/connect.php");

$admin_company_id = $_GET["admin_company_id"] ?? $_SESSION["admin_company_id"];

// Check if the filter dates are set
$startDate = $_GET['startDate'] ?? null;
$endDate = $_GET['endDate'] ?? null;
$status = $_GET['status'] ?? null;

// Using prepared statements to prevent SQL injection
$sql = "SELECT innovator.InnovatorFirstName, innovator.InnovatorLastName, idea.IdeaID, idea.IdeaSubmission, idea.SubmissionDate 
        FROM innovator 
        JOIN idea ON innovator.InnovatorID = idea.InnovatorID 
        WHERE innovator.CompanyID = ?";

// Append the date filter conditions if they are set
if (!empty($startDate) && !empty($endDate)) {
    $sql .= " AND DATE(idea.SubmissionDate) BETWEEN ? AND ?";
} elseif (!empty($startDate)) {
    $sql .= " AND DATE(idea.SubmissionDate) >= ?";
} elseif (!empty($endDate)) {
    $sql .= " AND DATE(idea.SubmissionDate) <= ?";
}

// Append the anonymous filter conditions
if ($status === 'All') {
    $sql .= " AND innovator.InnovatorAnonymous IN (0, 1)";
} elseif ($status === 'Anonymous') {
    $sql .= " AND innovator.InnovatorAnonymous = 1";
} elseif ($status === 'Acknowledged') {
    $sql .= " AND innovator.InnovatorAnonymous = 0";
}

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {

    // Bind the date parameters if they are set
    if (!empty($startDate) && !empty($endDate)) {
        mysqli_stmt_bind_param($stmt, "sss", $admin_company_id, $startDate, $endDate);
    } elseif (!empty($startDate) && empty($endDate)) {
        mysqli_stmt_bind_param($stmt, "ss", $admin_company_id, $startDate);
    } elseif (empty($startDate) && !empty($endDate)) {
        mysqli_stmt_bind_param($stmt, "ss", $admin_company_id, $endDate);
    } else
        mysqli_stmt_bind_param($stmt, "s", $admin_company_id);


    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>First Name</th><th>Last Name</th><th>IdeaID</th><th>Submission Date</th><th>Idea</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["InnovatorFirstName"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["InnovatorLastName"]) . "</td>";
            echo "<td><a href='../frontend/comment.php?idea_id=" . urlencode($row["IdeaID"]) . "'>" . htmlspecialchars($row["IdeaID"]) . "</a></td>";
            echo "<td>" . htmlspecialchars($row["SubmissionDate"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["IdeaSubmission"]) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error in preparing the SQL statement";
}

mysqli_close($conn);

?>