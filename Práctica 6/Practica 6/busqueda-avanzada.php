<?php
    $title = "Búsqueda avanzada - Photory";
    $botonesHeader = "<a href='iniciar-sesion.php'><span class='icon-login'>Inciar sesión</span></a>
                      <a href='registro.php'><span class='icon-user-plus'>Regístrate</span></a>";
    require_once("head.inc");
    require_once("header.inc");
?>

<main>
    <form class="registro" autocomplete="off" target="_self" action="resultado-busqueda.php" method="post">
        <fieldset>
            <legend><h2>Búsqueda de imágenes avanzada</h2></legend>

            <div>
                <label for="titulo">Título de la imágen:</label>
                <input type="text" id="titulo" maxlength="200" placeholder="Introduzca el titulo" name="titulo">
            </div>

            <div>
                <label for="fechab">Fecha:</label>
                <input type="date" id="fechab" title="Introduzca la fecha" name="fecha">
            </div>

            <div>
                <label for="pais">País:</label>
                <select id="pais" name="pais">
                    <option selected value="Seleccione...">Seleccione...</option>
                    <optgroup label="Europa">
                        <option>Albania</option>
                        <option>Alemania</option>
                        <option>Andorra</option>
                        <option>...</option>
                    </optgroup>

                    <optgroup label="América">
                        <option>Antigua y Barbuda</option>
                        <option>Argentina</option>
                        <option>Bahamas</option>
                        <option>...</option>
                    </optgroup>

                    <optgroup label="Asia">
                        <option>Afganistán</option>
                        <option>Arabia Saudita</option>
                        <option>Bangladés</option>
                        <option>...</option>
                    </optgroup>

                    <optgroup label="África">
                        <option>Angola</option>
                        <option>Argelia</option>
                        <option>Benín</option>
                        <option>...</option>
                    </optgroup>

                    <optgroup label="Oceanía">
                        <option>Australia</option>
                        <option>Fiyi</option>
                        <option>Islas Marshall</option>
                        <option>...</option>
                    </optgroup>

                    <optgroup label="Euroasia">
                        <option>Armenia</option>
                        <option>Azerbaiyán</option>
                        <option>Chipre</option>
                        <option>...</option>
                    </optgroup>
                </select>
            </div>
            <input type="submit" value="Buscar">
        </fieldset>
    </form>
</main>

<?php
    require_once("footer.inc");
?>