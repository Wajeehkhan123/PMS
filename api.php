<?php
require('conn.php');
?>
<?php
if(isset($_REQUEST["action"]) && !empty($_REQUEST["action"]))
{
	$action = $_REQUEST["action"];
	 
	if($action == "getCities")
	{
		$country = $_REQUEST['countryid'];
		$sql = "SELECT cityid,name FROM city WHERE countryid=$country";
		
		$result = mysqli_query($conn,$sql);
		$recordFound = mysqli_num_rows($result);
		$cities = array();
		
		if($recordFound > 0)
	    {
			 while($row = mysqli_fetch_assoc($result))
	         {
				$cities[] = $row; 
			 }
		}
		
		$output["data"] = $cities;
		echo json_encode($output);
		
	}
	else if($action == "recordUpdate")
	{
		$id = $_REQUEST['id'];
		$uname = $_REQUEST['newUsername'];
		$login = $_REQUEST['newLogin'];
		$password = $_REQUEST['newPassword'];
		
		$sql = "UPDATE user SET name='$uname',login='$login',password='$password' WHERE id='$id'";
		
		if(mysqli_query($conn,$sql) == true)
	    {
			$flag = true;
		}
		else{
			$flag = false;
		}
		$output["data"] = $flag;
		echo json_encode($output);

	}
}
?>