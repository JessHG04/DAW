<?php
        //NOMBRE DE USUARIO
        if (!empty($_POST["nameUsuR"])) {
            //$int_optionsNameUsu = array("options" => array("min_range" => 4, "max_range" => 15));
            //if(filter_var(strlen($_POST["nameUsuR"]), FILTER_VALIDATE_INT, $int_optionsNameUsu))
            if (preg_match('/[a-zA-Z0-9 ]{3,15}$/', $_POST["nameUsuR"])) {
                $_POST["nameUsuR"] = filter_var($_POST["nameUsuR"], FILTER_SANITIZE_STRING);
                $nombreCorrecto = true;
            } else {
                $errorReg = "No es un nombre de usuario válido <br>Solo puede contener de 3 a 15 letras del alfabeto inglés (en mayúsculas y minúsculas) y números";
            }
        }

        //CONTRASENYA
        if($errorReg == null){
            //NO ha introducido una contrasenya
            if(empty($_POST["cntrR"])) {
                $errorReg = "No ha introducido una contraseña";
            }
            //NO ha repetido la contrasenya
            else if(empty($_POST["cntrR2"])){
                $errorReg = "No ha repetido la contraseña";
            }
            //HA introducido una contrasenya y la ha repetido
            else {
                //NO coinciden las contrasenyas
                if($_POST["cntrR"] != $_POST["cntrR2"]) {
                    $errorReg = "No coinciden las contraseñas";
                }
                //COINCIDEN las contrasenyas
                else {
                    if (preg_match('/[a-zA-Z0-9_]{6,15}$/', $_POST["cntrR"])) {
                        $_POST["cntrR"] = filter_var($_POST["cntrR"], FILTER_SANITIZE_STRING);
                        //Compruebo que al menos tenga una letra minuscula, una mayuscula y un numero
                        $permitidosLetMayusCntrUsu = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $permitidosLetMinusCntrUsu = "abcdefghijklmnopqrstuvwxyz";
                        $permitidosNumCntrUsu = "0123456789";
                        $hayMayus = existe_valor($_POST["cntrR"], $permitidosLetMayusCntrUsu);
                        $hayMinus = existe_valor($_POST["cntrR"], $permitidosLetMinusCntrUsu);
                        $hayNum = existe_valor($_POST["cntrR"], $permitidosNumCntrUsu);
                        if(!$hayMayus || !$hayMinus || !$hayNum) {
                            $errorReg = "No es una contraseña válida <br>Debe contener al menos una letra mayúscula, una minúscula y un numero";
                        }
                    } else {
                        $errorReg = "No es una contraseña válida <br>Solo puede contener de 6 a 15 letras del alfabeto inglés (en mayúsculas y minúsculas), números y el subrayado";
                    }
                    //Si NO hay error
                    if($errorReg == null){
                        $contrCorrecta = true;
                    }
                }
            }
        }

        //EMAIL
        if($errorReg == null){
            if(!empty($_POST["emailR"])){
                if (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,3}$/', $_POST["emailR"])) {
                    $_POST["emailR"] = filter_var($_POST["emailR"], FILTER_SANITIZE_STRING);
                    $emailCorecto = true;
                } else {
                    $errorReg = "No es un correo válido<br> Debe tener un dominio existente";
                }
            }
        }

        //SEXO
        if($errorReg == null){
            if(!empty($_POST["sexoR"]) && $_POST["sexoR"] != "Seleccione..." && $_POST["sexoR"] != "..."){
                if($_POST["sexoR"] == "Mujer" || $_POST["sexoR"] == "Hombre"){
                    $sexoCorrecto = true;
                } else{
                    $errorReg = "El sexo seleccionado no es válido";
                }
            } else{
                $errorReg = "No ha seleccionado sexo";
            }
        }

        //PAIS
        if($errorReg == null){
            if(!empty($_POST["paisR"]) && $_POST["paisR"] != "Seleccione..." && $_POST["paisR"] != "..."){
                $paisN = $mysqli->real_escape_string($_POST["paisR"]);
                $paises = "SELECT * FROM pibd.paises where paises.NomPais='$paisN'";
                if(!($resultadoPaises = $mysqli->query($paises))) {
                    echo "<p>Error al ejecutar la sentencia <b>$paises</b>: " . $mysqli->error . "</p>";
                    exit;
                }
                while($filaPais = $resultadoPaises->fetch_object()){
                    $paIdReg = $filaPais->IdPais;
                    $paisCorrecto = true;
                    break;
                }
                $resultadoPaises->close();
                if(!$paisCorrecto){
                    $errorReg = "No ha seleccionado un pais válido";
                }
            } else{
                $errorReg = "No ha seleccionado pais";
            }
        }

        //FECHA DE NACIMIENTO
        if($errorReg == null){
            if(!empty($_POST["fchaNacR"])) {
                $fechaNac = date_create($_POST["fchaNacR"]);
                $fechaActual = date_create(date('d/m/Y'));
                //echo "fecha nacimiento: " . date_format($fechaNac, 'd/m/Y') . " --> " . date_timestamp_get($fechaNac) . "<br>";
                //echo "fecha actual: " . date('d/m/Y') . " --> " . date_timestamp_get($fechaActual) . "<br>";
                if(date_timestamp_get($fechaNac) != ""){
                    if(date_format($fechaNac, 'd/m/Y') != date('d/m/Y')) {
                        if(date_timestamp_get($fechaNac) > date_timestamp_get($fechaActual)) {
                            $errorReg = "No es una fecha de nacimiento válida <br>Esa fecha aún no ha llegado";
                        } else{
                            $fNacCorrecta = true;
                        }
                    } else{
                        $errorReg = "No es una fecha de nacimiento válida <br>Es la fecha de hoy";
                        //$fNacCorrecta = true;
                    }
                } else{
                    $errorReg = "No es una fecha de nacimiento válida <br>Esa fecha no existe en el sistema Unix que empezó el 01/01/1970";
                }
            } else{
                $errorReg = "No ha introducido una fecha de nacimiento";
            }
        }

        //Me guardo los datos introducidos
        $datosReg = array();
        foreach ($_POST as $clave => $valor) {
            if(empty($_POST[$clave])){
                $datosReg[$clave] = "No ha introducido datos";
                //echo "<b>$clave: </b>No ha introducido datos<br>";
            } else if(!isset($_POST[$clave]) || $_POST[$clave] == null){
                $datosReg[$clave] = "No ha introducido datos";
            }
            else if($valor != "Seleccione..." && $valor != "..."){
                $datosReg[$clave] = $valor;
                //echo "<b>$clave: </b>$valor <br>";
            }
            else{
                $datosReg[$clave] = "No ha seleccionado";
                //echo "<b>$clave: </b>No ha seleccionado<br>";
            }
        }

        //Si NO hay errores
        //echo "$errorReg <br>";
        if($errorReg == null){
            if($nombreCorrecto && $contrCorrecta && $emailCorecto && $sexoCorrecto && $fNacCorrecta){
                $insertarDatosUsu = true;
                $nomReg = $mysqli->real_escape_string($datosReg['nameUsuR']);
                $clReg = $mysqli->real_escape_string($datosReg['cntrR']);
                $emReg = $mysqli->real_escape_string($datosReg['emailR']);
                $seReg = $mysqli->real_escape_string($datosReg['sexoR']);
                $feNac = date_create($mysqli->real_escape_string($datosReg['fchaNacR']));
                $feNacReg = date_format($feNac, 'Y-m-d');
                $ciReg = $mysqli->real_escape_string($datosReg['ciudadResR']);
                $paNomReg = $mysqli->real_escape_string($datosReg['paisR']);
                $foReg = $mysqli->real_escape_string($datosReg['fileFotoR']);

                //$feR = date_create(date('d/m/Y'));
                //$feReg = date_format($feR, 'Y-m-d');

                //echo "Foto: $foReg<br> Pais: $paNomReg<br> Ciudad: $ciReg<br><br>";
                //SEXO
                if($seReg == "Mujer"){
                    $seReg = 1;
                } else if($seReg == "Hombre"){
                    $seReg = 0;
                }
                //CIUDAD
                if($ciReg == "No ha introducido datos"){
                    $ciReg = "";
                }
                //PAIS
                if($paNomReg == "No ha seleccionado"){
                    $paNomReg = "";
                    $insertarDatosUsu = false;
                }
                //FOTO
                if($foReg == "No ha introducido datos"){
                    //$foReg = ""; //en el futuro meterlo asi -->
                    //$foReg = '"' . $foReg . '"'; //en el futuro meterlo asi
                    $foReg = '"images/user.png"';
                } else{
                    //$foReg = '"' . $foReg . '"'; //en el futuro meterlo asi
                    $foReg = '"images/user.png"';
                }
                //echo "Foto: $foReg<br> Pais: $paNomReg --> $paIdReg<br> Ciudad: $ciReg<br>";
                //Antes insertaba aqui
            }
        }
        //HAY errores
        else{
            if($insertando){
                $repetirReg = "<a href='registro.php'><span class='icon-user-plus'>Registrarse de nuevo</span></a>";
            } else{
                $repetirReg = "<a href='modificar-datos.php'>Modificar datos de nuevo</a>";
            }
        }
?>