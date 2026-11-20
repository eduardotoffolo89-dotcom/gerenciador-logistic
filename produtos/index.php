<?php
require_once '../config/conexao.php';
$titulo='Produtos'; require '../includes/header.php';
$lista=$pdo->query("SELECT * FROM produtos ORDER BY id DESC")->fetchAll();
?>
<div class="d-flex justify-content-between align-items-center mb-3"><h1 class="h3 page-title">Produtos</h1><a class="btn btn-primary" href="form.php">Novo produto</a></div>
<div class="card p-3"><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Nome</th><th>Descrição</th><th>Quantidade</th><th>Ações</th></tr></thead><tbody>
<?php foreach($lista as $p): ?><tr><td><?=h($p['nome'])?></td><td><?=h($p['descricao'])?></td><td><?=h($p['quantidade'])?></td><td><a class="btn btn-sm btn-outline-primary" href="form.php?id=<?=$p['id']?>">Editar</a> <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir produto?')" href="excluir.php?id=<?=$p['id']?>">Excluir</a></td></tr><?php endforeach; ?>
<?php if(!$lista): ?><tr><td colspan="4" class="text-center text-muted">Nenhum produto cadastrado.</td></tr><?php endif; ?>
</tbody></table></div></div>
<?php require '../includes/footer.php'; ?>
