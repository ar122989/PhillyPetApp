<html>
	<head>
		<title>Found Pets</title>
		<meta charset="utf-8" />  
		<meta name="viewport" content="width=device-width, initial-scale=1" /> 
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
		<script type="text/javascript">
			var type = null;
			var breed = null;
			var gender = null;
			var color = null;
			var description = null;
			var foundNear = null;
			var phoneNumber = null;
			var email = null;
			var comments = null;
			var pictureUri = null;
		</script>
	</head>
	<body>
		<?php
			$link = mysql_connect('gingerbreadhousechal.fatcowmysql.com', 'dbaccount1', 'i9d_J3*Jen=Id8'); 

			mysql_select_db(phillypets); 

			$query = mysql_query("SELECT Type, Breed, Gender, Color, Description, Location, Email, PhoneNumber, Comments, PictureURI FROM Pets WHERE Found = 1");
		?>
		<div data-role="page" id="foundPetList">
			<script type="text/javascript">
				$('#foundPetList').on('pageinit', function (){
					$('.foundPet').click(function() {
						type = $(this).find('p').attr('type');
						breed = $(this).find('p').attr('breed');
						gender = $(this).find('p').attr('gender');
						color = $(this).find('p').attr('color');
						description = $(this).find('p').attr('description');
						foundNear = $(this).find('p').attr('foundNear');
						phoneNumber = $(this).find('p').attr('phoneNumber');
						email = $(this).find('p').attr('email');
						comments = $(this).find('p').attr('comments');
						pictureUri = $(this).find('p').attr('pictureUri');
					});
				});
			</script>
			<div data-role="content" role="main">
				
				<ul data-role="listview" data-inset="true">
					<?php
						while($row = mysql_fetch_assoc($query)) {
					?>
						<li data-role="fieldcontain" data-theme="b">
						<a class="foundPet" href="#foundPet">
						<?php
							switch ($row['Type']) {
								case 1:
									$petType = 'Dog';
									break;

								case 2:
									$petType = 'Cat';
									break;

								case 3:
									$petType = 'Bird';
									break;	

								case 4:
									$petType = 'Other';
									break;
							}
							echo '<img src="' . $row['PictureURI'] . '" />';
							echo '<h3>' . $petType . '</h3>';
							echo '<p type="' . $petType . '" breed="' . $row['Breed'] . '" gender="' . $row['Gender'] . '" color="' . $row['Color'] . '"
							description="' . $row['Description'] . '" foundNear="' . $row['Location'] . '" email="' . $row['Email'] . '" phoneNumber="' . $row['PhoneNumber'] . '" 
							comments="' . $row['Comments'] . '" pictureUri="' . $row['PictureURI'] . '" >' . $row['Breed'] . '</p>';
						?>
						</a>
						</li>
					<?php
						}	
					?>
				</ul>
			</div>
		</div>
		<div data-role"page" id="foundPet">
			<script type="text/javascript">
				$('#foundPet').on('pageinit', function (){
					$('#picture').attr('src', pictureUri);
					$('#type').text('Type of Pet: ' + type);
					$('#breed').text('Breed: ' + breed);

					switch(gender) {
						case "0":
							$('#gender').text('Gender: Male');
							break;

						case "1":
							$('#gender').text('Gender: Female');
							break;
					}

					$('#color').text("Color: " + color);
					$('#description').text("Description: " + description);
					$('#foundNear').text("Found near: " + foundNear);
					$('#phoneNumber').text("Phone Number: " + phoneNumber);
					$('#email').text("Email Addresss: " + email);
					$('#comments').text("Comments: " + comments);
				});
			</script>
			<style>
				div.field {
					margin: 10px;
				}
			</style>
			<div data-role="content" role="main">
				<img id="picture" src="" style="width: 130px; height: 130px" />
				<div id="type" class="field">
				</div>
				<div id="breed" class="field">
				</div>
				<div id="gender" class="field">
				</div>
				<div id="color" class="field">
				</div>
				<div id="description" class="field">
				</div>
				<div id="foundNear" class="field">
				</div>
				<div id="phoneNumber" class="field">
				</div>
				<div id="email" class="field">
				</div>
				<div id="comments" class="field">
				</div>
			</div>
		</div>
	</body>
</html>
