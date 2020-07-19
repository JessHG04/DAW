<?php
    $title = "Subir Foto - Photory";
    require_once("head.inc.php");
    $subirFoto = "false";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }
?>
<main>
    <form class="registro" autocomplete="off" target="_self" action="subir-foto-respuesta.php" method="post">
        <fieldset>
            <legend><h2>Subir foto</h2></legend>
            <div>
                <label for="title">Título*:</label>
                <input type="text" autofocus required name="tituloFoto" id="title" placeholder="Introduzca un título para la foto" autocomplete="on" title="Introduzca un titulo para la foto" size ="40">
            </div>

            <div>
                <label for="description">Descripcion:</label>
                <textarea id = "description" rows="4" cols="60" id="texto" placeholder="Descripcion más detallada de la foto" maxlength="4000" name="descFoto" title="Descripción más detallada de la foto"></textarea>
            </div>

            <div>
                <label for="datePhoto">Fecha en la que se hizo la foto:</label>
                <input type="date" name="$fechaF" id="datePhoto" title="Introduzca la fecha en la que se realizó la foto">
            </div>

            <div>
                <label for="pais">País donde se hizo la foto:</label>
                <select id="pais" name="paisFoto">
                    <?php
                        require_once("selectPaises.inc.php");
                    ?>
                </select>
            </div>

            <div>
                <label for="nfileFoto">Foto*:</label>
                <span class="icon-upload"></span><input type="file" name="fileFoto" required id="nfile" accept="image/*" multiple class="boton">
            </div>

            <div>
                <label for="alternative">Texto alternativo:</label>
                <input type="text" required autofocus name="alternativoFoto" minlength="10" id="alternative" placeholder="Introduzca un texto alternativo para la foto (mínimo 10 caracteres)" autocomplete="on" title="Introduzca un texto alternativo para la foto (minimo 10 caracteres)" size ="40">
            </div>

            <div>
                <label for="aphotory">Álbum de Photory:</label>
                <select id="aphotory" name="albumFoto">
                <?php
                $usuarioAlbum = $mysqli->real_escape_string($_SESSION["nameUsu"]);
                $IdUsuario = "SELECT usuarios.IdUsuario from pibd.usuarios WHERE usuarios.NomUsuario ='$usuarioAlbum'";
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
                        if($_SESSION['nombreAlbum'] == $filaAlbumes->Titulo){
                            echo "<option selected>$filaAlbumes->Titulo</option>";
                        } else{
                            echo "<option>$filaAlbumes->Titulo</option>";
                        }
                    }
                }
                $_SESSION['nombreAlbum'] = null;
                $resultadoIdUsuario->close();
                $resultadoDatosAlbumes->close();
                ?>
                </select> (*)
            </div>


            <input type="submit" value="Subir la foto"><br>
        </fieldset>
    </form>
</main>

<?php
    require_once("footer.inc.php");
?>