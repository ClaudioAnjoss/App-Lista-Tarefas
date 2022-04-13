<?php 

session_start();

require 'tarefa_controller.php';

$acao = '';

session_destroy();


header('location: ../index.php');

?>