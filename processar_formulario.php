<?php
require_once("banco.php");
require_once("tabelas.php");
session_start ();

if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$data_nascimento = $_POST['data'];
$email = $_POST['email'];
$genero = $_POST['genero'];
$LGBT = ($_POST['lgbt'] === 'sim') ? true : false;
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$regiao = isset ($_POST['regiao']) ? $_POST['regiao'] : 'Não especificado';
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$interesses = isset ($_POST['interesses']) ? $_POST['interesses'] : [];
$relacionamento = isset ($_POST['relacionamento']) ? $_POST ['relacionamento'] : 'Não especificado';


$stmt = $conn->prepare("INSERT INTO tb_pessoa_ppi (nm_pessoa, dt_nascimento, id_genero) VALUES (:nome, :data, :genero)");
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':data', $data_nascimento);
$stmt->bindParam(':genero', $genero);
$stmt->execute();

$id_pessoa = $conn->lastInsertId();

$stmt = $conn->prepare("INSERT INTO tb_cidade_ppi (nm_cidade, id_estado) VALUES (:cidade, :estado)");
$stmt->bindParam(':cidade', $cidade);
$stmt->bindParam(':estado', $estado);
$stmt->execute();

$id_cidade = $conn->lastInsertId();

$stmt = $conn->prepare("INSERT INTO tb_usuario_ppi (id_usuario, id_pessoa, fl_LGBT, id_cidade, id_tipo_relacionamento) VALUES
						(:usuario, :id_pessoa, :LGBT, :id_cidade, :relacionamento)");
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':id_pessoa', $id_pessoa);
$stmt->bindParam(':LGBT', $LGBT, PDO::PARAM_STR);
$stmt->bindParam(':id_cidade', $id_cidade);
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