<!DOCTYPE html>
<html>
<head>
    <title>EMI Calculator</title>
    <link rel="stylesheet" type="text/css" href="css/emi.css" />
</head>
<body>
<?php include 'header.php'; ?>
<div class="emi_calc_div">
    <form method="post">
        <h2>EMI Calculator</h2>
        <input type="text" name="amount" placeholder="Loan Amount" required>
        <input type="text" name="rate" placeholder="Interest Rate (%)" required>
        <input type="text" name="tenure" placeholder="Loan Tenure (Years)" required>
        <input type="submit" name="submit" value="Calculate">
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $amount = $_POST['amount'];
        $rate = $_POST['rate'] / 100 / 12; // monthly interest rate
        $tenure = $_POST['tenure'] * 12; // loan tenure in months

        $emi = $amount * $rate * (pow(1 + $rate, $tenure) / (pow(1 + $rate, $tenure) - 1));
        $total = $emi * $tenure;

        echo "<div class='result'>";
        echo "<h3>Loan EMI: " . number_format($emi, 2) . "</h3>";
        echo "<h3>Total Payment (Amount + Interest): " . number_format($total, 2) . "</h3>";
        echo "</div>";
    }
    ?>
</div>
</body>
</html>
