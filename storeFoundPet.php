<?php
	$type = htmlentities($_POST["fpType"]);
	$breed = htmlentities($_POST["fpBreed"]);
	$gender = htmlentities($_POST["fpGender"]);
	$color = htmlentities($_POST["fpColor"]);
	$description = htmlentities($_POST["fpDescription"]);
	$location = htmlentities($_POST["fpLocation"]);
	$email = htmlentities($_POST["fpEmail"]);
	$phoneNumber = htmlentities($_POST["fpPhoneNumber"]);
	$comments = htmlentities($_POST["fpComments"]);
	$found = 1;
  
	$info = pathinfo($_FILES['fpImageUpload']['name']);
	$ext = $info['extension']; 
	
	$pictureURI = 'Images/' . uniqid() . '.' . $ext;
	move_uploaded_file($_FILES['fpImageUpload']['tmp_name'], $pictureURI); 
	
	$link = new mysqli('gingerbreadhousechal.fatcowmysql.com', 'dbaccount1', 'i9d_J3*Jen=Id8', 'phillypets'); 
  
  $stmt = $link->prepare("INSERT INTO Pets (Type, Breed, Gender, Color, Description, Location, Email, PhoneNumber, Comments, PictureURI, Found) 
							VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
              
  $stmt->bind_param('isisssssssi', $type, $breed, $gender, $color, $description, $location, $email, $phoneNumber, $comments, $pictureURI, $found);
  
  $stmt->execute();
?>

<script type="text/javascript">
	window.location.href = '/#index';
</script>