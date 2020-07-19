<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Página 2</title>
</head>

<body>
    <p>
        Tu nombre es
        <?php
        if(isset($_POST["nombre"]) && $_POST["nombre"]!="") {
            $_SESSION["nombre"] = $_POST["nombre"];
            echo $_POST["nombre"];
        } else {
            if(isset($_SESSION["nombre"]) && $_SESSION["nombre"]!="") {
                echo $_SESSION["nombre"];
            } else {
                echo "No tengo nombre";
            }
        }
        ?>
    </p>
    <p>
        <a href="pagina1.php">Página 1</a>
    </p>
</body>
</html>