<?php
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

$_SESSION ['dados_formulario'] = compact ('nome', 'data_nascimento', 'email', 'genero', 'LGBT', 'usuario', 'senha', 'regiao',
'estado', 'cidade', 'interesses', 'relacionamento', 'biografia');

header ('Location: homepage.php');
exit();
}
else {
	header ('Location: cupid.php');
	exit();
}
?>