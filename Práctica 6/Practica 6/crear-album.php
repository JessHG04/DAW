<?php
    $title = "Crear álbum - Photory";
    $botonesHeader = "<a href='subir-foto.php'><span class='icon-upload-cloud'>Subir foto</span></a>
                      <a href='menu-usuario.php'><span class='icon-user'>Mi perfil</span></a>";
    require_once("head.inc");
    require_once("header.inc");
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
    require_once("footer.inc");
?>