<!doctype html>
<html lang="pt-br">
<head>
	<?php require_once '../src/view/head.php' ?>
	<title>Login</title>
</head>
<!--=====neck=====-->
<body>
<section id="conteudo">
	<form method="post" action="/login">
		<table>
			<caption>
                <?php if(!$flash['status']){ ?>
                    Login
                <?php }else{echo $flash['status'];} ?>
            </caption>

			<?php $_POST = \Miti\Tratamento::indexar($_POST, ['nome']) ?>
			
			<tbody>
					<tr>
						<th scope="row"><label for="nome">Nome</label></th>
						<td><input type="text" name="nome" id="nome" value="<?=$_POST['nome']?>" maxlength="<?=\Model\Usuario::NOME_L?>" required autofocus /></td>
					</tr>

					<tr>
						<th scope="row"><label for="senha">Senha</label></th>
						<td><input type="password" name="senha" id="senha" required /></td>
					</tr>
					
					<tr>
						<th scope="row"><label for="manter">Manter</label></th>
						<td><input type="checkbox" name="manter" id="manter" checked /></td>
					</tr>
			</tbody>

			<tfoot><tr><td colspan="100"><div><input type="submit" value="Login" /></div></td></tr></tfoot>
		</table>
	</form>
</section>
</body>
</html>
