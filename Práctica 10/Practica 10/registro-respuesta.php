<?php
    $title = "Respuesta del registro - Photory";
    require_once("head.inc.php");
    $subirFoto = "false";
    $miPerfil = "false";
    $iniciarSesion = "true";
    $registrate = "false";
    if(isset($_SESSION['nameUsu'])){
        $subirFoto = "true";
        $miPerfil = "true";
        $iniciarSesion = "false";
        $registrate = "false";
    }
    require_once("header.inc.php");

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
    $nombreCorrecto = $contrCorrecta = $emailCorecto = $sexoCorrecto = $fNacCorrecta = $fotoCorrecto = false;
    $insertarDatosUsu = false;
    $insertando = $modificando = false; //para ver que pongo en el boton de $repetirReg si enlace a modificar datos o a registro
    $nombreFoto = null;
    $yaInsertado = false;
    $hayFoto = true;

    if($seguirEjecutando){
        //NO hay nombre de usuario
        if(empty($_POST["nameUsuR"])) {
            $errorReg = "No ha introducido nombre de usuario <br> Debe registrarse correctamente";
            $repetirReg = "<a href='registro.php'><span class='icon-user-plus'>Regístrate</span></a>";
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
        $insertando = true;
        require_once("formulario-registro-filtros.php");

        //INSERTO DATOS EN LA BDD
        if($insertarDatosUsu){
            $usuarios = "SELECT * FROM pibd.usuarios where usuarios.NomUsuario='$nomReg'";
            if(!($resultadoUsuarios = $mysqli->query($usuarios))) {
                echo "<p>Error al ejecutar la sentencia <b>$usuarios</b>: " . $mysqli->error . "</p>";
                exit;
            }
            while($filaUsu = $resultadoUsuarios->fetch_object()){
                $idUsu = $filaUsu->IdUsuario;
                $yaInsertado = true;
                break;
            }
            $resultadoUsuarios->close();
            if(!$yaInsertado){
                $insertUsuario = "INSERT INTO pibd.usuarios (NomUsuario, Clave, Email, Sexo, FNacimiento, Ciudad, Pais, Foto, FRegistro, Estilo) VALUES ('$nomReg', '$clReg', '$emReg', '$seReg', '$feNacReg', '$ciReg', '$paIdReg', '$foReg', null, '1')";
                if ($mysqli->query($insertUsuario) === TRUE) {
                    $correctoReg = "Se ha registrado correctamente";
                } else {
                    echo "Error: " . $insertUsuario . "<br>" . $mysqli->error;
                }
            }else {
                $errorReg = "Ya hay registrado un usuario con ese nombre: $nomReg";
            }
        }

        require_once("formulario-registro-filtros-imprimirDatos.php");
    }
    require_once("footer.inc.php");
?>