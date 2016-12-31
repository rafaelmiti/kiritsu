<?php
use \PHPUnit\Framework\TestCase;

class ChuvaModelTest extends TestCase{
	private static $config;
	private $chuva;
	
	public static function setUpBeforeClass(){
		global $config;
		self::$config = $config;
	}

	protected function setUp(){
        $this->chuva = new \Model\Chuva(self::$config, true);
		$this->chuva->criar(['id' => 1, 'data' => '2017-12-04', 'intensidade' => 1]);
	}
	
    protected function tearDown(){
        $this->chuva->getORM()->getBanco()->rebobinar();
    }
    
	public function testEditar(){
        $tupla = ['id' => '1', 'data' => '2017-12-05', 'intensidade' => '2'];
		$this->chuva->atualizar($tupla)->zerar();
        
        $c = $this->chuva->ler(['id' => '1'], 'asc', 1)->vetorizar();
		$this->assertSame($tupla, $c);
	}
	
    public function testPaginar(){
        $this->chuva->paginar([], 'asc', 1)->vetorizar();
        
        $this->assertSame(367, $this->chuva->getTotal());
        $this->assertInstanceOf(\Miti\Paginacao::class, $this->chuva->getPaginacao());
    }
    
	public function testExcluir(){
		$this->chuva->deletar(['id' => 1])->zerar();
        
        $c = $this->chuva->ler(['id' => 1])->vetorizar();
		$this->assertNull($c);
	}
}
