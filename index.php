<?php
session_start();

/*if(!$_SESSION['logado']){
	$_SESSION['mensagem'] = 'acesso negado';
	header('Location:cadastro.php');
	exit();
	

}*/
require 'config/autoload.php';

$eventos = new Modelo\Evento($_SESSION['usuario_id']); 

$eventos = $eventos->listarTodos();

?>

	<?php include 'includes/head.inc.php' ; ?>
  <body>
		<div id="main">
		<?php include 'includes/menu_usuario.inc.php' ; ?>
	<div id = "eventos">
		<ul>
	<?php foreach($eventos as $evento): ?>
	<li>
	<div class="evento">
		<div>
				<?php setlocale('LC_ALL','pt_BR') ; ?>
			<h2> <?php echo strftime("%d - %m ", strtotime($evento['dataInicio']) ) ; ?>  </h2>
		</div>

		<div>
			<h3><?php echo $evento['nome'] ; ?></h3>
			<p><?php echo $evento['descricao'] ; ?></p>
			<form action = "salvarParticipante.php" method ="post">
			<button type = "submit" class="button">Eu vou</button>
			<input type="hidden" value = "<?php echo $_SESSION['usuario_id'] ; ?> " name = "usuario">	
			<input type="hidden" value = "<?php echo $evento['id'] ; ?>" name = "evento">	
			</form>
		</div>

	</div>
	</li>
	<?php endforeach ; ?>
		</ul>
	</div>


		<?php include 'includes/menu_lateral.inc.php' ; ?>	
		</div>
		
  </body>
</html>
