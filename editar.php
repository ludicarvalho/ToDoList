<?php
include "./banco.php";
include "./classe.php";
if (empty($_POST)) {
	//buscar
	$td = new Todo();
	$td->SetID($_GET['id']);
	$td->Obter();
}
else {
	$td = new Todo();
	$td->SetID($_GET['id']);
	$td->SetDescricao($_POST['descricao']);
	$td->SetData(date('Y-m-d'));
	$td->SetHora(date('H:i:s'));

	if ($td->Gravar()) {
?>
	<script>
		window.opener.location.reload();
		window.close();	
	</script>
<?php
	}
	else {
?>
	<script>
		alert("Falha ao garvar.");
	</script>
<?php
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<link rel="shortcut icon" href="https://cdn3.iconfinder.com/data/icons/pixel-perfect-at-16px-volume-3-1/16/5091-512.png" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.css" />
		<title>Editar: <?php echo $td->GetID(); ?></title>
		<style>
			@media screen and (max-width: 769px) {
				.btn {
					width: 100%;
					margin-top: 15px;
				}
			}
			.card-header {
				background-image: linear-gradient(to right, #000080,#FF0000);
				color: #00FF00;
				font-weight: bold;
			}
		</style>
	</head>
	<body>

		<div class="container">

			<form action="editar.php?id=<?php echo $_GET['id']; ?>" method="post">
			
				<div class="card">

					<div class="card-header">Anotação: <?php echo $td->GetID(); ?></div>

					<div class="card-body">

						<div class="form-group">

							<label for="txtDescricao">
								<strong>Descrição</strong>
							</label>
							<input class="form-control form-control-sm" type="text" name="descricao" id="txtDescricao" placeholder="Digite aqui" maxlength="250" onkeydown="Contar()" value="<?php echo $td->GetDescricao(); ?>" />
							<small class="text-muted" id="res">Até <strong>250</strong> caracteres.</small>

						</div>

					</div>

					<div class="card-footer">

						<a class="btn btn-success float-left" href="javascript:window.close()">Voltar</a>

						<input class="btn btn-warning float-right" value="Alterar" type="submit" />

					</div>

				</div>

			</form>

		</div>

		<script src="ajax.js"></script>

	</body>
</html>