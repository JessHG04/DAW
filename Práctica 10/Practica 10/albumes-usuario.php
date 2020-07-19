<?php
	$title = "Mis álbumes - Photory";
	require_once("head.inc.php");
    $subirFoto = "true";
    $miPerfil = "true";
    $iniciarSesion = "false";
    $registrate = "false";
    require_once("header.inc.php");
    if(!isset($_SESSION["nameUsu"])){
        header('Location: iniciar-sesion.php');
    }
?>
<main>
	<section>
		<?php
		$id = "";
	    if(isset($_GET['id'])){
	        $id = $_GET['id'];
	    }
		//Comprobar id para que ese usuario exista en la bbdd

		//ID máximo para las comprobaciones de url
		$SeIdMax = 'SELECT * FROM pibd.usuarios ORDER BY usuarios.IdUsuario DESC limit 1';
		if(!($resultadoIdMax = $mysqli->query($SeIdMax))){
			echo "<p>Error al ejecutar la sentencia <b>$SeIdMax</b>: " . $mysqli->error;
		    echo "</p>";
		    exit;
		}
		while($filaIdMax = $resultadoIdMax->fetch_object()){
	        $IdMax = $filaIdMax->IdUsuario;
	        //echo $IdMax;
	    }
	    //ID mínimo para las comprobaciones de url
	    $SeIdMin = 'SELECT * FROM pibd.usuarios ORDER BY usuarios.IdUsuario limit 1';
		if(!($resultadoIdMin = $mysqli->query($SeIdMin))){
			echo "<p>Error al ejecutar la sentencia <b>$SeIdMin</b>: " . $mysqli->error;
		    echo "</p>";
		    exit;
		}
		while($filaIdMin = $resultadoIdMin->fetch_object()){
	        $IdMin = $filaIdMin->IdUsuario;
	        //echo $IdMin;
	    }

		if($id == "" || $id ==null || !is_numeric($id) || $id<$IdMin || $id>$IdMax || !isset($id)){
echo <<<hearDOC
<main>
    <section id="detalle-foto">
        <h2 class="error">ESTE USUARIO NO EXISTE</h2>
    </section>
</main>
hearDOC;
	    }else{
	    	echo "<h2>Mis álbumes</h2>";
	    	$idValida = $mysqli->real_escape_string($id);
		    $datosAlbumes = "SELECT * FROM pibd.albumes where albumes.usuario='$idValida'";
		    if(!($resultadoAlbumes = $mysqli->query($datosAlbumes))) {
		        echo "<p>Error al ejecutar la sentencia <b>$datosAlbumes</b>: " . $mysqli->error;
		        echo '</p>';
		        exit;
		    }
		    echo '<table><tr>';
		    echo '<th style="text-align:center;">Título</th>';
		    echo '<th style="text-align:center;">Descripción</th>';
		    echo '</tr>';
		    while($filaAlbumes = $resultadoAlbumes->fetch_object()) {
		        echo "<tr>";
		        echo "<td><a href='albumes-id.php?id=$filaAlbumes->IdAlbum'> $filaAlbumes->Titulo</a></td>";
		        echo "<td>$filaAlbumes->Descripcion</td>";
		        echo "</tr>";
		    }
		    echo '</table><br>';
		    if(isset($resultadoAlbumes)){
		        $resultadoAlbumes->close();
		    }
		}
		$resultadoIdMax->close();
    	$resultadoIdMin->close();
		?>
	</section>
</main>
<?php
    require_once("footer.inc.php");
?>