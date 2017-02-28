<?php
use Model\Memoria;
use PHPUnit\Framework\TestCase;

class MemoriaModelTest extends TestCase
{
	private static $config;
	private $memoria;
	
	public static function setUpBeforeClass()
    {
		global $config;
		self::$config = $config;
	}

	protected function setUp()
    {
        $this->memoria = new Memoria(self::$config, true);
		$this->memoria->criar(['id' => 1, 'categoria' => '1', 'sub_categoria' => 'Sub categoria', 'descricao' => 'Descrição.']);
	}
	
    protected function tearDown()
    {
        $this->memoria->getORM()->getBanco()->rebobinar();
    }
    
	public function testEditar()
    {
        $tupla = ['id' => '1', 'categoria' => '2', 'sub_categoria' => 'Sub categoria 2', 'descricao' => 'Descrição 2.'];
		$this->memoria->atualizar($tupla)->zerar();
        
        $m = $this->memoria->ler(['id' => '1'])->vetorizar();
		$this->assertSame($tupla, $m);
	}
	
    public function testPaginar()
    {
        $this->memoria->paginar(['id' => '1'], 1)->vetorizar();
        
        $this->assertSame(1, $this->memoria->getTotal());
        $this->assertInstanceOf(\Miti\Paginacao::class, $this->memoria->getPaginacao());
    }
    
	public function testExcluir()
    {
		$this->memoria->deletar(['id' => 1])->zerar();
        
        $m = $this->memoria->ler(['id' => 1])->vetorizar();
		$this->assertNull($m);
	}
}
