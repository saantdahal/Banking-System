<?php
session_start(); // Ensure session is started at the top

include 'header.php';
include 'staff_profile_header.php';
include 'db_connect.php';

// Handle form submission to search for an application
if (isset($_POST['search_application'])) {
    // Check if application number is empty
    if (empty($_POST['application_no'])) {
        echo '<script>alert("Please enter application number")</script>';
    } else {
        // Set application number to session variable
        $_SESSION['application_no'] = $_POST['application_no'];
    }
}

// Handle form submission to approve a customer
if (isset($_POST['approve_cust'])) {
    if (isset($_SESSION['application_no'])) {
        include 'account_approve_process.php';
    } else {
        echo '<script>alert("Please search for an application first.")</script>';
    }
}

// Handle form submission to delete a pending account
if (isset($_POST['delete_application'])) {
    if (isset($_SESSION['application_no'])) {
        $application_no = $_SESSION['application_no'];
        $sql = "DELETE FROM pending_accounts WHERE Application_no = '$application_no'";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Application deleted successfully.")</script>';
            unset($_SESSION['application_no']);
        } else {
            echo '<script>alert("Error deleting application: ' . $conn->error . '")</script>';
        }
    } else {
        echo '<script>alert("Please search for an application first.")</script>';
    }
}

?>

<html>
<head>
    <title>Pending Customers</title>
    <link rel="stylesheet" type="text/css" href="css/pending_customers.css"/>
</head>
<body>

<div class="application_search">
    <form method="post">
        <input type="text" name="application_no" placeholder="Enter Application number" required>
        <input type="submit" name="search_application" value="Search">
    </form>
</div>

<?php
if (isset($_SESSION['application_no'])) {
    $application_no = $_SESSION['application_no'];
    $sql = "SELECT * FROM pending_accounts WHERE Application_no = '$application_no'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '
        <div class="application_details">
            <h3>Application Details</h3>
            <table>
                <tr><th>Application No</th><td>' . $row['Application_no'] . '</td></tr>
                <tr><th>Name</th><td>' . $row['Name'] . '</td></tr>
                <tr><th>Gender</th><td>' . $row['Gender'] . '</td></tr>
                <tr><th>Mobile</th><td>' . $row['Mobile_no'] . '</td></tr>
                <tr><th>Email</th><td>' . $row['Email_id'] . '</td></tr>
                <tr><th>Landline</th><td>' . $row['Landline_no'] . '</td></tr>
                <tr><th>DOB</th><td>' . $row['DOB'] . '</td></tr>
                <tr><th>PAN</th><td>' . $row['PAN'] . '</td></tr>
                <tr><th>Citizenship</th><td>' . $row['CITIZENSHIP'] . '</td></tr>
                <tr><th>Home Address</th><td>' . $row['Home_Addr'] . '</td></tr>
                <tr><th>Office Address</th><td>' . $row['Office_Addr'] . '</td></tr>
                <tr><th>Country</th><td>' . $row['Country'] . '</td></tr>
                <tr><th>State</th><td>' . $row['State'] . '</td></tr>
                <tr><th>City</th><td>' . $row['City'] . '</td></tr>
                <tr><th>Pin</th><td>' . $row['Pin'] . '</td></tr>
                <tr><th>Area Loc</th><td>' . $row['Area_Loc'] . '</td></tr>
                <tr><th>Nominee Name</th><td>' . $row['Nominee_name'] . '</td></tr>
                <tr><th>Nominee A/c No</th><td>' . $row['Nominee_ac_no'] . '</td></tr>
                <tr><th>Account Type</th><td>' . $row['Account_type'] . '</td></tr>
                <tr><th>Application Date</th><td>' . $row['Application_Date'] . '</td></tr>
            </table>
            <div class="actions">
                <form method="post">
                    <input type="submit" name="approve_cust" value="Approve">
                    <input type="submit" name="delete_application" value="Delete">
                </form>
            </div>
        </div>';
    } else {
        echo '<p>No details found for the entered application number.</p>';
    }
}
?>

<div class="pending_customers_container">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Application No.</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Landline</th>
                <th>DOB</th>
                <th>PAN</th>
                <th>Citizenship</th>
                <th>Home Address</th>
                <th>Office Address</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Pin</th>
                <th>Area Loc.</th>
                <th>Nominee Name</th>
                <th>Nominee A/c no</th>
                <th>Account Type</th>
                <th>Application Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM pending_accounts";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $Sl_no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '
                        <tr>
                            <td>' . $Sl_no++ . '</td>
                            <td>' . $row['Application_no'] . '</td>
                            <td>' . $row['Name'] . '</td>
                            <td>' . $row['Gender'] . '</td>
                            <td>' . $row['Mobile_no'] . '</td>
                            <td>' . $row['Email_id'] . '</td>
                            <td>' . $row['Landline_no'] . '</td>
                            <td>' . $row['DOB'] . '</td>
                            <td>' . $row['PAN'] . '</td>
                            <td>' . $row['CITIZENSHIP'] . '</td>
                            <td>' . $row['Home_Addr'] . '</td>
                            <td>' . $row['Office_Addr'] . '</td>
                            <td>' . $row['Country'] . '</td>
                            <td>' . $row['State'] . '</td>
                            <td>' . $row['City'] . '</td>
                            <td>' . $row['Pin'] . '</td>
                            <td>' . $row['Area_Loc'] . '</td>
                            <td>' . $row['Nominee_name'] . '</td>
                            <td>' . $row['Nominee_ac_no'] . '</td>
                            <td>' . $row['Account_type'] . '</td>
                            <td>' . $row['Application_Date'] . '</td>
                        </tr>';
                }
            } else {
                echo '<tr><td colspan="21">No pending accounts found</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include 'footer.php';
?>
</body>
</html>
