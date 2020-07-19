<?php
    $title = "Búsqueda avanzada - Photory";
    require_once("head.inc.php");
    $subirFoto = "false";
    $miPerfil = "false";
    $iniciarSesion = "true";
    $registrate = "true";
    if(isset($_SESSION['nameUsu'])){
        $subirFoto = "true";
        $miPerfil = "true";
        $iniciarSesion = "false";
        $registrate = "false";
    }
    require_once("header.inc.php");
?>

<main>
    <form class="registro" autocomplete="off" target="_self" action="resultado-busqueda.php" method="post">
        <fieldset>
            <legend><h2>Búsqueda de imágenes avanzada</h2></legend>

            <div>
                <label for="titulo">Título de la imágen:</label>
                <input type="text" id="titulo" maxlength="200" placeholder="Introduzca el titulo" name="tituloAvan">
            </div>

            <div>
                <label for="fechab">Fecha:</label>
                <input type="date" id="fechab" title="Introduzca la fecha" name="fechaAvan">
            </div>

            <div>
                <label for="pais">País:</label>
                <select id="pais" name="paisAvan">
                    <?php
                        require_once("selectPaises.inc.php");
                    ?>
                </select>
            </div>
            <input type="submit" value="Buscar">
        </fieldset>
    </form>
</main>

<?php
    require_once("footer.inc.php");
?>