<header>
    <img src='images/Logo2.png' alt='Logo Photory' width='100' > <br>
    <h1> Photory </h1> <br>
    <h2> Tu sitio donde compartir fotografías </h2>
    <div>
        <?php
            if(isset($_SESSION['nameUsu'])){
                echo "<a href='menu-usuario.php'><span class='icon-user'>Mi perfil</span></a> <a href='subir-foto.php'><span class='icon-upload-cloud'>Subir foto</span></a> ";
            } else{
                 echo "<a href='iniciar-sesion.php'><span class='icon-login'>Inciar sesión</span></a>
                         <a href='registro.php'><span class='icon-user-plus'>Regístrate</span></a> ";
            }
        ?>
    </div>
</header>