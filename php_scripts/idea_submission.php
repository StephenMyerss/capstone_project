<?php

if (isset($_POST["submit"])) {
    // Check if the "Anonymous Post" checkbox is checked
    $anonymous = isset($_POST["anonymous"]) ? 1 : 0;

    // Get values from the form
    $first_name = $anonymous ? "" : $_POST["first_name"];
    $last_name = $anonymous ? "" : $_POST["last_name"];
    $job_title = $anonymous ? "" : $_POST["job_title"];
    $email = $anonymous ? "" : $_POST["email"];
    $company = $_POST["company"];
    $idea_text = $_POST["idea_text"];

    if (($anonymous && !empty($idea_text))) {
        insertIntoInnovator(
            $anonymous,
            $first_name,
            $last_name,
            $email,
            $job_title,
            $company,
            $conn
        );

        $innovatorID = mysqli_insert_id($conn); // Get the ID of the last inserted record

        insertIntoIdea($innovatorID, $company, $idea_text, $conn);
    } else {
        if (!$anonymous && !empty($first_name) && !empty($last_name) && !empty($job_title) && !empty($idea_text)) {
            $checkUserEmailQuery = "SELECT InnovatorID FROM Innovator WHERE InnovatorEmail = '$email'";
            $checkUserEmailResult = mysqli_query($conn, $checkUserEmailQuery);

            if (mysqli_num_rows($checkUserEmailResult) < 1) {
                // User with the given email does not exist

                insertIntoInnovator(
                    $anonymous,
                    $first_name,
                    $last_name,
                    $email,
                    $job_title,
                    $company,
                    $conn
                );
                $innovatorID = mysqli_insert_id($conn); // Get the ID of the last inserted record
            } else {
                // Retrieve the InnovatorID
                $row = mysqli_fetch_assoc($checkUserEmailResult);
                $innovatorID = $row['InnovatorID'];
            }
            insertIntoIdea($innovatorID, $company, $idea_text, $conn);
        } else {
            echo '<script>alert("Please fill in all required fields.");</script>';
        }
    }
}

function insertIntoInnovator($anonymous, $first_name, $last_name, $email, $job_title, $company, $conn)
{
    $insertIntoInnovator = "INSERT INTO Innovator (InnovatorAnonymous, InnovatorFirstName, InnovatorLastName, InnovatorEmail, InnovatorJobTitle, CompanyID)
        VALUES ('$anonymous', '$first_name', '$last_name', '$email', '$job_title', '$company')";

    try {
        mysqli_query($conn, $insertIntoInnovator);
        echo '<script>alert("Innovator submitted successfully!");</script>';
        // Redirect or perform additional actions as needed
    } catch (mysqli_sql_exception $e) {
        echo '<script>alert("Error submitting idea: ' . $e->getMessage() . '");</script>';
    }
}

function insertIntoIdea($innovatorID, $company, $idea_text, $conn)
{
    $insertIntoIdea = "INSERT INTO Idea (InnovatorID, CompanyID, IdeaSubmission )
        VALUES ('$innovatorID', '$company', '$idea_text')";

    try {
        mysqli_query($conn, $insertIntoIdea);
        echo '<script>alert("Idea submitted successfully!");</script>';
        // Redirect or perform additional actions as needed
    } catch (mysqli_sql_exception $e) {
        echo '<script>alert("Error submitting idea: ' . $e->getMessage() . '");</script>';
    }
}

?>
