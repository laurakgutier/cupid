<?php
require_once("banco.php");
require_once("tabelas.php");
session_start ();

if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$data_nascimento = $_POST['data'];
$email = $_POST['email'];
$genero = $_POST['genero'];
$LGBT = isset ($_POST['LGBT']) ? $_POST['LGBT'] : 'Não especificado';
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$regiao = isset ($_POST['regiao']) ? $_POST['regiao'] : 'Não especificado';
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$interesses = isset ($_POST['interesses']) ? $_POST['interesses'] : [];
$relacionamento = isset ($_POST['relacionamento']) ? $_POST ['relacionamento'] : 'Não especificado';
$biografia = $_POST ['biografia'];


$stmt = $conn->prepare("INSERT INTO tb_pessoa_ppi (nm_pessoa, dt_nascimento, id_genero) VALUES (:nome, :data, :genero)");
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':data', $data);
$stmt->bindParam(':genero', $genero);
$stmt->execute();

header ('Location: homepage.php');
exit();
}
else {
	header ('Location: cupid.php');
	exit();
}
?>