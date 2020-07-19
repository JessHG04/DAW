<?php
    $title = "Photory";
    require_once("head.inc.php");
    require_once("headerIndex.inc.php");
?>

<main>
    <form action="resultado-busqueda.php" id="formulario-index" method="post">
        <input type="text" name="titulo" maxlength="200" placeholder="Buscar">
        <button>Buscar</button>
        <a href="busqueda-avanzada.php">Avanzado<span class="icon-sliders"></span></a>
    </form>

    <section>
        <h2>Fotos recientes</h2>
        <div>
            <figure>
                <a href="foto-id.php?id=1">
                    <img src="images/ejemplo.jpg" alt="Paisaje estrellado de Noruega" height="200" width="200">
                </a>
                <figcaption>
                    <p>
                        <b>Título:</b> <a href="foto-id.php?id=1">Título de la foto</a> <br>
                        <b>Fecha:</b> <time datetime="2018-09-23">Domingo, 23/09/2018</time> <br>
                        <b>País:</b> Noruega
                    </p>
                </figcaption>
            </figure>

            <figure>
                <a href="foto-id.php?id=2">
                    <img src="images/ejemplo2.jpg" alt="Primer plano de búho" height="200" width="200">
                </a>
                <figcaption>
                    <p>
                        <b>Título:</b> <a href="foto-id.php?id=2">Título de la foto</a> <br>
                        <b>Fecha:</b> <time datetime="2018-09-20">Jueves, 20/09/2018</time> <br>
                        <b>País:</b> Rusia
                    </p>
                </figcaption>
            </figure>

            <figure>
                <a href="foto-id.php?id=3">
                    <img src="images/ejemplo3.jpg" alt="Camada de gatitos" height="200" width="200">
                </a>
                <figcaption>
                    <p>
                        <b>Título:</b> <a href="foto-id.php?id=3">Título de la foto</a> <br>
                        <b>Fecha:</b> <time datetime="2018-09-17">Lunes, 17/09/2018</time> <br>
                        <b>País:</b> España
                    </p>
                </figcaption>
            </figure>

            <figure>
                <a href="foto-id.php?id=4">
                    <img src="images/ejemplo4.jpg" alt="Bombero apagando un gran fuego" height="200" width="200">
                </a>
                <figcaption>
                    <p>
                        <b>Título:</b> <a href="foto-id.php?id=4">Título de la foto</a> <br>
                        <b>Fecha:</b> <time datetime="2018-09-14">Viernes, 14/09/2018</time> <br>
                        <b>País:</b> Argentina
                    </p>
                </figcaption>
            </figure>

            <figure>
                <a href="foto-id.php?id=5">
                    <img src="images/ejemplo5.jpg" alt="Escritorio con dos monitores para programar" height="200" width="200">
                </a>
                <figcaption>
                    <p>
                        <b>Título:</b> <a href="foto-id.php?id=5">Título de la foto</a> <br>
                        <b>Fecha:</b> <time datetime="2018-09-10">Lunes, 10/09/2018</time> <br>
                        <b>País:</b> Japón
                    </p>
                </figcaption>
            </figure>
        </div>
    </section>
</main>

<?php
    require_once("footer.inc");
?>