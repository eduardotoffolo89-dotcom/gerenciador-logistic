<?php
require_once '../config/conexao.php';$titulo='Fretes';require '../includes/header.php';
$sql="SELECT f.*,t.nome transportador,o.identificacao origem,d.identificacao destino,
(SELECT COUNT(*) FROM frete_produtos fp WHERE fp.frete_id=f.id) total_produtos
FROM fretes f JOIN transportadores t ON t.id=f.transportador_id
JOIN enderecos o ON o.id=f.origem_id JOIN enderecos d ON d.id=f.destino_id ORDER BY f.data_frete DESC,f.id DESC";
$lista=$pdo->query($sql)->fetchAll();?>
<div class="d-flex justify-content-between mb-3"><h1 class="h3 page-title">Fretes</h1><a class="btn btn-primary" href="form.php">Gerar frete</a></div>
<div class="card p-3 table-responsive"><table class="table"><thead><tr><th>Data</th><th>Transportador</th><th>Origem</th><th>Destino</th><th>Produtos</th><th>Status</th></tr></thead><tbody>
<?php foreach($lista as $f):?><tr><td><?=h(date('d/m/Y',strtotime($f['data_frete'])))?></td><td><?=h($f['transportador'])?></td><td><?=h($f['origem'])?></td><td><?=h($f['destino'])?></td><td><?=h($f['total_produtos'])?></td><td><?=h($f['status'])?></td></tr><?php endforeach;?>
<?php if(!$lista):?><tr><td colspan="6" class="text-center">Nenhum frete cadastrado.</td></tr><?php endif;?></tbody></table></div><?php require '../includes/footer.php';?>
