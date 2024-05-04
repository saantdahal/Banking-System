<?php
session_start(); // Ensure session is started at the top

include 'header.php';
include 'staff_profile_header.php';
include 'db_connect.php';

// Handle form submission to search for an application
if(isset($_POST['search_application'])) {
    // Check if application number is empty
    if(empty($_POST['application_no'])) {
        echo '<script>alert("Please enter application number")</script>';
    } else {
        // Set application number to session variable
        $_SESSION['application_no'] = $_POST['application_no'];
    }
}

// Handle form submission to approve a customer
if(isset($_POST['approve_cust'])) {
    // Check if application number is set in session
    if(isset($_SESSION['application_no'])) {
        // Proceed with approval process
        include 'account_approve_process.php';
    } else {
        // Display message to search for an application first
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
        <input type="submit" name="search_application" value="Approve">
    </form>
</div>

<div class="pending_customers_container">
    <form method="post">
        <table border="1px" cellpadding="10">
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
                // Retrieve all pending accounts
                $sql = "SELECT * FROM pending_accounts";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $Sl_no = 1;
                    // Output data of each row
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
        <div class="approve">
            <!-- Display approve button only if an application is searched -->
            <?php if(isset($_SESSION['application_no'])): ?>
                <input type="submit" name="approve_cust" value="Approve">
            <?php endif; ?>
        </div>
    </form>
</div>

<?php
include 'footer.php';
?>
</body>
</html>
