<?php
    $title = "Solicitar álbum - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }
    echo <<<hearDOC
        <main>
            <section>
                <h2>Solicitud de impresión de álbum</h2>
                <p>Mediante esta opción puedes solicitar la impresión y envío de tus álbumes a todo color, toda resolución. Aquí tienes las tarifas. Ya sólo tienes que rellenar el siguiente formulario:</p>

            </section>
        </main>
hearDOC;
    require_once("tablaTarifas.inc");
?>
<main>
    <section>
        <form class="registro" id="formularioSolicitarAlbum" autocomplete="off" target="_self" action="solicitar-album-respuesta.php" method="post">
            <fieldset>
                <legend><h2>Formulario de solicitud</h2></legend>
                <p>Rellena el siguiente formulario aportando todos los detalles para confeccionar tu álbum.</p>

                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" placeholder="Introduzca su nombre" required maxlength="200" title="Introduzca su nombre" size ="25"> (*)
                </div>

                <div>
                    <label for="album">Título del álbum:</label>
                    <input type="text" id="album" placeholder="Introduzca el título del álbum" required maxlength="200" title="Introduzca el título del álbum" size ="25"> (*)
                </div>

                <div>
                    <label for="texto">Texto adicional:</label>
                    <textarea rows="4" cols="60" id="texto" placeholder="dedicatoria, descripción de su contenido, etc." maxlength="4000" title="dedicatoria, descripción de su contenido, etc."></textarea>
                </div>

                <div>
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" autocomplete="on" placeholder="Introduzca su email" required maxlength="200" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Introduzca su email" size ="25"> (*)
                </div>

                <div id="direccion">
                    <label for="calle">Dirección:</label>
                    <input type="text" id="calle" placeholder="Calle" required title="Introduzca su calle" size ="25">
                    <input type="number" id="numero" min="1" max="500" step="1" placeholder="Número" required>
                    <input type="text" id="puerta" placeholder="Puerta" title="Introduzca su puerta" size ="25">
                    <input type="number" id="cp" min="0" max="99999" step="1" placeholder="CP" size="25" required>

                    <input type="text" id="localidad" placeholder="Localidad" required title="Introduzca su localidad" size ="25">

                    <input type="text" id="provincia" placeholder="Provincia" required title="Introduzca su provincia" size ="25">

                    <select name="pais">
                        <?php
                            require_once("selectPaises.inc.php");
                        ?>
                    </select> (*)
                </div>

                <div>
                    <label for="telefono">Teléfono:</label>
                    <input type="number" id="telefono" min="0" max="999999999" size="25" step="1" placeholder="Teléfono">
                </div>

                <div>
                    <label for="calbum">Color de la portada:</label>
                    <input type="color" id="calbum" value="#000000">
                </div>

                <div>
                    <label for="copias">Número de copias:</label>
                    <input type="number" name="nCopias" id="copias" min="1" max="500" step="1" placeholder="Copias" value="1" required> (*)
                </div>

                <div>
                    <label for="resolucion">Resolución de impresión:</label>
                    <input type="range" name="resolucion" id="resolucion" min="150" max="900" step="150" value="150" onchange="document.getElementById('outresolucion').textContent=this.value">
                    <output id="outresolucion">150</output>
                </div>

                <div>
                    <label for="aphotory">Álbum de Photory:</label>
                    <select id="aphotory">
                    <?php
                    $usuarioAlbum = $_SESSION["nameUsu"];
                    $IdUsuario = "SELECT usuarios.IdUsuario from pibd.usuarios WHERE usuarios.NomUsuario ='" . $usuarioAlbum . "'";
                    if(!($resultadoIdUsuario = $mysqli->query($IdUsuario))){
                        echo "<p>Error al ejecutar la sentencia <b>$IdUsuario</b>: " . $mysqli->error;
                        echo '</p>';
                        exit;
                    }

                    while($filaUsu = $resultadoIdUsuario->fetch_object()){
                        $DatosAlbumes = 'SELECT albumes.Titulo FROM pibd.albumes, pibd.usuarios WHERE albumes.Usuario = usuarios.IdUsuario and usuarios.IdUsuario='.$filaUsu->IdUsuario;
                        if(!($resultadoDatosAlbumes = $mysqli->query($DatosAlbumes))){
                            echo "<p>Error al ejecutar la sentencia <b>$DatosAlbumes</b>: " . $mysqli->error;
                            echo '</p>';
                            exit;
                        }
                        while($filaAlbumes = $resultadoDatosAlbumes->fetch_object()){
                            echo "<option>$filaAlbumes->Titulo</option>";
                        }
                    }
                    $resultadoIdUsuario->close();
                    $resultadoDatosAlbumes->close();
                    ?>
                    </select> (*)
                </div>

                <div>
                    <label for="fechar">Fecha recepción:</label>
                    <input type="date" id="fechar" title="Introduzca la fecha en la que le gustaría recibirlo"> Fecha aproximada
                </div>

                <div>
                    <p>¿Impresión a color?</p>
                    <div>
                        <input type="radio" checked name="impresionColor[]" value="c" id="c"> <label for="c">Color</label>
                        <input type="radio" name="impresionColor[]" value="bn" id="bn"> <label for="bn">Blanco y negro</label>
                    </div>
                </div>
                <input type="submit" value="Enviar"><br>
            </fieldset>
        </form>
    </section>
</main>

<?php
    require_once("footer.inc.php");
?>