<?php

//iniciar sessão
session_start();

//verificar se tem post
if( ! $_POST){
	header('Location:listarEventos.php');
	exit();
}

//importar os dados
require 'config/autoload.php';

//criar o objeto evento 

$evento = new Modelo\Evento($_SESSION['usuario_id']);

//recuperar dados do post e atribuir ao objeto
$evento->id = $_POST['id'];
$evento->nome = $_POST['nome'];
$evento->uf = $_POST['uf'];
$evento->dataInicio = $_POST['dataInicio'];
$evento->dataTermino = $_POST['dataFim'];
$evento->descricao = $_POST['descricao'];

//var_dump($_POST);
//exit();
//salvar usuário

if($evento->atualizar()){

	$_SESSION['mensagem'] = 'Usuario cadastrado com sucesso';

}else{
	$_SESSION['erros'] = $evento->erros;

}

header('Location:listarEventos.php');
exit();

?> 
