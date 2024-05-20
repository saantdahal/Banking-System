<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cust_id = $_POST['cust_id'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo '<script>alert("Passwords do not match.")</script>';
        echo '<script>location="forget_password.php"</script>';
    } else {
        include 'db_connect.php';

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Debugging messages
        echo '<script>console.log("Customer ID: ' . $cust_id . '")</script>';
        echo '<script>console.log("New Password: ' . $new_password . '")</script>';
        echo '<script>console.log("Hashed Password: ' . $hashed_password . '")</script>';

        // Update the password in the database
        $sql = "UPDATE bank_customers SET Password = ? WHERE Customer_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashed_password, $cust_id);

        if ($stmt->execute()) {
            echo '<script>alert("Password changed successfully.")</script>';
            echo '<script>location="login.php"</script>';
        } else {
            echo '<script>alert("Failed to update password. Please try again.")</script>';
            echo '<script>location="forget_password.php"</script>';
            echo '<script>console.log("Error: ' . $conn->error . '")</script>'; // Add this line for detailed error logging
        }

        $stmt->close();
        $conn->close();
    }
} else {
    // Redirect to forget password page if accessed directly
    echo '<script>location="forget_password.php"</script>';
}
?>
