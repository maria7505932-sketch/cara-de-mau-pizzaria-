<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard - Cara de Mau</title>

<link rel="stylesheet" href="../style.css">

</head>

<body>

<header>

<div class="logo">

<img src="../imagens/logo.png">

<div>

<h1>CARA DE MAU</h1>

<span>PIZZARIA</span>

</div>

</div>

<div>

<h2>Bem-vindo,
<?php echo $_SESSION['usuario']; ?>

</h2>

</div>

</header>

<div class="painel">

<div class="card">

<h2>👤 Gerente</h2>

<p>Cadastrar gerente e garçons</p>

<a href="../proprietario/cadastrar_gerente.php">

<button>Acessar</button>

</a>

</div>

<div class="card">

<h2>🍕 Produtos</h2>

<p>Cadastrar produtos</p>

<a href="../gerente/cadastrar_produto.php">

<button>Acessar</button>

</a>

</div>

<div class="card">

<h2>🍽️ Mesas</h2>

<p>Gerenciar mesas</p>

<a href="../paginas/mesas.php">

<button>Acessar</button>

</a>

</div>

<div class="card">

<h2>📋 Pedidos</h2>

<p>Gerenciar pedidos</p>

<a href="../paginas/pedidos.php">

<button>Acessar</button>

</a>

</div>

<div class="card">

<h2>📊 Relatórios</h2>

<p>Visualizar relatórios</p>

<a href="../paginas/relatorios.php">

<button>Acessar</button>

</a>

</div>

<div class="card">

<h2>💰 Comissões</h2>

<p>Calcular comissões</p>

<a href="../paginas/comissoes.php">

<button>Acessar</button>

</a>

</div>

</div>

</body>

</html>