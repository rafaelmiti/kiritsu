<?php
use Miti\Tratamento;
$title = 'Memória > Visualizar';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <?php require_once '../src/view/head.php' ?>
        <title><?=$title?></title>
        <script>window.onload = function(){mitiFormulario.confirmarClick();};</script>
    </head>

    <body>
        <?php require_once '../src/view/nav.php' ?>

        <section id="conteudo">
            <table class="lista">
                <caption class="<?=$flash['status']?>"><?=$flash['message']?: $title?></caption>

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Sub categoria</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    echo !$banco->quantificar()? '<tr><td colspan="100">Não há registros.</td></tr>': null;

                    while ($m = $banco->vetorizar()):
                        $m = Tratamento::escapar($m);
                        ?>

                        <tr>
                            <th scope="row"><?=$m['id']?></th>
                            <td><?=$m['c_nome']?></td>
                            <td><?=$m['sub_categoria']?></td>
                            <td title="<?=$m['descricao']?>"><?=Tratamento::encurtar($m['descricao'], 100)?></td>

                            <td class="centro">
                                <a
                                    href="/l/memoria/editar/<?=$m['id']?>"
                                ><img src="/img/lapis.png" alt="Lápis" title="Editar" /></a>

                                <a
                                    href="/l/memoria/excluir/<?=$m['id']?>" class="miticlick" title="<?=$m['c_nome'].'::'.$m['sub_categoria']?>"
                                ><img src="/img/x.png" alt="Letra X" title="Excluir" /></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="100">
                            <div class="esquerda"><?=$banco->quantificar()?> / <?=$memoria->getTotal()?></div>
                            <div><?=$memoria->getPaginacao()->criar('pagina', 'on', 'off', $_GET)?></div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
    </body>
</html>
