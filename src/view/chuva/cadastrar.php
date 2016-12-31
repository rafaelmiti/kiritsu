<?php $title = 'Chuva &#10157; Cadastrar' ?>
<!doctype html>
<html lang="pt-br">
<head>
	<?php require_once '../src/view/head.php' ?>
	<title><?=$title?></title>
</head>
<!--=====neck=====-->
<body>
<?php require_once '../src/view/nav.php' ?>

<section id="conteudo">
	<form method="post">
		<table>
			<caption><?=$flash['status']? $flash['status']: $title?></caption>

			<tbody>
                <?php $_POST = \Miti\Tratamento::indexar($_POST, ['data', 'intensidade']) ?>
                
				<tr>
					<th scope="row"><label for="data">Data</label></th>
					<td><input type="date" name="data" id="data" value="<?=$_POST['data']?>" required /></td>
				</tr>
                
                <tr>
					<th scope="row"><label for="intensidade">Intensidade</label></th>
					<td><input type="number" name="intensidade" id="intensidade" value="<?=$_POST['intensidade']?>" min="0" max="2" required /></td>
				</tr>
			</tbody>

			<tfoot><tr><td colspan="100"><div><input type="submit" value="Cadastrar" /></div></td></tr></tfoot>
		</table>
	</form>
</section>
</body>
</html>
