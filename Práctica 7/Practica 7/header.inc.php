<header>
    <form action="resultado-busqueda.php" id="formulario-index" method="post">
        <div id="buscadorNav">
            <input type="text" name="titulo" maxlength="200" placeholder="Buscar">
            <button>Buscar</button>
        </div>
    </form>
    <a href="index.php"><img src="images/Logo2.png" alt="Logo Photory" width="100" ></a> <br>
    <h1> Photory </h1> <br>
    <h2>Tu sitio donde compartir fotografías</h2>
    <div>
        <?php
            if($iniciarSesion == "true"){
                echo "<a href='iniciar-sesion.php'><span class='icon-login'>Inciar sesión</span></a> ";
            }
            if($registrate == "true"){
                echo "<a href='registro.php'><span class='icon-user-plus'>Regístrate</span></a> ";
            }
            if($miPerfil == "true"){
                echo "<a href='menu-usuario.php'><span class='icon-user'>Mi perfil</span></a> ";
            }
            if($subirFoto == "true"){
                echo "<a href='subir-foto.php'><span class='icon-upload-cloud'>Subir foto</span></a> ";
            }

        ?>
        <!--
        <a href='iniciar-sesion.php'><span class='icon-login'>Inciar sesión</span></a>
        <a href='registro.php'><span class='icon-user-plus'>Regístrate</span></a>

        <a href='subir-foto.php'><span class='icon-upload-cloud'>Subir foto</span></a>
        <a href='menu-usuario.php'><span class='icon-user'>Mi perfil</span></a>
        -->
    </div>
</header>