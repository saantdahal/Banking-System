<?php ob_start(); ?>
<html>
<head>
    <title>View Customer Transactions</title>
    <link rel="stylesheet" type="text/css" href="css/view_customer_transactions.css" />
    <script type="text/javascript">
        function printStatement() {
            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'staff_profile_header.php';?>

    <div class="view_cust_trans_container_outer">
        <form method="POST">
            <input name="account_no" placeholder="Customer Account No"><br>
            <input type="submit" name="submit_view" value="Submit">
        </form>
    </div>

    <?php 
    if(isset($_POST['submit_view'])){
        $cust_ac = $_POST['account_no'];
        include 'db_connect.php'; 

        // Get the customer details from account number
        $cust_sql = "SELECT * FROM bank_customers WHERE Account_no = '$cust_ac'";
        $cust_result = $conn->query($cust_sql);

        if ($cust_result->num_rows > 0) {
            $cust_row = $cust_result->fetch_assoc();
            $customer_id = $cust_row['Customer_ID'];

            $passbook_table = "passbook_$customer_id";
            $sql = "SELECT * FROM $passbook_table ORDER BY Transaction_date DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
    ?>

    <div class="view_cust_trans_container_inner">
        <div class="trans_details" id="printableArea">
            <span class="heading">Statement - SASBANK</span><br>
            <div class="account_details">
                <p>Account Holder: <?php echo $cust_row['Username']; ?></p>
                <p>Account Number: <?php echo $cust_row['Account_no']; ?></p>
                <p>Branch: <?php echo $cust_row['Branch']; ?></p>
                <p>Mobile No: <?php echo $cust_row['Mobile_no']; ?></p>
                <p>Email Id: <?php echo $cust_row['Email_ID']; ?></p>
            </div>
            <table>
                <tr>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Credit Amount</th>
                    <th>Debit Amount</th>
                    <th>Net Balance</th>
                    <th>Remark</th>
                </tr>
                <?php
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                                <td>{$row['Transaction_id']}</td>
                                <td>{$row['Transaction_date']}</td>
                                <td>{$row['Description']}</td>
                                <td>{$row['Cr_amount']}</td>
                                <td>{$row['Dr_amount']}</td>
                                <td>{$row['Net_Balance']}</td>
                                <td>{$row['Remark']}</td>
                              </tr>";
                    }
                ?>
            </table>
        </div>
        <button onclick="printStatement()">Print Statement</button>
    </div>

    <?php
            } else {
                echo '<script>alert("No transactions found for this account")</script>';
            }
        } else {
            echo '<script>alert("Customer not found")</script>';
        }
    }
    ?>

    <?php include 'footer.php'; ?>
</body>
</html>
<?php ob_end_flush(); ?>
