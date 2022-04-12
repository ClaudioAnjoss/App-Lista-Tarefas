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

<?php if(isset($_GET['conta']) && $_GET['conta'] == 'failed') { ?>
		<div class="bg-danger text-center p-3">
			<h1 class="lead">Houve um erro ao criar a conta!</h1>
		</div>
		<?php } ?>

	<div class="container">
        <div class="row p-3">
            <div class="col-md-5 border border-dark rouded m-auto bg-light">
                <h1 class="display-4">Criar conta</h1>
                <form action="scripts/tarefa_controller.php?acao=criar_conta" method="post">
                    <input type="text" name="nome" id="" class="form-control m-2" placeholder="Nome" required>
                    <input type="email" name="email" id="" class="form-control m-2" placeholder="Digite seu E-mail" required>
                    <input type="password" name="senha" id="" class="form-control m-2" placeholder="Digite sua Senha" required>
                    <button type="submit" class="btn btn-primary btn-block m-2">Criar conta</button>
                </form>
            </div>
        </div>
        <div class="col-md-5 m-auto">
            <p class="lead">Ja possui uma conta? Clique aqui e volte para fazer o login <a href="login.php" type="href" class="btn btn-danger">Voltar e fazer login</a href="login.php"></p>
            
        </div>
    </div>
</body>

</html>