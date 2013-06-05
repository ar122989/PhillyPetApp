<?php
	$type = $_POST["lpType"];
	$breed = $_POST["lpBreed"];
	$gender = $_POST["lpGender"];
	$color = $_POST["lpColor"];
	$description = $_POST["lpDescription"];
	$location = $_POST["lpLocation"];
	$email = $_POST["lpEmail"];
	$phoneNumber = $_POST["lpPhoneNumber"];
	$comments = $_POST["lpComments"];
	$found = 0;
  
	$info = pathinfo($_FILES['lpImageUpload']['name']);
	$ext = $info['extension']; 
	
	$pictureURI = 'Images/' . uniqid() . '.' . $ext;
	move_uploaded_file($_FILES['lpImageUpload']['tmp_name'], $pictureURI); 
	
	$link = new mysqli('gingerbreadhousechal.fatcowmysql.com', 'dbaccount1', 'i9d_J3*Jen=Id8', 'phillypets'); 
  
  $stmt = $link->prepare("INSERT INTO Pets (Type, Breed, Gender, Color, Description, Location, Email, PhoneNumber, Comments, PictureURI, Found) 
							VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
              
  $stmt->bind_param('isisssssssi', $type, $breed, $gender, $color, $description, $location, $email, $phoneNumber, $comments, $pictureURI, $found);
  
  $stmt->execute();
?>

<script type="text/javascript">
	window.location.href = '/#index';
</script>