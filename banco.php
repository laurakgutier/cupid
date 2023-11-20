<?php

//$bd_host = "192.168.20.18";
$bd_host = "200.19.1.18";
$sgbd = "pgsql";
$base_de_dados = "lauragutier";
$bd_usuario = "lauragutier";
$bd_senha = "123456";

		try {
			$dsn_pgsql = "pgsql:host=$bd_host;port=5432;dbname=$base_de_dados;";
			// make a database connection
			$conn = new PDO(
				$dsn_pgsql,
				$bd_usuario,
				$bd_senha,
				[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
			);
		} catch (PDOException $e) {
			die($e->getMessage());
		}

?>
