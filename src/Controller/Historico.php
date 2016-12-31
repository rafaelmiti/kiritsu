<?php
namespace Controller;

class Historico{
	private $app;
	
	public function __construct(){
		global $app;
		$this->app = $app;
	}
	
	public function getVisualizar(){
		$pagina = isset($_GET['pagina'])? $_GET['pagina']: 1;
        
		try{
			$agenda = new \Model\Agenda($this->app->config('config'));
            
            $_GET[$agenda->c[6]] = 1;
            
			$banco = $agenda->paginar($_GET, 'desc', 15, $pagina);
		}catch(\Exception $ex){
            echo $ex->getMessage();
        }

		$this->app->render('historico/visualizar.php', ['app' => $this->app, 'agenda' => $agenda, 'banco' => $banco]);
	}
	
    public function getBuscar(){
        try{
			$agenda = new \Model\Agenda($this->app->config('config'));
		}catch(\Exception $ex){
            echo $ex->getMessage();
        }
        
		$this->app->render('historico/buscar.php', ['app' => $this->app, 'agenda' => $agenda]);
	}
    
    public function getEditar($c0){
		try{
			$agenda = new \Model\Agenda($this->app->config('config'));
			$a = $agenda->ler([$agenda->c[0] => $c0])->vetorizar();
		}catch(\Exception $ex){
            echo $ex->getMessage();
        }

		$a = \Miti\Tratamento::escapar($a);

		$this->app->render('historico/editar.php', ['app' => $this->app, 'agenda' => $agenda, 'a' => $a]);
	}
    
    public function postEditar($c0){
		try{
			$agenda = new \Model\Agenda($this->app->config('config'));
            $_POST[$agenda->c[0]] = $c0;
			$agenda->atualizar($_POST);
			$this->app->flash('status', 'Sucesso ao editar a história!');
		}catch(\Exception $ex){
            $this->app->flash('status', $ex->getMessage());
        }

		$this->app->redirect("/l/historico/editar/$c0");
	}
    
	public function getAgendar($c0){
		try{
			$agenda = new \Model\Agenda($this->app->config('config'));
			$agenda->agendar([$agenda->c[0] => $c0]);
			$this->app->flash('status', 'Sucesso ao reagendar a história!');
		}catch(\Exception $ex){
            $this->app->flash('status', $ex->getMessage());
        }

		$this->app->redirect('/l/agenda/visualizar');
	}
    
    public function getExcluir($c0){
		try{
			$agenda = new \Model\Agenda($this->app->config('config'));
			$agenda->deletar([$agenda->c[0] => $c0]);
			$this->app->flash('status', 'Sucesso ao excluir a história!');
		}catch(\Exception $ex){
            $this->app->flash('status', $ex->getMessage());
        }

		$this->app->redirect('/l/historico/visualizar');
	}
}
