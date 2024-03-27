<?php
session_start();

include("../database/connect.php");

if (isset($_POST["commentSubmit"])) {

    // Get values from the form
    $commentSubmission = $_POST["comment_text"];
    $ideaID = $_GET["idea_id"];
    $adminID = $_POST["admin_id"];

    if (!empty($commentSubmission)) {
        insertIntoComment($ideaID, $adminID, $commentSubmission, $conn);
//        $commentID = mysqli_insert_id($conn); // Get the ID of the last inserted record

    } else {
        $_SESSION['error_message'] = "No comment to record!";
        header("Location: ../frontend/comment.php?idea_id=" . urlencode($ideaID));
        exit();
    }
}

function insertIntoComment($ideaID, $adminID, $commentSubmission, $conn)
{
    $insertIntoCommentTable = "INSERT INTO Comment (IdeaID, AdminID, CommentSubmission)
        VALUES ('$ideaID', '$adminID', '$commentSubmission')";

    try {
        mysqli_query($conn, $insertIntoCommentTable);
        $_SESSION['success_message'] = "Comment submitted successfully!";
        header("Location: ../frontend/comment.php?idea_id=" . urlencode($ideaID));
        exit();
    } catch (mysqli_sql_exception $e) {
        echo '<script>alert("Error submitting Comment: ' . $e->getMessage() . '");</script>';
    }
}
?>
