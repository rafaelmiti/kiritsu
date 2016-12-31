<?php $title = 'Agenda &#10157; Visualizar' ?>
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
		<caption><?=$flash['status']? $flash['status']: $title ?></caption>
		
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

				$c3Status = '';
				$c3 = new \DateTime($a[$agenda->c[3]]);
				$hoje = new \DateTime('00:00:00');
				if($c3 < $hoje){$c3Status = 'atrasado';}
                elseif($c3 == $hoje){$c3Status = 'hoje';}
			?>
				<tr>
					<th scope="row"><?=$a[$agenda->c[0]]?></th>
					<td class="<?=$pontual?>"><?=$a[$agenda->c[1]]?></td>
					<td title="<?=$a[$agenda->c[2]]?>"><?=\Miti\Tratamento::encurtar($a[$agenda->c[2]], 90)?></td>
					<td class="centro <?=$c3Status?>"><?=\Miti\Tempo::usBR($a[$agenda->c[3]])?></td>
					<td class="centro"><?=\Miti\Tempo::diaDaSemana($a[$agenda->c[3]])?></td>
					<td class="centro"><?=mb_substr($a[$agenda->c[4]], 0, 5)?></td>

					<td class="centro">
						<?php if($a[$agenda->c[5]]): ?>
							<a href="/l/agenda/cadastrar?<?=$agenda->c[1]?>=<?=$a[$agenda->c[1]]?>&amp;<?=$agenda->c[3]?>=<?=$a[$agenda->c[3]]?>&amp;<?=$agenda->c[4]?>=<?=$a[$agenda->c[4]]?>&amp;<?=$agenda->c[5]?>=<?=$a[$agenda->c[5]]?>&amp;<?=$agenda->c[6]?>=1">
								<img src="/img/copia.png" alt="Cópia" title="Historiar duplicando" /></a>
						<?php else: ?>
							<a href="/l/agenda/historiar/<?=$a[$agenda->c[0]]?>" class="miticlick" title="<?=$a[$agenda->c[1]]?>">
								<img src="/img/v.png" alt="Letra V" title="Historiar" /></a>
						<?php endif; ?>
						
						<a href="/l/agenda/editar/<?=$a[$agenda->c[0]]?>">
							<img src="/img/lapis.png" alt="Lápis" title="Editar" /></a>
						
						<a href="/l/agenda/excluir/<?=$a[$agenda->c[0]]?>" class="miticlick" title="<?=$a[$agenda->c[1]]?>">
							<img src="/img/x.png" alt="Letra X" title="Excluir" /></a>
					</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
		
		<tfoot>
			<tr>
				<td colspan="100">
					<div class="esquerda"><?=$banco->quantificar()?> / <?=$agenda->getTotal()?></div>
					<div><?=$agenda->getPaginacao()->criar('pagina')?></div>
				</td>
			</tr>
		</tfoot>
	</table>
</section>
</body>
</html>
