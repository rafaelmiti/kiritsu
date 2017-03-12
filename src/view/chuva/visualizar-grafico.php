<?php
use Miti\Tempo;
$title = 'Chuva > Visualizar gráfico';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <?php require_once '../src/view/head.php' ?>
        <title><?=$title?></title>
        <style>td{border: none; padding: 0px; width: 2px;}</style>
    </head>
    
    <body>
        <?php require_once '../src/view/nav.php' ?>

        <section id="conteudo">
            <table>
                <caption class="<?=$flash['status']?>"><?=$flash['message']?: $title?></caption>

                <tbody>
                    <?php
                    echo !$banco->quantificar()? '<tr><td colspan="100">Não há registros.</td></tr>': null;

                    while ($c = $banco->vetorizar()):
                        $date = new \DateTime($c['data']);
                        $title = Tempo::usBR($c['data']);

                        switch ($c['intensidade']) {
                            case 0: $color = 'white'; break;
                            case 1: $color = 'lightblue'; break;
                            case 2: $color = 'darkblue'; break;
                        }

                        $day = "<td title='$title' id='{$c['data']}' style='background-color: $color'></td>";
                        ?>

                        <?php if ($date->format('m-d') === '01-01') { ?>
                            <tr><th scope="row"><?=$date->format('Y')?></th><?=$day?>
                        <?php } else {echo $day;} ?>

                        <?=$date->format('m-d') === '12-31'? '</tr>': null?>
                    <?php endwhile ?>
                </tbody>
            </table>
        </section>
    </body>
</html>
