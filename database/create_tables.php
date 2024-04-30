<?php
include "create_database.php";

// SQL script to create the Company table
$sqlCompany = "
CREATE TABLE IF NOT EXISTS Company
(
  CompanyName VARCHAR(30) NOT NULL,
  CompanyID INT NOT NULL AUTO_INCREMENT,
  CompanyURL VARCHAR(50) NOT NULL,
  PRIMARY KEY (CompanyID)
);
";

// SQL script to create the Innovator table
$sqlInnovator = "
CREATE TABLE IF NOT EXISTS Innovator
(
  InnovatorID INT NOT NULL AUTO_INCREMENT,
  InnovatorAnonymous BOOLEAN,
  InnovatorFirstName VARCHAR(50),
  InnovatorLastName VARCHAR(50),
  InnovatorEmail VARCHAR(50),
  InnovatorJobTitle VARCHAR(50),
  CompanyID INT,
  PRIMARY KEY (InnovatorID),
  FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID)
);
";

// SQL script to create the Admin table
$sqlAdmin = "
CREATE TABLE IF NOT EXISTS Admin
(
  AdminID INT NOT NULL AUTO_INCREMENT,
  AdminName VARCHAR(50) NOT NULL,
  AdminPassword VARCHAR(255) NOT NULL,
  AdminEmail VARCHAR(50) NOT NULL,
  CompanyID INT NOT NULL,
  PRIMARY KEY (AdminID),
  FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID)
);
";

// SQL script to create the Idea table
$sqlIdea = "
CREATE TABLE IF NOT EXISTS Idea
(
  IdeaID INT NOT NULL AUTO_INCREMENT,
  InnovatorID INT,
  IdeaSubmission VARCHAR(5000) NOT NULL,
  CompanyID INT NOT NULL,
  SubmissionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (IdeaID),
  FOREIGN KEY (InnovatorID) REFERENCES Innovator(InnovatorID)
);
";

$sqlComment = "
CREATE TABLE IF NOT EXISTS Comment
(
  CommentID INT NOT NULL AUTO_INCREMENT,
  CommentSubmission VARCHAR(400) NOT NULL,
  IdeaID INT NOT NULL,
  AdminID INT NOT NULL,
  PRIMARY KEY (CommentID),
  FOREIGN KEY (IdeaID) REFERENCES Idea(IdeaID),
  FOREIGN KEY (AdminID) REFERENCES Admin(AdminID)
);
";

// Execute the SQL script
if (
    mysqli_query($conn, $sqlCompany) &&
    mysqli_query($conn, $sqlInnovator) &&
    mysqli_query($conn, $sqlIH_Support) &&
    mysqli_query($conn, $sqlAdmin) &&
    mysqli_query($conn, $sqlIdea) &&
    mysqli_query($conn, $sqlComment)) {
    echo "Tables created successfully or already exist";
} else {
    echo "Error creating tables: " . mysqli_error($conn);
}

// Close the connection to the 'innovationhub' database
mysqli_close($conn);
?>