<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>A-Group Clinics & Apteks</title>

	<link rel="stylesheet" href="./style/style.css">
</head>

<body>
<style>
		.red_color{
			color: #BE2A2A;
			font-weight: 600;
		}
		.link a{
			display: block;
			width: 100%;
			height: 100%;
			color: #3e4953;
		}
	</style>


	<div class="main__wrapper">
		<div class="main__header">
			<div class="main__header__logo">
				<img src="./style/Logo.svg" alt="" srcset="">
			</div>

			<div class="main__header__name">
				<p>
					A-Qroup Sığorta şirkəti
				</p>
			</div>
		</div>

		<div class="container">
			<!-- Tab links -->
			<div class="tab">
		
				<h1 class="tablinks  red_color" >
				Optikalar
				</h1>		
			</div>

			<!-- Tab content -->
			<div id="clinics" class="tabcontent">
				<div class="elements__wrapper">

				<?php
				$connection = mysqli_connect('localhost', 'root', 'plo234hshjnjsaf23', 'clinics');
				$query = "SELECT * FROM `optiks` ORDER BY `id`;";

				$all_clinics = mysqli_query($connection, $query);


				while ($row = mysqli_fetch_assoc($all_clinics)) {
					$clinic_id = $row['id'];
					$clinic_name = $row['name'];
					$clinic_adress = $row['adress'];
					$clinic_phone = $row['phone'];
					$clinic_location1 = $row['location_1'];
					$clinic_location2 = $row['location_2'];
					?>

						<div class="elements_element">
							<div class="elements_element__container">
								<div class="elements_element_name">
									<p><?php echo $clinic_name ?></p>
								</div>
								<div class="elements_element_adress">
									<p>
									<?php echo $clinic_adress ?>
									</p>
								</div>
								<div class="elements_element_number">
									<p id="phoneNUmber">
									<?php echo $clinic_phone ?>
									</p>
								</div>
							</div>
							<div class="elements_element__location">
								 <a target="_blank" href="<?php echo "https://www.google.com/maps?q=".$clinic_location1.",".$clinic_location2."" ?>">
									<img src="https://a-group.az/storage/uploaded_files/jpn8/location.png" alt="">
								</a>
							</div>
						</div>
					<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>





	<script>
		const paragraphs = document.querySelectorAll('#phoneNUmber');

paragraphs.forEach(paragraph => {
	if(paragraph.textContent != ""){
// Get the text content of the <p> element
const phoneNumber = paragraph.textContent.trim();
	// Split the phone number into two parts
	const parts = phoneNumber.split(' ');
	const countryCode = parts.shift(); // Remove the first part (country code)
	
	const numberCode = parts.shift();
	// Format the country code with parentheses
	const formattedCountryCode = `(+${countryCode} ${numberCode})`;

	// Join the remaining parts back together
	const restOfNumber = parts.join(' ');

	// Combine the formatted country code and the rest of the number
	const formattedPhoneNumber = `${formattedCountryCode} ${restOfNumber}`;
	paragraph.textContent = formattedPhoneNumber;};
});

	</script>
</body>

</html>