<?php

//iniciar sessão
session_start();

//verificar se tem post
if( ! $_POST){
	///header('Location:cadastro.php');
	exit();
}

//importar usuario
require 'config/autoload.php';


//criar o objeto ususario

$participante = new Modelo\Participante();

//recuperar dados do post e atribuir ao objeto

$participante->usuario = $_POST['usuario'];
$participante->evento = $_POST['evento'];
//salvar usuári$_POSTo
//

if($participante->salvar()){

	$_SESSION['mensagem'] = 'Usuario cadastrado com sucesso';

}else{
	$_SESSION['erros'] = $participante->erros;

}

header('Location:index.php');
exit();

?> 
