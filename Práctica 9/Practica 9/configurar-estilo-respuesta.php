<?php
    $title = "Configurar estilo respuesta - Photory";
    require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }

    if(isset($_SESSION['errorEst']) && isset($_SESSION['correctoEst']) && isset($_SESSION['nomEstilo'])) {
        $errorEst = $_SESSION['errorEst'];
        $correctoEst = $_SESSION['correctoEst'];
        $nomEstilo = $_SESSION['nomEstilo'];
    }
?>
<main>
    <section>
        <p>
            <h2 class="error"><?php echo $errorEst; ?></h2>
            <h2 style="color:green;"><?php echo $correctoEst; ?></h2>
            <b>Estilo escogido: </b><?php echo $nomEstilo; ?><br>
        </p>
    </section>
</main>

<?php
    require_once("footer.inc.php");
?>
