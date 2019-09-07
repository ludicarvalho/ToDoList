<?php

$titulo = "ToDo List";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<link rel="shortcut icon" href="https://cdn3.iconfinder.com/data/icons/pixel-perfect-at-16px-volume-3-1/16/5091-512.png" />
	<link rel="stylesheet" href="../css/bootstrap.css" />
	<title><?php echo $titulo; ?></title>
	<link rel="stylesheet" href="estilo.css" />
</head>
<body onunload="window.opener.location.reload();">

	<div class="jumbotron">

		<div class="container">

			<span class="display-4"><?php echo $titulo; ?></span>

		</div>

	</div>

	<div class="container">

		<div class="form-group">

			<label for="txtDescricao">
				<strong>Descrição</strong>
			</label>

			<div class="input-group">
				<input class="form-control" type="text" id="txtDescricao" placeholder="Digite aqui" maxlength="250" oninput="Contar()" value="" />
				<div class="input-group-append">
					<button type="button" class="btn btn-outline-success" onclick="Grv()">Gravar</button>
				</div>
			</div>

			<small class="text-muted" id="res">Até <strong>250</strong> caracteres.</small>
		</div>

	</div>

<?php
	include "./banco.php";
	$cont = ObterDois("id, descricao, data, hora", "todo", "ORDER BY id");
	//var_dump($cont);
	if ($cont != false) {
?>
	<div class="container my-3" id="corpo">

	</div>
<?php
	}
	else {
?>
	<div class="alert alert-info">

		<div class="container">

			<span class="h1">Lista vazia</span>

		</div>

	</div>
<?php
	}
?>
	<script src="../js/jquery-3.4.1.js"></script>
	<script src="./ajax.js"></script>
	<script>
<?php
		$contador = 1;
		foreach ($cont as $item) {
			$id = $item['id'];
			$descricao = $item['descricao'];
			$data = date_create($item['data']);
			$dtFrmt = date_format($data, 'd/m/Y');
			$hora = $item['hora'];
?>
			
		Cartao(<?php echo "$id, '$descricao', '$dtFrmt', '$hora'"; ?>);
			
<?php
		}
?>
	</script>
	
</body>
</html>
