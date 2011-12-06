<?php

session_start();

require 'config/autoload.php';
//verificar se tem post
/*if( ! $_POST){
	///header('Location:cadastro.php');
	exit();
}*/
//criar o objeto ususario

$usuario = new Modelo\Usuario();


//recuperar dados do post e atribuir ao objeto

$usuario->login = $_POST['login'];
$usuario->senha = $_POST['senha'];

//$usuario->login = 'wouerner';
//$usuario->senha = '123';

$usuarioLogado = $usuario->entrar();

if($usuarioLogado){
	$_SESSION['usuario_nome'] = $usuarioLogado['nome'];
	$_SESSION['usuario_id'] = $usuarioLogado['id'];
	$_SESSION['logado'] = TRUE;

	header('Location:index.php');
	exit();

}else{

	$_SESSION['mensagen'] = 'Usuario não encontrado';
	header('Location:cadastro.php');
	exit();

}
