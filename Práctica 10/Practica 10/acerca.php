<?php
    $title = "Acerca - Photory";
    require_once("head.inc.php");
    $subirFoto = "false";
    $miPerfil = "false";
    $iniciarSesion = "true";
    $registrate = "true";
    if(isset($_SESSION['nameUsu'])){
        $subirFoto = "true";
        $miPerfil = "true";
        $iniciarSesion = "false";
        $registrate = "false";
    }
    require_once("header.inc.php");
?>

<main>
    <section>
        <h2>¿Quiéres conocernos?</h2>
        <p>Esta página es un trabajo para la asignatura Desarrollo de Aplicaciones Web de 3º curso del grado de Ingeniería Multimedia de la <a href="https://www.ua.es/">Universidad de Alicante </a>.<br>
        Ha sido realizada por:</p>

        <table id="tablaAcerca">
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Correo electrónico</th>
            </tr>
            <tr>
                <td>Jéssica</td>
                <td>Hernández Gómez</td>
                <td>23900715</td>
                <td><a href="mailto:jessicahg04@gmail.com">jessicahg04@<wbr>gmail.com</a>
                </td>
            </tr>
            <tr>
                <td>Araceli Lucía</td>
                <td>Rebollo Domínguez</td>
                <td>48771144</td>
                <td><a href="mailto:ararebdom@gmail.com">ararebdom@<wbr>gmail.com</a>
                </td>
            </tr>
            <tr>
                <td colspan="2">Grupo Prácticas:</td>
                <td colspan="2">Grupo 1. Viernes de 11h a 13h</td>
            </tr>
        </table>
    </section>
</main>

<?php
    require_once("footer.inc.php");
?>