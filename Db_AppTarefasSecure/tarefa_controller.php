<?php

require 'conexao.php';
require 'tarefa.php';
require 'tarefaservice.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao ;

    if($acao == 'inserir'){
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa',$_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao,$tarefa);
        $tarefaService->inserir();

        header('location: ../nova_tarefa.php?feed=success');
    }else if($acao == 'recuperar') {
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefa = $tarefaService->recuperar();

        $teste = 'chegou aqui';
    } else if ($acao == 'atualizar') {
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);
        $tarefa->__set('id', $_POST['id']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->atualizar();        
    } else if($acao = 'remover') {
        $tarefa = new Tarefa();
        $tarefa->__set('id',$_GET['id']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();

        // echo '<pre>';
        // print_r($tarefa);
        // echo '</pre>';
    }
?>