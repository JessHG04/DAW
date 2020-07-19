<?php
    $title = "Photory";
    require_once("head.inc.php");
    require_once("headerIndex.inc.php");
?>

<main>
    <form action="resultado-busqueda.php" id="formulario-index" method="post">
        <input type="text" name="tituloAvan" maxlength="200" placeholder="Buscar">
        <button>Buscar</button>
        <a href="busqueda-avanzada.php">Avanzado<span class="icon-sliders"></span></a>
    </form>

    <section>
        <h2>Fotos recientes</h2>
        <div>
        <?php
            // Ejecuta una sentencia SQL
            $fotos = 'SELECT * FROM pibd.fotos ORDER BY FRegistro DESC limit 5';
            if(!($resultadoFotos = $mysqli->query($fotos))) {
                echo "<p>Error al ejecutar la sentencia <b>$fotos</b>: " . $mysqli->error . "</p>";
                exit;
            }
            // Recorre el resultado y lo muestra
            while($filaFotos = $resultadoFotos->fetch_object()) {
                $fechaFoto = date_create($filaFotos->Fecha);
                echo <<<hearDOC
                    <figure>
                        <a href="foto-id.php?id=$filaFotos->IdFoto">
                            <img src=$filaFotos->Fichero alt="$filaFotos->Alternativo" height="200" width="200">
                        </a>
                        <figcaption>
                            <p>
                                <b>Título:</b> <a href="foto-id.php?id=$filaFotos->IdFoto">$filaFotos->Titulo</a> <br>
                                <b>Fecha:</b> <time datetime="$filaFotos->Fecha">
hearDOC;
                echo date_format($fechaFoto, 'd/m/Y') . "</time> <br>";
                $NombresPaises = "SELECT paises.* FROM pibd.paises where $filaFotos->Pais = paises.IdPais";
                if(!($resultadoNomPais = $mysqli->query($NombresPaises))) {
                    echo "<p>Error al ejecutar la sentencia <b>$NombresPaises</b>: " . $mysqli->error . "</p>";
                    exit;
                }
                while($filaFotos2 = $resultadoNomPais->fetch_object()){
                    echo <<<hearDOC
                                <b>País:</b> $filaFotos2->NomPais
                            </p>
                        </figcaption>
                    </figure>
hearDOC;
                }
            }
            // Libera la memoria ocupada por los resultados
            $resultadoFotos->close();
            $resultadoNomPais->close();
        ?>
        </div>
    </section>
</main>

<?php
    require_once("footer.inc.php");
?>