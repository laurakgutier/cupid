<?php
require_once("banco.php");
require_once("tabelas.php");
session_start ();

if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
$nome = $_POST['nome'] ?? '';
$data_nascimento = $_POST['data'] ?? '';
$email = $_POST['email'] ?? '';
$genero = $_POST['genero'] ?? '';
$LGBT = $_POST['lgbt'] ?? '';
$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';
$estado = $_POST['estado'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$interesses = $_POST['interesses'] ?? [];
$relacionamento = $_POST ['relacionamento'] ?? '';


$stmt = $conn->prepare("INSERT INTO tb_usuario_ppi (id_usuario, nm_usuario, dt_nascimento, ds_email,
ds_senha, is_lgbt, id_genero, id_cidade, id_tipo_relacionamento)
VALUES (:usuario, :nome, :data, :email, :senha, :LGBT, :genero, :cidade, :relacionamento)");
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':data', $data_nascimento);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);
$stmt->bindParam(':LGBT', $LGBT);
$stmt->bindParam(':genero', $genero);
$stmt->bindParam(':cidade', $cidade);
$stmt->bindParam(':relacionamento', $relacionamento);
$stmt->execute();

$stmtInteresse = $conn->prepare("INSERT INTO tb_usuario_interesse_ppi (id_usuario, id_interesse) VALUES (:usuario, :interesse)");

foreach ($_POST['interesses'] as $interesse) {
    $stmtInteresse->bindParam(':usuario', $usuario);
    $stmtInteresse->bindParam(':interesse', $interesse);
    $stmtInteresse->execute();
}

    header('Location: ../site/login.php?success=true');
    exit();
} else {
    header('Location: ../site/formulario.php?error=true');
    exit();
}
?>