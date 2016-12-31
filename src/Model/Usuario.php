<?php
namespace Model;

class Usuario extends Entidade{
	const NOME_L = 20;
	
	public function __construct(array $config, $unit = false){
        parent::__construct($config, 'usuario', 'u', $unit);
	}
	
	public function login($credencial){
		$u = $this->orm
			->selecionar('u', 'id')
			->selecionar('u', 'senha')
			->filtrar('u', 'nome', '=', $credencial['nome'])
			->ler()
			->vetorizar()
		;
		
		if($u['senha'] !== crypt($credencial['senha'], $this->config['salt'])){
			throw new \UnexpectedValueException('Falha na autenticação.');
		}
		
		$_SESSION['usuario'] = $u['id'];
	}
	
	public function logout(){
		unset($_SESSION['usuario']);
		session_destroy();
	}
}
