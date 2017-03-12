<?php use Miti\Tratamento ?>

<link rel="icon" href="/img/miti.png" type="image/png" />
<?=Tratamento::requerer('/css/geral.css')?>

<?=Tratamento::requerer('/js/Miti/Elemento.js')?>
<?=Tratamento::requerer('/js/Miti/Formulario.js')?>

<script>
    var mitiElemento = new MitiElemento;
    var mitiFormulario = new MitiFormulario;
</script>
