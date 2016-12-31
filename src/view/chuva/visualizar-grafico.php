<?php $title = 'Chuva &#10157; Visualizar gráfico' ?>
<!doctype html>
<html lang="pt-br">
<head>
	<?php require_once '../src/view/head.php' ?>
	<title><?=$title?></title>
    <style>td{border: none; padding: 0px; width: 2px;}</style>
</head>
<!--=====neck=====-->
<body>
<?php require_once '../src/view/nav.php' ?>

<section id="conteudo">
	<table>
		<caption><?=$flash['status']? $flash['status']: $title?></caption>
		
		<tbody>
			<?php
			if(!$banco->quantificar()){
                echo '<tr><td colspan="100">Não há registros.</td></tr>';
            }
			
			while($c = $banco->vetorizar()):
                $date = new \DateTime($c['data']);
                $title = \Miti\Tempo::usBR($c['data']);
                
                switch($c['intensidade']){
                    case 0: $color = 'white'; break;
                    case 1: $color = 'lightblue'; break;
                    case 2: $color = 'darkblue'; break;
                }
                
                $day = "<td title='$title' style='background-color: $color'></td>";
			?>
                <?php if($date->format('m-d') === '01-01'){ ?>
                    <tr><th scope="row"><?=$date->format('Y')?></th><?=$day?>
                <?php }else{echo $day;} ?>
                
                <?php if($date->format('m-d') === '12-31'){echo '</tr>';} ?>
			<?php endwhile; ?>
		</tbody>
	</table>
</section>
</body>
</html>
