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

if (mysqli_query($conn, $insertCompanyData)) {
    echo "Company data inserted.";
} else {
    echo "Error inserting company data: " . mysqli_error($conn);
}

// Close the connection to the 'innovationhub' database
mysqli_close($conn);
?>