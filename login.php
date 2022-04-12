<?php
$acao = '';
require "../App-Lista-Tarefas/Db_AppTarefasSecure/tarefa_controller.php";
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
		</div>
	</nav>

        <?php if(isset($_GET['login']) && $_GET['login'] == 'erro') { ?>
		<div class="bg-danger text-light text-center p-3">
			<h1 class="lead">Insira um usuario e senha valido</h1>
		</div>
		<?php } ?>

        <?php if(isset($_GET['conta']) && $_GET['conta'] == 'success') { ?>
		<div class="bg-success text-center p-3">
			<h1 class="lead">Conta criada com sucesso! Faça login para continuar</h1>
		</div>
		<?php } ?>

        <?php if(isset($_GET['acesso']) && $_GET['acesso'] == 'negado') { ?>
		<div class="bg-danger text-light text-center p-3">
			<h1 class="lead">Você precisa estar logado para acessar essa página! faça login para continuar</h1>
		</div>
		<?php } ?>

	<div class="container">
        <div class="row p-3">
            <div class="col-md-5 m-auto border rounded bg-light border-dark mr-3">
                <h1 class="display-4">Login</h1>
                <p class="lead">Faça login com sua conta já existente</p>
                <form class="p-3" action="scripts/tarefa_controller.php?acao=login" method="post">
                    <!-- <input type="text" name="nome" id="" class="form-control m-4" placeholder="Nome"> -->
                    <input type="email" name="email" id="" class="form-control m-2" placeholder="Digite seu E-mail" required>
                    <input type="password" name="senha" id="" class="form-control m-2" placeholder="Digite sua Senha" required>
                    <button type="submit" class="btn btn-primary btn-block m-2">Entrar</button>
                </form>
            </div>
        </div>
        <div class="col-md-5 m-auto">
            <p class="lead">Ou Clique aqui para criar uma conta <a href="cadastro.php" type="href" class="btn btn-danger">Criar conta</a href="login.php"></p>
            
        </div>
    </div>
</body>

</html>