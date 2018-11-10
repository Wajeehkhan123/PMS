<?php
require('conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images1/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts1/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor1/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css1/util.css">
	<link rel="stylesheet" type="text/css" href="css1/main.css">
<!--===============================================================================================-->
</head>
<script src="/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function (){
	
		$("#btnRegister").click(function() {
		
		var flag = true;
		var $u = $("#name").val();
		var $p = $("#password").val();
		var $pC = $("#login").val();
		
		if($u == "")
		{
			alert("Register Username is mandatory !");
			flag = false;
		}
		if($p == "")
		{
			alert("Register password is mandatory !");
			flag = false;
		}
		if($pC == "")
		{
			alert("Register login is mandatory !");
			flag = false;
		}
		
		return flag;
	});
	
});

</script>
<body>

<?php
$username = "";
$login = "";
$password = "";
$msg = "";
if(isset($_REQUEST['btnRegister']) == true )
{
	$username = $_REQUEST['name'];
	$login = $_REQUEST['login'];
    $password = $_REQUEST['password'];	
	
	$sql = "INSERT INTO admin(Name,Login,Password) values('$username','$login','$password')";
	if(mysqli_query($conn,$sql) == true)
	{
		$last_id = mysqli_insert_id($conn);
		$msg = "You are registered successfully!";
		header('Location: PMS_SignUp.php');
	}
	else{
		$msg = "Error !";
	}
}
?>

	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="POST" action="PMS_SignIn.php">
				<span class="contact100-form-title">
					PMS Sign Up
				</span>

				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Your Name</span>
					<input class="input100" type="text" name="name" placeholder="Enter your name" id="name">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Valid password is required">
					<span class="label-input100">Password</span>
					<input class="input100" type="password" name="password" placeholder="Enter your password" id="password">
					<span class="focus-input100"></span>
				</div>
				
				<div class="wrap-input100 validate-input" data-validate="Login is required">
					<span class="label-input100">Login</span>
					<input class="input100" type="text" name="login" placeholder="Enter your login" id="login">
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn" name="btnRegister" id="btnRegister">
							<span>
								Sign Up
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
				<?php 
                  if($msg != "")
                  {
	                 echo "<span class='red'>$msg</span>";
                  }
                ?>
			</form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor1/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/bootstrap/js/popper.js"></script>
	<script src="vendor1/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor1/daterangepicker/moment.min.js"></script>
	<script src="vendor1/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor1/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js1/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
