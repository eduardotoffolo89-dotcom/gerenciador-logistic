<?php
require_once '../config/conexao.php';session_start();$id=(int)($_GET['id']??0);
try{$q=$pdo->prepare("DELETE FROM transportadores WHERE id=?");$q->execute([$id]);$_SESSION['mensagem']='Transportador excluído.';}
catch(PDOException $e){$_SESSION['mensagem']='Não foi possível excluir: transportador vinculado a frete.';}
header('Location: index.php');exit;
