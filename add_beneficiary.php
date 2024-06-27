<html>
<body>
<head>
    <title>Add Beneficiary</title>
    <link rel="stylesheet" type="text/css" href="css/add_beneficiary.css" />
</head>
<?php 
include 'header.php';
include 'customer_profile_header.php';
?>
<div class="add_beneficiary_container">
    <form method="post">
        <br><input type="text" name="beneficiary_name" placeholder="Beneficiary Name" required><br>
        <input type="text" name="beneficiary_acno" placeholder="Beneficiary A/c no" required><br>
        <!-- IFSC Code field removed -->
        <select name="beneficiary_acc_type" required>
            <option value="" disabled selected>Account type</option>
            <option value="Saving">Saving</option>
            <option value="Current">Current</option><br>
        </select><br>
        <input type="submit" name="add_beneficiary_btn" value="Add"><br><br>
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

<?php
if(isset($_POST['add_beneficiary_btn'])){
    $beneficiary_name = $_POST['beneficiary_name'];
    $beneficiary_acno = $_POST['beneficiary_acno'];
    // IFSC code no longer needed
    $beneficiary_acc_type = $_POST['beneficiary_acc_type'];

    session_start();
    include 'db_connect.php';
    $cust_id = $_SESSION['customer_Id'];

    $sql = "SELECT Account_no FROM bank_customers WHERE Account_no = $beneficiary_acno";
    $result = $conn->query($sql);
    if($result->num_rows <= 0 ){
        echo '<script>alert("Incorrect Account number"); location="add_beneficiary.php";</script>';
    } else { 
        if($beneficiary_acno == $_SESSION['Account_No']){
            echo '<script>alert("You cannot add yourself as a beneficiary");</script>';
        } else {             
            date_default_timezone_set('Asia/Kathmandu'); 
            $_date_added = date("d/m/y h:i:s A");
            
            $sql = "INSERT INTO beneficiary_$cust_id (Beneficiary_name, Beneficiary_ac_no, Account_type, Status, Date_added) 
                    VALUES ('$beneficiary_name','$beneficiary_acno','$beneficiary_acc_type','ACTIVE','$_date_added')";
            if($conn->query($sql) === TRUE){
                echo '<script>alert("Beneficiary Added Successfully"); location="add_beneficiary.php";</script>';
            } else {
                echo "Error inserting data: " . $conn->error;
            }
        }
    }
}
?>
