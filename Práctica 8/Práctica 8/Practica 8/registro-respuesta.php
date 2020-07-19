<?php
    $title = "Respuesta del registro - Photory";
    require_once("head.inc.php");
    $subirFoto = "false";
    $miPerfil = "false";
    $iniciarSesion = "true";
    $registrate = "false";
    if(isset($_SESSION['nameUsu'])){
        $subirFoto = "true";
        $miPerfil = "true";
        $iniciarSesion = "false";
        $registrate = "false";
    }
    require_once("header.inc.php");


    $errorReg = "Se ha registrado correctamente <br>Compruebe su correo";
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
        $errorReg = "No ha introducido nombre de usuario <br> Debe registrarse correctamente";
echo <<<hearDOC
            <main>
                <section>
                    <p>
                        <h2 class='error'>$errorReg</h2>
                        <a href='registro.php'><span class='icon-user-plus'>Regístrate</span></a>
                    </p>
                </section>
            </main>
hearDOC;
    }
    require_once("footer.inc.php");
?>