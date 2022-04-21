<?php
session_start();

require 'conexao.php';
require 'tarefa.php';
require 'tarefaservice.php';
require 'login.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao ;



    // Verificar se usuario existe
    if($acao == 'verificar') {
        $email = $_GET['email'];

        $login = new Login();
        $login->__set('login', $email);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $login);
        $verificado = $tarefaService->verificar();

        echo json_encode($verificado);
    }

    //Criar Conta
    if($acao == 'criar_conta') {
        $nome = $_POST['nome'];
        $usuario = $_POST['email'];
        $senha = $_POST['senha'];

        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        $login = new Login();
        $login->__set('nome', $nome);
        $login->__set('login', $usuario);
        $login->__set('senha', $senha);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $login);
        $conta_criada = $tarefaService->cadastro();

        if($conta_criada) {  
            echo 'conta foi criada'          ;
            $acao = 'login';
            $conta = 'success';
        } else {
            header('location: ../index.php?conta=failed');
        }

        
    }

    // Login
    if($acao == 'login') {
        echo 'chegou aqui';
        $usuario = $_POST['email'];
        $senha = $_POST['senha'];

        $login = new Login();
        $login->__set('email', $usuario);
        $login->__set('senha', $senha);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $login);
        $login = $tarefaService->login();

        if($acao == 'login' && $conta == 'success') {
            $_SESSION['usuario'] = $login['0']['id'];
            $_SESSION['nome'] = $login['0']['nome'];
            header('location: ../nova_tarefa.php?conta=success');
            die();
        }

        if($login) {
            $_SESSION['usuario'] = $login['0']['id'];
            $_SESSION['nome'] = $login['0']['nome'];
            header('location: ../nova_tarefa.php');
        } else {
            header('location: ../index.php?login=erro');
        }
    }

    // Inserir
    if($acao == 'inserir'){
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa',$_POST['tarefa']);
        $tarefa->__set('id_usuario', $_SESSION['usuario']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao,$tarefa);
        $tarefaService->inserir();

        header('location: ../nova_tarefa.php?feed=success');
    }
    
    // Recuperar
    else if($acao === 'recuperar') {
        $tarefa = new Tarefa();        
        $tarefa->__set('id_usuario',$_SESSION['usuario']);
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefa = $tarefaService->recuperar();

    }
    
    // Atualizar
    else if ($acao === 'atualizar') {
        print_r($_GET);
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);
        $tarefa->__set('id', $_POST['id']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->atualizar();
        
        if(isset($_GET['page']) && $_GET['page'] == 'index') {
            header('location: tarefas_pendente.php?atualiza=success');
        } else {
            header('location: ../todas_tarefas.php?atualiza=success');
        }

    }
    
    // Remover
    else if($acao === 'remover') {
        $tarefa = new Tarefa();
        $tarefa->__set('id',$_GET['id']);
        
        $conexao = new Conexao();
        
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();

        if(isset($_GET['page']) && $_GET['page'] == 'index') {
            header('location: tarefas_pendente.php?remove=success');
        } else {
            header('location: todas_tarefas.php?remove=success');
        }
    }
    
    // Marcar
    else if ($acao === 'marcar') {
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);
        $tarefa->__set('id_status', 2);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao,$tarefa);
        $tarefaService->marcar();

        if(isset($_GET['page']) && $_GET['page'] == 'index') {
            header('location: tarefas_pendente.php?marcar=success');
        } else {
            header('location: todas_tarefas.php?marcar=success');
        }
    }
    
    // Pendentes
    else if($acao === 'pendentes') {
        $tarefa = new Tarefa();
        $tarefa->__set('id_usuario', $_SESSION['usuario']);
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefa = $tarefaService->recup_pendentes();
    }
?>