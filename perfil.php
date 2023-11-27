<?php
require_once("banco.php");
require_once("tabelas.php");
session_start();

// Verifica se o usuário está logado, caso contrário redireciona para a página de login
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

// Obtém o ID do usuário logado
$usuario = $_SESSION['usuario'];

// Realiza a consulta para obter os dados do perfil
$stmt = $conn->prepare("SELECT * FROM tb_usuario_ppi WHERE id_usuario = :usuario");
$stmt->bindParam(':usuario', $usuario);
$stmt->execute();
$perfil = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT A.id_pessoa, nm_pessoa, id_genero, id_usuario, is_lgbt, id_cidade, id_tipo_relacionamento
FROM tb_pessoa_ppi A, tb_usuario_ppi B
WHERE A.id_pessoa = B.id_pessoa");
$stmt->bindParam(':id_pessoa', $id_pessoa);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':genero', $genero);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':lgbt', $LGBT);
$stmt->bindParam(':cidade', $cidade);
$stmt->bindParam(':relacionamento', $relacionamento);
$stmt->execute();
$perfil = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['atualizar'])) {
        $novoNome = $_POST['nome'];
        $stmt = $conn->prepare("UPDATE tb_pessoa_ppi SET nm_pessoa = :nome WHERE id_usuario = :usuario");
        $stmt->bindParam(':nome', $novoNome);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        header('Location: perfil.php');
        exit();
    }

    if (isset($_POST['excluir'])) {
        $stmt = $conn->prepare("DELETE FROM tb_pessoa_ppi WHERE id_usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        header('Location: landing page.php');
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
        <input type="text" name="nome" id="nome" value="<?php echo $perfil['nm_pessoa']; ?>" required><br><br>

        <input type="submit" name="atualizar" value="Atualizar">
        <input type="submit" name="excluir" value="Excluir Perfil" onclick="return confirm('Tem certeza que deseja excluir seu perfil?');">
    </fieldset>
</form>
</body>
</html>