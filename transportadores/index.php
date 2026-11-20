<?php
require_once '../config/conexao.php';$titulo='Transportadores';require '../includes/header.php';
$lista=$pdo->query("SELECT * FROM transportadores ORDER BY id DESC")->fetchAll();?>
<div class="d-flex justify-content-between mb-3"><h1 class="h3 page-title">Transportadores</h1><a class="btn btn-primary" href="form.php">Novo transportador</a></div>
<div class="card p-3 table-responsive"><table class="table"><thead><tr><th>Nome</th><th>Documento</th><th>Telefone</th><th>Veículo</th><th>Ações</th></tr></thead><tbody>
<?php foreach($lista as $t):?><tr><td><?=h($t['nome'])?></td><td><?=h($t['documento'])?></td><td><?=h($t['telefone'])?></td><td><?=h($t['veiculo'])?></td><td><a class="btn btn-sm btn-outline-primary" href="form.php?id=<?=$t['id']?>">Editar</a> <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir transportador?')" href="excluir.php?id=<?=$t['id']?>">Excluir</a></td></tr><?php endforeach;?>
<?php if(!$lista):?><tr><td colspan="5" class="text-center">Nenhum transportador cadastrado.</td></tr><?php endif;?></tbody></table></div><?php require '../includes/footer.php';?>
