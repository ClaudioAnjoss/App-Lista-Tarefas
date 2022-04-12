<?php
$acao = 'recuperar';
require "../App-Lista-Tarefas/Db_AppTarefasSecure/tarefa_controller.php";

if(!isset($_SESSION['usuario'])) {
	header('location: login.php?acesso=negado');
}
?>

<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>App Lista Tarefas</title>

	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>
	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
				App Lista Tarefas
			</a>

			<a class="btn btn-outline-danger" href="Db_AppTarefasSecure/encerrar_sessao.php">Sair</a>
		</div>
	</nav>

	<!-- Dialog Atualizado -->
	<?php if (isset($_GET['atualiza']) && $_GET['atualiza'] == 'success') { ?>
		<div class="bg-success text-center p-3">
			<h1 class="lead">Tarefa atualizada com sucesso!</h1>
		</div>
	<?php } ?>

	<!-- Dialog Removida -->
	<?php if (isset($_GET['remove']) && $_GET['remove'] == 'success') { ?>
		<div class="bg-success text-center p-3">
			<h1 class="lead">Tarefa Removida com sucesso!</h1>
		</div>
	<?php } ?>

	<!-- Dialog Realizada -->
	<?php if (isset($_GET['marcar']) && $_GET['marcar'] == 'success') { ?>
		<div class="bg-success text-center p-3">
			<h1 class="lead">A tarefa foi marcada como realizada!</h1>
		</div>
	<?php } ?>

	<div class="container app">
		<div class="row">
			<div class="col-sm-3 menu">
				<ul class="list-group">
					<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
					<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
					<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
				</ul>
			</div>

			<div class="col-sm-9">
				<div class="container pagina">
					<div class="row">
						<div class="col">
							<h4>Todas tarefas</h4>
							<hr />

							<?php foreach ($tarefa as $key => $value) { ?>
								
								<div class="row mb-3 d-flex align-items-center tarefa">
									<div id="tarefa_<?= $value->id ?>" class="col-sm-9"><?= $value->tarefa ?> <strong>(<?= $value->status ?>)</strong> </div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="excluir('<?= $value->id ?>')"></i>

										<?php if($value->id_status == 1) { ?>
										<i class="fas fa-edit fa-lg text-info" onclick="editar('<?= $value->id ?>' , '<?= $value->tarefa ?>')"></i>
										<i class="fas fa-check-square fa-lg text-success" onclick="marcar(<?= $value->id ?>)"></i>

										<?php } else { ?>
											<p class="lead">Realizada</p>
										<?php } ?>

									</div>
								</div>

							<?php } ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="js/script.js"></script>
</body>

</html>