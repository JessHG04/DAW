<form class="registro" autocomplete="off" target="_self" action=<?php echo $enlaceFormReg; ?> method="post">
    <fieldset>
        <legend><h2><?php echo $titleFormReg; ?></h2></legend>
        <div>
            <label for="usuario">Nombre de usuario*:</label>
            <input type="text" autofocus name="nameUsuR" id="usuario" placeholder="Introduzca un nombre de usuario" autocomplete="on" title="Introduzca un nombre de usuario" size ="40" value="<?php echo $nombreUsuReg; ?>">
        </div>

        <div>
            <label for="contrasenya">Contraseña*:</label>
            <input type="password" name="cntrR" id="contrasenya" placeholder="Introduzca la contraseña" title="Introduzca la contraseña" size ="40" value="<?php echo $contrUsuReg; ?>">
        </div>

        <div>
            <label for="vcontrasenya">Repita la contraseña*:</label>
            <input type="password" name="cntrR2" id="vcontrasenya" placeholder="Repita la contraseña" title="Repita la contraseña" size ="40" value="<?php echo $contr2UsuReg; ?>">
        </div>

        <div>
            <label for="email">Dirección de e-mail*:</label>
            <input type="email" id="email" name="emailR" autocomplete="on" placeholder="Introduzca su email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Introduzca su email" size ="40" value="<?php echo $emailUsuReg; ?>">
        </div>

        <div>
            <label for="sexo">Sexo*:</label>
            <select id="sexo" name="sexoR">
                <option value="Seleccione...">Seleccione...</option>
                <?php
                    if($sexoUsuReg == 1){
                        echo "<option selected value='Mujer'>Mujer</option>";
                        echo "<option value='Hombre'>Hombre</option>";
                    } else{
                        echo "<option value='Mujer'>Mujer</option>";
                        echo "<option selected value='Hombre'>Hombre</option>";
                    }
                ?>
            </select>
        </div>

        <div>
            <label for="fechan">Fecha de nacimiento*:</label>
            <input type="date" name="fchaNacR" id="fechan" required title="Introduzca su fecha de nacimiento" value="<?php echo $fNacUsuReg; ?>">
        </div>

        <div>
            <label for="pais">País de residencia*:</label>
            <select id="pais" name="paisR">
                <?php
                    require_once("selectPaises.inc.php");
                ?>
            </select>
        </div>

        <div>
            <label for="ciudad">Ciudad de residencia*:</label>
            <input type="text" name="ciudadResR" id="ciudad" placeholder="Introduzca su ciudad de residencia" required title="Introduzca su ciudad de residencia" size ="40" value="<?php echo $ciudadUsuReg; ?>">
        </div>

        <div>
            <label for="nfile">Foto de perfil*:</label>
            <span class="icon-upload"></span><input type="file" id="nfile" accept="image/*" multiple class="boton">
        </div>

        <input type="submit" value="Registrarse"><br>
    </fieldset>
</form>