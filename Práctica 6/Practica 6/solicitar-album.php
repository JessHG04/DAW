<?php
    $title = "Solicitar álbum - Photory";
    $botonesHeader = "<a href='subir-foto.php'><span class='icon-upload-cloud'>Subir foto</span></a>
                      <a href='menu-usuario.php'><span class='icon-user'>Mi perfil</span></a>";
    require_once("head.inc");
    require_once("header.inc");
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
                        <option selected value="Seleccione...">Seleccione...</option>
                        <optgroup label="Europa">
                            <option>Albania</option>
                            <option>Alemania</option>
                            <option>Andorra</option>
                            <option>...</option>
                        </optgroup>

                        <optgroup label="América">
                            <option>Antigua y Barbuda</option>
                            <option>Argentina</option>
                            <option>Bahamas</option>
                            <option>...</option>
                        </optgroup>

                        <optgroup label="Asia">
                            <option>Afganistán</option>
                            <option>Arabia Saudita</option>
                            <option>Bangladés</option>
                            <option>...</option>
                        </optgroup>

                        <optgroup label="África">
                            <option>Angola</option>
                            <option>Argelia</option>
                            <option>Benín</option>
                            <option>...</option>
                        </optgroup>

                        <optgroup label="Oceanía">
                            <option>Australia</option>
                            <option>Fiyi</option>
                            <option>Islas Marshall</option>
                            <option>...</option>
                        </optgroup>

                        <optgroup label="Euroasia">
                            <option>Armenia</option>
                            <option>Azerbaiyán</option>
                            <option>Chipre</option>
                            <option>...</option>
                        </optgroup>
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
                        <option>mis álbumes</option>
                        <option>Álbum 1</option>
                        <option>Álbum 2</option>
                        <option>...</option>
                    </select> (*)
                </div>

                <div>
                    <label for="fechar">Fecha recepción:</label>
                    <input type="date" id="fechar" title="Introduzca la fecha en la que le gustaría recibirlo"> Fecha aproximada
                </div>

                <div>
                    <label for="c">¿Impresión a color?</label>
                    <input type="checkbox" name="imprssionColor[]" value="c" id="c">Color
                    <input type="checkbox" name="imprssionColor[]" value="bn" id="bn">Blanco y negro
                </div>
                <input type="submit" value="Enviar"><br>
            </fieldset>
        </form>
    </section>
</main>

<?php
    require_once("footer.inc");
?>