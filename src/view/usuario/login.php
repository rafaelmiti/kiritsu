<?php
use Miti\Tratamento;
$title = 'Login';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <?php require_once '../src/view/head.php' ?>
        <title><?=$title?></title>
    </head>

    <body>
        <section id="conteudo">
            <form method="post" action="/login">
                <table>
                    <caption class="<?=$flash['status']?>"><?=$flash['message']?: $title?></caption>

                    <?php $_POST = Tratamento::indexar($_POST, ['nome']) ?>

                    <tbody>
                            <tr>
                                <th scope="row"><label for="nome">Nome</label></th>
                                <td><input type="text" name="nome" id="nome" value="<?=$_POST['nome']?>" maxlength="<?=\Model\Usuario::NOME_L?>" required autofocus /></td>
                            </tr>

                            <tr>
                                <th scope="row"><label for="senha">Senha</label></th>
                                <td><input type="password" name="senha" id="senha" required /></td>
                            </tr>
                    </tbody>

                    <tfoot><tr><td colspan="100"><div><input type="submit" value="Login" /></div></td></tr></tfoot>
                </table>
            </form>
        </section>
    </body>
</html>
