<?php
// folder penenmapatan untuk file yang diupload bisa disesuaikan
// selama php bisa membaca folder tersebut
$uploadDir = 'file/';
if (isset($_POST['upload'])) {
   	 $fileName = $_FILES['userfile']['name']; 
   	 $tmpName = $_FILES['userfile']['tmp_name'];
   	 $fileSize = $_FILES['userfile']['size'];
     $fileType = $_FILES['userfile']['type']; 
   	 $filePath = $uploadDir . $fileName; 
   	 $result = move_uploaded_file($tmpName, $filePath);
    	if (!$result) {
        	echo "Error uploading file";
        	exit;
    	}
    	include 'koneksi_db.php';
    	if (!get_magic_quotes_gpc()) {
        	$fileName = addslashes($fileName);
        	$filePath = addslashes($filePath);
    	}
$query = "INSERT INTO upload(name, size, type, path ) VALUES('$fileName', '$fileSize', '$fileType', '$filePath')";

mysqli_query($conn,$query) or die('Error, query failed : ' . mysqli_error());
    	include 'close_db.php';
    	echo "<br>File uploaded<br>";
}
?>

<!DOCTYPE html>
<head>
    <body>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="userfile" id="fileToUpload">
            <input type="submit" value="Upload" name="upload">
        </form>
    </body>
</head>

