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
        <h2>FOTO SELECCIONADA</h2>
        <div id="fotoSele">
            <?php
                //Leo el fichero y me lo guardo
                if(($fichero = @file("images/imagenes seleccionadas.txt")) == false) {
                    echo "No se ha podido abrir el fichero images/imagenes seleccionadas.txt";
                } else  {
                    //print_r($fichero);
                    //echo "<br><br>";

                    //Guardo las lineas del fichero y el numero de lineas que hay en total, que seran el numero de fotos distintas que podra mostrar
                    $numLineas = 0;
                    foreach($fichero as $linea) {
                        $muestra[] = $linea;
                        $numLineas += 1;
                    }
                    //echo $linea . "<br><br>";
                    //print_r($muestra);

                    //Numero aleatorio para que cada vez utilice una foto distinta
                    $nAleatorio = rand(0, $numLineas-1);
                    //echo $nAleatorio;
                    setcookie("fotoAnterior", $nAleatorio, (time() + 60*60*24*90),'','',false, true);
                    if(isset($_COOKIE["fotoAnterior"])) {
                        while($_COOKIE["fotoAnterior"] == $nAleatorio){
                            $nAleatorio = rand(0, $numLineas-1);
                        }
                    }

                    //Me guardo el enlace de la foto elegida aleatoriamente
                    $selec = explode("|", $muestra[$nAleatorio]);
                    $enlace = $selec[0];
                    //print_r($selec);

                    //Muestro la imagen seleccionada con los datos del fichero "images/imagenes seleccionadas.txt"
                    $fotosSeleccion = "SELECT * FROM pibd.fotos WHERE fotos.Fichero='$enlace'";
                    if(!($resultadoSelec = $mysqli->query($fotosSeleccion))) {
                        echo "<p>Error al ejecutar la sentencia <b>$fotosSeleccion</b>: " . $mysqli->error . "</p>";
                        exit;
                    }
                    while($filaFotoSele = $resultadoSelec->fetch_object()) {
                        $fechaFoto1 = date_create($filaFotoSele->Fecha);
                        echo <<<hearDOC
                            <figure>
                                <figcaption>
                                    <p>
                                        <b>Foto seleccionada por:</b> {$selec[1]}<br>
                                        <b>Comentario:</b> {$selec[2]}
                                    </p>
                                </figcaption>
                                <a href="foto-id.php?id=$filaFotoSele->IdFoto">
                                    <img src=$filaFotoSele->Fichero alt="$filaFotoSele->Alternativo" width="200">
                                </a>
                                <figcaption>
                                    <p>
                                        <b>Título:</b> <a href="foto-id.php?id=$filaFotoSele->IdFoto">$filaFotoSele->Titulo</a> <br>
                                        <b>Fecha:</b> <time datetime="$filaFotoSele->Fecha">
hearDOC;
                        echo date_format($fechaFoto1, 'd/m/Y') . "</time> <br>";
                        $NombrePais = "SELECT paises.* FROM pibd.paises where $filaFotoSele->Pais = paises.IdPais";
                        if(!($resultadoNomPais1 = $mysqli->query($NombrePais))) {
                            echo "<p>Error al ejecutar la sentencia <b>$NombrePais</b>: " . $mysqli->error . "</p>";
                            exit;
                        }
                        while($filaFotoSele2 = $resultadoNomPais1->fetch_object()){
                            echo <<<hearDOC
                                        <b>País:</b> $filaFotoSele2->NomPais
                                    </p>
                                </figcaption>
                            </figure>
hearDOC;
                            break;
                        }
                        break;
                    }
                    $resultadoNomPais1->close();
                    $resultadoSelec->close();
                }
            ?>
        </div>
        <br>

        <h2>5 ÚLTIMAS FOTOS SUBIDAS</h2>
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
                            <img src=$filaFotos->Fichero alt="$filaFotos->Alternativo" width="200">
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