<?php
use \PHPUnit\Framework\TestCase;

class CategoriaModelTest extends TestCase{
	private static $config;
	private $categoria;
	
	public static function setUpBeforeClass(){
		global $config;
		self::$config = $config;
	}

	protected function setUp(){
        $this->categoria = new \Model\Categoria(self::$config, true);
		$this->categoria->getORM()->zerar();
	}

    protected function tearDown(){
        $this->categoria->getORM()->getBanco()->rebobinar();
    }
    
	public function testListar(){
		$c = $this->categoria->listar()->vetorizar();
		$this->assertSame(['id' => '7', 'nome' => 'Banco'], $c);
	}
}
