<?php
require_once("banco.php");
require_once("tabelas.php");
  session_start ();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "css/homepage.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <div id="header">
        <div id="logo">
            <img src="https://images.vexels.com/media/users/3/283687/isolated/preview/6b064c89a89035890e80bd06efe98e60-cupid-illustration-sleeping.png" alt = "Cupid Logo">
        </div>
        <h2>CUPID</h2>
        </div>
		<header>
		<?php
		echo "<h1>Bem vindo/a ao Cupid!</h1>";
		?>
    <p> Seu cadastro foi recebido com sucesso! <br> Por favor, faça login. </p>
	<button id="login">Login</button>
	</header>
    <script>
        document.getElementById("login").addEventListener("click", function(){
            window.location.href = "login.php";
        });
    </script>
</body>
</html>