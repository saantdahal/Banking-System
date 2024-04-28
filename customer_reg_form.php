<?php ob_start() ?>

<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="css/customer_reg_form.css"/>
    
	<?php include'header.php';  ?>
    </head>
    <body>
    <div class="container_regfrm_container_parent">
	<h3>Online Account Opening Form</h3>
	<div class="container_regfrm_container_parent_child">
		<form method="post">
				 <input type="text" name="name" placeholder="Name" required />
				 <select name ="gender" required >
					  <option class="default" value="" disabled selected>Gender</option>
					  <option value="Male" required >Male</option>
					  <option value="Female">Female</option>
					  <option value="Others">Others</option>
				</select>
				 <input type="text" name="mobile" placeholder="Mobile no" required />
				 <input type="text" name="email" placeholder="Email id" />
				 <input type="text" name="landline" placeholder="Landline no" />
				 <input type="text" name="dob" placeholder="Date of Birth" onfocus="(this.type='date')" required />
				 <input type="text" name="pan_no" placeholder="PAN Number" required />
				 <input type="text" name="citizenship" placeholder="Citizenship Number" required />
				 <input class="address" type="text" name="homeaddrs" placeholder="Home Address" required  />
				 <input class="address" type="text" name="officeaddrs" placeholder="Office Address" />
				 <input type="text" name="country" placeholder="NEP" value="NEP" readonly="readonly" />



				 <select name ="state" required >
					  <option class="default" value="" disabled selected>State</option>
					  
					  <option value="Karnali">Karnali</option>
					  <option value="Sudurpachhim">Sudurpachhim</option>
					  <option value="Gandaki">Gandaki</option>
					  <option value="Lumbini">Lumbini</option>
					  <option value="Province No. 1">Province No. 1</option>
					  <option value="Province No. 2">Province No. 2</option>
					  <option value="Bagmati">Bagmati</option>
					  
				</select>



				<select name="city" required>
    <option class="default" value="" disabled selected>City</option>
    <option value="Kathmandu">Kathmandu</option>
    <option value="Bhaktapur">Bhaktapur</option>
    <option value="Lalitpur">Lalitpur</option>
    <option value="Pokhara">Pokhara</option>
    <option value="Biratnagar">Biratnagar</option>
    <option value="Birgunj">Birgunj</option>
    <option value="Dharan">Dharan</option>
    <option value="Bharatpur">Bharatpur</option>
    <option value="Janakpur">Janakpur</option>
    <option value="Dhangadhi">Dhangadhi</option>
    <option value="Butwal">Butwal</option>
    <option value="Mahendranagar">Mahendranagar</option>
    <option value="Hetauda">Hetauda</option>
    <option value="Nepalgunj">Nepalgunj</option>
    <option value="Itahari">Itahari</option>
    <option value="Tulsipur">Tulsipur</option>
    <option value="Kalaiya">Kalaiya</option>
    <option value="Damak">Damak</option>
    <option value="Birendranagar">Birendranagar</option>
    <option value="Gaur">Gaur</option>
    <option value="Siraha">Siraha</option>
    <option value="Tansen">Tansen</option>
    <option value="Jaleshwar">Jaleshwar</option>
    <option value="Inaruwa">Inaruwa</option>
    <option value="Baglung">Baglung</option>
    <option value="Rajbiraj">Rajbiraj</option>
    <option value="Khandbari">Khandbari</option>
    <option value="Dhankuta">Dhankuta</option>
    <option value="Waling">Waling</option>
    <option value="Malangwa">Malangwa</option>
    <option value="Parasi">Parasi</option>
    <option value="Ilam">Ilam</option>
    <option value="Banepa">Banepa</option>
    <option value="Dailekh">Dailekh</option>
    <option value="Panauti">Panauti</option>
    <option value="Gorkha">Gorkha</option>
    <option value="Rajapur">Rajapur</option>
    <option value="Urlabari">Urlabari</option>
    <option value="Beni">Beni</option>
    <option value="Lamahi">Lamahi</option>
    <option value="Bhadrapur">Bhadrapur</option>
    <option value="Dipayal Silgadhi">Dipayal Silgadhi</option>
    <option value="Kamalamai">Kamalamai</option>
    <option value="Kanchanpur">Kanchanpur</option>
    <option value="Triyuga">Triyuga</option>
    <option value="Byas">Byas</option>
    <option value="Putalibazar">Putalibazar</option>
    <option value="Besisahar">Besisahar</option>
    <option value="Balara">Balara</option>
    <option value="Surkhet">Surkhet</option>
    <option value="Kohalpur">Kohalpur</option>
    <option value="Tikapur">Tikapur</option>
    <option value="Bhimeshwar">Bhimeshwar</option>
    <option value="Dudhauli">Dudhauli</option>
    <option value="Bhimdatta">Bhimdatta</option>
    <option value="Chautara">Chautara</option>
    <option value="Tehrathum">Tehrathum</option>
    <option value="Ramechhap">Ramechhap</option>
    <option value="Dhulikhel">Dhulikhel</option>
    <option value="Jumla">Jumla</option>
    <option value="Charikot">Charikot</option>
    <option value="Kusma">Kusma</option>
    <option value="Baglung">Baglung</option>
    <option value="Syangja">Syangja</option>
    <option value="Darchula">Darchula</option>
    <option value="Baitadi">Baitadi</option>
    <option value="Bajura">Bajura</option>
    <option value="Achham">Achham</option>
    <option value="Dolpa">Dolpa</option>
    <option value="Mustang">Mustang</option>
    <option value="Manang">Manang</option>
</select>




				 
				 <input type="text" name="pin" placeholder="Pin Code" required />
				 <input type="text" name="arealoc" placeholder="Area/Locality" required />
				 <input type="text" name="nominee_name" placeholder="Nominee Name (If any)" />
				 <input type="text" name="nominee_ac_no" placeholder="Nominee Account no"  />
				 
				 <select name ="acctype" required >
					  <option class="default" value="" disabled selected>Account Type</option>
					  <option value="Saving">Saving</option>
					  <option value="Current">Current</option>
				</select>
				<input type="submit" name="submit" value="Submit">
				</form>
         </div>
		 </div>
		 
<?php include'footer.php';?>
    
</body>
</html>


<?php 

if(isset($_POST['submit'])){

	session_start();
	$_SESSION['$cust_acopening'] = TRUE;
	$_SESSION['cust_name']=$_POST['name'];
	$_SESSION['cust_gender']=$_POST['gender'];
	$_SESSION['cust_mobile']=$_POST['mobile'];
	$_SESSION['cust_email']=$_POST['email'];
	$_SESSION['cust_landline']=$_POST['landline'];
	$_SESSION['cust_dob']=$_POST['dob'];
	$_SESSION['cust_pan=']=$_POST['pan_no'];
	$_SESSION['cust_citizenship']=$_POST['citizenship'];
	$_SESSION['cust_homeaddrs']=$_POST['homeaddrs'];
	$_SESSION['cust_officeaddrs']=$_POST['officeaddrs'];
	$_SESSION['cust_country']=$_POST['country'];
	$_SESSION['cust_state']=$_POST['state'];
	$_SESSION['cust_city']=$_POST['city'];
	$_SESSION['cust_pin']=$_POST['pin'];
	$_SESSION['arealoc']=$_POST['arealoc'];
	$_SESSION['nominee_name']=$_POST['nominee_name'];
	$_SESSION['nominee_ac_no']=$_POST['nominee_ac_no'];
	$_SESSION['cust_acctype']=$_POST['acctype'];
	
	header('location:cust_regfrm_confirm.php');
	
	
}

?>