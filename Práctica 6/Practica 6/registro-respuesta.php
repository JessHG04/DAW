<?php
    $title = "Respuesta del registro - Photory";
    $botonesHeader = "<a href='subir-foto.php'><span class='icon-upload-cloud'>Subir foto</span></a>
                      <a href='menu-usuario.php'><span class='icon-user'>Mi perfil</span></a>";
    require_once("head.inc");
    require_once("header.inc");


    $errorReg = "";
    if (!empty($_POST["nameUsuR"])) {
        if(!empty($_POST["cntrR"]) && !empty($_POST["cntrR2"])) {
            if($_POST["cntrR"] != $_POST["cntrR2"]) {
                $errorReg = "No coinciden las contraseñas";
            }
        } else {
            if(empty($_POST["cntrR"])) {
                $errorReg = "No ha introducido una contraseña";
            } else {
                $errorReg = "No ha repetido la contraseña";
            }
        }

echo <<<hearDOC
            <main>
                <section>
                    <p>
                        <h2 class='error'>$errorReg</h2>
hearDOC;
            foreach ($_POST as $clave => $valor) {
                if(empty($_POST[$clave])){
                    echo "<b>$clave: </b>No ha introducido datos<br>";
                }
                else if($valor != "Seleccione..." && $valor != "..."){
                    echo "<b>$clave: </b>$valor <br>";
                }
                else{
                    echo "<b>$clave: </b>No ha seleccionado<br>";
                }
            }
echo <<<hearDOC
                    <b>Foto de perfil: </b> ....
                </p>
            </section>
        </main>
hearDOC;
    } else {
        $errorReg = "No ha introducido nombre de usuario";
echo <<<hearDOC
            <main>
                <section>
                    <p>
                        <h2 class='error'>$errorReg</h2>
                    </p>
                </section>
            </main>
hearDOC;
    }
    require_once("footer.inc");
?>