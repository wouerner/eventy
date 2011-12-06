<?php
namespace Modelo;
class Participante
{
	private  $usuario;
	private	 $evento;

	public function __get($prop){
		return $this->$prop;
	
	}

	//não e possivel setar erros por isso a restrição
	public function __set($prop , $valor){
		if($prop != 'erros'){
			$this->$prop = $valor ; 
		
		}
	
	}

	public function salvar(){


	//abrir conexao com o banco
	$pdo = new \PDO(DSN, USER, PASSWD);
	//cria sql
	$sql = "INSERT INTO participantes (usuarios_id, eventos_id) VALUES (?,?)";
	//prepara sql
	$stm = $pdo->prepare($sql);
	//trocar valores
	$stm->bindParam(1, $this->usuario);
	$stm->bindParam(2, $this->evento);

	$resposta = $stm->execute();

	$erros = $stm->errorInfo();



	//fechar conexão
	$pdo = null ;

	return $resposta;


	}




}
?>
