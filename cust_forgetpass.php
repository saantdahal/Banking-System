<!DOCTYPE html>
<html>
<head>
    <title>Forget Password</title>
    <link rel="stylesheet" type="text/css" href="css/forget_password.css"/>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="forget_password_container">
        <p>Forget Password</p>
        <form method="post" action="change_password.php">
            <input type="text" name="cust_id" placeholder="Customer ID" required /><br>
            <input type="password" name="new_password" placeholder="New Password" required /><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required /><br>
            <input type="submit" name="change_password" value="Change Password"><br>
        </form><br>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>