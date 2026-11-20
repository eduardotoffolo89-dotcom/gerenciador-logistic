<?php
require_once '../config/conexao.php';session_start();$id=(int)($_GET['id']??0);
try{$q=$pdo->prepare("DELETE FROM enderecos WHERE id=?");$q->execute([$id]);$_SESSION['mensagem']='Endereço excluído.';}
catch(PDOException $e){$_SESSION['mensagem']='Não foi possível excluir: endereço vinculado a frete.';}
header('Location: index.php');exit;
