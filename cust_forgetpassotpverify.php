<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <link rel="stylesheet" type="text/css" href="css/cust_forgetpass.css"/>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="otp_verify_container">
        <p>Verify OTP</p>
        <form method="post" action="cust_forgetpass_verify.php">
            <input type="text" name="otp" placeholder="Enter OTP" required /><br>
            <input type="password" name="new_password" placeholder="New Password" required /><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required /><br>
            <input type="submit" name="verify_otp" value="Verify & Change Password"><br>
        </form><br>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
