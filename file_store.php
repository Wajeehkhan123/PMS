<?php
function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function SaveFile($src_path,$name)
{
	$new_name = GUID();
	$tempArr = explode(".", $name);
	$ext = end($tempArr);
	$full_new_name = $new_name.".".$ext;
	$dest_path = "img//".$full_new_name;
	move_uploaded_file($src_path,$dest_path);
	
	return $full_new_name;
}
?>