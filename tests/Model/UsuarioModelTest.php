<?php
use Model\Usuario;
use PHPUnit\Framework\TestCase;

class UsuarioModelTest extends TestCase
{
	private static $config;
	private $usuario;
	
	public static function setUpBeforeClass()
    {
		global $config;
		self::$config = $config;
	}
	
	protected function setUp()
    {
        $this->usuario = new Usuario(self::$config, true);
		$this->usuario->getORM()->zerar();
	}
	
    protected function tearDown()
    {
        $this->usuario->getORM()->getBanco()->rebobinar();
    }
    
	public function testNotLogin()
    {
        $this->setExpectedException('UnexpectedValueException', 'Falha na autenticação.');
		$credencial = ['nome' => 'joao', 'senha' => 'joao'];
		$this->usuario->login($credencial);
	}
    
    public function testLogin()
    {
		$credencial = ['nome' => 'admin', 'senha' => '123'];
		$this->usuario->login($credencial);
		$this->assertSame('1', $_SESSION['usuario']);
	}
	
	public function testLogout()
    {
		$_SESSION['usuario'] = '1';
		$this->usuario->logout();
		$this->assertFalse(isset($_SESSION['usuario']));
	}
}
