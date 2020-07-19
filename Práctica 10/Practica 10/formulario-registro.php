<form class="registro" autocomplete="off" target="_self" action=<?php echo $enlaceFormReg; ?> method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><h2><?php echo $titleFormReg; ?></h2></legend>
        <div>
            <label>(*) Campos obligatorios</label>
        </div><br>
        <div>
            <label for="usuario">Nombre de usuario*:</label>
            <input type="text" autofocus name="nameUsuR" id="usuario" placeholder="Introduzca un nombre de usuario" autocomplete="on" required title="Introduzca un nombre de usuario de 3 a 15 caracteres" size ="40" minlength="3" maxlength="15" pattern="[a-zA-Z0-9 ]{3,15}$" value="<?php echo $nombreUsuReg; ?>">
        </div>

        <div>
            <label for="contrasenya">Contraseña*:</label>
            <input type="password" name="cntrR" id="contrasenya" placeholder="Introduzca una contraseña" title="Introduzca una contraseña de 6 a 15 caracteres" required size ="40" minlength="6" maxlength="15" pattern="[a-zA-Z0-9_]{6,15}$" value="<?php echo $contrUsuReg; ?>">
        </div>

        <div>
            <label for="vcontrasenya">Repita la contraseña*:</label>
            <input type="password" name="cntrR2" id="vcontrasenya" placeholder="Repita la contraseña" title="Repita la contraseña" required size ="40" minlength="6" maxlength="15" pattern="[a-zA-Z0-9_]{6,15}$" value="<?php echo $contr2UsuReg; ?>">
        </div>

        <div>
            <label for="email">Dirección de e-mail*:</label>
            <input type="email" id="email" name="emailR" autocomplete="on" placeholder="Introduzca su email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,3}$" title="Introduzca su email" size ="40" value="<?php echo $emailUsuReg; ?>">
        </div>

        <div>
            <label for="sexo">Sexo*:</label>
            <select id="sexo" name="sexoR" required>
                <?php
                    if($sexoUsuReg == 1){
                        echo "<option value='Seleccione...'>Seleccione...</option>";
                        echo "<option selected value='Mujer'>Mujer</option>";
                        echo "<option value='Hombre'>Hombre</option>";
                    } else if($sexoUsuReg == 0){
                        echo "<option value='Seleccione...'>Seleccione...</option>";
                        echo "<option value='Mujer'>Mujer</option>";
                        echo "<option selected value='Hombre'>Hombre</option>";
                    } else if($sexoUsuReg == 2){
                        echo "<option selected value='Seleccione...'>Seleccione...</option>";
                        echo "<option value='Mujer'>Mujer</option>";
                        echo "<option value='Hombre'>Hombre</option>";
                    }
                ?>
            </select>
        </div>

        <div>
            <label for="fechan">Fecha de nacimiento*:</label>
            <input type="date" name="fchaNacR" id="fechan" required title="Introduzca su fecha de nacimiento" value="<?php echo $fNacUsuReg; ?>">
        </div>

        <div>
            <label for="pais">País de residencia:</label>
            <select id="pais" name="paisR">
                <?php
                    require_once("selectPaises.inc.php");
                ?>
            </select>
        </div>

        <div>
            <label for="ciudad">Ciudad de residencia:</label>
            <input type="text" name="ciudadResR" id="ciudad" placeholder="Introduzca su ciudad de residencia" title="Introduzca su ciudad de residencia" size ="40" value="<?php echo $ciudadUsuReg; ?>">
        </div>

        <div>
            <label for="nfile">Foto de perfil:</label>
            <span class="icon-upload"></span><input type="file" name="fileFotoR" id="nfile" accept="image/*" class="boton">
        </div>
        <?php
            if($titleButtonReg == "Modificar"){
                echo <<<hereDOC
                <div>
                    <label for = "eliminarFoto">No tener foto de perfil
                        <input type="checkbox" name="eliminarFoto" id="eliminarFoto">
                    </label> <br>
                </div>
                <div>
                    <label for="contrasenyaActual" style="color:green;"> Introduzca su Contraseña actual para confirmar los cambios*:</label>
                    <input type="password" name="cntrRActual" id="contrasenyaActual" placeholder="Introduzca la contraseña actual para confirmar los cambios" title="Introduzca su contraseña actual de 6 a 15 caracteres" required size ="40" minlength="6" maxlength="15" pattern="[a-zA-Z0-9_]{6,15}$" value="">
                </div>

hereDOC;
            }
        ?>

        <input type="submit" value="<?php echo $titleButtonReg; ?>"><br>
    </fieldset>
</form>