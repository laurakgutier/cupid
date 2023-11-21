<?php
require_once("banco.php"); 
session_start();
if (isset($_GET['erro'])) {
    $erro = $_GET['erro'];
    if ($erro === 'credenciais') {
        echo '<script>alert("Nome de usuário ou senha incorretos. Tente novamente.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cupid login</title>
    <link rel = "stylesheet" href = "css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
<div id="header">
        <div id="logo">
            <img src="https://images.vexels.com/media/users/3/283687/isolated/preview/6b064c89a89035890e80bd06efe98e60-cupid-illustration-sleeping.png" alt = "Cupid Logo">
        </div>
        <h2>CUPID</h2>
 </div>
    <h1>Faça seu login ou cadastre-se</h1>
    <form method="post" action="processar_login.php">
        <label for="username">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="password">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <input type="submit" value="Entrar">
		<button id = "cadastro">Não tenho uma conta</button>
		<script>
        document.getElementById("cadastro").addEventListener("click", function(){
            window.location.href = "cupid.php";
        });
    </script>
    </form>
</body>
</html>