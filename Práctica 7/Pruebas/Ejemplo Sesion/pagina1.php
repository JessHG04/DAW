<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Página 1</title>
</head>

<body>
    <?php
        if(isset($_SESSION["nombre"]) && $_SESSION["nombre"]!=""){
            echo "<p>Tu nombre ya lo sé, es { " . $_SESSION["nombre"] . " }</p>";
            echo '<p><a href="pagina3.php">Salir</a></p>';
        } else{
    ?>
            <form action="pagina2.php" method="post">
                <p>
                    Nombre: <input type="text" name="nombre"> <br>
                    <input type="submit" name="Enviar">
                </p>
                <a href="pagina2.php">Página 2</a>
            </form>
    <?php
        }
    ?>
</body>
</html>