<?php
    $title = "Crear álbum - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])) {
        header('Location: iniciar-sesion.php');
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //echo $_POST['tituloAlbum'] . "<br>";
        //echo $_POST['descAlbum'] . "<br>";
        //echo $_SESSION["idUsu"] . "<br>";
        $insertarAlbum = true;
        $idValida = $mysqli->real_escape_string($_SESSION["idUsu"]);
        $tituloValido = $mysqli->real_escape_string($_POST['tituloAlbum']);
        $descValida = $mysqli->real_escape_string($_POST['descAlbum']);

        $albumes = "SELECT * FROM pibd.albumes where albumes.Titulo='$tituloValido'";
        if(!($resultadoAlbumes = $mysqli->query($albumes))) {
            echo "<p>Error al ejecutar la sentencia <b>$albumes</b>: " . $mysqli->error . "</p>";
            exit;
        }
        while($filaAlbum = $resultadoAlbumes->fetch_object()){
            $insertarAlbum = false;
            $errorCreaAlbum = "Este álbum ya se ha subido";
            break;
        }
        $resultadoAlbumes->close();

        if($insertarAlbum){
            $insertAlbum = "INSERT INTO pibd.albumes (Titulo, Descripcion, Usuario) VALUES ('$tituloValido', '$descValida', '$idValida')";
            if ($mysqli->query($insertAlbum) === TRUE) {
                $_SESSION['nombreAlbum'] = $tituloValido;
                header("Location: subir-foto.php");
            } else {
                echo "Error: " . $insertAlbum . "<br>" . $mysqli->error;
            }
        } else{
            echo "<h2 class='error'>Ha habido un error al subir el álbum</h2> $errorCreaAlbum";
        }

    }
?>

<main>
    <form class="registro" autocomplete="off" target="_self" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <fieldset>
            <legend><h2>Crea un álbum</h2></legend>

            <div>
                <label for="titulo">Título del álbum:</label>
                <input type="text" required autofocus id="titulo" maxlength="200" placeholder="Introduzca el titulo" name="tituloAlbum">
            </div>

            <div>
                <label for="texto">Descripción:</label>
                <textarea rows="4" cols="60" id="descripcion" placeholder="Puede añadir una descripción de su álbum" maxlength="4000" name="descAlbum"></textarea>
            </div>
            <input type="submit" value="Crear">
        </fieldset>
    </form>
</main>

<?php
    require_once("footer.inc.php");
?>