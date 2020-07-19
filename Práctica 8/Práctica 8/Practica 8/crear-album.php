<?php
    $title = "Crear álbum - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(isset($_SESSION["nameUsu"])) {
?>

<main>
    <form class="registro" autocomplete="off" target="_self" action="menu-usuario.php" method="post">
        <fieldset>
            <legend><h2>Crea un álbum</h2></legend>

            <div>
                <label for="titulo">Título del álbum:</label>
                <input type="text" required autofocus id="titulo" maxlength="200" placeholder="Introduzca el titulo" name="titulo">
            </div>

            <div>
                <label for="texto">Descripción:</label>
                <textarea rows="4" cols="60" id="descripcion" placeholder="Puede añadir una descripción de su álbum" maxlength="4000"></textarea>
            </div>
            <input type="submit" value="Crear">
        </fieldset>
    </form>
</main>

<?php
        require_once("footer.inc.php");
    } else{
        header('Location: iniciar-sesion.php');
    }
?>