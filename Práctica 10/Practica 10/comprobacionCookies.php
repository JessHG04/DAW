<?php
    if(isset($_COOKIE["nombre_usuario"])) {
        for($i=0; $i<count($usuarios); $i++){
            if (strcmp($_COOKIE["nombre_usuario"], $usuarios[$i])==0) {
                if (strcmp($_COOKIE["contrasenya_usuario"], $contrasenyas[$i])==0) {
                    $_SESSION["nameUsu"] = $_COOKIE["nombre_usuario"];
                    $_SESSION["contrasenyaUsu"] = $_COOKIE["contrasenya_usuario"];
                    $_SESSION["estiloUsu"] = $_COOKIE["estilo_usuario"];

                    setcookie("nombre_usuario", $_SESSION["nameUsu"], (time() + 60*60*24*90),'','',false, true);
                    setcookie("contrasenya_usuario", $_SESSION["contrasenyaUsu"], (time() + 60*60*24*90),'','',false, true);
                    setcookie("estilo_usuario", $_SESSION["estiloUsu"], (time() + 60*60*24*90),'','',false, true);
                    $last_visit = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : "Primera vez";
                    $current_visit = date("c");
                    setcookie("last_visit", $current_visit, (time() + 60*60*24*90),'','',false, true);
                    break;
                } else{
                    header('Location: salir.php');
                }
            } else{
                header('Location: salir.php');
            }
        }
    }
?>