<?php
    $title = "Respuesta álbum - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }


    $costeAlbum = 0;
    $respuestaAlbum1 = "No se ha podido realizar la solicitud";
    $respuestaAlbum2 = "";
    if(empty($_POST["impresionColor"])) {
        $respuestaAlbum1 = "Ha habido un error en su solicitud del álbum<br>
                            ¿Lo quieres a color o en blanco y negro?";
    } else {
        $respuestaAlbum2 = "Te notificaremos por correo cualquier cambio.";
        $imprC = $_POST["impresionColor"];
        $res = $_POST["resolucion"];
        $nCopy = $_POST["nCopias"];
        $nPag = 0;
        $nFotos = 0;

        $nomValido = $mysqli->real_escape_string($_POST['albumS']);
        $datosAlbumes = "SELECT * FROM pibd.albumes where albumes.Titulo='$nomValido'";
        if(!($resultadoAlbumes = $mysqli->query($datosAlbumes))) {
            echo "<p>Error al ejecutar la sentencia <b>$datosAlbumes</b>: " . $mysqli->error . "</p>";
            exit;
        }
        while($filaAlbumes = $resultadoAlbumes->fetch_object()) {
            $IdAlbum = $filaAlbumes->IdAlbum;
            $fotosAlbumes = "SELECT IdFoto FROM pibd.fotos where fotos.Album='$filaAlbumes->IdAlbum'";
            if(!($resultadoFotosAlbum = $mysqli->query($fotosAlbumes))) {
                echo "<p>Error al ejecutar la sentencia <b>$fotosAlbumes</b>: " . $mysqli->error . "</p>";
                exit;
            }
            while($filaFotos = $resultadoFotosAlbum->fetch_object()) {
                $nFotos++;
            }
            if(isset($resultadoFotosAlbum)){
                $resultadoFotosAlbum->close();
            }
        }
        if(isset($resultadoAlbumes)){
            $resultadoAlbumes->close();
        }
        //pongo por defecto que en cada pagina caben 4 fotos
        $nPag = ($nFotos / 4) + ($nFotos % 4 ? 1 : 0);

        //echo "$imprC[0] , $res , $nCopy <br>";
        $hayColor = 0;
        if($imprC[0] == 'c'){
            $hayColor = 1;
            $costeAlbum = 0.05*$nFotos;
            if($res > 300){
                $costeAlbum += 0.02*$nFotos;
                if($nPag < 5 ){
                    $costeAlbum += 0.1*$nPag;
                }else if($nPag > 5 and $nPag <= 10){
                    $costeAlbum += 0.08*$nPag;
                } else if($nPag > 11){
                    $costeAlbum += 0.07*$nPag;
                }
            } else {
                if($nPag < 5 ){
                    $costeAlbum += 0.1*$nPag;
                }else if($nPag > 5 && $nPag <= 10){
                    $costeAlbum += 0.08*$nPag;
                } else if($nPag > 11){
                    $costeAlbum += 0.07*$nPag;
                }
            }
        } else {
            if($res > 300){
                $costeAlbum += 0.02*$nFotos;
            } else {
                if($nPag < 5 ){
                    $costeAlbum += 0.1*$nPag;
                }else if($nPag > 5 && $nPag <= 10){
                    $costeAlbum += 0.08*$nPag;
                } else if($nPag > 11){
                    $costeAlbum += 0.07*$nPag;
                }
            }
        }
        $costeAlbum *= $nCopy;
    }

    //print_r($_POST);
    if(isset($_POST['puertaAlbumS'])){
        $puerta = "";
    } else{
        $puerta = $_POST['puertaAlbumS'];
    }
    $feA = date_create($mysqli->real_escape_string($_POST['fechaRecAlbumS']));
    $feAReg = date_format($feA, 'Y-m-d');
    $paisN = $mysqli->real_escape_string($_POST['pais']);
    $paises = "SELECT * FROM pibd.paises where paises.NomPais='$paisN'";
    if(!($resultadoPaises = $mysqli->query($paises))) {
        echo "<p>Error al ejecutar la sentencia <b>$paises</b>: " . $mysqli->error . "</p>";
        exit;
    }
    while($filaPais = $resultadoPaises->fetch_object()){
        $paIdReg = $filaPais->IdPais;
        break;
    }
    $resultadoPaises->close();



    $yaInsertado = false;
            $usuarios = "SELECT * FROM pibd.solicitudes where solicitudes.Titulo='{$_POST['tituloAlbumS']}'";
            if(!($resultadoUsuarios = $mysqli->query($usuarios))) {
                echo "<p>Error al ejecutar la sentencia <b>$usuarios</b>: " . $mysqli->error . "</p>";
                exit;
            }
            while($filaUsu = $resultadoUsuarios->fetch_object()){
                $yaInsertado = true;
                break;
            }
            $resultadoUsuarios->close();
            if(!$yaInsertado){
                $insertUsuario = "INSERT INTO pibd.solicitudes (Album, Nombre, Titulo, Descripcion, Email, Calle, Numero, Puerta, CP, Localidad, Provincia, Pais, Color, Copias, Resolucion, Fecha, IColor, Coste) VALUES ('$IdAlbum', '{$_POST['nomAlbumS']}', '{$_POST['tituloAlbumS']}', '{$_POST['descAlbumS']}', '{$_POST['emailAlbumS']}', '{$_POST['calleAlbumS']}', '{$_POST['nCalleAlbumS']}', '$puerta', '{$_POST['cpAlbumS']}', '{$_POST['localidadAlbumS']}', '{$_POST['provinciaAlbumS']}', '$paIdReg', '{$_POST['cPortadaAlbumS']}', '{$_POST['nCopias']}', '{$_POST['resolucion']}', '$feAReg', '$hayColor', '$costeAlbum')";
                if ($mysqli->query($insertUsuario) === TRUE) {
                    $respuestaAlbum1 = "¡¡¡Tu solicitud ha sido enviada con éxito!!!";
                } else {
                    echo "Error: " . $insertUsuario . "<br>" . $mysqli->error;
                }
            }else {
                $respuestaAlbum1 = "Este álbum ya estaba registrado";
            }

    echo <<<hearDOC
        <main>
            <section>
                    <h2>$respuestaAlbum1</h2>
                <p>
                    $respuestaAlbum2 <br>
                    <b>Coste álbum: $costeAlbum €</b>
                </p>
            </section>
        </main>
hearDOC;
    require_once("tablaTarifas.inc");
    require_once("footer.inc.php");
?>
