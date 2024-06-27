<?php
ob_start();
include 'header.php';
include 'customer_profile_header.php';

if($_SESSION['customer_login'] != true){
    header('location:customer_login.php');
    return 0;
}
?>

<html>
<head>
    <title>Fund Transfer</title>
    <link rel="stylesheet" type="text/css" href="css/fund_transfer.css"/>
    <style>
        #customer_profile .link4{
            background-color: rgba(5, 21, 71,0.4);
        }
    </style>
</head>
<body>
    <div class="fundtransfer_conainer">
        <br>
        <span>IMPS (24x7 Instant Payment)</span><br><br>
        <div class="fund_transfer">
            <div class="beneficiary_btn">
                <form id="form1" method="post">
                    <a href="add_beneficiary.php"><input class="beneficiary" type="submit" name="add_beneficiary" value="Add beneficiary"></a>
                    <input class="beneficiary" type="submit" name="delete_beneficiary" value="Delete beneficiary">
                    <input class="beneficiary" type="submit" name="view_beneficiary" value="View beneficiary">
                </form>
            </div>
            <br>
            <form id="form2" method="post">
                <select name="beneficiary" required>
                    <option class="default" value="" disabled selected>Select Beneficiary</option>
                    <?php
                    include 'db_connect.php';
                    $cust_id = $_SESSION['customer_Id']; 
                    $sql = "SELECT * from beneficiary_$cust_id ";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo '<option value="'.$row['Beneficiary_ac_no'].'">'.$row['Beneficiary_name'].'-'.$row['Beneficiary_ac_no'].'</option>';
                    }
                    ?>
                </select><br>
                <input type="text" name="trnsf_amount" placeholder="Amount" required><br>
                <input type="text" name="trnsf_remark" placeholder="Remark"><br>
                <input type="submit" name="fnd_trns_btn" value="Send"><br>
            </form>
        </div>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>

<?php
if(isset($_POST['add_beneficiary'])){
    header("location:add_beneficiary.php");
}

if(isset($_POST['delete_beneficiary'])){
    header("location:delete_beneficiary.php");
}

if(isset($_POST['view_beneficiary'])){
    header("location:view_beneficiary.php");
}

if(isset($_POST['fnd_trns_btn'])){
    $_SESSION['trnsf_remark'] = $_POST['trnsf_remark'];

    // Check if the transfer amount is a valid number and greater than zero
    if(!is_numeric($_POST['trnsf_amount']) || $_POST['trnsf_amount'] <= 0){
        echo '<script>alert("Invalid amount. Amount must be greater than zero.")</script>';
    } else {
        $sender_ac_no = $_SESSION['Account_No']; // Sender's Account_No
        $_SESSION['trnsf_amount'] = $trnsf_amount = $_POST['trnsf_amount'];
        include 'db_connect.php';

        // Receivers account number
        $_SESSION['beneficiary_ac_no'] = $beneficiary_ac_no = $_POST['beneficiary'];
        
        // Check Sender's Minimum balance
        $sql = "SELECT * FROM bank_customers WHERE Account_no = '$sender_ac_no'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $_SESSION['sender_mob'] = $sender_mob = $row['Mobile_no'];
        $sender_name = $row['Username'];
        
        if($row['Current_Balance'] < $trnsf_amount){
            echo '<script>alert("Insufficient balance")
                location="fund_transfer.php";</script>';
        } else {
            $_SESSION['fund_trnsfer_otp'] = $otp_fund_trnsfer = mt_rand(100,999).mt_rand(100,999);

            // SMS Integration for send OTP to Sender to complete transaction
            $_SESSION['ref_no'] = $ref_no = mt_rand(1000,9999);
            header("Location:fund_transfer_otp.php");
        }
    }
}
?>
