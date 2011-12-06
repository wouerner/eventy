<?php 
session_start();

include 'config/autoload.php';
$idEvento = $_POST['idEvento'];


$evento = new Modelo\Evento($_SESSION['usuario_id']);

$evento = $evento->listarUm($idEvento);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Eventos</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />	
		<link href="css/form.css"rel="stylesheet" type="text/css" />	
  </head>
  <body>
		<div id="main">
		<?php include 'includes/menu_usuario.inc.php' ; ?>
			<div id="eventos">
				<form class="leftLabel" method="post" accept-charset="utf-8" action = "atualizar.php">
					<div class="info">
						<h2>Novo Evento</h2>
					</div>
					<ul>
					  
						<li>
							<label class="desc" for="nome">Nome:</label>
							<div>
								<input type="text" name="nome" class="text large" value="<?php echo $evento['nome'] ?>"/>
							</div>
						</li>

						<li>
							<label class="desc" for="uf">UF:</label>
							<div>
								<select class="select large" name="uf" id="uf">
								<option value="<?php echo $evento['uf'] ?>"><?php echo $evento['uf'] ?></option>
								  <option value="DF">Distrito Federal</option>
								  <option value="SP">São Paulo</option>
								</select>
							</div>
						</li>
						
						
						<li>
							<label class="desc" for="dataInicio">Data Inicio:</label>
							<div>
							<input type="text" id="dataInicio" name="dataInicio" class="text small" value="<?php echo $evento['dataInicio']?>"/>
							</div>
						</li>

						<li>
							<label class="desc" for="dataFim">Data Fim:</label>
							<div>
								<input type="text" id="dataFim" name="dataFim" class="text small" value="<?php echo $evento['dataTermino']?>"/>
							</div>
						</li>

						<li>
							<label class="desc" for="descricao">Descrição:</label>
							<div>
							<textarea class="textarea large" name="descricao" id="descricao"><?php echo $evento['descricao']?></textarea>
							</div>
						</li>

					</ul>
					<div class="buttons">
						<button type="submit" class="button green large">Salvar</button>
						<input type= "hidden" name= "id" value = "<?php echo $evento['id'] ; ?>" >
						
					</div>
				</form>
			  
			</div>

		<?php include 'includes/menu_lateral.inc.php' ; ?>	
		</div>
		
  </body>
</html>
