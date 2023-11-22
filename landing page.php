<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cupid</title>
	<link rel = "stylesheet" href = "css/landing.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <div id="header">
        <div id="logo">
            <img src="https://images.vexels.com/media/users/3/283687/isolated/preview/6b064c89a89035890e80bd06efe98e60-cupid-illustration-sleeping.png" alt = "Cupid Logo">
        </div>
        <h2>CUPID</h2>
        </div>
    <header>
        <h1>Bem-vindo ao Cupid</h1>
        <p>Encontre o amor da sua vida com o Cupid, o melhor site de relacionamentos.</p>
        <button id="formulario">Cadastre-se</button>
		<button id="entrar">Entrar</button>
    </header>
    <script>
        document.getElementById("formulario").addEventListener("click", function(){
            window.location.href = "cupid.php";
        });
		document.getElementById("entrar").addEventListener("click", function(){
            window.location.href = "login.php";
        });
    </script>
    <section>
        <h3>Recursos do Cupid</h3>
        <ul>
            <li>Conheça pessoas incríveis</li>
            <li>Chat ao vivo</li>
            <li>Perfil personalizado</li>
            <li>Combinações baseadas em interesses</li>
        </ul>
    </section>
    
</body>
</html>
