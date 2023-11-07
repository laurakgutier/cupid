<?php
function db_genero_select(){
	global $conn;
	$sth = $conn->prepare("SELECT * FROM TB_GENERO_PPI");
	$sth->execute();
	return $sth->fetchAll();
}
?>