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


$stmt = $conn->prepare("INSERT INTO tb_pessoa_ppi (nm_pessoa, dt_nascimento, id_genero) VALUES (:nome, :data, :genero)");
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':data', $data_nascimento);
$stmt->bindParam(':genero', $genero);
$stmt->execute();

$id_pessoa = $conn->lastInsertId();

$stmt = $conn->prepare("INSERT INTO tb_usuario_ppi (id_usuario, id_pessoa, is_LGBT, id_cidade, id_tipo_relacionamento) VALUES
						(:usuario, :id_pessoa, :LGBT, :cidade, :relacionamento)");
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':id_pessoa', $id_pessoa);
$stmt->bindParam(':LGBT', $LGBT);
$stmt->bindParam(':cidade', $cidade);
$stmt->bindParam(':relacionamento', $relacionamento);
$stmt->execute();

$stmt = $conn->prepare("INSERT INTO tb_usuario_interesse_ppi (id_usuario, id_interesse) VALUES (:usuario, :interesses)");
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':interesses', $interesses);
$stmt->execute();

$stmt = $conn->prepare("INSERT INTO tb_login_ppi (id_usuario, ds_email, ds_senha) VALUES (:usuario, :email, :senha)");
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);
$stmt->execute();


header ('Location: homepage.php');
exit();
}
else {
	header ('Location: cupid.php');
	exit();
}
?>