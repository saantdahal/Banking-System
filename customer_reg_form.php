<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="css/customer_reg_form.css"/>
    <script>
        const citiesByProvince = {
            "Province No. 1": ["Bhojpur", "Dhankuta", "Ilam", "Jhapa", "Khotang", "Morang", "Okhaldhunga", "Panchthar", "Sankhuwasabha", "Solukhumbu", "Sunsari", "Taplejung", "Terhathum", "Udayapur"],
            "Province No. 2": ["Bara", "Dhanusa", "Mahottari", "Parsa", "Rautahat", "Sarlahi", "Saptari", "Siraha"],
            "Bagmati": ["Bhaktapur", "Chitwan", "Dhading", "Dolakha", "Kathmandu", "Kavrepalanchok", "Lalitpur", "Makwanpur", "Nuwakot", "Ramechhap", "Rasuwa", "Sindhuli", "Sindhupalchok"],
            "Gandaki": ["Baglung", "Gorkha", "Kaski", "Lamjung", "Manang", "Mustang", "Myagdi", "Nawalpur", "Parbat", "Syangja", "Tanahun"],
            "Lumbini": ["Arghakhanchi", "Gulmi", "Kapilvastu", "Nawalparasi East", "Nawalparasi West", "Palpa", "Parasi", "Rupandehi"],
            "Karnali": ["Dolpa", "Humla", "Jajarkot", "Jumla", "Kalikot", "Mugu", "Salyan", "Surkhet"],
            "Sudurpashchim": ["Achham", "Baitadi", "Bajhang", "Bajura", "Dadeldhura", "Darchula", "Doti", "Kailali", "Kanchanpur"]
        };

        function updateCities() {
            const provinceSelect = document.querySelector("select[name='state']");
            const citySelect = document.querySelector("select[name='city']");
            const selectedProvince = provinceSelect.value;
            const cities = citiesByProvince[selectedProvince] || [];

            citySelect.innerHTML = '<option class="default" value="" disabled selected>Select District</option>';
            cities.forEach(city => {
                const option = document.createElement("option");
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        }

        function validateForm() {
            let form = document.forms["registrationForm"];
            let name = form["name"].value;
            let gender = form["gender"].value;
            let mobile = form["mobile"].value;
            let email = form["email"].value;
            let dob = form["dob"].value;
            let citizenship = form["citizenship"].value;
            let homeaddrs = form["homeaddrs"].value;
            let state = form["state"].value;
            let city = form["city"].value;
            let pin = form["pin"].value;
            let arealoc = form["arealoc"].value;
            let acctype = form["acctype"].value;

            let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            let mobilePattern = /^[0-9]{10}$/;

            if (name === "" || gender === "" || mobile === "" || email === "" || dob === "" || citizenship === "" || homeaddrs === "" || state === "" || city === "" || pin === "" || arealoc === "" || acctype === "") {
                alert("Please fill out all required fields.");
                return false;
            }

            if (!mobilePattern.test(mobile)) {
                alert("Please enter a valid 10-digit mobile number.");
                return false;
            }

            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            let today = new Date();
            let dobDate = new Date(dob);
            if (dobDate > today) {
                alert("Date of birth cannot be a future date.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

    <?php 
    if (isset($_POST['submit'])) {
        session_start();
        
        // Server-side validation
        $errors = [];
        
        if (empty($_POST['name'])) $errors[] = 'Name is required';
        if (empty($_POST['gender'])) $errors[] = 'Gender is required';
        if (empty($_POST['mobile']) || !preg_match('/^[0-9]{10}$/', $_POST['mobile'])) $errors[] = 'Valid mobile number is required';
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
        if (empty($_POST['dob'])) {
            $errors[] = 'Date of Birth is required';
        } else {
            $dobDate = new DateTime($_POST['dob']);
            $today = new DateTime();
            if ($dobDate > $today) {
                $errors[] = 'Date of birth cannot be a future date';
            }
        }
        if (empty($_POST['citizenship'])) $errors[] = 'Citizenship number is required';
        if (empty($_POST['homeaddrs'])) $errors[] = 'Home address is required';
        if (empty($_POST['state'])) $errors[] = 'State is required';
        if (empty($_POST['city'])) $errors[] = 'City is required';
        if (empty($_POST['pin'])) $errors[] = 'Pin Code is required';
        if (empty($_POST['arealoc'])) $errors[] = 'Area/Locality is required';
        if (empty($_POST['acctype'])) $errors[] = 'Account Type is required';

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
        } else {
            $_SESSION['$cust_acopening'] = TRUE;
            $_SESSION['cust_name'] = $_POST['name'];
            $_SESSION['cust_gender'] = $_POST['gender'];
            $_SESSION['cust_mobile'] = $_POST['mobile'];
            $_SESSION['cust_email'] = $_POST['email'];
            $_SESSION['cust_landline'] = $_POST['landline'];
            $_SESSION['cust_dob'] = $_POST['dob'];
            $_SESSION['cust_pan='] = $_POST['pan_no'];
            $_SESSION['cust_citizenship'] = $_POST['citizenship'];
            $_SESSION['cust_homeaddrs'] = $_POST['homeaddrs'];
            $_SESSION['cust_officeaddrs'] = $_POST['officeaddrs'];
            $_SESSION['cust_country'] = $_POST['country'];
            $_SESSION['cust_state'] = $_POST['state'];
            $_SESSION['cust_city'] = $_POST['city'];
            $_SESSION['cust_pin'] = $_POST['pin'];
            $_SESSION['arealoc'] = $_POST['arealoc'];
            $_SESSION['nominee_name'] = $_POST['nominee_name'];
            $_SESSION['nominee_ac_no'] = $_POST['nominee_ac_no'];
            $_SESSION['cust_acctype'] = $_POST['acctype'];
        
            header('Location: cust_regfrm_confirm.php');
        }
    }
    ?>

    <div class="container_regfrm_container_parent">
        <h3>Online Account Opening Form</h3>
        <div class="container_regfrm_container_parent_child">
            <form name="registrationForm" method="post" onsubmit="return validateForm()">
                <input type="text" name="name" placeholder="Name" required />
                <select name="gender" required>
                    <option class="default" value="" disabled selected>Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                </select>
                <input type="text" name="mobile" placeholder="Mobile no" required />
                <input type="text" name="email" placeholder="Email id" required/>
                <input type="text" name="landline" placeholder="Landline no" />
                <input type="text" name="dob" placeholder="Date of Birth" onfocus="(this.type='date')" required />
                <input type="text" name="pan_no" placeholder="PAN Number" />
                <input type="text" name="citizenship" placeholder="Citizenship Number" required />
                <input class="address" type="text" name="homeaddrs" placeholder="Home Address" required  />
                <input class="address" type="text" name="officeaddrs" placeholder="Office Address" />
                <input type="text" name="country" placeholder="NEP" value="NEP" readonly="readonly" />

                <select name="state" onchange="updateCities()" required>
                    <option class="default" value="" disabled selected>State</option>
                    <option value="Province No. 1">Province No. 1</option>
                    <option value="Province No. 2">Province No. 2</option>
                    <option value="Bagmati">Bagmati</option>
                    <option value="Gandaki">Gandaki</option>
                    <option value="Lumbini">Lumbini</option>
                    <option value="Karnali">Karnali</option>
                    <option value="Sudurpashchim">Sudurpashchim</option>
                </select>

                <select name="city" required>
                    <option class="default" value="" disabled selected>Select District</option>
                </select>

                <input type="text" name="pin" placeholder="Pin Code" required />
                <input type="text" name="arealoc" placeholder="Area/Locality" required />
                <input type="text" name="nominee_name" placeholder="Nominee Name (If any)" />
                <input type="text" name="nominee_ac_no" placeholder="Nominee Account no" />
                <select name="acctype" required>
                    <option class="default" value="" disabled selected>Account Type</option>
                    <option value="Saving">Saving</option>
                    <option value="Current">Current</option>
                </select>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
