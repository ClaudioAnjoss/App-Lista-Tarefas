<?php
$acao = 'pendentes';
require "../App-Lista-Tarefas/Db_AppTarefasSecure/tarefa_controller.php";

if (!isset($_SESSION['usuario'])) {
	header('location: index.php?acesso=negado');
}
?>

<!doctype html>
<html lang="pt-br">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- FontAwesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


	<link rel="stylesheet" href="css/estilo.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

	<title>App Lista Tarefas</title>
</head>

<body id="tarefas" class="fadeIn">

	<!-- Cabeçalho -->
	<header id="menu">
		<nav class="navbar navbar-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>

				<div class="pos-f-t">

					<a id="ativ-menu" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
						<div class="img-menu"><img class="img-fluid" src="img/perfil.jpg"></div>
					</a>

					<div class="collapse" id="navbarToggleExternalContent">
						<div class=" p-4">
							<h4 class="text-dark">Olá <?= $_SESSION['nome'] ?></h4>
							<span class="text-light">Navegue pelo o menu para acessar suas tarefas.</span>
							<ul class="nav navbar navbar-info">
								<li class="nav-item"><a href="tarefas_pendente.php" class="nav-link btn btn-outline-light active">Tarefas Pendentes</a>
								</li>
								<li class="nav-item"><a href="nova_tarefa.php" class="nav-link btn btn-outline-light">Nova Tarefa</a>
								</li>
								<li class="nav-item"><a href="todas_tarefas.php" class="nav-link btn btn-outline-light">Todas Tarefas</a>
								</li>
								<li class="nav-item"><a href="Db_AppTarefasSecure/encerrar_sessao.php" class="btn btn-outline-light">Sair</a>
								</li>
							</ul>
						</div>
					</div>

				</div>

			</div>
		</nav>
	</header>

	<!-- Nova Tarefa -->
	<section id="todas_tarefas">
		<div class="container app">
			<div class="row">

				<!-- Menu lateral -->
				<div class="col-lg-3 menu">
					<nav class="navbar navbar-expand-lg navbar-light">

						<button class="navbar-toggler border border-dark mb-3" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="collapse navbar-collapse" id="navbarNav">
							<ul class="">

								<li>
									<a href="tarefas_pendente.php" data-text="Tarefas Pendentes">Tarefas <i class="far fa-calendar-alt" style="color: #5C2E91;"></i>
									</a>
								</li>

								<li>
									<a href="nova_tarefa.php" data-text="Nova Tarefa">Nova <i class="far fa-plus-square" style="color: #5C2E91;"></i></span></a>
								</li>

								<li>
									<a href="todas_tarefas.php" data-text="Todas tarefas">Todas <i class="far fa-list-alt" style="color: #5C2E91;"></i></a>
								</li>


							</ul>
						</div>
					</nav>
				</div>

				<!-- Conteudo -->
				<div class="col-sm-9">
					<div class="container pagina bg-white">
						<div class="row">
							<div class="col">
								<h4 class="">Tarefas Pendentes</h4>
								<p class="lead mb-5" style="font-size: 1em;">De uma olhada nas tarefas que ainda estão pendentes.</p>
								<hr />

								<!-- Alertas -->
								<?php if (isset($_GET['atualiza']) && $_GET['atualiza'] == 'success') { ?>
									<div class="alert text-light bg-success mt-4 fade show " role="alert">
										<p class="lead pt-3">A <strong>Tarefa</strong> foi atualizada com sucesso!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button></p>
									</div>
								<?php } ?>

								<?php if (isset($_GET['remove']) && $_GET['remove'] == 'success') { ?>
									<div class="alert text-light bg-success mt-4 fade show " role="alert">
										<p class="lead pt-3">A <strong>Tarefa</strong> foi removida com sucesso!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button></p>
									</div>
								<?php } ?>

								<?php if (isset($_GET['marcar']) && $_GET['marcar'] == 'success') { ?>
									<div class="alert text-light bg-success mt-4 fade show " role="alert">
										<p class="lead pt-3"> <strong>Sucesso!</strong> a tarefa acabou de ser finalizada!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button></p>
									</div>
								<?php } ?>

								<?php foreach ($tarefa as $key => $value) { ?>

									<div class="row mb-3 d-flex align-items-center tarefa bord">
										<div id="tarefa_<?= $value->id ?>" class="col-lg-7"><?= $value->tarefa ?> </div>
										<div class="col-sm-5 d-flex justify-content-between"> 
											<span class="btn btn-outline-danger botoes" data-text="Excluir" onclick="excluir_pedentes('<?= $value->id ?>')">
												<i class="fas fa-trash-alt fa-lg"></i>
											</span>

											<?php if ($value->id_status == 1) { ?>
												<span class="btn btn-outline-info botoes" data-text="Editar" onclick="editar_pedentes('<?= $value->id ?>' , '<?= $value->tarefa ?>')">
													<i class="fas fa-edit fa-lg"></i>
												</span>
												<span class="btn btn-outline-success botoes" data-text="Finalizar" onclick="marcar_pedentes(<?= $value->id ?>)">
													<i class="fas fa-check-square fa-lg"></i>
												</span>

											<?php } else { ?>
												<p id="lead-size" class="lead">Realizada</p>
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
	</section>


	<script src="js/script_pedentes.js"></script>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script>
		$(document).ready(function() {
			$('.nav-link').click(function(e) {
				$('.nav-link').removeClass('active');
				$(this).addClass('active');
			});
		});

		menu
		const menu_toggle = document.querySelector('#ativ-menu');
		const navigation = document.querySelector('.pos-f-t');
		menu_toggle.onclick = function() {
			navigation.classList.toggle('active')
		}
	</script>
</body>

</html>