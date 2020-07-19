<?php
    $title = "Menú usuario - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "false";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }
    $last_visit = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : "Primera vez";
?>

<main>
    <section>
        <img src="images/user.png" alt="Foto de usuario" height="200" width="200" id="fotoPerfilUsu">
        <div id="Musuario">
            <h2>
            <?php
                if(isset($_SESSION["nameUsu"]) && $_SESSION["nameUsu"]!="") {
                    if(isset($_COOKIE['last_visit'])){
                        $date = date_create($last_visit);
echo <<<hereDOC
                        <h2>Hola {$_SESSION["nameUsu"]}</h2>
                        <p>Su última visita fue el
hereDOC;
                        echo " <b>" . date_format($date, 'd/m/Y');
                        echo "</b> a las <b>" .  date_format($date, 'H:i') . "h</b></p>";
                    } else {
                        echo "<h2>Hola {$_SESSION["nameUsu"]}</h2>";
                    }
                } else {
                    echo "<h2>No tengo nombre</h2>";
                }
            ?>
            </h2>
            <!-- <h2>Raquel García</h2> -->
            <a href="baja.php">Darme de baja</a><br>
            <?php
            $usuarioAlbum = $_SESSION["nameUsu"];
            $IdUsuario = "SELECT usuarios.IdUsuario from pibd.usuarios WHERE usuarios.NomUsuario ='" . $usuarioAlbum . "'";
            if(!($resultadoIdUsuario = $mysqli->query($IdUsuario))){
                echo "<p>Error al ejecutar la sentencia <b>$IdUsuario</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
            while($filaUsu = $resultadoIdUsuario->fetch_object()){
                echo "<a href='albumes-usuario.php?id=$filaUsu->IdUsuario'>Mis álbumes</a><br>";
            }

            $resultadoIdUsuario->close();
            ?>
            <a href="crear-album.php">Crear álbum</a><br>
            <a href="solicitar-album.php">Solicitar álbum</a><br>
            <a href="modificar-datos.php">Configurar mis datos</a><br>
            <a href="configurar-estilo.php">Configurar estilo de la página</a><br>
            <a href="salir.php" class="enlaceSalirUsu">Salir</a>
        </div>
    </section>
</main>

<?php
    require_once("footer.inc.php");
?>