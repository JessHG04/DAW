<?php
    $title = "Configurar estilo - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }

?>
<main>
    <form class="registro" autocomplete="off" target="_self" action="configurar-estilo.php" method="post">
        <fieldset>
            <legend><h2>Configurando estilos....</h2></legend>
            <div id="listaEstilos">
                <div >
                    <input type="radio" checked name="cambioEstilos[]" value="normal" id="normal"> <label for="normal">Estilo normal</label> <br>
                    <input type="radio" name="cambioEstilos[]" value="impresion" id="impresion"> <label for="impresion">Estilo impresión</label><br>
                    <input type="radio" name="cambioEstilos[]" value="accesible" id="accesible"> <label for="accesible">Estilo accesible</label><br>
                    <input type="radio" name="cambioEstilos[]" value="adaptativo" id="adaptativo"> <label for="adaptativo">Estilo adaptativo</label><br>
                </div>
            </div>
            <input type="submit" value="Cambiar Estilo"><br>
        </fieldset>
    </form>
</main>

<?php
    require_once("footer.inc.php");
?>
