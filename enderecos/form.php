<?php
require_once '../config/conexao.php';require_once '../includes/funcoes.php';
$id=(int)($_GET['id']??0);$e=['identificacao'=>'','tipo'=>'Origem','rua'=>'','numero'=>'','bairro'=>'','cidade'=>'','uf'=>'','cep'=>''];
if($id){$q=$pdo->prepare("SELECT * FROM enderecos WHERE id=?");$q->execute([$id]);$e=$q->fetch()?:$e;}
if($_SERVER['REQUEST_METHOD']==='POST'){
 $d=[];foreach(['identificacao','tipo','rua','numero','bairro','cidade','uf','cep'] as $c)$d[]=trim($_POST[$c]??'');
 if($d[0]===''||$d[2]===''||$d[5]==='')$erro='Preencha identificação, rua e cidade.';
 else{if($id){$q=$pdo->prepare("UPDATE enderecos SET identificacao=?,tipo=?,rua=?,numero=?,bairro=?,cidade=?,uf=?,cep=? WHERE id=?");$q->execute([...$d,$id]);}
 else{$q=$pdo->prepare("INSERT INTO enderecos(identificacao,tipo,rua,numero,bairro,cidade,uf,cep) VALUES(?,?,?,?,?,?,?,?)");$q->execute($d);}
 session_start();$_SESSION['mensagem']='Endereço salvo.';redirecionar('index.php');}
}
$titulo='Cadastro de endereço';require '../includes/header.php';?>
<h1 class="h3 mb-3 page-title"><?=h($titulo)?></h1><?php if(isset($erro)):?><div class="alert alert-warning"><?=h($erro)?></div><?php endif;?>
<form method="post" class="card p-4"><div class="row g-3">
<div class="col-md-6"><label class="form-label">Identificação *</label><input name="identificacao" class="form-control" required value="<?=h($e['identificacao'])?>"></div>
<div class="col-md-6"><label class="form-label">Tipo</label><select name="tipo" class="form-select"><option <?= $e['tipo']==='Origem'?'selected':''?>>Origem</option><option <?= $e['tipo']==='Destino'?'selected':''?>>Destino</option><option <?= $e['tipo']==='Ambos'?'selected':''?>>Ambos</option></select></div>
<div class="col-md-8"><label class="form-label">Rua *</label><input name="rua" class="form-control" required value="<?=h($e['rua'])?>"></div>
<div class="col-md-4"><label class="form-label">Número</label><input name="numero" class="form-control" value="<?=h($e['numero'])?>"></div>
<div class="col-md-4"><label class="form-label">Bairro</label><input name="bairro" class="form-control" value="<?=h($e['bairro'])?>"></div>
<div class="col-md-4"><label class="form-label">Cidade *</label><input name="cidade" class="form-control" required value="<?=h($e['cidade'])?>"></div>
<div class="col-md-2"><label class="form-label">UF</label><input name="uf" maxlength="2" class="form-control" value="<?=h($e['uf'])?>"></div>
<div class="col-md-2"><label class="form-label">CEP</label><input name="cep" class="form-control" value="<?=h($e['cep'])?>"></div></div><div class="mt-3"><button class="btn btn-primary">Salvar</button> <a class="btn btn-secondary" href="index.php">Voltar</a></div></form>
<?php require '../includes/footer.php';?>
