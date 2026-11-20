<?php
require_once 'config/conexao.php';
$titulo = 'Início';
require 'includes/header.php';
$totais = [];
foreach (['produtos','enderecos','transportadores','fretes'] as $t) {
    $totais[$t] = (int)$pdo->query("SELECT COUNT(*) FROM $t")->fetchColumn();
}
?>
<h1 class="page-title h3 mb-4">Painel inicial</h1>
<p class="text-muted">Bem-vindo ao sistema de controle de produtos, endereços, transportadores e fretes.</p>
<div class="row g-3">
<?php foreach (['produtos'=>'Produtos','enderecos'=>'Endereços','transportadores'=>'Transportadores','fretes'=>'Fretes'] as $chave=>$nome): ?>
<div class="col-md-3"><div class="card p-3"><div class="text-muted"><?= h($nome) ?></div><div class="display-6 fw-semibold"><?= $totais[$chave] ?></div><a href="<?= h($chave) ?>/index.php">Acessar →</a></div></div>
<?php endforeach; ?>
</div>
<div class="card p-4 mt-4">
<h2 class="h5">Como utilizar</h2>
<ol class="mb-0">
<li>Cadastre os produtos que serão transportados.</li>
<li>Cadastre os endereços de origem e destino.</li>
<li>Cadastre o transportador responsável.</li>
<li>Gere o frete relacionando transportador, endereços e um ou mais produtos.</li>
<li>Consulte os fretes e emita relatório por data.</li>
</ol></div>
<?php require 'includes/footer.php'; ?>
