<?php
require('conn.php');
include('file_store.php');
session_start();
if(isset($_SESSION['user']) == false)
{
	header('Location: PMS_signUp.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Products</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body style='  background: #a64bf4;
  background: -webkit-linear-gradient(45deg, #00dbde, #fc00ff);
  background: -o-linear-gradient(45deg, #00dbde, #fc00ff);
  background: -moz-linear-gradient(45deg, #00dbde, #fc00ff);
  background: linear-gradient(45deg, #00dbde, #fc00ff);
  background-repeat: no-repeat;
  background-attachment: fixed;
'>
    <div>
	  <a style='color:white;text-align:center;font-size:170%;padding-top:5px;margin-left:30px;' href='PMS_home.php'>Back</a>
	  <a style='float:right;color:white;text-align:center;font-size:170%;padding-top:5px;margin-right:30px;' href='signout.php'>Logout</a>
	</div>
	<div style='color:white;text-align:center;font-size:170%;padding-top:5px;'>All Products</div>
	
<?php
$sql = "SELECT * FROM product where IsActive = 1";
$result = mysqli_query($conn,$sql);

$recordFound = mysqli_num_rows($result);

if($recordFound > 0)
{	
	while($row = mysqli_fetch_assoc($result))
	{
		$proId = "";
		$id = $row["ProductId"];
		$typeId = $row["TypeId"];
		$s = "SELECT TypeName from type where TypeId = '$typeId'";
		$r = mysqli_query($conn,$s);
		$type = mysqli_fetch_assoc($r);
		$typename = $type["TypeName"];
		$name = $row["Name"];
		$price = $row["Price"];
		$desc = $row["Description"];
		$updateon = $row["UpdatedOn"];
		$updateby = $row["UpdatedBy"];
		$url = $row["PicURL"];
		$q = "SELECT Name FROM admin WHERE AdminId = '$updateby'";
		$w = mysqli_query($conn,$q);
		$t = mysqli_fetch_assoc($w);
		$adminname = $t["Name"];
		
		echo "		
		<div class='container-login100' style='text-align:center;margin-bottom:20px;width:30%;min-height:unset;position:relative;float:left;margin-left:30px;margin-top:15px;background-color:white;border-radius:10%;'>
		            <img src='img/$url'></img>
					<span><b>Product Name: $name<b></span>
					
				    <span><b>Product Type: $typename<b></span><br>
					
					<span><b>Product Price:$price<b></span><br>
					
					<span><b>Product Description:<br>$desc<b></span><br>
					
					<span><b>Updated On: $updateon<b></span><br>
					
					<span><b>Updated By Admin: $adminname<b></span><br>

					<input type='button' style='border-radius: 20px;padding: 10px;  background: #00d0ff;color: white;'  value='Edit' onclick=window.location.href='editproduct.php?proId=$id';>
					<input type='button' style='border-radius: 20px;padding: 10px;  background: #00d0ff;color: white;' value='Delete'  onclick=window.location.href='deleteproduct.php?proId=$id';>
							
		</div>
		";
	}
	
}
?>
<?php
if(isset($_REQUEST['back']) == true)
{
	header('Location: PMS_home.php');
}
?>

<?php
if(isset($_REQUEST['logout']) == true)
{
	header('Location: signout.php');
}
?>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>