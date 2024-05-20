<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    $entered_otp = $_POST['otp'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Debugging messages
    echo '<script>console.log("Entered OTP: ' . $entered_otp . '")</script>';
    echo '<script>console.log("Session OTP: ' . $_SESSION['forgetpass_otp'] . '")</script>';

    if ($new_password !== $confirm_password) {
        echo '<script>alert("Passwords do not match.")</script>';
        echo '<script>location="cust_forgetpassotpverify.php"</script>';
    } else {
        if (isset($_SESSION['forgetpass_otp']) && $entered_otp === $_SESSION['forgetpass_otp']) {
            $customer_id = $_SESSION['cust_id'];

            // Debugging message
            echo '<script>console.log("OTP verified. Updating password for Customer ID: ' . $customer_id . '")</script>';

            // Hash the new password before storing it
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            include 'db_connect.php';

            // Update the password in the database
            $sql = "UPDATE bank_customers SET Password = ? WHERE Customer_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hashed_password, $customer_id);

            if ($stmt->execute()) {
                // Clear the OTP from the session after successful password update
                unset($_SESSION['forgetpass_otp']);
                echo '<script>alert("Password changed successfully.")</script>';
                echo '<script>location="login.php"</script>';
            } else {
                echo '<script>alert("Failed to update password. Please try again.")</script>';
            }

            $stmt->close();
            $conn->close();
        } else {
            echo '<script>alert("Invalid OTP.")</script>';
            echo '<script>location="cust_forgetpassotpverify.php"</script>';
        }
    }
} else {
    echo '<script>alert("Invalid request method.")</script>';
}
?>
