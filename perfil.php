<?php
require_once("banco.php");
require_once("tabelas.php");
require_once("verifica_login.php");

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$usuario = $_SESSION['usuario'];

$stmt = $conn->prepare("SELECT * FROM tb_usuario_ppi WHERE id_usuario = :usuario");
$stmt->bindParam(':usuario', $usuario);
$stmt->execute();
$perfil = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT id_usuario, nm_usuario, dt_nascimento, ds_email, ds_senha, is_lgbt, id_genero,
id_cidade, id_tipo_relacionamento FROM tb_usuario_ppi
WHERE id_usuario = :usuario");
$stmt->bindParam(':usuario', $usuario);
$stmt->execute();
$perfil = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['atualizar'])) {
        $novoUser = $_POST['usuario'];
        $stmt = $conn->prepare("UPDATE tb_usuario_ppi SET id_usuario = :usuario WHERE id_usuario = :usuario");
        $stmt->bindParam(':usuario', $novoUser);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        $novoNome = $_POST['nome'];
        $stmt = $conn->prepare("UPDATE tb_usuario_ppi SET nm_usuario = :nome WHERE id_usuario = :usuario");
        $stmt->bindParam(':nome', $novoNome);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        $novoEmail = $_POST['email'];
        $stmt = $conn->prepare("UPDATE tb_usuario_ppi SET ds_email = :email WHERE id_usuario = :usuario");
        $stmt->bindParam(':email', $novoEmail);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        
        $novoGenero = $_POST['genero'];
        $stmt = $conn->prepare("UPDATE tb_usuario_ppi SET id_genero = :genero WHERE id_usuario = :usuario");
        $stmt->bindParam(':genero', $novoGenero);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        header('Location: perfil.php');
        exit();
    }

    if (isset($_POST['excluir'])) {
        $stmt = $conn->prepare("DELETE FROM tb_usuario_interesse_ppi WHERE id_usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM tb_usuario_ppi WHERE id_usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        header('Location: landing.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil - CUPID</title>
    <link rel="stylesheet" href="css/perfil.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
<div id="header">
    <div id="logo">
        <img src="https://images.vexels.com/media/users/3/283687/isolated/preview/6b064c89a89035890e80bd06efe98e60-cupid-illustration-sleeping.png" alt="Cupid Logo">
    </div>
    <h2>CUPID</h2>
</div>

<h1>Seu Perfil</h1>
<form method="post" action="perfil.php">
    <fieldset>
        <legend>Dados pessoais</legend>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $perfil['nm_usuario']; ?>" required><br><br>

        <label for="data">Data de nascimento:</label>
        <input type="date" name="data" id="data" value="<?php echo $perfil['dt_nascimento']; ?>" required><br><br>

        <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" value="<?php echo $perfil['ds_email']; ?>" required><br><br>

        <label for="genero">Gênero:</label>
		<select id="genero" name="genero" value="<?php echo $perfil['genero']; ?>" required>
		<option value="" disabled selected>Selecione</option></select><br><br>

        <p>Você faz parte da comunidade LGBT+?</p>
        <input type="radio" id="sim" name="lgbt" value="sim">
		<label for="sim">Sim</label><br>
		<input type="radio" id="nao" name="lgbt" value="nao">
		<label for="nao">Não</label><br>
        <br><br>

        <input type="submit" name="atualizar" value="Atualizar">
        <input type="submit" name="excluir" value="Excluir Perfil" onclick="return confirm('Tem certeza que deseja excluir seu perfil?');">
    </fieldset>
</form>
</body>
</html>