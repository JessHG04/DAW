<?php
    $title = "Baja usuario - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }
?>
<main>
    <section>
        <?php
            $errorBaja = $errorBajaFotos = $errorBajaAlbumes = $correctoBaja = $correctoBajaFotos = $correctoBajaAlbumes = null;
            $puedeBorrar = false;

            //echo $_POST["passConfBaja"] . "<br>";
            //echo $_POST["idUsuBaja"] . "<br>";

            $idValida = $mysqli->real_escape_string($_POST["idUsuBaja"]);
            $usuarios = "SELECT * FROM pibd.usuarios where usuarios.IdUsuario='$idValida'";
            if(!($resultadoUsus = $mysqli->query($usuarios))) {
                echo "<p>Error al ejecutar la sentencia <b>$usuarios</b>: " . $mysqli->error . "</p>";
                exit;
            }
            while($filaUsus = $resultadoUsus->fetch_object()) {
                if($filaUsus->Clave == $_POST["passConfBaja"]){
                    $puedeBorrar = true;
                }
            }
            if(isset($resultadoUsus)){
                $resultadoUsus->close();
            }

            if($puedeBorrar){
                /*
                //BORRO FOTOS
                $idAlbumes = array();
                //Busco los id de los albumes para poder borrar las fotos de cada album
                $albumes = "SELECT * FROM pibd.albumes where albumes.Usuario='$idValida'";
                if(!($resultadoAlbumes = $mysqli->query($albumes))) {
                    echo "<p>Error al ejecutar la sentencia <b>$albumes</b>: " . $mysqli->error . "</p>";
                    exit;
                }
                while($filaAlbumes = $resultadoAlbumes->fetch_object()) {
                    $idAlbumes[] = $filaAlbumes->IdAlbum;
                }
                //print_r($idAlbumes);
                if(!empty($idAlbumes)){
                    foreach ($idAlbumes as $valor) {
                        //echo $valor;
                        $deleteFotosUsuario = "DELETE FROM pibd.fotos WHERE fotos.Album = '$valor'";
                        if ($mysqli->query($deleteFotosUsuario) === TRUE) {
                            $correctoBajaFotos = "Se han borrado las fotos correctamente";
                        } else {
                            $errorBajaFotos = "Lo sentimos ha habido un error y no se han podido borrar las fotos";
                            break;
                        }
                    }
                } else{
                    $errorBajaFotos = "Lo sentimos ha habido un error y no se han podido borrar las fotos";
                }
                //BORRO ALBUMES
                $deleteAlbumesUsuario = "DELETE FROM pibd.albumes WHERE albumes.Usuario = '$idValida'";
                if ($mysqli->query($deleteAlbumesUsuario) === TRUE) {
                    $correctoBajaAlbumes = "Se han borrado los álbumes correctamente";
                } else {
                    $errorBajaAlbumes = "Lo sentimos ha habido un error y no se han podido borrar los álbumes";
                }
                */
                //BORRO USUARIO con sus albumes y fotos
                $deleteUsuario = "DELETE FROM pibd.usuarios WHERE usuarios.IdUsuario = '$idValida'";
                //echo $idValida;
                if ($mysqli->query($deleteUsuario) === TRUE) {
                    $correctoBaja = "Baja de {$_SESSION["nameUsu"]} realizada correctamente";
                } else {
                    $errorBaja = "Lo sentimos ha habido un error y no se ha dado de baja";
                }
            } else{
                $errorBaja = "La contraseña para confirmar la baja no es correcta";
                $errorBajaAlbumes = "Lo sentimos ha habido un error y no se han podido borrar los álbumes";
                $errorBajaFotos = "Lo sentimos ha habido un error y no se han podido borrar las fotos";
            }
            //Destruyo la carpeta de sus fotos, las cookies y la sesion
            if($correctoBaja != null){
                /*
                $carpeta = "images/FotosUsuarios/" . $_SESSION["nameUsu"] . "/";
                if(file_exists("C:\\xampp\\htdocs\\DAW\\Practica 10\\" . $carpeta)) {
                    rmdir($carpeta);
                }
                */
                setcookie("nombre_usuario", $_SESSION["nameUsu"], (time() - 60*60*24*90));
                setcookie("contrasenya_usuario", $_SESSION["contrasenyaUsu"], (time() - 60*60*24*90));
                setcookie("estilo_usuario", $_SESSION["estiloUsu"], (time() - 60*60*24*90));
                $current_visit = date("c");
                setcookie("last_visit", $current_visit, (time() - 60*60*24*90));
                session_destroy();
                //Imprimo datos de borrado
                echo <<<hereDOC
                    <h2 style='color:green;'>$correctoBaja</h2>
                    </p><p>
                        <a href='registro.php'><span class='icon-user-plus'>Regístrate</span></a>
                    </p>
hereDOC;
            } else{
                //Imprimo datos de borrado con error
                echo "<h2 class='error'>$errorBaja</h2>";
                /*<p>
                    <b>Fotos: </b> $correctoBajaFotos  $errorBajaFotos
                </p>
                <p>
                    <b>Albumes: </b> $correctoBajaAlbumes $errorBajaAlbumes
                </p>*/
            }
        ?>
    </section>
</main>
<?php
    require_once("footer.inc.php");
?>