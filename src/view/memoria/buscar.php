<!doctype html>
<html lang="pt-br">
<head>
	<?php require_once '../src/view/head.php' ?>
	<title>Memória &#10157; Buscar</title>
</head>
<!--=====neck=====-->
<body>
<?php require_once '../src/view/nav.php' ?>

<section id="conteudo">
	<form action="/l/memoria/visualizar">
		<table>
			<caption>
                <?php if(!$flash['status']){ ?>
                    Memória &#10157; Buscar
                <?php }else{echo $flash['status'];} ?>
            </caption>

			<tbody>
					<tr>
						<th scope="row"><label for="id">#</label></th>
						<td><input type="text" name="id" id="id" /></td>
					</tr>

					<tr>
						<th scope="row"><label for="categoria">Categoria</label></th>
						
						<td>
							<select name="categoria" id="categoria">
								<option></option>
								
								<?php
                                try{
                                    $categoria = new \Model\Categoria($app->config('config'));
                                    $banco = $categoria->listar();
                                }catch(\Exception $ex){
                                    echo $ex->getMessage();
                                }
                                
								while($c = $banco->vetorizar()){
									$c = \miti\Tratamento::escapar($c);
								?>
									<option value="<?=$c['id']?>"><?=$c['nome']?></option>
								<?php } ?>
							</select>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="sub_categoria">Sub categoria</label></th>
						<td><input type="text" name="sub_categoria" id="sub_categoria" /></td>
					</tr>

					<tr>
						<th scope="row"><label for="descricao">Descrição</label></th>
						<td><input type="text" name="descricao" id="descricao" /></td>
					</tr>
					
					<input type="hidden" name="pagina" value="1" />
			</tbody>

			<tfoot><tr><td colspan="100"><div><input type="submit" value="Buscar" /></div></td></tr></tfoot>
		</table>
	</form>
</section>
</body>
</html>
