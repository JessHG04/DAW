<?php
    $title = "Configurar estilo respuesta - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }

    if(isset($_SESSION['errorEst']) && isset($_SESSION['correctoEst']) && isset($_SESSION['nomEstilo'])) {
        $errorEst = $_SESSION['errorEst'];
        $correctoEst = $_SESSION['correctoEst'];
        $nomEstilo = $_SESSION['nomEstilo'];

        //Si no ha habido errores
        if($errorEst == ""){
            //saco el estilo actualizado en la bdd
            $usu = "SELECT * FROM pibd.usuarios where usuarios.NomUsuario='{$_SESSION["nameUsu"]}'";
            if(!($resultadoUsu = $mysqli->query($usu))) {
                echo "<p>Error al ejecutar la sentencia <b>$usu</b>: " . $mysqli->error . "</p>";
                exit;
            }
            while($filaUsu = $resultadoUsu->fetch_object()){
                $idUsu = $filaUsu->IdUsuario;
                $estUsus = $filaUsu->Estilo;
                break;
            }
            $resultadoUsu ->close();
            $estiloUsu = "SELECT * FROM pibd.estilos where estilos.IdEstilo='$estUsus'";
            if(!($resultadoEstilo = $mysqli->query($estiloUsu))) {
                echo "<p>Error al ejecutar la sentencia <b>$estiloUsu</b>: " . $mysqli->error . "</p>";
                exit;
            }
            while($filaEstilo = $resultadoEstilo->fetch_object()){
                $nomEstilo = $filaEstilo->Fichero;
                break;
            }
            $resultadoEstilo->close();
            //actualizo el estilo en la sesion y en la cookie si la hay
            if(isset($idUsu)){
                $_SESSION["estiloUsu"] = $nomEstilo;
                if(isset($_COOKIE['estiloUsu'])){
                    setcookie("estilo_usuario", $_SESSION["estiloUsu"], (time() + 60*60*24*90),'','',false, true);
                }
            }
        }
    }
?>
<main>
    <section>
        <p>
            <h2 class="error"><?php echo $errorEst; ?></h2>
            <h2 style="color:green;"><?php echo $correctoEst; ?></h2>
            <b>Estilo escogido: </b><?php echo $nomEstilo; ?><br>
        </p>
    </section>
</main>

<?php
    require_once("footer.inc.php");
?>
