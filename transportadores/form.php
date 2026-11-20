<?php
require_once '../config/conexao.php';require_once '../includes/funcoes.php';$id=(int)($_GET['id']??0);
$t=['nome'=>'','documento'=>'','telefone'=>'','email'=>'','veiculo'=>''];
if($id){$q=$pdo->prepare("SELECT * FROM transportadores WHERE id=?");$q->execute([$id]);$t=$q->fetch()?:$t;}
if($_SERVER['REQUEST_METHOD']==='POST'){$d=[];foreach(['nome','documento','telefone','email','veiculo'] as $c)$d[]=trim($_POST[$c]??'');
if($d[0]==='')$erro='Informe o nome.';else{if($id){$q=$pdo->prepare("UPDATE transportadores SET nome=?,documento=?,telefone=?,email=?,veiculo=? WHERE id=?");$q->execute([...$d,$id]);}
else{$q=$pdo->prepare("INSERT INTO transportadores(nome,documento,telefone,email,veiculo) VALUES(?,?,?,?,?)");$q->execute($d);}
session_start();$_SESSION['mensagem']='Transportador salvo.';redirecionar('index.php');}}
$titulo='Cadastro de transportador';require '../includes/header.php';?>
<h1 class="h3 mb-3 page-title"><?=h($titulo)?></h1><?php if(isset($erro)):?><div class="alert alert-warning"><?=h($erro)?></div><?php endif;?>
<form method="post" class="card p-4"><label class="form-label">Nome *</label><input class="form-control mb-3" name="nome" required value="<?=h($t['nome'])?>">
<label class="form-label">CPF/CNPJ</label><input class="form-control mb-3" name="documento" value="<?=h($t['documento'])?>">
<label class="form-label">Telefone</label><input class="form-control mb-3" name="telefone" value="<?=h($t['telefone'])?>">
<label class="form-label">E-mail</label><input type="email" class="form-control mb-3" name="email" value="<?=h($t['email'])?>">
<label class="form-label">Veículo</label><input class="form-control mb-3" name="veiculo" placeholder="Ex.: Caminhão baú" value="<?=h($t['veiculo'])?>">
<button class="btn btn-primary">Salvar</button> <a class="btn btn-secondary" href="index.php">Voltar</a></form><?php require '../includes/footer.php';?>
