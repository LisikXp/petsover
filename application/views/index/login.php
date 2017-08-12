<?
/**
  * Страница авторизации пользователей. Предполагается, 
  * что в вашей базе данных присутствует таблица users,
  * в которой существуют поля id, login и password
  */
// Подлючаем файл с пользовательскими функциями


if(isset($_SESSION['user_id'])){header('location: portfolio?id='.$_SESSION['user_id']);} // =====> Если авторизирован - выполняем переход
include "enter.php"
?>
<html>
<head>
	<title>Авторизация пользователей</title>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<meta property="og:url"           content="http://petsoverload.yaskravo.net/" />
	<meta property="og:type"          content="petsoverload" />
	<meta property="og:title"         content="petsoverload" />
	<meta property="og:description"   content="Your description" />
	<meta property="og:image"         content="http://petsoverload.yaskravo.net/img/posts/Blueberries_waterdrops.jpg" />


	<link href="style.css" rel="stylesheet" type="text/css" />
	<script>
		window.onload = function() {
			document.getElementById('email').ontextInput = function() {
				alert(this.data);
			},
			focus = function() {
				alert("ok");
			}
			;
		};
	</script>

</head>
<body>
	<?
// Если запущен процесс авторизации, но она не была успешной,
// или же авторизация еще не запущена, отображаем форму авторизации
	if($auth !== true) {
		?>
		<!-- Блок для вывода сообщений об ошибках -->
		<div id="full_error" class="error" style="display:
		<?
		echo $errors['full_error'] ? 'inline-block' : 'none';
		?>
		;">
		<?
	// Выводим сообщение об ошибке, если оно есть
		echo $errors['full_error'] ? $errors['full_error'] : '';
		?>
	</div>
	<form action="" method="post">
		<div class="row">
			<label for="email">Ваш email:</label>
			<input type="email" class="text" name="email" id="email" />
		</div>
		<div class="row">
			<label for="password">Ваш пароль:</label>
			<input type="password" class="text" name="password" id="password" />
		</div>
		<div class="row">
			<input type="submit" name="authorize" id="btn-submit" value="Авторизоваться" />
		
		</div>
	</form>
	<?
}	// Закрывающая фигурная скобка условного оператора проверки успешной авторизации
// Иначе выводим сообщение об успешной авторизации
else {
	print $message;
}

/**
  * Если всё правильно, будет выведено сообщение об успешной авторизации,
  * пользователь будет переадресован на защищенную страницу
  */
?>

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.9&appId=889490487857628";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your share button code -->
<div class="fb-share-button" data-href="http://petsoverload.yaskravo.net/img/posts/Blueberries_waterdrops.jpg" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Поделиться</a></div>



<a href="https://plus.google.com/share?url=http://petsoverload.yaskravo.net/img/posts/Blueberries_waterdrops.jpg" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
  src="https://www.gstatic.com/images/icons/gplus-32.png" alt="Share on Google+"/></a>
  <a href="registration">Sign Up</a>
</body>
</html>