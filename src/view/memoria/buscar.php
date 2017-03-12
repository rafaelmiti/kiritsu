<?php
use Miti\Tratamento;
$title = 'Memória > Buscar';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <?php require_once '../src/view/head.php' ?>
        <title><?=$title?></title>
    </head>

    <body>
        <?php require_once '../src/view/nav.php' ?>

        <section id="conteudo">
            <form action="/l/memoria/visualizar" id="memoria-buscar">
                <table>
                    <caption class="<?=$flash['status']?>"><?=$flash['message']?: $title?></caption>

                    <tbody>
                        <tr>
                            <th scope="row"><label for="categoria">Categoria</label></th>

                            <td>
                                <select name="categoria" id="categoria">
                                    <option></option>

                                    <?php
                                    try {
                                        $categoria = new \Model\Categoria($app->config('config'));
                                        $banco = $categoria->listar();
                                    } catch (\Exception $ex) {
                                        echo $ex->getMessage();
                                    }

                                    while ($c = $banco->vetorizar()):
                                        $c = Tratamento::escapar($c);
                                        ?>

                                        <option value="<?=$c['id']?>"><?=$c['nome']?></option>
                                    <?php endwhile ?>
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
