<?php
    $title = "Configurar estilo - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errorEst = $correctoEst = "";
        $estiloValido = $mysqli->real_escape_string($_POST['cambioEstilos']);
        $estilos = "SELECT * FROM pibd.estilos where estilos.Fichero='$estiloValido'";
        if(!($resultadoEstilos = $mysqli->query($estilos))) {
            echo "<p>Error al ejecutar la sentencia <b>$estilos</b>: " . $mysqli->error . "</p>";
            exit;
        }
        while($filaEstilo = $resultadoEstilos->fetch_object()){
            $idEstilo = $filaEstilo->IdEstilo;
            $nomEstilo = $filaEstilo->Nombre;
            break;
        }
        $resultadoEstilos->close();

        $usuValido = $mysqli->real_escape_string($_SESSION["nameUsu"]);
        $usuariosRegistrados = "SELECT * FROM pibd.usuarios where usuarios.NomUsuario='$usuValido'";
        if(!($resultadoUsuarios = $mysqli->query($usuariosRegistrados))) {
            echo "<p>Error al ejecutar la sentencia <b>$usuariosRegistrados</b>: " . $mysqli->error . "</p>";
            exit;
        }
        while($filaUsu = $resultadoUsuarios->fetch_object()){
            $idUsu = $filaUsu->IdUsuario;
            break;
        }
        $resultadoUsuarios->close();

        if(isset($idEstilo) && !empty($idEstilo) && isset($idUsu) && !empty($idUsu)){
            $modificarEstiloUsu = "UPDATE pibd.usuarios SET usuarios.Estilo='$idEstilo' WHERE usuarios.IdUsuario = '$idUsu'";
            if ($mysqli->query($modificarEstiloUsu) === TRUE) {
                $_SESSION["estiloUsu"] = $estiloValido;
                setcookie("estilo_usuario", $_SESSION["estiloUsu"], (time() + 60*60*24*90),'','',false, true);
                $correctoEst = "Se ha actualizado el estilo de la página escogido";
                $_SESSION['errorEst'] = $errorEst;
                $_SESSION['correctoEst'] = $correctoEst;
                $_SESSION['nomEstilo'] = $nomEstilo;
                header('Location: configurar-estilo-respuesta.php');
            } else {
                $errorEst = "Ha habido un problema <br> El estilo no ha podido modificarse";
                $_SESSION['errorEst'] = $errorEst;
                $_SESSION['correctoEst'] = $correctoEst;
                $_SESSION['nomEstilo'] = $nomEstilo;
                header('Location: configurar-estilo-respuesta.php');
                //echo "Error modificando el estilo: " . $modificarEstiloUsu . "<br>" . $mysqli->error;
            }
        } else{
            $errorEst = "Ha habido un problema <br> El estilo escogido no existe";
            $_SESSION['errorEst'] = $errorEst;
            $_SESSION['correctoEst'] = $correctoEst;
            $_SESSION['nomEstilo'] = "";
            header('Location: configurar-estilo-respuesta.php');
        }
        //echo "$estiloValido --> $idEstilo";
    }

?>
<main>
    <form class="registro" autocomplete="off" target="_self" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <fieldset>
            <legend><h2>Configurando estilos....</h2></legend>
            <div id="listaEstilos">
                <div >
                    <input type="radio" checked name="cambioEstilos" value="normal" id="normal"> <label for="normal">Estilo normal</label> <br>
                    <input type="radio" name="cambioEstilos" value="impresion" id="impresion"> <label for="impresion">Estilo impresión</label><br>
                    <input type="radio" name="cambioEstilos" value="accesible" id="accesible"> <label for="accesible">Estilo accesible</label><br>
                    <input type="radio" name="cambioEstilos" value="adaptativo" id="adaptativo"> <label for="adaptativo">Estilo adaptativo</label><br>
                </div>
            </div>
            <input type="submit" value="Cambiar Estilo"><br>
        </fieldset>
    </form>
</main>

<?php
    require_once("footer.inc.php");
?>
