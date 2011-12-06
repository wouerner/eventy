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

$usuario = new Modelo\Usuario();

//recuperar dados do post e atribuir ao objeto

$usuario->nome = $_POST['nome'];
$usuario->login = $_POST['login'];
$usuario->senha = $_POST['senha'];
$usuario->email = $_POST['email'];


//salvar usuário
//

if($usuario->salvar()){

	$_SESSION['mensagem'] = 'Usuario cadastrado com sucesso';

}else{
	$_SESSION['erros'] = $usuario->erros;

}

header('Location:cadastro.php');
exit();

?> 
