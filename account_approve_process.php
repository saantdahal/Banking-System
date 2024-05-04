<?php
// Check if a session is not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session
}


// Check if the form is submitted
if(isset($_POST['approve_cust'])){
    // Include necessary files and initialize session
    include 'db_connect.php';

    // Check if the session variable is set
    if(isset($_SESSION['application_no'])) {
        $application_no = $_SESSION['application_no'];

        // Query to fetch pending account details
        $sql = "SELECT * FROM pending_accounts WHERE Application_no = '$application_no'";
        $result = $conn->query($sql);

        // Check if the query was successful
        if($result->num_rows > 0){
            // Fetch the account details
            $row = $result->fetch_assoc();
            $name = $row['Name'];
            $gender = $row['Gender'];
            $mob_no = $row['Mobile_no'];
            $landline = $row['Landline_no'];
            $pan = $row['PAN'];
            $citizenship = $row['CITIZENSHIP'];
            $dob = $row['DOB'];
            $email = $row['Email_id'];     
            $home_addr = $row['Home_Addr'];
            $office_addr = $row['Office_Addr'];
            $country = $row['Country'];
            $state = $row['State'];
            $city = $row['City'];
            $pin = $row['Pin'];
            $ara_loc = $row['Area_Loc'];
            $nominee_name = $row['Nominee_name'];
            $nominee_acno = $row['Nominee_ac_no'];
            $acc_type = $row['Account_type'];

            // Generate customer ID and account number
            $ifsc = 1011;
            $customer_id = $ifsc . mt_rand(100, 1000);
            $acc_no = $ifsc . mt_rand(01, 99) . $customer_id;

            // Get current date and time
            $ac_opening_date = date("d/m/y h:i:s A");

            // Begin transaction
            $conn->autocommit(FALSE);

            // Insert customer details into bank_customers table
            $sql1 = "INSERT INTO bank_customers (
                        Username, Gender, Customer_ID, Account_no, Branch, IFSC_Code, Mobile_no, Landline_no, PAN, CITIZENSHIP,
                        DOB, Email_ID, Home_Addr, Office_Addr, Country, State, City, Pin_code, Area_Loc, Nominee_name,
                        Nominee_ac_no, Account_type, Ac_Opening_Date, Account_Status)
                    VALUES (
                        '$name', '$gender', '$customer_id', '$acc_no', 'Demo Branch', '$ifsc', '$mob_no', '$landline', '$pan', '$citizenship',
                        '$dob', '$email', '$home_addr', '$office_addr', '$country', '$state', '$city', '$pin', '$ara_loc', '$nominee_name',
                        '$nominee_acno', '$acc_type', '$ac_opening_date', 'ACTIVE') ";

            // Delete the pending application from pending_accounts table
            $sql2 = "DELETE FROM pending_accounts WHERE Application_no = '$application_no' ";

            // Create Passbook table for the customer
            $sql3 = "CREATE TABLE passbook_$customer_id (
                        id INT(255) AUTO_INCREMENT PRIMARY KEY, 
                        Transaction_id VARCHAR(255) NULL,
                        Transaction_date VARCHAR(255) NULL,
                        Description VARCHAR(255) NULL,
                        Cr_amount VARCHAR(255) NULL,
                        Dr_amount VARCHAR(255) NULL,
                        Net_Balance VARCHAR(255) NULL,
                        Remark VARCHAR(255) NULL)";

            // Create Beneficiary table for the customer
            $sql4 = "CREATE TABLE beneficiary_$customer_id (
                        id INT(255) AUTO_INCREMENT PRIMARY KEY, 
                        Beneficiary_name VARCHAR(255) NULL,
                        Beneficiary_ac_no VARCHAR(255) NULL,
                        IFSC_code VARCHAR(255) NULL,
                        Account_type VARCHAR(255) NULL,
                        Status VARCHAR(255) NULL,
                        Date_added VARCHAR(255) NULL)";

            // If all queries are successful, commit the transaction
            if($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE && $conn->query($sql4) === TRUE){
                // Generate a transaction ID
                $transaction_id = mt_rand(100, 999) . mt_rand(1000, 9999) . mt_rand(10, 99);

                // Insert an initial transaction into the passbook
                $sql = "INSERT INTO passbook_$customer_id (Transaction_id, Transaction_date, Description, Cr_Amount, Dr_Amount, Net_Balance) 
                        VALUES ('$transaction_id', '$ac_opening_date', 'Account Opening', '0', '0', '0')";
                $conn->query($sql);

                // Commit the transaction
                $conn->commit();

                // Display success message
                echo '<script>alert("Account Created Successfully\n\nAccount no: '.$acc_no.'\n\nHint: Get Debit Card then register e-banking")</script>';
            } else {
                // Rollback the transaction if any query fails
                $conn->rollback();
                echo "Error Creating Account<br><br>" . $conn->error;   
            }
        } else {
            // Display error if application not found
            echo '<script>alert("Application not found")</script>';
        }
    } else {
        // Display error if session variable is not set
        echo '<script>alert("Session variable not set")</script>';
    }
}
?>
