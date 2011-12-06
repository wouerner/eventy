<?php
namespace Modelo;
class Evento
{
	private $id;
	private$nome;
	private$descricao;
	private$dataInicio;
	private$dataTermino;
	private$uf;
	private$criadoEm;
	private$alteradoEm;
	
	private$usuario;//Objeto de Modelo\Usuario
	private $erros = null;
	private $requeridos = array(
		'nome' => 'Nome n�o informado.' ,
		'uf' => 'uf n�o informado.' ,
		'dataInicio' => 'data Inicio n�o informado' ,
		'dataTerminio' => 'Data terminio n�o informada'
	);
	
	public function __construct( $usuario){
		$this->usuario = $usuario;
		$this->criadoEm = date('Y-m-d h:i');
		$this->alteradoEm = date('Y-m-d h:i');
	}
	public function __get($prop){
		return $this->$prop;
	
	}

	//n�o e possivel setar erros por isso a restri��o
	public function __set($prop , $valor){
		if($prop != 'erros'){
			$this->$prop = $valor ; 
		
		}
	
	}


	public function salvar(){

	if( ! $this->validar() ){
		return false;
		
	}

	try {

	//abrir conexao com o banco
	$pdo = new \PDO(DSN, USER, PASSWD);
	//cria sql
	$sql = "INSERT INTO eventos (nome, descricao, dataInicio, dataTermino, uf,criadoEm, alteradoEm,usuarios_id) VALUES (?,?,?, ? ,?,?,?,?)";
	//prepara sql
	$stm = $pdo->prepare($sql);
	//trocar valores
	$stm->bindParam(1, $this->nome);
	$stm->bindParam(2, $this->descricao);
	$stm->bindParam(3, $this->dataInicio);
	$stm->bindParam(4, $this->dataTerminio);
	$stm->bindParam(5, $this->uf);
	$stm->bindParam(6, $this->criadoEm);
	$stm->bindParam(7, $this->alteradoEm);
	$stm->bindParam(8, $this->usuario->id);


	$resposta = $stm->execute();

	$erros = $stm->errorInfo();


	if($erros){
		throw new \Exception($erros[2]);
	
	}

	//fechar conex�o
	$pdo = null ;

	return $resposta;
	
	}
	
	catch(\Exception $e){
	
		$this->erros['banco'] = $e->getMessage();
		return false;
		
	}


	}
	

	//passar array para validar os campos + as mensagens de erros
	public function validar(){
		foreach ($this->requeridos as $prop=>$mensagem){



		if (empty($this->$prop)){
			$this->erros[$prop] = $mensagem;
		
		}}

		if (empty ($this->erros) ){
			return true;
		}

		return false;
	
	}

	public function listar(){
		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM eventos WHERE usuarios_id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1,$this->usuario);

		$stm->execute();

		return $stm->fetchAll();

	}

	public function listarUm($id){
		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM eventos WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1,$id);

		$stm->execute();

		return $stm->fetch();

	}
	public function listarTodos(){
		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM eventos';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		return $stm->fetchAll();

	}

	
	public function atualizar(){
	
		
		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'UPDATE eventos SET  
			nome = ? , 
			descricao = ? , 
			dataInicio = ? ,
			dataTermino = ?,
			uf = ? ,
			alteradoEm = ?
			WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1,$this->nome);
		$stm->bindParam(2,$this->descricao);
		$stm->bindParam(3,$this->dataInicio);
		$stm->bindParam(4,$this->dataTermino);
		$stm->bindParam(5,$this->uf);
		$stm->bindParam(6,$this->alteradoEm);
		$stm->bindParam(7,$this->id);

		$stm->execute();

		return true;
	
	}

	public function deletar(){
		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'DELETE FROM eventos
			WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1,$this->id);

		$stm->execute();

		return true;


	}



}
?>
