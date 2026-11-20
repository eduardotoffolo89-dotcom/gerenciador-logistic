<?php
require_once '../config/conexao.php'; session_start();
$id=(int)($_GET['id']??0);
try{$q=$pdo->prepare("DELETE FROM produtos WHERE id=?");$q->execute([$id]);$_SESSION['mensagem']='Produto excluído.';}
catch(PDOException $e){$_SESSION['mensagem']='Não foi possível excluir: o produto pode estar vinculado a um frete.';}
header('Location: index.php');exit;
