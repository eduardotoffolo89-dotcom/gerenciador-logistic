<?php
require_once '../config/conexao.php';$titulo='Endereços';require '../includes/header.php';
$lista=$pdo->query("SELECT * FROM enderecos ORDER BY id DESC")->fetchAll();?>
<div class="d-flex justify-content-between mb-3"><h1 class="h3 page-title">Endereços</h1><a class="btn btn-primary" href="form.php">Novo endereço</a></div>
<div class="card p-3 table-responsive"><table class="table"><thead><tr><th>Identificação</th><th>Rua</th><th>Cidade/UF</th><th>Tipo</th><th>Ações</th></tr></thead><tbody>
<?php foreach($lista as $e):?><tr><td><?=h($e['identificacao'])?></td><td><?=h($e['rua'])?>, <?=h($e['numero'])?></td><td><?=h($e['cidade'])?>/<?=h($e['uf'])?></td><td><?=h($e['tipo'])?></td><td><a class="btn btn-sm btn-outline-primary" href="form.php?id=<?=$e['id']?>">Editar</a> <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir endereço?')" href="excluir.php?id=<?=$e['id']?>">Excluir</a></td></tr><?php endforeach;?>
<?php if(!$lista):?><tr><td colspan="5" class="text-center">Nenhum endereço cadastrado.</td></tr><?php endif;?></tbody></table></div>
<?php require '../includes/footer.php';?>
