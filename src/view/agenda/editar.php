<?php $title = "Agenda &#10157; Editar &#10157; #{$a[$agenda->c[0]]}" ?>
<!doctype html>
<html lang="pt-br">
<head>
	<?php require_once '../src/view/head.php' ?>
	<title><?=$title?></title>
	<script>window.onload = function(){mitiFormulario.contar('<?=$agenda->c[2]?>', <?=$agenda->l[2]?>);};</script>
</head>
<!--=====neck=====-->
<body>
<?php require_once '../src/view/nav.php' ?>

<section id="conteudo">
	<form method="post">
		<table>
            <caption><?=$flash['status']? $flash['status']: $title?></caption>

			<tbody>
				<tr>
					<th scope="row"><?=$agenda->C[1]?></th>
					<td><input type="text" name="<?=$agenda->c[1]?>" value="<?=$a[$agenda->c[1]]?>" maxlength="<?=$agenda->l[1]?>" required /></td>
					<td></td>
				</tr>

				<tr>
					<th scope="row"><?=$agenda->C[2]?></th>
					<td><textarea name="<?=$agenda->c[2]?>" id="<?=$agenda->c[2]?>" cols="100" rows="25" maxlength="<?=$agenda->l[2]?>"><?=$a[$agenda->c[2]]?></textarea></td>
					<td id="<?=$agenda->c[2]?>_miticontar" width="40"></td>
				</tr>

				<tr>
					<th scope="row"><?=$agenda->C[3]?></th>
					<td><input type="date" name="<?=$agenda->c[3]?>" value="<?=$a[$agenda->c[3]]?>" required /></td>
					<td></td>
				</tr>

				<tr>
					<th scope="row"><?=$agenda->C[4]?></th>
                    <td><input type="time" name="<?=$agenda->c[4]?>" value="<?=mb_substr($a[$agenda->c[4]], 0, 5)?>" /></td>
					<td></td>
				</tr>

				<tr>
					<th scope="row"><?=$agenda->C[5]?></th>

					<td>
                        <select name="<?=$agenda->c[5]?>" required>
							<option value="1" <?=$a[$agenda->c[5]]? 'selected': ''?>>Sim</option>
							<option value="0" <?=!$a[$agenda->c[5]]? 'selected': ''?>>Não</option>
						</select>
					</td>

					<td></td>
				</tr>
			</tbody>

            <input type="hidden" name="<?=$agenda->c[6]?>" value="0" required />
            
			<tfoot><tr><td colspan="100"><div><input type="submit" value="Editar" /></div></td></tr></tfoot>
		</table>
	</form>
</section>
</body>
</html>
