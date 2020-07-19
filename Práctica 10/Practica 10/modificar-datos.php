<?php
    $title = "Modificar datos - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }


    echo "<main>";
    $nomValido = $mysqli->real_escape_string($_SESSION["nameUsu"]);
    $datosUsuario = "SELECT * FROM pibd.usuarios where usuarios.NomUsuario ='$nomValido'";
    if(!($resultadoDatosUsu = $mysqli->query($datosUsuario))) {
        echo "<p>Error al ejecutar la sentencia <b>$datosUsuario</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }
    while($filaDatosUsu = $resultadoDatosUsu->fetch_object()) {
        $fechaNacUsu = date_create($filaDatosUsu->FNacimiento);
        $fechaRegUsu = date_create($filaDatosUsu->FRegistro);
        if(isset($filaDatosUsu->Foto) && $filaDatosUsu->Foto != ""){
            $enlace = $filaDatosUsu->Foto;
        } else{
            $enlace = '"images/user.png"';
        }
echo <<<hearDOC
        <section>
            <h1>Mis Datos</h1>
            <b>Foto: </b> <br><img src=$enlace alt="$filaDatosUsu->NomUsuario" width="200"> <br>
            <b>Nombre de usuario: </b>$filaDatosUsu->NomUsuario <br>
            <b>Contraseña: </b>
hearDOC;
            $caracteresClave = strlen($filaDatosUsu->Clave);
            for ($i=0; $i < $caracteresClave; $i++) {
                echo "*";
            }
            echo "<br>";
            //echo "$filaDatosUsu->Clave<br>";
echo <<<hearDOC
            <b>Email: </b>$filaDatosUsu->Email <br>
            <b>Sexo: </b>
hearDOC;
            $nombreUsuReg = $filaDatosUsu->NomUsuario;
            $contrUsuReg = $filaDatosUsu->Clave;
            $contr2UsuReg = $filaDatosUsu->Clave;
            $emailUsuReg = $filaDatosUsu->Email;
            $sexoUsuReg = $filaDatosUsu->Sexo;
            $fNacUsuReg = $filaDatosUsu->FNacimiento;
            $ciudadUsuReg = $filaDatosUsu->Ciudad;
            if($filaDatosUsu->Sexo == 1){
                echo "Mujer <br>";
            } else{
                echo "Hombre <br>";
            }
            echo "<b>Fecha de nacimiento: </b>" . date_format($fechaNacUsu, 'd/m/Y') . "<br>";
            echo "<b>Ciudad: </b>$filaDatosUsu->Ciudad <br>";
            echo "<b>Pais: </b>";
            $NombresPaises = "SELECT paises.* FROM pibd.paises where $filaDatosUsu->Pais = paises.IdPais";
            if(!($resultadoNomPais = $mysqli->query($NombresPaises))) {
                echo "<p>Error al ejecutar la sentencia <b>$NombresPaises</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
            while($filaFotos2 = $resultadoNomPais->fetch_object()){
                $paisUsuReg = $filaFotos2->NomPais;
                echo "$filaFotos2->NomPais <br>";
            }
            echo "<b>Fecha de registro: </b>". date_format($fechaRegUsu, 'd/m/Y') . " a las " . date_format($fechaRegUsu, 'H:m:s') . "h<br>";
            echo "<b>Estilo: </b>";
            //$filaDatosUsu->Estilo <br>
            $datoEstiloUsu = "SELECT estilos.* FROM pibd.estilos where $filaDatosUsu->Estilo = estilos.IdEstilo";
            if(!($resultadoEstiloUsu = $mysqli->query($datoEstiloUsu))) {
                echo "<p>Error al ejecutar la sentencia <b>$datoEstiloUsu</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
            while($filaEstiloUsu = $resultadoEstiloUsu->fetch_object()){
                echo "$filaEstiloUsu->Nombre <br>";
            }
        echo "</section>";
    }
    $resultadoDatosUsu->close();
    $resultadoNomPais->close();
    $resultadoEstiloUsu->close();

    $titleFormReg = "Modificar datos";
    $titleButtonReg = "Modificar";
    $enlaceFormReg = "modificar-datos-respuesta.php";
    require_once("formulario-registro.php");
    echo "</main>";


    require_once("footer.inc.php");
?>

