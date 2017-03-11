<?php $title = "Memória > Editar > #{$m['id']}" ?>
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
            <caption><?=$flash['status']?: $title?></caption>

            <tbody>
                <tr>
                    <th scope="row"><label for="categoria">Categoria</label></th>

                    <td>
                        <select name="categoria" id="categoria" required>
                            <?php
                            try {
                                $categoria = new \Model\Categoria($app->config('config'));
                                $banco = $categoria->listar();
                            } catch (\Exception $ex) {
                                echo $ex->getMessage();
                            }

                            while ($c = $banco->vetorizar()):
                                $c = \Miti\Tratamento::escapar($c);
                                ?>
                            
                                <option value="<?=$c['id']?>" <?=$c['id'] == $m['categoria']? 'selected': ''?>><?=$c['nome']?></option>
                            <?php endwhile; ?>
                        </select>
                    </td>

                    <td></td>
                </tr>

                <tr>
                    <th scope="row"><label for="sub_categoria">Sub categoria</label></th>
                    <td><input type="text" name="sub_categoria" id="sub_categoria" value="<?=$m['sub_categoria']?>" maxlength="<?=$memoria->l[2]?>" /></td>
                    <td></td>
                </tr>

                <tr>
                    <th scope="row"><label for="descricao">Descrição</label></th>
                    <td><textarea name="descricao" id="descricao" cols="100" rows="30" maxlength="<?=$memoria->l[3]?>" required><?=$m['descricao']?></textarea></td>
                    <td id="descricao_miticontar" width="40"></td>
                </tr>
            </tbody>

            <tfoot><tr><td colspan="100"><div><input type="submit" value="Editar" /></div></td></tr></tfoot>
        </table>
    </form>
</section>
</body>
</html>
