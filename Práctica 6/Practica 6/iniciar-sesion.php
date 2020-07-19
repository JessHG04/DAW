<?php
    $title = "Iniciar sesión - Photory";
    $botonesHeader = "<a href='registro.php'><span class='icon-user-plus'>Regístrate</span></a>";
    require_once("head.inc");
    require_once("header.inc");


    $name = $pass = "";
    $nameErr = $passErr = "";
    $smsInicioErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuarios = array("usuario1", "usuario2", "usuario3", "usuario4");
        $contrasenyas = array("pass1", "pass2", "pass3", "pass4");
        $registrado = false;
        $passOk = false;

        if(empty($_POST["name"]) && empty($_POST["pass"])) {
            $nameErr = "Introduzca su nombre";
            $passErr = "Introduzca una contraseña";
            $name = "";
            $pass = "";
        } else if (empty($_POST["name"])) {
            $nameErr = "Introduzca su nombre";
            $name = "";
            $pass = "";
        } else if(empty($_POST["pass"])) {
            $passErr = "Introduzca una contraseña";
            $name = "";
            $pass = "";
        } else if(!empty($_POST["name"]) && !empty($_POST["pass"])) {
            $name = test_input($_POST["name"]);
            $pass = test_input($_POST["pass"]);

            for($i=0; $i<count($usuarios); $i++){
                if (strcmp($name, $usuarios[$i])==0) {
                    $registrado = true;
                    if (strcmp($pass, $contrasenyas[$i])==0) {
                        $passOk = true;
                        $name = $pass = "";
                        $nameErr = $passErr = "";
                        $smsInicioErr = "";
                        header('Location: menu-usuario.php');
                    }
                }
                if(!$registrado) {
                    $smsInicioErr = "Usted no se ha registrado";
                    $name = "";
                    $pass = "";
                } else if(!$passOk) {
                    $smsInicioErr = "";
                    $smsInicioErr = "Ha olvidado su contraseña";
                    $name = "";
                    $pass = "";
                } else {
                    $smsInicioErr = "";
                }
            }
        } else{
            $name = $pass = "";
            $nameErr = $passErr = "";
            $smsInicioErr = "";
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<main>
    <form class="registro" autocomplete="off" target="_self" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <fieldset>
            <legend><h2>Iniciar sesión</h2></legend>

            <div>
                <label for="usuario">Nombre de usuario:</label>
                <input type="text" autofocus  id="usuario" placeholder="Introduzca un nombre de usuario" autocomplete="on" title="Introduzca un nombre de usuario" size ="40" name="name" value="<?php echo $name;?>"> <br>
                <p class="error"><?php echo $nameErr;?></p>
            </div>

            <div>
                <label for="contrasenya">Contraseña:</label>
                <input type="password" id="contrasenya" placeholder="Introduzca la contraseña" title="Introduzca la contraseña" size ="40" name="pass" value="<?php echo $pass;?>"> <br>
                <p class="error"><?php echo $passErr;?></p>
                <p class="error"><?php echo $smsInicioErr;?></p>
            </div>
            <input type="submit" value="Iniciar sesión">
        </fieldset>
    </form>
</main>

<?php
    require_once("footer.inc");
?>