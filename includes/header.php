<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/funcoes.php';
$titulo = $titulo ?? 'Gerenciador Logístico';
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h($titulo) ?> | Gerenciador Logístico</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/gerenciador-logistico/assets/css/estilo.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
 <div class="container">
  <a class="navbar-brand fw-bold" href="index.php">📦 Gerenciador Logístico</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"><span class="navbar-toggler-icon"></span></button>
  <div class="collapse navbar-collapse" id="menu">
   <ul class="navbar-nav ms-auto">
    <li class="nav-item"><a class="nav-link" href="/gerenciador-logistico/index.php">Início</a></li>
    <li class="nav-item"><a class="nav-link" href="/gerenciador-logistico/produtos/index.php">Produtos</a></li>
    <li class="nav-item"><a class="nav-link" href="/gerenciador-logistico/enderecos/index.php">Endereços</a></li>
    <li class="nav-item"><a class="nav-link" href="/gerenciador-logistico/transportadores/index.php">Transportadores</a></li>
    <li class="nav-item"><a class="nav-link" href="/gerenciador-logistico/fretes/index.php">Fretes</a></li>
    <li class="nav-item"><a class="nav-link" href="/gerenciador-logistico/relatorios/index.php">Relatórios</a></li>
   </ul>
  </div>
 </div>
</nav>
<main class="container py-4">
<?php if (!empty($_SESSION['mensagem'])): ?>
 <div class="alert alert-info"><?= h($_SESSION['mensagem']); unset($_SESSION['mensagem']); ?></div>
<?php endif; ?>
