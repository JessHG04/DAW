<?php
    $title = "Resultado de búsqueda - Photory";
    $botonesHeader = "<a href='iniciar-sesion.php'><span class='icon-login'>Inciar sesión</span></a>
                      <a href='registro.php'><span class='icon-user-plus'>Regístrate</span></a>";
    require_once("head.inc");
    require_once("header.inc");
?>

<main>
    <section>
        <h2>Resultado de búsqueda de imágenes</h2>
        <p>
            <b>Titulo:</b> <?php
            if(isset($_POST["titulo"])){
                echo $_POST["titulo"];
            }
            ?><br>

            <b>Fecha:</b> <?php
            if(isset($_POST["fecha"])){
                echo $_POST["fecha"];
            }
            ?><br>
            <b>País:</b> <?php
            if(isset($_POST["pais"])){
                if($_POST["pais"] != "Seleccione..." && $_POST["pais"] != "..."){
                    echo $_POST["pais"];
                }
            }
            ?><br>
<!-- <?php /*
            echo <<<hearDOC
            <b>Titulo:</b>
            if(isset([$_POST['titulo']])){
                [$_POST['titulo']]
            }
            </p><br>

            <b>Fecha:</b>
            if(isset([$_POST['fecha']])){
                 [$_POST['fecha']]
            }
            </p><br>
            <b>País:</b>
            if(isset([$_POST['pais']])){
                if([$_POST['pais']] != 'Seleccione...' && [$_POST['pais']] != '...'){
                    [$_POST['pais']]
                }
            }
hearDOC*/
            ?> -->
        </p>
        <div>
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
                        <b>Título:</b> <a href="foto-id.php?id=2">Título de la foto</a> <br>
                        <b>Fecha:</b> <time datetime="2018-09-17">Lunes, 17/09/2018</time> <br>
                        <b>País:</b> España
                    </p>
                </figcaption>
            </figure>
        </div>
    </section>
</main>

<?php
    require_once("footer.inc");
?>