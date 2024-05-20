<?php ob_start(); ?>

<html>
<head>
    <title>Edit Customer Details</title>
    <link rel="stylesheet" type="text/css" href="css/view_customer_by_acc_no.css" />
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'staff_profile_header.php'; ?>

    <div class="view_cust_byac_container_outer">
        <form method="POST">
            <input name="account_no" placeholder="Customer Account No"><br>
            <input type="submit" name="submit_view" value="Submit">
        </form>
    </div>

    <?php 
    if(isset($_POST['submit_view'])){
        $cust_ac = $_POST['account_no'];
        include 'db_connect.php'; 
        $sql = "SELECT * FROM bank_customers WHERE Account_no = '$cust_ac'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
    ?>

    <div class="view_cust_byac_container_inner">
        <div class="cust_details">
            <span class="heading">Edit Customer Details</span><br>
            <form method="POST">
                <input type="hidden" name="customer_id" value="<?php echo $row['Customer_ID']; ?>">
                <label>Customer Id: <?php echo $row['Customer_ID']; ?></label><br>
                <label>Account Number: <?php echo $row['Account_no']; ?></label><br>
                <label>Account Name: <input name="username" value="<?php echo $row['Username']; ?>"></label><br>
                <label>Account Type: <input name="account_type" value="<?php echo $row['Account_type']; ?>"></label><br>
                <label>Branch: <input name="branch" value="<?php echo $row['Branch']; ?>"></label><br>
                <label>Mobile No: <input name="mobile_no" value="<?php echo $row['Mobile_no']; ?>"></label><br>
                <label>Nominee Name: <input name="nominee_name" value="<?php echo $row['Nominee_name']; ?>"></label><br>
                <label>Nominee Ac/no: <input name="nominee_ac_no" value="<?php echo $row['Nominee_ac_no']; ?>"></label><br>
                <label>Email Id: <input name="email_id" value="<?php echo $row['Email_ID']; ?>"></label><br>
                <label>Address: <input name="home_addr" value="<?php echo $row['Home_Addr']; ?>"></label><br>
                <label>Date of Birth: <input type="date" name="dob" value="<?php echo $row['DOB']; ?>"></label><br>
                <label>PAN: <input name="pan" value="<?php echo $row['PAN']; ?>"></label><br>
                <input type="submit" name="submit_update" value="Update">
            </form>
        </div>
    </div>

    <?php
        } else {
            echo '<script>alert("Customer not found")</script>';
        }
    }

    if(isset($_POST['submit_update'])){
        include 'db_connect.php';
        $customer_id = $_POST['customer_id'];
        $username = $_POST['username'];
        $account_type = $_POST['account_type'];
        $branch = $_POST['branch'];
        $mobile_no = $_POST['mobile_no'];
        $nominee_name = $_POST['nominee_name'];
        $nominee_ac_no = $_POST['nominee_ac_no'];
        $email_id = $_POST['email_id'];
        $home_addr = $_POST['home_addr'];
        $dob = $_POST['dob'];
        $pan = $_POST['pan'];

        $update_sql = "UPDATE bank_customers SET 
            Username='$username',
            Account_type='$account_type',
            Branch='$branch',
            Mobile_no='$mobile_no',
            Nominee_name='$nominee_name',
            Nominee_ac_no='$nominee_ac_no',
            Email_ID='$email_id',
            Home_Addr='$home_addr',
            DOB='$dob',
            PAN='$pan'
            WHERE Customer_ID='$customer_id'";

        if($conn->query($update_sql) === TRUE){
            echo '<script>alert("Customer details updated successfully")</script>';
        } else {
            echo '<script>alert("Error updating record: '.$conn->error.'")</script>';
        }
    }
    ?>

    <?php include 'footer.php'; ?>
</body>
</html>

<?php ob_end_flush(); ?>
