<?php
    $title = "Iniciar sesión - Photory";
    require_once("head.inc.php");
    $subirFoto = "false";
    $miPerfil = "false";
    $iniciarSesion = "false";
    $registrate = "true";
    require_once("header.inc.php");

    $nameUsu = $pass = "";
    $nameErr = $passErr = "";
    $smsInicioErr = "";

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_SESSION["nameUsu"]) && $_SESSION["nameUsu"]!=""){
        header('Location: menu-usuario.php');
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $registrado = false;
        $passOk = false;

        if(empty($_POST["nameUsu"]) && empty($_POST["pass"])) {
            $nameErr = "Introduzca su nombre";
            $passErr = "Introduzca una contraseña";
            $nameUsu = "";
            $pass = "";
        } else if (empty($_POST["nameUsu"])) {
            $nameErr = "Introduzca su nombre";
            $nameUsu = "";
            $pass = "";
        } else if(empty($_POST["pass"])) {
            $passErr = "Introduzca una contraseña";
            $nameUsu = "";
            $pass = "";
        } else if(!empty($_POST["nameUsu"]) && !empty($_POST["pass"])) {
            $nameUsu = test_input($_POST["nameUsu"]);
            $pass = test_input($_POST["pass"]);

            for($i=0; $i<count($usuarios); $i++){
                if (strcmp($nameUsu, $usuarios[$i])==0) {
                    if (strcmp($pass, $contrasenyas[$i])==0) {
                        $registrado = true;
                        $passOk = true;
                        $nameUsu = $pass = "";
                        $nameErr = $passErr = "";
                        $smsInicioErr = "";
                        if(isset($_POST["nameUsu"]) && $_POST["nameUsu"]!=""){
                            $_SESSION["nameUsu"] = $_POST["nameUsu"];
                            $_SESSION["contrasenyaUsu"] = $_POST["pass"];
                            $_SESSION["estiloUsu"] = $estilos[$i];
                            if(isset($_POST["recordar"])){
                                //echo "me recuerdoooo";
                                /*
                                setcookie("nombre_usuario", $_SESSION["nameUsu"], (time() + 60*60*24*90), "/", ".", true, true);
                                echo $_SERVER["PHP_SELF"] ."<br>";
                                echo $_SERVER["REQUEST_URI"] ."<br>";
                                echo $_SERVER["DOCUMENT_ROOT"] ."<br>";
                                echo $_SERVER["SERVER_NAME"];
                                */
                                setcookie("nombre_usuario", $_SESSION["nameUsu"], (time() + 60*60*24*90),'','',false, true);
                                setcookie("contrasenya_usuario", $_SESSION["contrasenyaUsu"], (time() + 60*60*24*90),'','',false, true);
                                setcookie("estilo_usuario", $_SESSION["estiloUsu"], (time() + 60*60*24*90),'','',false, true);
                                $last_visit = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : "Primera vez";
                                /* Es lo mismo que poner este if:
                                if(isset($_COOKIE['last_visit'])){
                                    echo " " . $_COOKIE['last_visit'];
                                } else {
                                    echo " Primera vez";
                                }*/
                                $current_visit = date("c");
                                setcookie("last_visit", $current_visit, (time() + 60*60*24*90),'','',false, true);
                            }
                            header('Location: menu-usuario.php');
                        }
                    }
                }
            }
            if(!$registrado) {
                $smsInicioErr = "Usted no se ha registrado";
                $nameUsu = $pass = "";
            } else if(!$passOk) {
                $smsInicioErr = "";
                $smsInicioErr = "Ha olvidado su contraseña";
                $nameUsu = $pass = "";
            } else {
                $smsInicioErr = "";
            }
        } else{
            $nameUsu = $pass = "";
            $nameErr = $passErr = "";
            $smsInicioErr = "";
        }
    }
?>

<main>
    <form class="registro" autocomplete="off" target="_self" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <fieldset>
            <legend><h2>Iniciar sesión</h2></legend>

            <div>
                <label for="usuario">Nombre de usuario:</label>
                <input type="text" autofocus  id="usuario" placeholder="Introduzca un nombre de usuario" autocomplete="on" title="Introduzca un nombre de usuario" size ="40" name="nameUsu" value="<?php echo $nameUsu;?>"> <br>
                <p class="error"><?php echo $nameErr;?></p>
            </div>

            <div>
                <label for="contrasenya">Contraseña:</label>
                <input type="password" id="contrasenya" placeholder="Introduzca la contraseña" title="Introduzca la contraseña" size ="40" name="pass" value="<?php echo $pass;?>"> <br>
                <p class="error"><?php echo $passErr;?></p>
                <p class="error"><?php echo $smsInicioErr;?></p>
            </div>
            <div>
                <label for = "recordar">
                    <input type="checkbox" name="recordar" value="ok" id="recu"><label for="recu">Recordar mis datos</label>
                </label> <br>
            </div>
            <input type="submit" value="Iniciar sesión">
        </fieldset>
    </form>
</main>

<?php
    require_once("footer.inc.php");
?>