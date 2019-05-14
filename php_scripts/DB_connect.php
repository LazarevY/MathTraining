<?php

define ('HOST',			"localhost");
define ('DB_USER',		"root");
define ('DB_PASSWORD',		"");
define ('DB',			"users_base");


    $db = mysqli_connect (HOST, DB_USER, DB_PASSWORD,DB);
//	if(!$db){
//		echo "Ошибка подключения\n";
//	}else{
//		echo "Есть контакт с базой\n";
//	}
//    ?>