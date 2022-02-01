
<?php

// Upload and Rename File

if (isset($_POST['submit']))
{    
	$filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	$allowed_file_types = array('.png','.jpg');	

	if (in_array($file_ext,$allowed_file_types))
	{	
		// Rename file
		$newfilename ="product".".png" ;

	
			
			move_uploaded_file($_FILES["file"]["tmp_name"], "upload.image/".$newfilename);
			echo "File uploaded successfully.";		
		
	}
	elseif (empty($file_basename))
	{	
		// file selection error
		echo "Please select a file to upload.";
	} 
	
	else
	{
		// file type error
		echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
		unlink($_FILES["file"]["tmp_name"]);
	}
}

?>