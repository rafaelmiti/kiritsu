<?php use Miti\Tratamento ?>

<nav class="esquerdo">
    <div>
        <img src="/img/caminho.png" alt="Kanji da palavra caminho" id="logo" />
        <h1><?=$app->config('config')['sistema']?></h1>
    </div>

    <ul>
        <li>Agenda</li>
        <a href="/l/agenda/visualizar"><img src="/img/olho.png" title="Visualizar" /></a>
        <a href="/l/agenda/cadastrar"><img src="/img/mais.png" title="Cadastrar" /></a>

        <li>Histórico</li>
        <a href="/l/historico/visualizar"><img src="/img/olho.png" title="Visualizar" /></a>
        <a href="/l/historico/buscar"><img src="/img/lupa.png" title="Buscar" /></a>

        <li>Memória</li>
        <a href="/l/memoria/visualizar"><img src="/img/olho.png" title="Visualizar" /></a>
        <a href="/l/memoria/cadastrar"><img src="/img/mais.png" title="Cadastrar" /></a>
        <a href="/l/memoria/buscar"><img src="/img/lupa.png" title="Buscar" /></a>

        <li>Chuva</li>
        <a href="/l/chuva/visualizar"><img src="/img/olho.png" title="Visualizar" /></a>
        <a href="/l/chuva/cadastrar"><img src="/img/mais.png" title="Cadastrar" /></a>
        <a href="/l/chuva/visualizar-grafico"><img src="/img/grafico.png" title="Visualizar gráfico" /></a>

        <li>Sair</li>
        <a href="/logout"><img src="/img/logout.png" /></a>
    </ul>

    <?php
    try {
        $inspiracao = new \Model\Inspiracao($app->config('config'));
        $i = $inspiracao->lerAleatorio()->vetorizar();
    } catch (\Exception $ex) {
        echo $ex->getMessage();
    }

    $i = Tratamento::escapar($i);
    ?>

    <img src="/l/inspiracao/visualizar/<?=$i['id']?>" alt="Foto de personalidade" title="<?=$i['nome']?>" id="inspiracao" />
</nav>
