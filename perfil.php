<?php
require_once("banco.php");
require_once("tabelas.php");
require_once("verifica_login.php");

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$usuario = $_SESSION['usuario'];

$stmt = $conn->prepare("SELECT id_usuario, nm_usuario, dt_nascimento, ds_email, ds_senha, is_lgbt, id_genero,
id_cidade, id_tipo_relacionamento FROM tb_usuario_ppi
WHERE id_usuario = :usuario");
$stmt->bindParam(':usuario', $usuario);
$stmt->execute();
$perfil = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM tb_usuario_interesse_ppi WHERE id_usuario = :usuario");
$stmt->bindParam(':usuario', $usuario);
$stmt->execute();
$interessesDoUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

        $novaData = $_POST['data'];
        $stmt = $conn->prepare("UPDATE tb_usuario_ppi SET dt_nascimento = :data WHERE id_usuario = :usuario");
        $stmt->bindParam(':data', $novaData);
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

        $novaSenha = $_POST['senha'];
        $stmt = $conn->prepare("UPDATE tb_usuario_ppi SET ds_senha = :senha WHERE id_usuario = :usuario");
        $stmt->bindParam(':senha', $novaSenha);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        $novoLGBT = $_POST['lgbt'];
        $stmt = $conn->prepare("UPDATE tb_usuario_ppi SET is_lgbt = :lgbt WHERE id_usuario = :usuario");
        $stmt->bindParam(':lgbt', $novoLGBT);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        $novaCidade = $_POST['cidade'];
        $stmt = $conn->prepare("UPDATE tb_usuario_ppi SET id_cidade = :cidade WHERE id_usuario = :usuario");
        $stmt->bindParam(':cidade', $novaCidade);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        $novosInteresses = $_POST['interesses'] ?? [];
        $stmt = $conn->prepare("DELETE FROM tb_usuario_interesse_ppi WHERE id_usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        foreach ($novosInteresses as $interesse) {
            $stmt = $conn->prepare("INSERT INTO tb_usuario_interesse_ppi (id_usuario, id_interesse) VALUES (:usuario, :interesse)");
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':interesse', $interesse);
            $stmt->execute();
        }

        $novoRelacionamento = $_POST['relacionamento'] ?? '';
        $stmt = $conn->prepare("UPDATE tb_usuario_ppi SET id_tipo_relacionamento = :relacionamento WHERE id_usuario = :usuario");
        $stmt->bindParam(':relacionamento', $novoRelacionamento);
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
        header('Location: index.php');
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
    <div id="menu">
  <nav>
    <a href="feed.php">Feed</a>
    <a class="link" onclick="return sair()" href="logout.php">Sair</a>
  </nav>
</div>
</div>

<h1>Seu Perfil</h1>
<form method="post" action="processa_perfil.php">
    <fieldset>
        <legend>Dados pessoais</legend>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $perfil['nm_usuario']; ?>" required><br><br>

        <label for="data">Data de nascimento:</label>
        <input type="date" name="data" id="data" value="<?php echo $perfil['dt_nascimento']; ?>" required><br><br>

        <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" value="<?php echo $perfil['ds_email']; ?>" required><br><br>

        <label for="genero">Gênero:</label>
        <select id="genero" name="genero" required>
    <option value="" disabled>Selecione</option>
    <?php
    $generos = db_genero_select();

    foreach ($generos as $option) {
        $value = $option['id_genero'];
        $label = $option['nm_genero'];

        $selected = ($perfil['id_genero'] === $value) ? 'selected' : '';

        echo "<option value='$value' $selected>$label</option>";
    }
    ?>
</select>
        
        <p>Você faz parte da comunidade LGBT+?</p>
        <input type="radio" id="sim" name="lgbt" value="sim" <?php if ($perfil['is_lgbt'] === 'sim') echo 'checked'; ?>>
		<label for="sim">Sim</label><br>
		<input type="radio" id="nao" name="lgbt" value="nao" <?php if ($perfil['is_lgbt'] === 'nao') echo 'checked'; ?>>
		<label for="nao">Não</label><br>
        
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" id="usuario" value="<?php echo $perfil['id_usuario']; ?>" required maxlength="30">
        <br><br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" value="<?php echo $perfil['ds_senha']; ?>"required maxlength="20">
        </fieldset><br>
        <fieldset>
                <legend>Localização</legend>
                <label for="cidade">Cidade:</label>
                <select id="cidade" name="cidade" required>
				<option value="" disabled selected>Selecione</option>
				<?php
                $cidades = db_cidade_select();

                foreach ($cidades as $option) {
                    $value = $option['id_cidade'];
                    $label = $option['nm_cidade'];

                    $selected = ($perfil['id_cidade'] === $value) ? 'selected' : '';

                    echo "<option value='$value' $selected>$label</option>";
                }
                ?>
                </select>
            </fieldset><br>
            <fieldset>
                <legend> Interesses </legend>
                <p>Seus hobbies.</p>
				<?php
                $interessesDisponiveis = db_interesses_select();

                foreach ($interessesDisponiveis as $interesse) {
                    $checked = '';
                    foreach ($interessesDoUsuario as $int) {
                        if ($int['id_interesse'] === $interesse['id_interesse']) {
                            $checked = 'checked';
                            break;
                        }
                    }

                    echo "<label for=\"interesse_{$interesse['id_interesse']}\">{$interesse['ds_interesse']}</label>";
                    echo "<input type=\"checkbox\" name=\"interesses[]\" value=\"{$interesse['id_interesse']}\" id=\"interesse_{$interesse['id_interesse']}\" $checked>";
                    echo "<br>";
                }
                ?>
                <br><br>
                <p>Tipo ideal de relacionamento</p>
                <?php
                $tiposRelacionamento = db_relacionamento_select();

                foreach ($tiposRelacionamento as $relacionamento) {
                    $checked = ($perfil['id_tipo_relacionamento'] === $relacionamento['id_tipo_relacionamento']) ? 'checked' : '';
            
                    echo "<input type=\"radio\" id=\"relacionamento_{$relacionamento['id_tipo_relacionamento']}\" name=\"relacionamento\" value=\"{$relacionamento['id_tipo_relacionamento']}\" $checked>";
                    echo "<label for=\"relacionamento_{$relacionamento['id_tipo_relacionamento']}\">{$relacionamento['ds_tipo_relacionamento']}</label><br>";
                }				
				?>
            </fieldset><br>

        <input type="submit" name="atualizar" value="Atualizar">
        <input type="submit" name="excluir" value="Excluir Perfil" onclick="return confirm('Tem certeza que deseja excluir seu perfil?');">
    </fieldset>
</form>
</body>
</html>