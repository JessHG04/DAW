<?php
        //NOMBRE DE USUARIO
        if (!empty($_POST["nameUsuR"])) {
            //$int_optionsNameUsu = array("options" => array("min_range" => 4, "max_range" => 15));
            //if(filter_var(strlen($_POST["nameUsuR"]), FILTER_VALIDATE_INT, $int_optionsNameUsu))
            if (preg_match('/[a-zA-Z0-9 ]{3,15}$/', $_POST["nameUsuR"])) {
                $_POST["nameUsuR"] = filter_var($_POST["nameUsuR"], FILTER_SANITIZE_STRING);
                $usuarios = "SELECT * FROM pibd.usuarios where usuarios.NomUsuario='{$_POST["nameUsuR"]}'";
                if(!($resultadoUsuarios = $mysqli->query($usuarios))) {
                    echo "<p>Error al ejecutar la sentencia <b>$usuarios</b>: " . $mysqli->error . "</p>";
                    exit;
                }
                while($filaUsu = $resultadoUsuarios->fetch_object()){
                    $yaInsertado = true;
                    break;
                }
                $resultadoUsuarios->close();
                if($yaInsertado && !$modificando){
                    $errorReg = "Ese nombre de usuario ya existe";
                } else{
                    $nombreCorrecto = true;
                }
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
                if(isset($fechaNac) && $fechaNac != "") {
                    if(checkdate(date_format($fechaNac, 'm'), date_format($fechaNac, 'd'), date_format($fechaNac, 'Y'))){
                        if(date_format($fechaNac, 'd/m/Y') != date('d/m/Y')){
                            if(date_format($fechaNac, 'd') >= date('d') && date_format($fechaNac, 'm') >= date('m') && date_format($fechaNac, 'Y') >= date('Y')){
                                $errorReg = "No es una fecha de nacimiento válida <br>Esa fecha aún no ha llegado";
                            } else{
                                $fNacCorrecta = true;
                            }
                        } else{
                            $errorReg = "No es una fecha de nacimiento válida <br>Es la fecha de hoy";
                        }
                    } else{
                        $errorReg = "No es una fecha de nacimiento válida";
                    }
                } else{
                    $errorReg = "No ha introducido una fecha de nacimiento 2";
                }
            } else{
                $errorReg = "No ha introducido una fecha de nacimiento";
            }
        }

        //FOTO DE PERFIL || FICHERO
        if($errorReg == null) {
            /*print_r($_POST);
            echo "<br><br>";
            print_r($_FILES);
            echo "<br><br>";*/
            $msgError = array(0 => "No hay error, el fichero se subió con éxito",
                            1 => "El tamaño del fichero supera la directiva
                                upload_max_filesize el php.ini",
                            2 => "El tamaño del fichero supera la directiva
                                MAX_FILE_SIZE especificada en el formulario HTML",
                            3 => "El fichero fue parcialmente subido",
                            4 => "No se ha subido un fichero",
                            6 => "No existe un directorio temporal",
                            7 => "Fallo al escribir el fichero al disco",
                            8 => "La subida del fichero fue detenida por la extensión");

            if($_FILES["fileFotoR"]["error"] > 0) {
                //echo "Error: " . $msgError[$_FILES["fileFotoR"]["error"]] . "<br />";
                if($_FILES["fileFotoR"]["error"] != 4){
                    $errorReg = $msgError[$_FILES["fileFotoR"]["error"]];
                }
            } else {
                /*
                echo "Nombre original: " . $_FILES["fileFotoR"]["name"] . "<br />";
                echo "Tipo: " . $_FILES["fileFotoR"]["type"] . "<br />";
                echo "Tamaño: " . ceil($_FILES["fileFotoR"]["size"] / 1024) . " Kb<br />";
                echo "Nombre temporal: " . $_FILES["fileFotoR"]["tmp_name"] . "<br />";
                */

                //Comprobando tipos: image/gif, image/jpeg, ....
                //mime_content_type();
                $tipoFichero = $_FILES["fileFotoR"]["type"];
                //echo gettype($tipoFichero);
                $esImagen = explode("/", $tipoFichero);
                //echo "<br>" . $esImagen[0] . "<br><br>";

                if($esImagen[0] == "image"){
                    if($nombreCorrecto){
                            if($modificando && isset($_POST['eliminarFoto']) && $_POST['eliminarFoto'] == "on"){
                                $errorReg = "¿Quieres subir una foto nueva o no tener foto?";
                            } else{
                                $nombreFoto = "images\\Usuarios\\" . $_POST["nameUsuR"] . "-" . rand() . "-" . $_FILES["fileFotoR"]["name"];
                                move_uploaded_file($_FILES["fileFotoR"]["tmp_name"], "C:\\xampp\\htdocs\\DAW\\Practica 10\\" . $nombreFoto);
                                //$nombreFoto = '"images/Usuarios/' . $_POST["nameUsuR"] . '-' . $_FILES["fileFotoR"]["name"] . '"';
                                $fotoCorrecto = true;
                            }
                    } else{
                        $errorReg = "No se ha podido subir la foto de perfil<br> El nombre de usuario no es correcto";
                    }
                } else{
                    $errorReg = "El fichero NO es una imagen";
                }
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
        if($fotoCorrecto && isset($nombreFoto)){
            $datosReg['fileFotoR'] = $nombreFoto;
        } else{
            $datosReg['fileFotoR'] = "No ha seleccionado";
            $hayFoto = false;
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
                    if(!$modificando){
                        $insertarDatosUsu = false;
                    }
                }
                //FOTO
                if($fotoCorrecto){
                    if($modificando){
                        $usuValido = $mysqli->real_escape_string($_SESSION["nameUsu"]);
                        $usuarioFoto = "SELECT * FROM pibd.usuarios where usuarios.NomUsuario='$usuValido'";
                        if(!($resultadoFotoUsu = $mysqli->query($usuarioFoto))) {
                            echo "<p>Error al ejecutar la sentencia <b>$usuarioFoto</b>: " . $mysqli->error . "</p>";
                            exit;
                        }
                        while($filaFoto = $resultadoFotoUsu->fetch_object()){
                            $foAntes = $filaFoto->Foto;
                            break;
                        }
                        $resultadoFotoUsu->close();
                    }
                    if(!$hayFoto && !$modificando){
                        $foReg = '"images/user.png"';
                    } else if($hayFoto){
                        $foReg = '"' . $foReg . '"';// <-- en el futuro meterlo asi
                        //$foReg = '"images/user.png"';
                    } else{
                        $foReg = $foAntes;
                    }
                    //echo "1-->" . $foReg;
                    //echo "Foto: $foReg<br> Pais: $paNomReg --> $paIdReg<br> Ciudad: $ciReg<br>";
                    //Antes insertaba aqui
                }
            }
        } //HAY errores
        else{
            $foReg = '"images/user.png"';
            if($insertando){
                $repetirReg = "<a href='registro.php'><span class='icon-user-plus'>Registrarse de nuevo</span></a>";
            } else{
                $repetirReg = "<a href='modificar-datos.php'>Modificar datos de nuevo</a>";
            }
        }

?>