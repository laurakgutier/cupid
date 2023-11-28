<?php
require_once("banco.php");
session_start();

if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM tb_login_ppi WHERE id_usuario = :usuario AND ds_senha = :senha");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) === 1) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['logado'] = true;
        header('Location: feed.php');
        exit();
    } else {
        header('Location: login.php?erro=credenciais');
        exit();
    }
}
?>
