<?php
require('conn.php');
include('file_store.php');
session_start();
if(isset($_SESSION['user']) == false)
{
	header('Location: PMS_signUp.php');
}
?>
<?php
if(isset($_REQUEST['proId']) && isset($_REQUEST['proId'])>0){
	$pid = $_REQUEST['proId'];
	
	$sql = "UPDATE product SET IsActive=0 WHERE ProductId = '$pid' and IsActive=1";
	
	if(mysqli_query($conn,$sql)== true)
	{
		header('Location: viewproduct.php');
	}
	else
	{
		header('Location: PMS_home.php');
	}
}
?>