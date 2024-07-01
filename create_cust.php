<?php
//include "validate_admin.php";
include "header.php";
include "user_navbar.php";
//include "admin_sidebar.php";

include "session_timeout.php";
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="customer_add_style.css">
</head>

<body>
    <form class="add_customer_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">

        <div class="flex-container-form_header">
            <h1 id="form_header">Please fill in the following details . . .</h1>
        </div>

        <?php
        if (!empty($errors)) {
            echo '<div class="error-messages">';
            foreach ($errors as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
        }
        ?>

        <div class="flex-container">
            <div class=container>
                <label>First Name :</label><br>
                <input name="fname" size="30" type="text" value="<?php echo isset($fname) ? $fname : ''; ?>" required />
            </div>
            <div class=container>
                <label>Last Name :</b></label><br>
                <input name="lname" size="30" type="text" value="<?php echo isset($lname) ? $lname : ''; ?>" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Gender :</label>
            </div>

            <div class="flex-container-radio">
                <div class="container">
                    <input type="radio" name="gender" value="male" id="male-radio" <?php echo isset($gender) && $gender == 'male' ? 'checked' : ''; ?>>
                    <label id="radio-label" for="male-radio"><span class="radio">Male</span></label>
                </div>

                <div class="container">
                    <input type="radio" name="gender" value="female" id="female-radio" <?php echo isset($gender) && $gender == 'female' ? 'checked' : ''; ?>>
                    <label id="radio-label" for="female-radio"><span class="radio">Female</span></label>
                </div>

                <div class="container">
                    <input type="radio" name="gender" value="others" id="other-radio" <?php echo isset($gender) && $gender == 'others' ? 'checked' : ''; ?>>
                    <label id="radio-label" for="other-radio"><span class="radio">Others</span></label>
                </div>
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Date of Birth :</label><br>
                <input name="dob" id="dob" size="30" type="text" placeholder="yyyy-mm-dd" value="<?php echo isset($dob) ? $dob : ''; ?>" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Citizenship No :</label><br>
                <input name="citizen" size="25" type="text" value="<?php echo isset($citizen) ? $citizen : ''; ?>" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Email-ID :</label><br>
                <input name="email" size="30" type="text" value="<?php echo isset($email) ? $email : ''; ?>" required />
            </div>
            <div class=container>
                <label>Phone No. :</b></label><br>
                <input name="phno" size="30" type="text" value="<?php echo isset($phno) ? $phno : ''; ?>" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Address :</label><br>
                <textarea name="address" required><?php echo isset($address) ? $address : ''; ?></textarea>
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Bank Branch :</label>
            </div>
            <div class=container>
                <select name="branch">
                    <option value="Kathmandu" <?php echo isset($branch) && $branch == "Kathmandu" ? 'selected' : ''; ?>>Kathmandu</option>
                    <option value="Bhaktpur" <?php echo isset($branch) && $branch == "Bhaktpur" ? 'selected' : ''; ?>>Bhaktpur</option>
                    <option value="Lalitpur" <?php echo isset($branch) && $branch == "Lalitpur" ? 'selected' : ''; ?>>Lalitpur</option>
                    <option value="Dhading" <?php echo isset($branch) && $branch == "Dhading" ? 'selected' : ''; ?>>Dhading</option>
                    <option value="Head office" <?php echo isset($branch) && $branch == "Head office" ? 'selected' : ''; ?>>Head office</option>
                </select>
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Account No :</label><br>
                <input name="acno" size="25" type="text" value="<?php echo isset($acno) ? $acno : ''; ?>" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Opening Balance :</label><br>
                <input name="o_balance" size="20" type="text" value="<?php echo isset($o_balance) ? $o_balance : ''; ?>" required />
            </div>
            <div class=container>
                <label>PIN(4 digit) :</b></label><br>
                <input name="pin" size="15" type="password" value="<?php echo isset($pin) ? $pin : ''; ?>" required />
            </div>
        </div>

        <div class="flex-container">
            <div class=container>
                <label>Username :</label><br>
                <input name="cus_uname" size="30" type="text" value="<?php echo isset($cus_uname) ? $cus_uname : ''; ?>" required />
            </div>
            <div class=container>
                <label>Password :</b></label><br>
                <input name="cus_pwd" type="password" value="<?php echo isset($cus_pwd) ? $cus_pwd : ''; ?>" required />
            </div>
        </div>

        <div class="flex-container">
            <div class="container">
                <button type="submit">Submit</button>
            </div>
            <div class="container">
                <button type="reset" class="reset" onclick="return confirmReset();">Reset</button>
            </div>
        </div>

    </form>

    <script>
        function confirmReset() {
            return confirm('Do you really want to reset?')
        }

        function validateForm() {
            const dob = document.getElementById('dob').value;
            const dobDate = new Date(dob);
            const today = new Date();

            if (dobDate > today) {
                alert('Date of Birth cannot be a future date.');
                return false;
            }

            return true;
        }
    </script>
</body>

</html>
