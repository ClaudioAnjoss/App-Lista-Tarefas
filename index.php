<?php
$acao = '';
require "../App-Lista-Tarefas/Db_AppTarefasSecure/tarefa_controller.php";

if (isset($_SESSION['usuario'])) {
	header('location: nova_tarefa.php');
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

	<link rel="stylesheet" href="css/estilo.css">

	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

	<title>App Lista Tarefas</title>
</head>

<body id="page-login" class="fadeIn">

	<!-- Cabeçalho -->
	<header>
		<nav class="navbar navbar-light ">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>
	</header>

	<!-- Aba login e Cadastro -->
	<section>
		<div id="login">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div id="accordion">
							<ul id="" class="nav nav-tabs">
								<li class="nav-item" id="headingOne">
									<a href="#" class="nav-link active" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										LOGIN
									</a>
								</li>
								<li class="nav-item" id="headingTwo">
									<a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										CADASTRO
									</a>
								</li>
							</ul>

							<!-- Alertas -->
							<section class="mt-3">
								<?php if (isset($_GET['login']) && $_GET['login'] == 'erro') { ?>
									<div class="alert text-light bg-danger fade show" role="alert">
										<p class="lead pt-3"><strong>Usuário</strong> ou <strong>senha</strong> invalidos(a)<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button></p>
									</div>
								<?php } ?>



								<?php if (isset($_GET['acesso']) && $_GET['acesso'] == 'negado') { ?>
									<div class="alert text-light bg-danger fade show" role="alert">
										<p class="lead pt-3"><strong>Você precisa estar logado</strong> para acessar essa página! faça login para continuar<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button></p>
									</div>
								<?php } ?>

								<?php if (isset($_GET['conta']) && $_GET['conta'] == 'failed') { ?>
									<div class="alert text-light bg-danger fade show" role="alert">
										<p class="lead pt-3"><strong>Houve um erro ao criar a conta...</strong> Tente novamente mais tarde<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button></p>
									</div>
								<?php } ?>
							</section>

							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="login">
									<form class="p-3" action="scripts/tarefa_controller.php?acao=login" method="post">
										<input type="email" name="email" id="" class="form-control form_login" placeholder="E-mail" required>
										<input type="password" name="senha" id="" class="form-control form_login" placeholder="Senha" required>
										<span class="lead d-block"><a href="#">ESQUECI MINHA SENHA</a></span>
										<button type="submit" class="btn ml-auto">Entrar</button>
									</form>
								</div>
							</div>
							<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="login">
									<form id="cadastro" class="p-3" action="scripts/tarefa_controller.php?acao=criar_conta" method="post">
										<input type="text" name="nome" id="" class="form-control form_login" placeholder="Nome" required>
										<input id="email" type="email" name="email" id="" class="form-control form_login" placeholder="E-mail" style="margin-bottom: 0;" required>
										<p id="feedback_email" class="lead" style="font-size: 0.9em;"></p>
										<input id="pass" type="password" name="senha" id="" class="form-control form_login" placeholder="Senha" required>
										<input id="confirm_pass" type="password" name="senha" id="" class="form-control form_login" placeholder="Repita a senha" style="margin-bottom: 0;" required>
										<p id="feedback_pass" class="lead" style="font-size: 0.9em;"></p>
										<button id="sub" type="submit" class="btn ml-auto btn-block">Criar Conta</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 bg_login">
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script>
		$(document).ready(function() {
			$('.nav-link').click(function(e) {
				$('.nav-link').removeClass('active');
				$(this).addClass('active');
			});

			$("#confirm_pass").keyup(() => {

				if ($('#pass').val() == $('#confirm_pass').val()) {
					$('#feedback_pass').css('color', 'green');
					$('#feedback_pass').html('Valida');
				} else {
					$('#feedback_pass').css('color', 'red');
					$('#feedback_pass').html('Invalida');
				}
			})

			$('#sub').click(e => {
				if ($('#pass').val() == $('#confirm_pass').val()) {
					e.preventDefault();
					let email = $('#email').val();

					$.ajax({
						type: 'GET',
						url: 'Db_AppTarefasSecure/tarefa_controller.php',
						data: `acao=verificar&email=${email}`,
						dataType: 'json',
						success: dados => {
							console.log(dados[0]);
							if (dados[0]) {
								$('#feedback_email').css('color', 'red');
								$('#feedback_email').html('E-mail já existe, tente outro');
							} else {
								$('#cadastro').submit()
							}
						},
						erro: erro => {console.log(erro)}
					})

				} else {
					e.preventDefault();
					console.log('o usuario não podera enviar');
					$('#feedback_pass').css('color', 'red');
					$('#feedback_pass').html('Senha invalida, Por favor confirme a senha a senha para o envio do formulario.');
				}

			})
		});
	</script>
</body>

</html>