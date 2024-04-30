<?php
include "create_database.php";

// SQL script to insert Company info
$insertCompanyData = "INSERT INTO Company (CompanyName, CompanyURL) VALUES 
    ('Google', 'www.google.com'),
    ('Microsoft', 'www.microsoft.com'),
    ('Apple', 'www.apple.com'),
    ('Amazon', 'www.amazon.com'),
    ('Facebook', 'www.facebook.com'),
    ('Netflix', 'www.netflix.com'),
    ('Twitter', 'www.twitter.com'),
    ('Tesla', 'www.tesla.com'),
    ('Adobe', 'www.adobe.com'),
    ('IBM', 'www.ibm.com')";

// Sql script for Dummy people info
$insertDummyPeople = "INSERT INTO innovator (InnovatorAnonymous, InnovatorFirstName, InnovatorLastName, InnovatorEmail , InnovatorJobTitle, CompanyID) VALUES
    (0,'John', 'Smith','john.smith@example.com','Marketing Coordinator',1),
    (0,'Emily', 'Johnson','emily.johnson@example.com','Software Engineer',2),
    (0,'Michael', 'Brown','michael.brown@example.com','Human Resources Manager',3),
    (0,'Sarah', 'Davis','sarah.davis@example.com','Graphic Designer',4),
    (0,'David', 'Wilson','david.wilson@example.com','Financial Analyst',5),
    (0,'Jessica', 'Martinez','jessica.martinez@example.com','Customer Service Representative',6),
    (0,'James', 'Anderson','james.anderson@example.com','Project Manager',7),
    (0,'Olivia', 'Taylor','olivia.taylor@example.com','Sales Associate',8),
    (0,'William', 'Clark','william.clark@example.com','Data Scientist',9),
    (0,'Sophia', 'White','sophia.white@example.com','Operations Manager',10),
    (1,'', '','','',1),
    (1,'', '','','',2),
    (1,'', '','','',3)";

$password = password_hash('admin', PASSWORD_DEFAULT);
$insertAdmins = "INSERT INTO admin(AdminName, AdminPassword, AdminEmail, CompanyID) Values
    ('admin1', '$password', 'admin1@admin.com', 1),
    ('admin2', '$password', 'admin2@admin.com', 2),
    ('admin3', '$password', 'admin3@admin.com', 3),
    ('admin4', '$password', 'admin4@admin.com', 4),
    ('admin5', '$password', 'admin5@admin.com', 5),
    ('admin6', '$password', 'admin6@admin.com', 6),
    ('admin7', '$password', 'admin7@admin.com', 7),
    ('admin8', '$password', 'admin8@admin.com', 8),
    ('admin9', '$password', 'admin9@admin.com', 9),
    ('admin10', '$password', 'admin10@admin.com', 10),
    ('admin11', '$password', 'admin11@admin.com', 1),
    ('admin12', '$password', 'admin12@admin.com', 2)";
    

// An array of random ideas to simulate different ideas
$dummyIdeas = array(
    'The old oak tree stood majestically in the center of the park.',
    'She danced gracefully under the moonlit sky, her movements like poetry in motion.',
    'The aroma of freshly baked bread filled the cozy kitchen.',
    'Lost in thought, he stared out of the window, watching the raindrops trickle down the glass pane.',
    'The laughter of children echoed through the bustling marketplace.',
    'With a flick of her wrist, she painted strokes of color across the canvas, creating a masterpiece.',
    'The sound of waves crashing against the shore was soothing to the weary traveler.',
    'He savored the first sip of hot coffee, feeling its warmth spread through his body.',
    'The twinkling stars illuminated the night sky, creating a breathtaking spectacle.',
    'With a gentle smile, she reached out and held his hand, silently reassuring him.'
);

// random comments
$comment1 = "Wow, amazing!";
$comment2 = "I totally agree with you.";
$comment3 = "This is really helpful.";

// Inserts the Companies and Employees
if (
    mysqli_query($conn, $insertCompanyData) &&
    mysqli_query($conn, $insertDummyPeople) &&
    mysqli_query($conn, $insertAdmins)
    )
    {
    echo "Company, Innovator and Admins inserted.";
} else {
    echo "Error inserting data: " . mysqli_error($conn);
}

// Define the range of years (e.g., last 10 years)
$startYear = strtotime("-10 year");
$endYear = strtotime("now");

$c = 0;
$k = 0;
// Simulates a person entering 15 different ideas for each of the 10 companies
for ($i = 0; $i < 13; $i++) {
    for ($j = 0; $j < 5; $j++) {

        // Generate a random timestamp within the defined range
        $randomTimestamp = mt_rand($startYear, $endYear);

        // Convert the timestamp to a MySQL-compatible datetime format
        $randomDate = date("Y-m-d H:i:s", $randomTimestamp);

        if ($c >= 10) {
            $c = 0;
        }

        $randomIdea = rand(0, 9);

        $insertDummyIdeas = "INSERT INTO idea (InnovatorID, IdeaSubmission, CompanyID, SubmissionDate) VALUES ($i + 1, '{$dummyIdeas[$randomIdea]}', $c + 1, '$randomDate')";
        if (mysqli_query($conn, $insertDummyIdeas)) {
            $k++;
            echo "Idea inserted.". $k;
        } else {
            echo "Idea insertion failed: " . mysqli_error($conn);
        }
    }
    $c++;
}

        $insertIntoCommentTable = "INSERT INTO Comment (IdeaID, AdminID, CommentSubmission)
        VALUES (1, 1, '{$comment1}')";

        $insertIntoCommentTable2 = "INSERT INTO Comment (IdeaID, AdminID, CommentSubmission)
        VALUES (1, 11, '{$comment2}')";

        $insertIntoCommentTable3 = "INSERT INTO Comment (IdeaID, AdminID, CommentSubmission)
        VALUES (55, 1, '{$comment3}')";

        if (mysqli_query($conn, $insertIntoCommentTable)  ) {
            echo "Comment 1 inserted.";
        } else {
            echo "Comment 1 insertion failed: " . mysqli_error($conn);
        }

        if (mysqli_query($conn, $insertIntoCommentTable2)  ) {
            echo "Comment 2 inserted.";
        } else {
            echo "Comment 2 insertion failed: " . mysqli_error($conn);
        }

        if (mysqli_query($conn, $insertIntoCommentTable3)  ) {
            echo "Comment 3 inserted.";
        } else {
            echo "Comment 3 insertion failed: " . mysqli_error($conn);
        }

// Close the connection to the 'innovationhub' database
mysqli_close($conn);
?>