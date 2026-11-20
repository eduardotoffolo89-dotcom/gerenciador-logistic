<?php
require_once '../config/conexao.php';
$data=$_GET['data']??'';
if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$data)){http_response_code(400);exit('Data inválida.');}
$q=$pdo->prepare("SELECT f.id,f.data_frete,f.status,t.nome transportador,o.identificacao origem,d.identificacao destino,
GROUP_CONCAT(p.nome SEPARATOR ' | ') produtos
FROM fretes f JOIN transportadores t ON t.id=f.transportador_id
JOIN enderecos o ON o.id=f.origem_id JOIN enderecos d ON d.id=f.destino_id
LEFT JOIN frete_produtos fp ON fp.frete_id=f.id LEFT JOIN produtos p ON p.id=fp.produto_id
WHERE f.data_frete=? GROUP BY f.id ORDER BY f.id");
$q->execute([$data]);$linhas=$q->fetchAll();
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="relatorio-fretes-'.$data.'.csv"');
$out=fopen('php://output','w');fwrite($out, "\xEF\xBB\xBF");
fputcsv($out,['ID','Data','Status','Transportador','Origem','Destino','Produtos'],';');
foreach($linhas as $l)fputcsv($out,$l,';');
fclose($out);
