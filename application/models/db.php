
<?php

$db = mysql_connect("ordinato.mysql.ukraine.com.ua", "ordinato_petsov", "w67s6u55"); // root - логин, 1234 - пароль к базе данных
mysql_select_db("ordinato_petsov", $db); // test - имя базы данных
mysql_query("SET character_set_results = 'utf8', 
			     character_set_client = 'utf8', 
			     character_set_connection = 'utf8',
			     character_set_database = 'utf8', 
			     character_set_server = 'utf8'", $db);

?>