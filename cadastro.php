<?php

session_start();

/*$mensagem=null;
if(!empty($_SESSION['mensagem'])){
	$mensagem = $_SESSION['mensagem'];
	unset($_SESSION['mensagem']);
}*/

//var_dump($_SESSION['erros']);

//$erros = $_SESSION['erros'];

$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL;
$erros =  isset($_SESSION['erros']) ? $_SESSION['erros'] : NULL;

//echo $_SESSION['banco'];
//echo $_SESSION['mensagem'];

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Autenticação</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />	
		<link href="css/form.css"rel="stylesheet" type="text/css" />	
  </head>
  <body>


		<div id="main">
			<div id="login">
				<form class="topLabel" method="post" accept-charset="utf-8" action ="entrar.php" >
					<div class="info">
						<h2>Autenticação</h2>
					</div>
					<ul>
						<li>
							<label class="desc" for="login">Usuário ou E-Mail:</label>
							<div>
								<input type="text" name="login" class="text meddium" />
							</div>
						</li>
						<li>
							<label class="desc" for="senha">Senha:</label>
							<div>
								<input type="password" name="senha" class="text small" />
							</div>
						</li>
					</ul>
					<div class="buttons">
						<button type="submit" class="button blue large">Entrar</button>
					</div>
				</form>
			</div>
			<div id="cadastro">

			<div>
				<?php if($erros): ?>
				<?php foreach($erros as $erro => $mensagem):?>
					<?php echo 'erro: '.$mensagem.'<br/>' ; ?>
					
				<?php endforeach ;?>
				<?php endif ;?>

				<?php if($mensagem): ?>
				<?php foreach($mensagem as $mensagem => $m):?>
					<?php echo 'erro: '.$m.'<br/>' ; ?>
					
				<?php endforeach ;?>
				<?php endif ;?>
			</div>
				<form class="leftLabel" method="post" accept-charset="utf-8" action = "salvar.php" >
					<div class="info">
						<h2>Cadastrar</h2>
					</div>
					<ul>
						<li>
							<label class="desc" for="nome">Nome:</label>
							<div>
								<input type="text" name="nome" id="nome" class="text large" />
							</div>
						</li>
					
						<li>
							<label class="desc" for="">E-Mail:</label>
							<div>
								<input type="text" name="email" id="email" class="text large" />
							</div>
						</li>
						
						<li>
							<label class="desc" for="login">Login:</label>
							<div>
								<input type="text" name="login" id="login" class="text meddium" />
							</div>
						</li>
						
						<li>
							<label class="desc" for="senha">Senha:</label>
							<div>
								<input type="password" id="senha"  name="senha" class="text small" />
							</div>
						</li>

					</ul>
					<div class="buttons">
						<button type="submit" class="button green large">Salvar</button>
					</div>
				</form>
			</div>
		</div>
  </body>
</html>
