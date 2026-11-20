<?php
require_once '../config/conexao.php';require_once '../includes/funcoes.php';
$produtos=$pdo->query("SELECT id,nome FROM produtos ORDER BY nome")->fetchAll();
$enderecos=$pdo->query("SELECT id,identificacao,tipo FROM enderecos ORDER BY identificacao")->fetchAll();
$transportadores=$pdo->query("SELECT id,nome FROM transportadores ORDER BY nome")->fetchAll();
if($_SERVER['REQUEST_METHOD']==='POST'){
 $transportador=(int)($_POST['transportador_id']??0);$origem=(int)($_POST['origem_id']??0);$destino=(int)($_POST['destino_id']??0);
 $data=$_POST['data_frete']??date('Y-m-d');$status=$_POST['status']??'Pendente';
 $ids=array_values(array_unique(array_filter(array_map('intval',$_POST['produtos']??[]))));
 if(!$transportador||!$origem||!$destino||$origem===$destino||!$ids)$erro='Selecione transportador, origem, destino diferentes e ao menos um produto.';
 else{
  $pdo->beginTransaction();
  try{$q=$pdo->prepare("INSERT INTO fretes(data_frete,transportador_id,origem_id,destino_id,status,observacao) VALUES(?,?,?,?,?,?)");
   $q->execute([$data,$transportador,$origem,$destino,$status,trim($_POST['observacao']??'')]);$frete=$pdo->lastInsertId();
   $q=$pdo->prepare("INSERT INTO frete_produtos(frete_id,produto_id) VALUES(?,?)");foreach($ids as $pid)$q->execute([$frete,$pid]);
   $pdo->commit();session_start();$_SESSION['mensagem']='Frete gerado com sucesso.';redirecionar('index.php');
  }catch(Throwable $e){$pdo->rollBack();$erro='Erro ao salvar o frete. Confira os dados selecionados.';}
 }
}
$titulo='Gerar frete';require '../includes/header.php';?>
<h1 class="h3 page-title mb-3">Gerar frete</h1>
<?php if(isset($erro)):?><div class="alert alert-warning"><?=h($erro)?></div><?php endif;?>
<?php if(!$produtos||!$enderecos||!$transportadores):?><div class="alert alert-info">Antes de gerar um frete, cadastre pelo menos um produto, dois endereços e um transportador.</div><?php endif;?>
<form method="post" class="card p-4">
<div class="row g-3">
<div class="col-md-6"><label class="form-label">Transportador *</label><select name="transportador_id" class="form-select" required><option value="">Selecione</option><?php foreach($transportadores as $t):?><option value="<?=$t['id']?>"><?=h($t['nome'])?></option><?php endforeach;?></select></div>
<div class="col-md-6"><label class="form-label">Data do frete *</label><input type="date" name="data_frete" class="form-control" required value="<?=h(date('Y-m-d'))?>"></div>
<div class="col-md-6"><label class="form-label">Origem *</label><select name="origem_id" class="form-select" required><option value="">Selecione</option><?php foreach($enderecos as $e):?><option value="<?=$e['id']?>"><?=h($e['identificacao'])?> (<?=h($e['tipo'])?>)</option><?php endforeach;?></select></div>
<div class="col-md-6"><label class="form-label">Destino *</label><select name="destino_id" class="form-select" required><option value="">Selecione</option><?php foreach($enderecos as $e):?><option value="<?=$e['id']?>"><?=h($e['identificacao'])?> (<?=h($e['tipo'])?>)</option><?php endforeach;?></select></div>
<div class="col-12"><label class="form-label">Produtos transportados *</label><div id="lista-produtos"><div class="row g-2 mb-2 linha-produto"><div class="col-10"><select name="produtos[]" class="form-select" required><option value="">Selecione um produto</option><?php foreach($produtos as $p):?><option value="<?=$p['id']?>"><?=h($p['nome'])?></option><?php endforeach;?></select></div><div class="col-2"><button type="button" class="btn btn-outline-danger remover-produto">Remover</button></div></div></div><button type="button" id="adicionar-produto" class="btn btn-sm btn-outline-primary">+ Adicionar outro produto</button></div>
<div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select"><option>Pendente</option><option>Em transporte</option><option>Concluído</option></select></div>
<div class="col-12"><label class="form-label">Observação</label><textarea name="observacao" class="form-control"></textarea></div>
</div><div class="mt-3"><button class="btn btn-primary" <?=(!$produtos||count($enderecos)<2||!$transportadores)?'disabled':''?>>Salvar frete</button> <a href="index.php" class="btn btn-secondary">Voltar</a></div></form>
<?php require '../includes/footer.php';?>
