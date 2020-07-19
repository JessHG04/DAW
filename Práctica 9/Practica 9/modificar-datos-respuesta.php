<?php
    $title = "Modificar datos respuesta - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }

    function existe_valor($texto, $valores){
        $hayValor = false;
        for($i=0; $i < strlen($valores); $i++) {
            for ($j=0; $j < strlen($texto); $j++) {
                if(substr($valores, $i, 1) == substr($texto, $j, 1)) {
                    $hayValor = true;
                    break;
                }
            }
        }
        return $hayValor;
    }

    $seguirEjecutando = true;
    if (!isset($_SERVER["HTTP_REFERER"])) {
        echo "<main><section><h2 class='error'>Envío incorrecto</h2></main></section>";
        $seguirEjecutando = false;
    }
    $url = parse_url($_SERVER["HTTP_REFERER"]);
    if($url["host"] != $_SERVER["SERVER_NAME"]){
        echo "<main><section><h2 class='error'>Envío incorrecto</h2></main></section>";
        $seguirEjecutando = false;
    }


    $datosReg = "";
    $errorReg = $repetirReg = $correctoReg = null;
    $nombreCorrecto = $contrCorrecta = $emailCorecto = $sexoCorrecto = $fNacCorrecta = false;
    $insertarDatosUsu = false;
    $insertando = false; //para ver que pongo en el boton de $repetirReg si enlace a modificar datos o a registro
    $puedeModificar = false;

    if($seguirEjecutando){
        //NO hay nombre de usuario
        if(empty($_POST["nameUsuR"])) {
            $errorReg = "No ha introducido nombre de usuario <br> Debe modificar sus datos correctamente";
            $repetirReg = "<a href='modificar-datos.php'>Modificar datos de nuevo</a>";
            echo <<<hearDOC
                <main>
                    <section>
                        <p>
                            <h2 class='error'>$errorReg</h2>
                            $repetirReg
                        </p>
                    </section>
                </main>
hearDOC;
            $seguirEjecutando = false;
        }
    }

    if($seguirEjecutando){
        require_once("formulario-registro-filtros.php");

        //MODIFICO DATOS EN LA BDD
        if($insertarDatosUsu){
            $usuValido = $mysqli->real_escape_string($_SESSION["nameUsu"]);
            $usuariosRegistrados = "SELECT * FROM pibd.usuarios where usuarios.NomUsuario='$usuValido'";
            if(!($resultadoUsuarios = $mysqli->query($usuariosRegistrados))) {
                echo "<p>Error al ejecutar la sentencia <b>$usuariosRegistrados</b>: " . $mysqli->error . "</p>";
                exit;
            }
            while($filaUsu = $resultadoUsuarios->fetch_object()){
                $idUsu = $filaUsu->IdUsuario;
                //echo $_POST['cntrRActual'] . " --> " . $filaUsu->Clave;
                if($_POST['cntrRActual'] == $filaUsu->Clave){
                    $puedeModificar = true;
                }
                break;
            }
            $resultadoUsuarios->close();

            if(isset($idUsu) && !empty($idUsu)){
                if($puedeModificar){
                    $updateUsuario = "UPDATE pibd.usuarios SET NomUsuario = '$nomReg', Clave = '$clReg', Email = '$emReg', Sexo = '$seReg', FNacimiento = '$feNacReg', Ciudad = '$ciReg', Pais = '$paIdReg', Foto = '$foReg' WHERE IdUsuario = '$idUsu'";
                    if ($mysqli->query($updateUsuario) === TRUE) {
                        $correctoReg = "Se han modificado los datos correctamente";
                        $_SESSION["nameUsu"] = $datosReg['nameUsuR'];
                        $_SESSION["contrasenyaUsu"] = $datosReg['cntrR'];
                        setcookie("nombre_usuario", $_SESSION["nameUsu"], (time() + 60*60*24*90),'','',false, true);
                        setcookie("contrasenya_usuario", $_SESSION["contrasenyaUsu"], (time() + 60*60*24*90),'','',false, true);
                    } else {
                        echo "Error: " . $updateUsuario . "<br>" . $mysqli->error;
                    }
                } else{
                    $errorReg = "No se han podido modificar los datos <br>Ha olvidado confirmar con su contraseña actual";
                }
            } else{
                $errorReg = "No se han podido modificar los datos <br>No es un usuario registrado";
            }
        } else {
            $errorReg = "No se han podido modificar los datos <br>";
        }

        require_once("formulario-registro-filtros-imprimirDatos.php");
    }
    require_once("footer.inc.php");
?>

