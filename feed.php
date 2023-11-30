<?php
require_once("verifica_login.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Feed - CUPID</title>
  <link rel = "stylesheet" href = "css/feed.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
<div id="header">
  <div id="logo">
    <img src="https://images.vexels.com/media/users/3/283687/isolated/preview/6b064c89a89035890e80bd06efe98e60-cupid-illustration-sleeping.png" alt = "Cupid Logo">
  </div>
  <h2>CUPID</h2>
  <div id="menu">
  <nav>
    <a href="perfil.php">Perfil</a>
    <a class="link" onclick="return sair()" href="logout.php">Sair</a>
  </nav>
</div>
</div>
<script>
function sair() {
    if (confirm('Tem certeza que deseja sair?')) {
        return true;
    } else {
        return false;
    }
}
</script>
<div id = "feed">
  <div id="class-container">
    <div class="card">
      <img src="https://www.cnnbrasil.com.br/wp-content/uploads/sites/12/2023/09/anitta-fala-sobre-golpe-em-ultimo-romance.jpg?w=1200&h=900&crop=1" alt="Imagem 1">
      <h3>Larissa</h3>
      <p>Em busca de novas amizades</p>
    </div>
    <div class="card">
      <img src="https://i.scdn.co/image/ab6761610000e5ebbadd159b5a79377deefa6336" alt="Imagem 2">
      <h3>João Vitor</h3>
      <p>Procurando namoro</p>
    </div>
    <div class="card">
      <img src="https://img.wattpad.com/3442a5f63e3755ac454d1ce68aaf3514095a6d40/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f30494f5a7a6331556e774d7644513d3d2d3239393236303138312e313436623666383536346566333164323638373234393334333238312e6a7067?s=fit&w=720&h=720" alt="Imagem 3">
      <h3>Gabriel</h3>
      <p>Procura relacionamento aberto</p>
    </div>
    <div class="card">
      <img src="https://assets.vogue.in/photos/60f919551cd7c4573a592a89/1:1/w_899,h_899,c_limit/SZA.jpeg" alt="Imagem 4">
      <h3>Solana</h3>
      <p>Aceita relacionamentos a distância</p>
    </div>
  </div>
  <div class="buttons">
  <button class="like-btn">Like</button>
  <button class="dislike-btn">Dislike</button>
</div>
</div>

  <script>
    const cards = document.querySelectorAll('.card');
    const likeBtn = document.querySelector('.like-btn');
    const dislikeBtn = document.querySelector('.dislike-btn');
    let currentCardIndex = 0;

    likeBtn.addEventListener('click', () => {
      cards[currentCardIndex].style.display = 'none'; 
      currentCardIndex = (currentCardIndex + 1) % cards.length; 
      cards[currentCardIndex].style.display = 'block'; 
    });

    dislikeBtn.addEventListener('click', () => {
      cards[currentCardIndex].style.display = 'none'; 
      currentCardIndex = (currentCardIndex + 1) % cards.length; 
      cards[currentCardIndex].style.display = 'block'; 
    });

    for (let i = 1; i < cards.length; i++) {
      cards[i].style.display = 'none';
    }
  </script>
</body>
</html>