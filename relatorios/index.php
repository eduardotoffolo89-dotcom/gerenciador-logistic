<?php
require_once '../config/conexao.php';$titulo='Relatórios';require '../includes/header.php';?>
<h1 class="h3 page-title mb-3">Relatório de fretes por dia</h1>
<div class="card p-4"><p>Escolha uma data para baixar um arquivo CSV que pode ser aberto no Excel.</p>
<form method="get" action="baixar.php" class="row g-2"><div class="col-md-5"><input type="date" name="data" class="form-control" required value="<?=date('Y-m-d')?>"></div><div class="col-md-3"><button class="btn btn-primary">Baixar relatório</button></div></form></div>
<?php require '../includes/footer.php';?>
