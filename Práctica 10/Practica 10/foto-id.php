<?php
    $title = "Foto - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }
    $id = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    //ID máximo para las comprobaciones de url
    $SeIdMax = 'SELECT * FROM pibd.fotos ORDER BY fotos.IdFoto DESC limit 1';
    if(!($resultadoIdMax = $mysqli->query($SeIdMax))){
        echo "<p>Error al ejecutar la sentencia <b>$SeIdMax</b>: " . $mysqli->error;
        echo "</p>";
        exit;
    }
    while($filaIdMax = $resultadoIdMax->fetch_object()){
        $IdMax = $filaIdMax->IdFoto;
        //echo $IdMax;
    }
    //ID mínimo para las comprobaciones de url
    $SeIdMin = 'SELECT * FROM pibd.fotos ORDER BY fotos.IdFoto limit 1';
    if(!($resultadoIdMin = $mysqli->query($SeIdMin))){
        echo "<p>Error al ejecutar la sentencia <b>$SeIdMin</b>: " . $mysqli->error;
        echo "</p>";
        exit;
    }
    while($filaIdMin = $resultadoIdMin->fetch_object()){
        $IdMin = $filaIdMin->IdFoto;
        //echo $IdMin;
    }

if($id == "" || $id ==null || !is_numeric($id) || $id<$IdMin || $id>$IdMax || !isset($id) ){
echo <<<hearDOC
<main>
    <section id="detalle-foto">
        <h2 class="error">ESTA FOTO NO EXISTE</h2>
    </section>
</main>
hearDOC;
    }else{
    // Ejecuta una sentencia SQL
    $idValida = $mysqli->real_escape_string($id);
    $foto = "SELECT * FROM pibd.fotos WHERE fotos.IdFoto ='$idValida'";
    if(!($resultadoFotos = $mysqli->query($foto))) {
        echo "<p>Error al ejecutar la sentencia <b>$foto</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }
    //Muestra el resultado
    while($filaFoto = $resultadoFotos->fetch_object()) {
        $fechaFoto = date_create($filaFoto->Fecha);
echo <<<hearDOC
        <main>
            <section id="detalle-foto">
                <h2>$filaFoto->Titulo</h2>
                <figure>
                    <img src=$filaFoto->Fichero alt="$filaFoto->Alternativo" width="400">
                </figure>
                <p>
                    <b>Título:</b> $filaFoto->Titulo</a> <br>
                    <b>Descripción:</b> $filaFoto->Descripcion</a> <br>
                    <b>Fecha:</b> <time datetime="$filaFoto->Fecha">
hearDOC;
        echo date_format($fechaFoto, 'd/m/Y') . "</time> <br>";
        $NombrePais = 'SELECT paises.* FROM pibd.fotos, pibd.paises where fotos.Pais = paises.IdPais';
        if(!($resultadoNomPais = $mysqli->query($NombrePais))) {
            echo "<p>Error al ejecutar la sentencia <b>$NombrePais</b>: " . $mysqli->error;
            echo '</p>';
            exit;
        }
        while($filaFoto2 = $resultadoNomPais->fetch_object()){
            if($filaFoto->Pais == $filaFoto2->IdPais){
echo <<<hearDOC
                    <b>País:</b> $filaFoto2->NomPais <br>
hearDOC;

            $NombreAlbum = 'SELECT albumes.* FROM pibd.fotos, pibd.albumes where fotos.Album = albumes.IdAlbum';
            if(!($resultadoNomAlbum = $mysqli->query($NombreAlbum))){
                echo "<p>Error al ejecutar la sentencia <b>$NombreAlbum</b>: " . $mysqli->error;
                echo '</p>';
                exit;
            }
                while($filaFoto3 = $resultadoNomAlbum->fetch_object()){
                    if($filaFoto->Album == $filaFoto3->IdAlbum){
echo <<<hearDOC
                    <b>Álbum:</b> <a href="albumes-id.php?id=$filaFoto3->IdAlbum"> $filaFoto3->Titulo</a> <br>
hearDOC;

                    $NombreUsuario = 'SELECT usuarios.* FROM pibd.fotos, pibd.albumes, pibd.usuarios where fotos.Album = albumes.IdAlbum and albumes.Usuario = usuarios.IdUsuario';
                    if(!($resultadoNomUsu = $mysqli->query($NombreUsuario))){
                        echo "<p>Error al ejecutar la sentencia <b>$NombreUsuario</b>: " . $mysqli->error;
                        echo '</p>';
                        exit;
                    }
                        while($filaFoto4 = $resultadoNomUsu->fetch_object()){
                            if($filaFoto3->Usuario == $filaFoto4->IdUsuario){
echo <<<hearDOC
                    <b>Usuario:</b><a href="usuario-id.php?=$filaFoto4->NomUsuario" > $filaFoto4->NomUsuario</a> <br>
hearDOC;
                                //El break es porque si no me imprimía dos veces el usuario
                                break;
                            }
                        }
                        //Este para que aunque tenga el mismo album que otra foto, no repita los datos
                        break;
                    }
                }
                //Este es para que aunque el país sea el mismo que tiene otra foto, no repita los datos
                break;
            }
        }
    }
    $resultadoFotos->close();
    $resultadoNomPais->close();
    $resultadoNomAlbum->close();
    $resultadoNomUsu->close();
}
$resultadoIdMax->close();
$resultadoIdMin->close();

?>
            </p>
        </section>
    </main>

<?php
    require_once("footer.inc.php");
?>