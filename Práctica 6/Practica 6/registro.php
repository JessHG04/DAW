<?php
    $title = "Registro - Photory";
    $botonesHeader = "<a href='iniciar-sesion.php'><span class='icon-login'>Inciar sesión</span></a>";
    require_once("head.inc");
    require_once("header.inc");
?>

<main>
    <form class="registro" autocomplete="off" target="_self" action="registro-respuesta.php" method="post">
        <fieldset>
            <legend><h2>Registro</h2></legend>
            <div>
                <label for="usuario">Nombre de usuario*:</label>
                <input type="text" autofocus name="nameUsuR" id="usuario" placeholder="Introduzca un nombre de usuario" autocomplete="on" title="Introduzca un nombre de usuario" size ="40">
            </div>

            <div>
                <label for="contrasenya">Contraseña*:</label>
                <input type="password" name="cntrR" id="contrasenya" placeholder="Introduzca la contraseña" title="Introduzca la contraseña" size ="40">
            </div>

            <div>
                <label for="vcontrasenya">Repita la contraseña*:</label>
                <input type="password" name="cntrR2" id="vcontrasenya" placeholder="Repita la contraseña" title="Repita la contraseña" size ="40">
            </div>

            <div>
                <label for="email">Dirección de e-mail*:</label>
                <input type="email" id="email" name="emailR" autocomplete="on" placeholder="Introduzca su email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Introduzca su email" size ="40">
            </div>

            <div>
                <label for="sexo">Sexo*:</label>
                <select id="sexo" name="sexoR">
                    <option value="Seleccione...">Seleccione...</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Hombre">Hombre</option>
                </select>
            </div>

            <div>
                <label for="fechan">Fecha de nacimiento*:</label>
                <input type="date" name="fchaNacR" id="fechan" required title="Introduzca su fecha de nacimiento">
            </div>

            <div>
                <label for="pais">País de residencia*:</label>
                <select id="pais" name="paisR">
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

            <div>
                <label for="ciudad">Ciudad de residencia*:</label>
                <input type="text" name="ciudadResR" id="ciudad" placeholder="Introduzca su ciudad de residencia" required title="Introduzca su ciudad de residencia" size ="40">
            </div>

            <div>
                <label for="nfile">Foto de perfil*:</label>
                <span class="icon-upload"></span><input type="file" id="nfile" accept="image/*" multiple class="boton">
            </div>

            <input type="submit" value="Registrarse"><br>
        </fieldset>
    </form>
</main>

<?php
    require_once("footer.inc");
?>