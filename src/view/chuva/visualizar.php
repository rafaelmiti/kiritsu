<?php $title = 'Chuva &#10157; Visualizar' ?>
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
        <caption><?=$flash['status']?: $title?></caption>

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Data</th>
                <th scope="col">Intensidade</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php
            echo !$banco->quantificar()? '<tr><td colspan="100">Não há registros.</td></tr>': null;

            while ($c = $banco->vetorizar()):
                $c = \miti\Tratamento::escapar($c);
                ?>
            
                <tr>
                    <th scope="row"><?=$c['id']?></th>
                    <td class="centro"><?=\Miti\Tempo::usBR($c['data'])?></td>
                    <td class="centro"><?=$c['intensidade']?></td>

                    <td class="centro">
                        <a
                            href="/l/chuva/editar/<?=$c['id']?>"
                        ><img src="/img/lapis.png" alt="Lápis" title="Editar" /></a>

                        <a
                            href="/l/chuva/excluir/<?=$c['id']?>"
                            title="<?=$c['data']?>"
                            class="miticlick"
                        ><img src="/img/x.png" alt="Letra X" title="Excluir" /></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="100">
                    <div class="esquerda"><?=$banco->quantificar()?> / <?=$chuva->getTotal()?></div>
                    <div><?=$chuva->getPaginacao()->criar('pagina', 'on', 'off', $_GET)?></div>
                </td>
            </tr>
        </tfoot>
    </table>
</section>
</body>
</html>
