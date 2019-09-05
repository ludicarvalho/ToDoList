<?php
$resultado =  array();
$descricao = $_POST['descricao'];
$data = date('Y-m-d');
$hora = date('H:i:s');

include "./banco.php";
include "./classe.php";

$td = new Todo();
$td->SetDescricao($descricao);
$td->SetData($data);
$td->SetHora($hora);

$ultID = $td->Gravar($descricao, $data, $hora);

if ($ultID > 0) {
    $resultado['status'] = true;
    $resultado['lstid'] = $ultID;
    $resultado['dt'] = date_format(date_create($data), 'd/m/Y');
    $resultado['hora'] = $hora;
}
else {
	$resultado['status'] = false;
}
header('Content-type: application/json');

echo json_encode($resultado);
?>