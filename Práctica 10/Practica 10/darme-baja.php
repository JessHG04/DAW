<?php
    $title = "Baja usuario - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }
?>
<main>
    <section>
        <?php
        $id = "";
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        //Comprobar id para que ese usuario exista en la bbdd

        //ID máximo para las comprobaciones de url
        $SeIdMax = 'SELECT * FROM pibd.usuarios ORDER BY usuarios.IdUsuario DESC limit 1';
        if(!($resultadoIdMax = $mysqli->query($SeIdMax))){
            echo "<p>Error al ejecutar la sentencia <b>$SeIdMax</b>: " . $mysqli->error;
            echo "</p>";
            exit;
        }
        while($filaIdMax = $resultadoIdMax->fetch_object()){
            $IdMax = $filaIdMax->IdUsuario;
            //echo $IdMax;
        }
        //ID mínimo para las comprobaciones de url
        $SeIdMin = 'SELECT * FROM pibd.usuarios ORDER BY usuarios.IdUsuario limit 1';
        if(!($resultadoIdMin = $mysqli->query($SeIdMin))){
            echo "<p>Error al ejecutar la sentencia <b>$SeIdMin</b>: " . $mysqli->error;
            echo "</p>";
            exit;
        }
        while($filaIdMin = $resultadoIdMin->fetch_object()){
            $IdMin = $filaIdMin->IdUsuario;
            //echo $IdMin;
        }

        if($id == "" || $id ==null || !is_numeric($id) || $id<$IdMin || $id>$IdMax || !isset($id)){
echo <<<hearDOC
<main>
    <section id="detalle-foto">
        <h2 class="error">ESTE USUARIO NO EXISTE</h2>
    </section>
</main>
hearDOC;
        }else{
            echo "<h2>Baja de {$_SESSION["nameUsu"]}</h2>";
            echo "<p><b>Se borrarán los siguientes datos: </b></p>";
            echo "<h3>Albumes: </h3>";


            $idValida = $mysqli->real_escape_string($id);
            $datosAlbumes = "SELECT * FROM pibd.albumes where albumes.usuario='$idValida'";
            if(!($resultadoAlbumes = $mysqli->query($datosAlbumes))) {
                echo "<p>Error al ejecutar la sentencia <b>$datosAlbumes</b>: " . $mysqli->error . "</p>";
                exit;
            }
            echo '<table><tr>';
            echo '<th style="text-align:center;">Título</th>';
            echo '<th style="text-align:center;">Numero de fotos</th>';
            echo '</tr>';
            $totalFotos = 0;
            while($filaAlbumes = $resultadoAlbumes->fetch_object()) {
                echo "<tr>";
                echo "<td><a href='albumes-id.php?id=$filaAlbumes->IdAlbum'> $filaAlbumes->Titulo</a></td>";

                $fotosAlbumes = "SELECT IdFoto FROM pibd.fotos where fotos.Album='$filaAlbumes->IdAlbum'";
                if(!($resultadoFotosAlbum = $mysqli->query($fotosAlbumes))) {
                    echo "<p>Error al ejecutar la sentencia <b>$fotosAlbumes</b>: " . $mysqli->error . "</p>";
                    exit;
                }
                $numFotos=0;
                while($filaFotos = $resultadoFotosAlbum->fetch_object()) {
                    $numFotos++;
                }
                if(isset($resultadoFotosAlbum)){
                    $resultadoFotosAlbum->close();
                }
                echo "<td style='text-align:center;'>$numFotos</td>";
                $totalFotos += $numFotos;
                echo "</tr>";
            }
            echo "<tr>";
            echo "<td style='text-align:center;'><b>Total de fotos: </b></td>";
            echo "<td style='text-align:center;'>$totalFotos</td>";
            echo "</tr>";
            echo '</table><br>';
            if(isset($resultadoAlbumes)){
                $resultadoAlbumes->close();
            }
        }
        $resultadoIdMax->close();
        $resultadoIdMin->close();
        ?>
    </section>

    <form class="registro" autocomplete="off" target="_self" action="darme-baja-respuesta.php" method="post">
        <fieldset>
            <legend><h2>Confirmar baja de usuario</h2></legend>
            <div>
                <label for="contrasenya">Confirma la baja con tu contraseña:</label>
                <input type="password" id="contrasenya" placeholder="Introduzca la contraseña para confirmar la baja" title="Introduzca la contraseña para confirmar la baja" size ="40" name="passConfBaja" value=""> <br>
            </div> <br>
            <input type="hidden" name="idUsuBaja" value="<?php echo $idValida;?>">
            <input type="submit" value="Dar de baja">
        </fieldset>
    </form> <br>
</main>
<?php
    require_once("footer.inc.php");
?>