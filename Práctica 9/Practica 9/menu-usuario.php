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
        <?php
            $usuarioNom = $mysqli->real_escape_string($_SESSION["nameUsu"]);
            $IdUsuario = "SELECT * from pibd.usuarios WHERE usuarios.NomUsuario ='$usuarioNom'";
            if(!($resultadoIdUsuario = $mysqli->query($IdUsuario))){
                echo "<p>Error al ejecutar la sentencia <b>$IdUsuario</b>: " . $mysqli->error . "</p>";
                exit;
            }
            while($filaUsu = $resultadoIdUsuario->fetch_object()){
                echo <<<hereDOC
                    <img src=$filaUsu->Foto alt="$filaUsu->NomUsuario" height="200" width="200" id="fotoPerfilUsu">
                    <div id="Musuario">
                        <h2>
hereDOC;
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
                $_SESSION["idUsu"] = $filaUsu->IdUsuario;
                echo <<<hereDOC
                        </h2>
                        <a href='darme-baja.php?id=$filaUsu->IdUsuario'>Darme de baja</a><br>
                        <a href='albumes-usuario.php?id=$filaUsu->IdUsuario'>Mis álbumes</a><br>
hereDOC;
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