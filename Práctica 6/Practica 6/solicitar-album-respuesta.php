<?php
    $title = "Respuesta álbum - Photory";
    $botonesHeader = "<a href='subir-foto.php'><span class='icon-upload-cloud'>Subir foto</span></a>
                      <a href='menu-usuario.php'><span class='icon-user'>Mi perfil</span></a>";
    require_once("head.inc");
    require_once("header.inc");



    $costeAlbum = 0;
    $respuestaAlbum1 = "¡¡¡Tu solicitud ha sido enviada con éxito!!!";
    $respuestaAlbum2 = "";
    if(empty($_POST["imprssionColor"])) {
        $respuestaAlbum1 = "Ha habido un error en su solicitud del álbum<br>
                            ¿Lo quieres a color o en blanco y negro?";
    } else {
        $respuestaAlbum2 = "Te notificaremos por correo cualquier cambio.";
        $imprC = $_POST["imprssionColor"];
        $res = $_POST["resolucion"];
        $nCopy = $_POST["nCopias"];
        $nPag = 10;
        $nFotos = 30;
        //echo "$imprC[0] , $res , $nCopy <br>";
        if($imprC[0] == 'c'){
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
    require_once("footer.inc");
?>
