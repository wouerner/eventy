<?php
namespace Modelo;

class Usuario
{
	public $id;
	public $nome;
	public $login;
	public $senha;
	public $email;
	public $criadoEm;
	public $alteradoEm;	


	private $erros = null;
	private $requeridos = array(
		'nome' => 'Nome n�o informado.' ,
		'email' => 'E-mail n�o informado.' ,
		'login' => 'Login n�o informado' ,
		'senha' => 'Senha n�o informada'
	);




	public function __get($prop){
		return $this->$prop;
	
	}

	//n�o e possivel setar erros por isso a restri��o
	public function __set($prop , $valor){
		if($prop != 'erros'){
			$this->$prop = $valor ; 
		
		}
	
	}

	
	public function __construct(){
		$this->criadoEm = date('Y-m-d h:i');
		$this->alteradoEm = date('Y-m-d h:i');
	}



	public function salvar(){

	if( ! $this->validar() ){
		return false;
		
	}

	try {

	//abrir conexao com o banco
	$pdo = new \PDO(DSN, USER, PASSWD);
	//cria sql
	$sql = "insert into usuarios (nome, login, senha, email, criadoEm) values (?,?,?,?,?)";
	//prepara sql
	$stm = $pdo->prepare($sql);
	//trocar valores
	$stm->bindParam(1, $this->nome);
	$stm->bindParam(2, $this->login);
	$stm->bindParam(3, md5($this->senha));
	$stm->bindParam(4, $this->email);
	$stm->bindParam(5, $this->criadoEm);


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



	public function entrar(){
		
		try {
		//conectar ao banco de dados
			$pdo = new \PDO(DSN, USER, PASSWD);	
			//montar o comando
			$sql = "SELECT * FROM usuarios  WHERE login =? AND senha =?";
		//preparar o comando
			$stm = $pdo->prepare($sql);

		//trocar valores
			$stm->bindParam(1, $this->login);
			$stm->bindParam(2, md5($this->senha));

		//executar o comando
			$resposta =$stm->execute();
			$erros = $stm->errorInfo();
			

			if(!empty($erros[2])){
				throw new \Exception($erros[2]);
	
			}
		
		//fechar conexao
			$pdo=null;

			if($resposta){
				
				return  $stm -> fetch();
		
			}

			return false;
		}

		catch(\Exception $e){
			$this->erros['banco'] = $e->getMessage();
		
		
		}


	
	
	}
	
}

?>
