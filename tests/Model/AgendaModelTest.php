<?php
use Model\Agenda;
use PHPUnit\Framework\TestCase;

class AgendaModelTest extends TestCase
{
	private static $config;
	private $agenda;
	private $c;
	
	public static function setUpBeforeClass()
    {
		global $config;
		self::$config = $config;
	}
	
	protected function setUp()
    {
        $this->agenda = new Agenda(self::$config, true);
        $this->c = $this->agenda->c;
        
        $tupla = [
            $this->c[0] => '1',
            $this->c[1] => 'Categoria',
            $this->c[2] => 'Atividade',
            $this->c[3] => '2015-02-04',
            $this->c[4] => '13:13',
            $this->c[5] => '0',
            $this->c[6] => '0',
        ];
        
		$this->agenda->criar($tupla);
	}
	
	protected function tearDown()
    {
		$this->agenda->getORM()->getBanco()->rebobinar();
	}
	
	public function testEditar()
    {
        $tupla = [
            $this->c[0] => '1',
            $this->c[1] => 'Categoria 2',
            $this->c[2] => 'Atividade 2',
            $this->c[3] => '2015-02-05',
            $this->c[4] => '13:14:00',
            $this->c[5] => '1',
            $this->c[6] => '1',
        ];
        
		$this->agenda->atualizar($tupla)->zerar();
        
        $a = $this->agenda->ler([$this->c[0] => '1'])->vetorizar();
		$this->assertSame($tupla, $a);
	}
	
    public function testPaginar()
    {
        $this->agenda->paginar([$this->c[6] => 0], 'asc', 1)->vetorizar();
        
        $this->assertSame(17, $this->agenda->getTotal());
        $this->assertInstanceOf(\Miti\Paginacao::class, $this->agenda->getPaginacao());
    }
    
	public function testHistoriar()
    {
		$this->agenda->historiar([$this->c[0] => '1'])->zerar();
        $a = $this->agenda->ler([$this->c[0] => '1'])->vetorizar();
		$this->assertSame('1', $a[$this->c[6]]);
	}
	
	public function testAgendar()
    {
		$this->agenda->agendar([$this->c[0] => '1'])->zerar();
        $a = $this->agenda->ler([$this->c[0] => '1'])->vetorizar();
		$this->assertSame('0', $a[$this->c[6]]);
	}
	
	public function testExcluir()
    {
		$this->agenda->deletar([$this->c[0] => '1'])->zerar();
        $a = $this->agenda->ler([$this->c[0] => '1'])->vetorizar();
		$this->assertNull($a);
	}
}
