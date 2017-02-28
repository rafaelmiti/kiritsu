<?php
use Model\Inspiracao;
use PHPUnit\Framework\TestCase;

class InspiracaoModelTest extends TestCase
{
	private static $config;
	private $inspiracao;
	
	public static function setUpBeforeClass()
    {
		global $config;
		self::$config = $config;
	}

	protected function setUp()
    {
        $this->inspiracao = new Inspiracao(self::$config, true);
	}
	
    protected function tearDown()
    {
        $this->inspiracao->getORM()->getBanco()->rebobinar();
    }
    
	public function testLer()
    {
		$i = $this->inspiracao->ler(['id' => '1'])->vetorizar();
		$this->assertSame('Allan Kardec', $i['nome']);
	}
	
	public function testLerAleatorio()
    {
		$i = $this->inspiracao->lerAleatorio()->vetorizar();
		$aleatorio = false;
		
		for ($j = 1; $j <= 3; $j++) {
			$i2 = $this->inspiracao->lerAleatorio()->vetorizar();
            
			if ($i != $i2) {
                $aleatorio = true;
                break;
            }
		}
		
		$this->assertTrue($aleatorio);
	}
}
