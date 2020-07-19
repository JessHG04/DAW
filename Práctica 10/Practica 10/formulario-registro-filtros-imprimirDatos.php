<?php
        //Imprimo los datos introducidos en el formulario
        echo <<<hearDOC
            <main>
                <section>
                    <p>
                        <h2 class='error'>$errorReg</h2>
                        <h2 style = 'color:green;'>$correctoReg</h2>
hearDOC;
        if($modificando){
            $name = $_SESSION["nameUsu"];
            $usu = "SELECT * FROM pibd.usuarios where usuarios.NomUsuario='$name'";
            if(!($resultadoUsuario = $mysqli->query($usu))) {
                echo "<p>Error al ejecutar la sentencia <b>$usu</b>: " . $mysqli->error . "</p>";
                exit;
            }
            while($filaUsu = $resultadoUsuario->fetch_object()){
                $fotoUsu = $filaUsu->Foto;
                break;
            }
            $resultadoUsuario->close();
            echo "<b>Foto: </b> <br><img src=$fotoUsu alt='{$datosReg['nameUsuR']}' width='200'> <br>";
            //echo "<b>Foto: </b> <br><img src='images/user.png' alt='{$datosReg['nameUsuR']}' height='200' width='200'> <br>";
        } else{
            echo "<b>Foto: </b> <br><img src=$foReg alt='{$datosReg['nameUsuR']}' width='200'> <br>";
            //echo "<b>Foto: </b> <br><img src='images/user.png' alt='{$datosReg['nameUsuR']}' height='200' width='200'> <br>";
        }
        echo <<<hearDOC
                        <b>Nombre de usuario: </b>{$datosReg['nameUsuR']} <br>
                        <b>Contraseña: </b>{$datosReg['cntrR']} <br>
                        <b>Repetición de la contraseña: </b>{$datosReg['cntrR2']} <br>
                        <b>Dirección de e-mail: </b>{$datosReg['emailR']} <br>
                        <b>Sexo: </b>{$datosReg['sexoR']} <br>
hearDOC;
        if($datosReg['fchaNacR'] != "No ha introducido datos"){
            $fReg = date_create($datosReg['fchaNacR']);
            echo "<b>Fecha de nacimiento: </b>" . date_format($fReg, 'd/m/Y') . " <br>";
        } else{
            echo "<b>Fecha de nacimiento: </b>{$datosReg['fchaNacR']} <br>";
        }
        echo <<<hearDOC
                        <b>Pais de residencia: </b>{$datosReg['paisR']} <br>
                        <b>Ciudad de residencia: </b>{$datosReg['ciudadResR']} <br><br>
                        $repetirReg
                    </p>
                </section>
            </main>
hearDOC;
?>