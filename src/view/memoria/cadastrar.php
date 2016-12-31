<?php $title = 'Memória &#10157; Cadastrar' ?>
<!doctype html>
<html lang="pt-br">
<head>
	<?php require_once '../src/view/head.php' ?>
	<title><?=$title?></title>
	<script>window.onload = function(){mitiFormulario.contar('descricao', <?=$memoria->l[3]?>);};</script>
</head>
<!--=====neck=====-->
<body>
<?php require_once '../src/view/nav.php' ?>

<section id="conteudo">
	<form method="post">
		<table>
			<caption><?=!$flash['status']? $title: $flash['status']?></caption>

			<tbody>
				<tr>
					<?php $_POST = \Miti\Tratamento::indexar($_POST, ['categoria', 'sub_categoria', 'descricao']) ?>
					
					<th scope="row"><label for="categoria">Categoria</label></th>
					
					<td>
						<select name="categoria" id="categoria" required>
							<option></option>
							
							<?php
							try{
								$categoria = new \Model\Categoria($app->config('config'));
								$banco = $categoria->listar();
							}catch(\Exception $ex){echo $ex->getMessage();}
							
							while($c = $banco->vetorizar()):
								$c = \Miti\Tratamento::escapar($c);
							?>
								<option value="<?=$c['id']?>" <?=$c['id'] == $_POST['categoria']? 'selected': ''?>><?=$c['nome']?></option>
							<?php endwhile; ?>
						</select>
					</td>
					
					<td></td>
				</tr>

				<tr>
					<th scope="row"><label for="sub_categoria">Sub categoria</label></th>
					<td><input type="text" name="sub_categoria" id="sub_categoria" value="<?=$_POST['sub_categoria']?>" maxlength="<?=$memoria->l[2]?>" /></td>
					<td></td>
				</tr>

				<tr>
					<th scope="row"><label for="descricao">Descrição</label></th>
					<td><textarea name="descricao" id="descricao" cols="100" rows="30" maxlength="<?=$memoria->l[3]?>" required><?=$_POST['descricao']?></textarea></td>
					<td id="descricao_miticontar" width="40"></td>
				</tr>
			</tbody>

			<tfoot><tr><td colspan="100"><div><input type="submit" value="Cadastrar" /></div></td></tr></tfoot>
		</table>
	</form>
</section>
</body>
</html>
