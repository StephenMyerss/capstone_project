<?php

// Function to generate options dynamically for a dropdown
function generateCompanyOptions() {
    global $conn; // Access the database connection within the function

    $selectedCompany = isset($_GET['company']) ? $_GET['company'] : '';

    // Query to fetch all company names
    $fetchData = mysqli_query($conn, "SELECT CompanyName FROM Company");

    // Check if any records are returned
    if (mysqli_num_rows($fetchData) > 0) {
        // Loop through each row and fetch company names
        while ($row = mysqli_fetch_assoc($fetchData)) {
            // Check if the current company matches the selected company
            $isSelected = $row['CompanyName'] == $selectedCompany ? 'selected' : '';

            // Output each company name as an option
            echo '<option value="' . htmlspecialchars($row['CompanyName']) . '" ' . $isSelected . '>' . htmlspecialchars($row['CompanyName']) . '</option>';
        }
    } else {
        // If no records found
        echo '<option value="">No companies found</option>';
    }
}

function getCompanyIdFromName($companyName) {
    global $conn;

    $fetchID = mysqli_query($conn, "SELECT CompanyID FROM Company WHERE CompanyName = '$companyName'");

    if (mysqli_num_rows($fetchID) == 1) {
        // Company with the given name exists

        // Fetch the result as an associative array
        $row = mysqli_fetch_assoc($fetchID);
        // Get the CompanyID from the fetched row
        return $row['CompanyID'];
    } else {
        return null;
    }
}

function filterAdminsBasedOnCompany($companyName) {
    global $conn;

    $companyId = getCompanyIdFromName($companyName) ?? 1;

    $fetchAdmins = mysqli_query($conn, "SELECT AdminName, AdminEmail FROM Admin WHERE CompanyID = '$companyId'");

    if (mysqli_num_rows($fetchAdmins) > 0) {
        // Admins with the given company exist
        echo "<table>";
        echo "<tr><th>Name</th><th>Email</th><th>Password Reset</th></th></tr>";

        while ($row = mysqli_fetch_assoc($fetchAdmins)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["AdminName"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["AdminEmail"]) . "</td>";
            echo "<td><a href='../frontend/password_reset.php?adminEmail=" . urlencode($row["AdminEmail"]) . "'>Here</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No Admins found for " . $companyName . ".";
    }
}

function getAdminAndCompanyNameFromEmail($adminEmail) {
    global $conn;

    // Query to retrieve admin name and company name based on admin email
    $query = "SELECT AdminName, CompanyName 
              FROM Admin 
              INNER JOIN Company ON Admin.CompanyID = Company.CompanyID 
              WHERE AdminEmail = '$adminEmail'";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        // Admin with the given email exists
        $row = mysqli_fetch_assoc($result);
        // Return admin name and company name as an associative array
        return array('adminName' => $row['AdminName'], 'companyName' => $row['CompanyName']);
    } else {
        // Admin with the given email does not exist or multiple admins found (shouldn't happen)
        return null;
    }
}

?>
