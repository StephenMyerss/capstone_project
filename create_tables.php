<?php
include "database.php";

// SQL script to create the Innovator table
$sqlInnovator = "
CREATE TABLE IF NOT EXISTS Innovator
(
  InnovatorID INT NOT NULL AUTO_INCREMENT,
  InnovatorEmail VARCHAR(30) NOT NULL,
  InnovatorName VARCHAR(30) NOT NULL,
  PRIMARY KEY (InnovatorID)
);
";

// SQL script to create the IH_Support table
$sqlIH_Support = "
CREATE TABLE IF NOT EXISTS IH_Support
(
  IHSID INT NOT NULL AUTO_INCREMENT,
  IHSName VARCHAR(30) NOT NULL,
  IHSEmail VARCHAR(30) NOT NULL,
  IHSPassword VARCHAR(30) NOT NULL,
  PRIMARY KEY (IHSID)
);
";

// SQL script to create the Company table
$sqlCompany = "
CREATE TABLE IF NOT EXISTS Company
(
  CompanyName VARCHAR(30) NOT NULL,
  CompanyID INT NOT NULL AUTO_INCREMENT,
  CompanyURL VARCHAR(30) NOT NULL,
  PRIMARY KEY (CompanyID)
);
";

// SQL script to create the Admin table
$sqlAdmin = "
CREATE TABLE IF NOT EXISTS Admin
(
  AdminID INT NOT NULL AUTO_INCREMENT,
  AdminName VARCHAR(30) NOT NULL,
  AdminPassword VARCHAR(30) NOT NULL,
  AdminEmail VARCHAR(30) NOT NULL,
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
  IdeaSubmission VARCHAR(400) NOT NULL,
  InnovatorID INT NOT NULL,
  CompanyID INT NOT NULL,
  PRIMARY KEY (IdeaID),
  FOREIGN KEY (InnovatorID) REFERENCES Innovator(InnovatorID),
  FOREIGN KEY (CompanyID) REFERENCES Company(CompanyID)
);
";

// Execute the SQL script
if (mysqli_query($conn, $sqlInnovator) &&
    mysqli_query($conn, $sqlIH_Support) &&
    mysqli_query($conn, $sqlCompany) &&
    mysqli_query($conn, $sqlAdmin) &&
    mysqli_query($conn, $sqlIdea)) {
    echo "Tables created successfully or already exist";
} else {
    echo "Error creating tables: " . mysqli_error($conn);
}

// Close the connection to the 'innovationhub' database
mysqli_close($conn);
?>
