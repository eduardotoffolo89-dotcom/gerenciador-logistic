<?php
require_once '../config/conexao.php'; require_once '../includes/funcoes.php';
$id=(int)($_GET['id']??0); $p=['nome'=>'','descricao'=>'','quantidade'=>1,'peso'=>''];
if($id){$q=$pdo->prepare("SELECT * FROM produtos WHERE id=?");$q->execute([$id]);$p=$q->fetch()?:$p;}
if($_SERVER['REQUEST_METHOD']==='POST'){
 $dados=[trim($_POST['nome']??''),trim($_POST['descricao']??''),(int)($_POST['quantidade']??0),(float)($_POST['peso']??0)];
 if($dados[0]===''||$dados[2]<1){$erro='Informe o nome e uma quantidade maior que zero.';}
 else {
  if($id){$q=$pdo->prepare("UPDATE produtos SET nome=?,descricao=?,quantidade=?,peso=? WHERE id=?");$q->execute([...$dados,$id]);}
  else{$q=$pdo->prepare("INSERT INTO produtos(nome,descricao,quantidade,peso) VALUES(?,?,?,?)");$q->execute($dados);}
  session_start();$_SESSION['mensagem']='Produto salvo com sucesso.';redirecionar('index.php');
 }
}
$titulo=$id?'Editar produto':'Novo produto';require '../includes/header.php';
?>
<h1 class="h3 page-title mb-3"><?=h($titulo)?></h1>
<?php if(isset($erro)):?><div class="alert alert-warning"><?=h($erro)?></div><?php endif;?>
<form method="post" class="card p-4">
<label class="form-label">Nome *</label><input class="form-control mb-3" name="nome" required value="<?=h($p['nome'])?>">
<label class="form-label">Descrição</label><textarea class="form-control mb-3" name="descricao"><?=h($p['descricao'])?></textarea>
<label class="form-label">Quantidade *</label><input type="number" min="1" class="form-control mb-3" name="quantidade" required value="<?=h($p['quantidade'])?>">
<label class="form-label">Peso (kg)</label><input type="number" step="0.01" min="0" class="form-control mb-3" name="peso" value="<?=h($p['peso'])?>">
<div><button class="btn btn-primary">Salvar</button> <a class="btn btn-secondary" href="index.php">Voltar</a></div></form>
<?php require '../includes/footer.php'; ?>
