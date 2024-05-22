<!DOCTYPE html>
<html>
<head>
    <title>Staff Home</title>
    <link rel="stylesheet" type="text/css" href="css/credit_customer_ac.css" />
    <style>
        .print-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #004156;
            color: white;
            border: none;
            font-size: 1em;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: #002f3f;
        }
    </style>
    <script>
        function printSlip() {
            var printContents = document.getElementById('deposit-slip').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</head>
<body>
    <?php include 'staff_profile_header.php'; ?>
    <div class="cust_credit_container">
        <form method="post">
            <input class="customer" type="text" name="customer_account_no" placeholder="Customer A/c No" required><br>
            <input class="customer" type="submit" name="fetch_details_btn" value="Fetch Details">
        </form><br>

        <?php
        if (isset($_POST['fetch_details_btn'])) {
            include 'db_connect.php';
            $cust_ac_no = $_POST['customer_account_no'];
            $sql = "SELECT * FROM bank_customers WHERE Account_no = $cust_ac_no";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $customer_name = $row['Username'];
                $customer_ifsc = $row['IFSC_Code'];
                $customer_mob = $row['Mobile_no'];
                $customer_netbal = $row['Current_Balance'];
                echo "<p>Account Number: $cust_ac_no</p>";
                echo "<p>Customer Name: $customer_name</p>";
                echo "<p>IFSC Code: $customer_ifsc</p>";
                echo "<p>Mobile Number: $customer_mob</p>";
                echo "<p>Current Balance: $customer_netbal</p>";
                echo '<form method="post">';
                echo '<input type="hidden" name="customer_account_no" value="' . $cust_ac_no . '">';
                echo '<input class="customer" type="text" name="credit_amount" placeholder="Amount" required><br>';
                echo '<input class="customer" type="text" name="depositor_name" placeholder="Depositor Name" required><br>';
                echo '<input class="customer" type="text" name="remarks" placeholder="Remarks" required><br>';
                echo '<input class="customer" type="submit" name="credit_btn" value="Credit">';
                echo '</form><br>';
            } else {
                echo '<script>alert("Incorrect Account Number")</script>';
            }
        }

        if (isset($_POST['credit_btn'])) {
            $cust_ac_no = $_POST['customer_account_no'];
            $credit_amount = $_POST['credit_amount'];
            $depositor_name = $_POST['depositor_name'];
            $remarks = $_POST['remarks'];

            if (!is_numeric($credit_amount)) {
                echo '<script>alert("Invalid amount")</script>';
            } else {
                include 'db_connect.php';
                $sql = "SELECT * FROM bank_customers WHERE Account_no = $cust_ac_no";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $customer_ac_no = $row['Account_no'];
                    $customer_id = $row['Customer_ID'];
                    $customer_name = $row['Username'];
                    $customer_ifsc = $row['IFSC_Code'];
                    $customer_mob = $row['Mobile_no'];
                    $customer_netbal = $row['Current_Balance'] + $credit_amount;
                    $customer_passbk = "passbook_" . $customer_id;

                    // Generate Transaction ID
                    $transaction_id = mt_rand(100, 999) . mt_rand(1000, 9999) . mt_rand(10, 99);

                    // Transaction Date
                    date_default_timezone_set('Asia/Kathmandu');
                    $transaction_date = date("d/m/y h:i:s A");

                    // Customer's Transaction Description
                    $Transac_description = "Cash Deposit/" . $transaction_id;

                    // Set autocommit to off
                    $conn->autocommit(FALSE);

                    // Add amount to customer's available balance
                    $sql1 = "UPDATE bank_customers SET Current_Balance = '$customer_netbal' WHERE bank_customers.Account_no = '$customer_ac_no '";

                    // Insert Statement into customer Passbook
                    $sql2 = "INSERT INTO $customer_passbk (Transaction_id, Transaction_date, Description, Cr_amount, Dr_amount, Net_Balance, Remark)
                             VALUES ('$transaction_id','$transaction_date','$Transac_description','$credit_amount','0','$customer_netbal','$remarks')";

                    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
                        $conn->commit();

                        // Generate deposit slip
                        echo '<div id="deposit-slip" class="deposit-slip">';
                        echo '<h2>SASBANK</h2>';
                        echo '<p>Deposit Slip</p>';
                        echo '<p>Transaction ID: ' . $transaction_id . '</p>';
                        echo '<p>Account Number: ' . $customer_ac_no . '</p>';
                        echo '<p>Customer Name: ' . $customer_name . '</p>';
                        echo '<p>Depositor Name: ' . $depositor_name . '</p>';
                        echo '<p>IFSC Code: ' . $customer_ifsc . '</p>';
                        echo '<p>Amount Credited: ' . $credit_amount . '</p>';
                        echo '<p>Remarks: ' . $remarks . '</p>';
                        echo '<p>Date and Time: ' . $transaction_date . '</p>';
                        echo '</div>';
                        echo '<button class="print-button" onclick="printSlip()">Print</button>';

                        echo '<script>alert("Amount credited successfully to customer account")</script>';
                    } else {
                        echo '<script>alert("Transaction failed\n\nReason:\n\n' . $conn->error . '")</script>';
                        $conn->rollback();
                    }
                } else {
                    echo '<script>alert("Incorrect Account Number")</script>';
                }
            }
        }
        ?>

    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
