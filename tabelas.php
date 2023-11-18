<?php
function db_genero_select(){
	global $conn;
	$sth = $conn->prepare("SELECT * FROM TB_GENERO_PPI");
	$sth->execute();
	return $sth->fetchAll();
}

function db_regiao_select(){
	global $conn;
	$sth = $conn->prepare("SELECT * FROM TB_REGIAO_PPI");
	$sth->execute();
	return $sth->fetchAll();
}

function db_interesses_select(){
	global $conn;
	$sth = $conn->prepare("SELECT * FROM TB_INTERESSE_PPI");
	$sth->execute();
	return $sth->fetchAll();
}

function db_relacionamento_select(){
	global $conn;
	$sth = $conn->prepare("SELECT * FROM TB_TIPO_RELACIONAMENTO_PPI");
	$sth->execute();
	return $sth->fetchAll();
}
?>