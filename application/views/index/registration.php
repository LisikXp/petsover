<?php
require_once $_SERVER['DOCUMENT_ROOT']. "/application/models/functions.php";
// echo 'Name: ' . $user->getName();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<meta charset="utf-8" />
	<meta name="description" content="" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="libs/js/common.js"></script>
	<link rel='stylesheet' href='/css/style.css' />
	<script>
		$( function() {
			$("#datepicker").datepicker({
				dateFormat:'d-m-yy'
			});

			function readURL(input) { /* превью картинки*/

				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#image').attr('src', e.target.result);

					};

					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#userfile").change(function(){
				readURL(this);
			});
		} );
	</script>
</head>
<body>

	<form action="" method="POST">
		<div class="row">
			<input type="text" class="text" name="name" id="name" placeholder="Your name" /><br>
			<input type="text" class="text" name="email" id="email" placeholder="Email adress" /><br>
			<input type="password" class="text" name="password" id="password" placeholder="Password" /><br>
			<input type="text" name="location" placeholder="Your location">
		</div>
		<div class="row">
			<input name="reg" type="submit" value="Created free account" />
		</div>
	</form>
	<?php
 if(isset($_SESSION['msg'])){ //  Если есть ОШИБКА
    echo $_SESSION['msg']; // ВЫВОДИМ
    unset ($_SESSION['msg']);} 
    ?>


</body>
</html>
