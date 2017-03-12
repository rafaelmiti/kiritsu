<?php $title = 'Histórico > Buscar' ?>
<!doctype html>
<html lang="pt-br">
    <head>
        <?php require_once "../src/view/head.php" ?>
        <title><?=$title?></title>
    </head>

    <body>
        <?php require_once "../src/view/nav.php" ?>

        <section id="conteudo">
            <form action="/l/historico/visualizar" id="historico-buscar">
                <table>
                    <caption class="<?=$flash['status']?>"><?=$flash['message']?: $title ?></caption>

                    <tbody>
                        <tr>
                            <th><?=$agenda->C[1]?></th>
                            <td><input type="text" name="<?=$agenda->c[1]?>" maxlength="<?=$agenda->l[1]?>" /></td>
                        </tr>

                        <tr>
                            <th><?=$agenda->C[2]?></th>
                            <td><input type="text" name="<?=$agenda->c[2]?>" /></td>
                        </tr>

                        <tr>
                            <th><?=$agenda->C[3]?></th>
                            <td><input type="date" name="<?=$agenda->c[3]?>" /></td>
                        </tr>

                        <input type="hidden" name="pagina" value="1" />
                    </tbody>

                    <tfoot><tr><td colspan="100"><div><input type="submit" value="Buscar" /></div></td></tr></tfoot>
                </table>
            </form>
        </section>
    </body>
</html>
