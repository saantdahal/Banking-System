<?php
session_start();

$customer_id = $_POST['cust_id'];
$debitcard = $_POST['dbt_crd'];
$mob_no = $_POST['mobile_no'];

include 'db_connect.php';

$sql = "SELECT Username, Password, Customer_ID, Mobile_no, Debit_Card_No FROM bank_customers WHERE Customer_ID = '$customer_id'";
$result = $conn->query($sql);

if (!is_numeric($customer_id) || !is_numeric($debitcard) || !is_numeric($mob_no)) {
    echo '<script>alert("Incorrect format")</script>';
} else {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($mob_no == $row['Mobile_no'] && $debitcard == $row['Debit_Card_No']) {
            // Generate and store new password
            $new_password = generateNewPassword(); // Define your password generation logic
            
            // Update the password in the database
            $update_sql = "UPDATE bank_customers SET Password = '$new_password' WHERE Customer_ID = '$customer_id'";
            if ($conn->query($update_sql) === TRUE) {
                echo '<script>alert("Password updated successfully. Your new password is: '.$new_password.'")</script>';
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo '<script>alert("Customer ID, Debit Card Number, or Mobile Number mismatch")</script>';
        }
    } else {
        echo '<script>alert("Customer not found!")</script>';
    }
}

function generateNewPassword() {
    // Define your password generation logic
    // For example, you can use rand() function to generate a random password
    return 'new_password'; // Return the generated password
}
?>
