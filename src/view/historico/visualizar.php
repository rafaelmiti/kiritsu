<?php $title = 'Histórico &#10157; Visualizar' ?>
<!doctype html>
<html lang="pt-br">
<head>
	<?php require_once '../src/view/head.php' ?>
	<title><?=$title?></title>
	<script>window.onload = function(){mitiFormulario.confirmarClick();};</script>
</head>
<!--=====neck=====-->
<body>
<?php require_once '../src/view/nav.php' ?>

<section id="conteudo">
	<table class="lista">
		<caption><?=$flash['status']? $flash['status']: $title?></caption>
		
		<thead>
			<tr>
				<th><?=$agenda->C[0]?></th>
				<th><?=$agenda->C[1]?></th>
				<th><?=$agenda->C[2]?></th>
				<th><?=$agenda->C[3]?></th>
				<th>Dia</th>
				<th><?=$agenda->C[4]?></th>
				<th>Ações</th>
			</tr>
		</thead>

		<tbody>
			<?php
			if(!$banco->quantificar()){echo '<tr><td colspan="100">Não há registros.</td></tr>';}
			
			while($a = $banco->vetorizar()):
				$a = \Miti\Tratamento::escapar($a);
                $pontual = !$a[$agenda->c[5]]? 'pontual': '';
			?>
				<tr>
					<th scope="row"><?=$a[$agenda->c[0]]?></th>
					<td class="<?=$pontual?>"><?=$a[$agenda->c[1]]?></td>
					<td title="<?=$a[$agenda->c[2]]?>"><?=\Miti\Tratamento::encurtar($a[$agenda->c[2]], 90)?></td>
					<td class="centro"><?=\Miti\Tempo::usBR($a[$agenda->c[3]])?></td>
					<td class="centro"><?=\Miti\Tempo::diaDaSemana($a[$agenda->c[3]])?></td>
					<td class="centro"><?=mb_substr($a[$agenda->c[4]], 0, 5)?></td>

					<td class="centro">
						<a href="/l/historico/agendar/<?=$a[$agenda->c[0]]?>" class="miticlick" title="<?=$a[$agenda->c[1]]?>">
							<img src="/img/agenda.png" alt="Agenda" title="Reagendar" /></a>
                        
                        <a href="/l/historico/editar/<?=$a[$agenda->c[0]]?>">
							<img src="/img/lapis.png" alt="Lápis" title="Editar" /></a>
                        
                        <a href="/l/historico/excluir/<?=$a[$agenda->c[0]]?>" class="miticlick" title="<?=$a[$agenda->c[1]]?>">
							<img src="/img/x.png" alt="Letra X" title="Excluir" /></a>
					</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
		
		<tfoot>
			<tr>
				<td colspan="100">
					<div class="esquerda"><?=$banco->quantificar()?> / <?=$agenda->getTotal()?></div>
					<div><?=$agenda->getPaginacao()->criar('pagina', 'on', 'off', $_GET)?></div>
				</td>
			</tr>
		</tfoot>
	</table>
</section>
</body>
</html>
