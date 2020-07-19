<?php
    $title = "Foto - Photory";
    $botonesHeader = "<a href='iniciar-sesion.php'><span class='icon-login'>Inciar sesión</span></a>
                      <a href='registro.php'><span class='icon-user-plus'>Regístrate</span></a>";
    require_once("head.inc");
    require_once("header.inc");
$id = $_GET['id'];

if(($id % 2) != 0){
?>

<main>
    <section id="detalle-foto">
        <h2>Título de la foto</h2>
        <figure>
            <img src="images/ejemplo.jpg" alt="Paisaje estrellado de Noruega" height="400" width="400">
        </figure>
        <p>
            <b>Título:</b> Paisaje estrellado de Noruega <br>
            <b>Fecha:</b> <time datetime="2018-09-23">Domingo, 23/09/2018</time> <br>
            <b>País:</b> Noruega <br>
            <b>Álbum de fotos:</b> <a href="album-id.php">Álbum de la foto</a> <br>
            <b>Usuario:</b> <a href="usuario-id.php">Usuario 1</a> <br>
        </p>
    </section>
</main>
<?php
}else{
?>
<main>
    <section id="detalle-foto">
        <h2>Título de la foto</h2>
        <figure>
            <img src="images/ejemplo2.jpg" alt="Primer plano de búho" height="400" width="400">
        </figure>
        <p>
            <b>Título:</b> Primer plano de búho <br>
            <b>Fecha:</b> <time datetime="2018-09-20">Jueves, 20/09/2018</time> <br>
            <b>País:</b> Rusia <br>
            <b>Álbum de fotos:</b> <a href="album-id.php">Álbum de la foto</a> <br>
            <b>Usuario:</b> <a href="usuario-id.php">Usuario 1</a> <br>
        </p>
    </section>
</main>

<?php
}
    require_once("footer.inc");
?>