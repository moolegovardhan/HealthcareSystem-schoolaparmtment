<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination

try{
$targetFolder = 'Transcripts'; // Relative to the root
       // echo "File Presssssssssssssssss".$_GET['filename'];
        $fileName = $_GET['filename'];
        echo $_FILES[$fileName];
	$tempFile = $_FILES[$_GET['filename']]['tmp_name'];
      //  print_r($tempFile);
	$targetPath = $_SERVER['../'] . $targetFolder;
       // print_r($targetPath);
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES[$_GET['filename']]['name'];
	//print_r($targetFile);
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	//print_r($fileParts);
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}

}  catch (Exception $e){
       echo $e->getMessage();
    }

?>