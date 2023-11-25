<?php
  session_start ();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title> Cadastro CUPID </title>
        <link rel = "stylesheet" href = "css/cupid.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Pacifico&display=swap" rel="stylesheet">
    </head>
	<body>
	    <div id="header">
        <div id="logo">
            <img src="https://images.vexels.com/media/users/3/283687/isolated/preview/6b064c89a89035890e80bd06efe98e60-cupid-illustration-sleeping.png" alt = "Cupid Logo">
        </div>
        <h2>CUPID</h2>
        </div>
        <h1>Faça o seu cadastro para continuar</h1>
        <form method="post" action = "processar_formulario.php">
		<?php
		require_once("banco.php");
        require_once("tabelas.php");
		
		$genero = db_genero_select ();
		
		$regiao = db_regiao_select ();
		
		$interesses = db_interesses_select ();
	
		$relacionamento = db_relacionamento_select ();
		
		$estado = db_estado_select ();
		
		$cidade = db_cidade_select();

	
function regioes($nome, $dados){
	$html="";
	for ($i=0; $i<=count($dados)-1; $i++){
		$html.= "<label for=\"${nome}_" . $dados[$i][0] . "\">" .$dados[$i][1] . "</label>\n";
	    $html.="<input type=\"radio\" name=\"$nome\" value=\"" .$dados[$i][0]. "\" id=\"${nome}_" .
	    $dados[$i][0]. "\">\n";
    }
	return $html;
}

function regiao(){
	global $regiao;
	return regioes("regiao", $regiao);
}
	
	function checkbox_interesse($nome, $dados){
	global $interesses;
	$html="";
	for ($i=0; $i<=count($dados)-1; $i++){
		$html.= "<label for=\"${nome}_" . $dados[$i][0] . "\">" .$dados[$i][1] . "</label>\n";
	    $html.="<input type=\"checkbox\" name=\"$nome\" value=\"" .$dados[$i][0]. "\" id=\"${nome}_" .
	    $dados[$i][0]. "\">\n";
    }
	return $html;
}

function checkbox_interesses(){
	global $interesses;
	return checkbox_interesse("interesses", $interesses);
}

function radio_relacionamentos($nome, $dados){
	global $relacionamento;
	$html="";
	for ($i=0; $i<=count($dados)-1; $i++){
		$html.= "<label for=\"${nome}_" . $dados[$i][0] . "\">" .$dados[$i][1] . "</label>\n";
	    $html.="<input type=\"radio\" name=\"$nome\" value=\"" .$dados[$i][0]. "\" id=\"${nome}_" .
	    $dados[$i][0]. "\">\n";
    }
	return $html;
}

function radio_relacionamento(){
	global $relacionamento;
	return radio_relacionamentos("relacionamento", $relacionamento);
}


	?>
		
            <fieldset>
                <legend> Dados pessoais </legend>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required"><br><br>

                <label for="data">Data de nascimento:</label>
                <input type="date" name="data" id="data" required><br><br>

                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required><br><br>

                <label for="genero">Gênero:</label>
				<select id="genero" name="genero" required>
				<option value="" disabled selected>Selecione</option>
                <?php
				foreach ($genero as $option){
					$value = $option[0];
					$label = $option[1];
					echo "<option value = '$value'>$label</option>";
				}
				?>
				</select>
				<br>
                <br>
                <p>Você faz parte da comunidade LGBT+?</p>
                <input type="radio" id="sim" name="lgbt" value="sim">
				<label for="sim">Sim</label><br>
				<input type="radio" id="nao" name="lgbt" value="nao">
				<label for="nao">Não</label><br>
                <br><br>
                <p>Crie um nome de usuário:</p>
                <label for="usuario">Usuário:</label>
                <input type="text" name="usuario" id="usuario" required maxlength="30">
                <br><br>
                <p>Crie uma senha forte:</p>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" maxlength="20">
            </fieldset><br>
            <fieldset>
                <legend>Região</legend>
                <?php
				echo regiao ();
				?>
                <br><br>
                <label for="estado">Informe seu estado:</label>
				<select id="estado" name="estado" required>
				<option value="" disabled selected>Selecione</option>

				<?php
				foreach ($estado as $option){
					$value = $option[0];
					$label = $option[1];
					echo "<option value = '$value'>$label</option>";
				}
				?> </select>
                <br><br>
                <label for="cidade">Informe sua cidade:</label>
                <select id="cidade" name="cidade" required>
				<option value="" disabled selected>Selecione</option>
				
				<?php
				foreach ($cidade as $option){
					$value = $option[0];
					$label = $option[1];
					echo "<option value = '$value'>$label</option>";
				}
				?> </select>
				
            </fieldset><br>
            <fieldset>
                <legend> Interesses </legend>
                <p>Selecione seus hobbies.</p>
				<?php
				echo checkbox_interesses();
				?>
                
                <br><br>
                <p>Que tipo de relacionamento procura?</p>
                <?php
				echo radio_relacionamento();
				?>
            </fieldset><br>
            <fieldset>
                <legend>Sobre você</legend>
                <label for="biografia">Escreva sua biografia:</label><br>
                <textarea id="biografia" name="biografia" rows="4" cols="30"></textarea>
            </fieldset><br>

            <input type="submit" value="Enviar">
            <input type="reset" value="Limpar tudo">
        </form>
    </body>
</html>
