
<?php

 $con = mysqli_connect('localhost', 'root', '', 'fileupload') or die(mysql_error()); 
if(isset($_POST['submit'])){
	//print_r($_FILES['fileToUpload']);

	$file_name = $_FILES['fileToUpload']['name'];
	$file_type = $_FILES['fileToUpload']['type'];
	$file_tmp_name = $_FILES['fileToUpload']['tmp_name'];
	$file_size = $_FILES['fileToUpload']['size'];

	$file_store = "files/".$file_name;
	 // && ($file_type="image/jpeg"|| $file_type="image/jpg"||$file_type="image/png"||$file_type="image/gif")

	if($file_name!=""){
		 $move= move_uploaded_file($file_tmp_name, $file_store);
		if($move){
			$query = "INSERT INTO images(name, size, type) values('$file_name', '$file_size', '$file_type')" or die(mysql_error());
			   $res= mysqli_query($con, $query);
				if($res){
						echo "file is uploded";
				}else{echo "file not uploded";}
				
		}

	}else{
		echo "File type not mached..!!";
	}

}
		
?>

<!-- <!DOCTYPE html>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery Preview an Image Before it is Uploaded</title>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function previewFile(input){
        var file = $("#id").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
</head> 
<body>
    <form action="confirmation.php" method="post">
        <p>
            <input type="file" id="id" name="photo" onchange="previewFile(this);" required>
        </p>
        <img id="previewImg" src="" alt="Placeholder">
        <p>
            <input type="submit" value="Submit">
        </p>
    </form>
</body>
</html>