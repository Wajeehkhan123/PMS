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
	<title>Add Product</title>
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
	
		$("#product").click(function() {
		
		var flag = true;
		var $u = $("#name").val();
		var $p = $("#price").val();
		var $d = $("#description").val();
		var $type = $("#type").val();
		var $pic = $("#picture").val();
		
		if($u == "")
		{
			alert("Must enter name !");
			flag = false;
		}
		if($p == "")
		{
			alert("Enter the price !");
			flag = false;
		}
		if($d == "")
		{
			alert("Description is necessary !");
			flag = false;
		}
		if($type == "0")
		{
			alert("What is the type of product? ");
			flag = false;
		}
		if($pic == "")
		{
			alert("Choose the file please !");
			flag = false;
		}
			
		return flag;
		
	});
		 
	//var dataToSend = {"action": "getCities", "countryid": countryid};
	
	/*var settings = {
		type: 'POST',
		dataType: 'json',
		url: 'api.php',
		data: dataToSend,
		success: function(response){ 
			for(var i=0; i<response.data.length; i++)
			{
				var obj = response.data[i];
				var opt = $("<option>").attr("value",obj.cityid).text(obj.name);
				$("#city").append(opt);
			}
		},
		error: function(err, type, httpStatus){
			alert("Error has ocurred "+err+" "+type+" "+httpStatus);
		}

	};
	$.ajax(settings);
	return false;
	});*/
	
});
</script>
<body>

<?php
if(isset($_REQUEST['product'])== true)
{
	$msg = "";
	$name = $_REQUEST['name'];
	$price = $_REQUEST['price'];
	$typeid = $_REQUEST['type'];
	$description = $_REQUEST['description'];
	$files = $_FILES['file'];
	$src_path = $files['tmp_name'];
	$filename = $files['name'];
	$new_name = SaveFile($src_path,$filename);
    $updateon = date('Y-m-d H:i:s');
	$updateby = $_SESSION["userid"];
    $active = 1;
	
	$sql = "INSERT INTO product(Name,Price,TypeId,Description,PicURL,UpdatedOn,UpdatedBy,IsActive) values('$name','$price','$typeid','$$description','$new_name','$updateon','$updateby','$active')";
	if(mysqli_query($conn,$sql) == true)
	{
		$last_id = mysqli_insert_id($conn);
		$msg = "Product Added Successfully!";
	}
	else{
		$msg = "Error !";
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


	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="POST" action="addproduct.php" enctype="multipart/form-data">
				<span class="contact100-form-title">
					Add New Product
				</span>

				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Name</span>
					<input class="input100" type="text" name="name" id="name" placeholder="Name.....">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Valid price is required">
					<span class="label-input100">Price</span>
					<input class="input100" type="text" name="price" id="price" placeholder="Price.....">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 input100-select">
					<span class="label-input100">Type Select</span>
					<div>
						<select class="selection-2" name="type" id="type">
							<option value="0">Select Type</option>
							<?php
							$msg = "";
							$sql = "SELECT * FROM type";
	                        $result = mysqli_query($conn,$sql);
      
	                        $recordFound = mysqli_num_rows($result);
	                        if($recordFound > 0)
	                        {
		                        while($row = mysqli_fetch_assoc($result))
	                            {
			                        $id = $row['TypeId'];
		                            $name = $row['TypeName'];
			                        echo "<option value='".$id."'>".$name."</option>";
	                            }
	                        }
							?>
						</select>
					</div>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Description is required">
					<span class="label-input100">Description</span>
					<textarea class="input100" name="description" id="description" placeholder="Description....."></textarea>
					<span class="focus-input100"></span>
				</div>
				
				<div class="wrap-input100 validate-input" data-validate="file is required">
					<span class="label-input100">Picture</span>
					<input class="input100" style="padding-top:15px;" type="file" id="picture" name="file">
				</div>

				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn" id="product" name="product">
							<span>
								Add Product
							</span>
						</button>
					</div>
				</div>
				
				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn" id="back" name="back">
							<span>
								Back
							</span>
						</button>
					</div>
				</div>
				
				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn" id="logout" name="logout">
							<span>
								Logout
							</span>
						</button>
					</div>
				</div>
				
				<?php
				   echo "<span>$msg</span>";
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
