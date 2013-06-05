<?php
  ini_set('memory_limit', -1);
  
	$type = $_POST["lpType"];
	$breed = $_POST["lpBreed"];
	$gender = $_POST["lpGender"];
	$color = $_POST["lpColor"];
	$description = $_POST["lpDescription"];
	$location = $_POST["lpLocation"];
	$email = $_POST["lpEmail"];
	$phoneNumber = $_POST["lpPhoneNumber"];
	$comments = $_POST["lpComments"];
  $pictureURI = "";
	$found = 0;
  
  if(!empty($_FILES['lpImageUpload']['name'])){
	  $info = pathinfo($_FILES['lpImageUpload']['name']);
	  $ext = $info['extension']; 
	
	  $pictureURI = 'Images/' . uniqid() . '.' . $ext;
  
    list($width, $height) = getimagesize($_FILES['lpImageUpload']['tmp_name']);

    // Get new dimensions
    $new_width = 130;
    $new_height = 130;

    // Resample
    $image_p = imagecreatetruecolor($new_width, $new_height);
    $image = imagecreatefromjpeg($_FILES['lpImageUpload']['tmp_name']);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    imagedestroy($image);

    // Output
    imagejpeg($image_p, $pictureURI, 100);
	
    imagedestroy($image_p);
  }
  
	$link = new mysqli('gingerbreadhousechal.fatcowmysql.com', 'dbaccount1', 'i9d_J3*Jen=Id8', 'phillypets'); 
  
  $stmt = $link->prepare("INSERT INTO Pets (Type, Breed, Gender, Color, Description, Location, Email, PhoneNumber, Comments, PictureURI, Found) 
							VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
              
  $stmt->bind_param('isisssssssi', $type, $breed, $gender, $color, $description, $location, $email, $phoneNumber, $comments, $pictureURI, $found);
  
  $stmt->execute();
?>

<script type="text/javascript">
  window.location.href = '/#index';
</script>