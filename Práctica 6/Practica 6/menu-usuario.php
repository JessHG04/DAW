<?php
    $title = "Menú usuario - Photory";
    $botonesHeader = "<a href='subir-foto.php'><span class='icon-upload-cloud'>Subir foto</span></a>";
    require_once("head.inc");
    require_once("header.inc");
?>

<main>
    <section>
        <img src="images/user.png" alt="Foto de usuario" height="200" width="200">
        <div id="Musuario">
            <h2>Raquel García</h2>
            <a href="baja.php">Darme de baja</a><br>
            <a href="album-usuario-id.php">Mis álbumes</a><br>
            <a href="crear-album.php">Crear álbum</a><br>
            <a href="solicitar-album.php">Solicitar álbum</a><br>
            <a href="index.php" class="enlaceSalirUsu">Salir</a>
        </div>
    </section>
</main>

<?php
    require_once("footer.inc");
?>