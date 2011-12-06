<?php

//iniciar sessão
session_start();

//verificar se tem post
if( ! $_POST){
	///header('Location:cadastro.php');
	exit();
}

//importar evento
require 'config/autoload.php';


//criar o objeto ususario


//recuperar dados do post e atribuir ao objeto
$usuario->id = $_SESSION['usuario_id'];


$evento = new Modelo\Evento($usuario);

$evento->nome = $_POST['nome'];
$evento->descricao = $_POST['descricao'];
$evento->dataInicio = $_POST['dataInicio'];
$evento->dataTerminio = $_POST['dataFim'];
$evento->uf = $_POST['uf'];



//salvar usuário
//

if($evento->salvar()){

	$_SESSION['mensagem'] = 'evento cadastrado com sucesso';

}else{
	$_SESSION['erros'] = $evento->erros;

}

header('Location:evento.php');
exit();

?> 
