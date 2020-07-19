<?php  
	$title = "Álbum - Photory";
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
		//ID máximo para las comprobaciones de url
		$SeIdMax = 'SELECT * FROM pibd.albumes ORDER BY albumes.IdAlbum DESC limit 1';
		if(!($resultadoIdMax = $mysqli->query($SeIdMax))){
			echo "<p>Error al ejecutar la sentencia <b>$SeIdMax</b>: " . $mysqli->error;
		    echo "</p>";
		    exit;
		}
		while($filaIdMax = $resultadoIdMax->fetch_object()){
	        $IdMax = $filaIdMax->IdAlbum;
	        //echo $IdMax;
	    }
	    //ID mínimo para las comprobaciones de url
	    $SeIdMin = 'SELECT * FROM pibd.albumes ORDER BY albumes.IdAlbum limit 1';
		if(!($resultadoIdMin = $mysqli->query($SeIdMin))){
			echo "<p>Error al ejecutar la sentencia <b>$SeIdMin</b>: " . $mysqli->error;
		    echo "</p>";
		    exit;
		}
		while($filaIdMin = $resultadoIdMin->fetch_object()){
	        $IdMin = $filaIdMin->IdAlbum;
	        //echo $IdMin;
	    }

    	if($id == "" || $id ==null || !is_numeric($id) || $id<$IdMin || $id>$IdMax || !isset($id)){
echo <<<hearDOC
<main>
    <section id="detalle-foto">
        <h2 class="error">ESTE ALBUM NO EXISTE</h2>
    </section>
</main>
hearDOC;
	    }else{
			$paises = array();
			$paisesID = array();
			//Datos del álbum (muestro el titulo y me guardo la descripción)
			$datosAlbum = 'SELECT * FROM pibd.albumes where albumes.IdAlbum='.$id;
			if(!($resultadoAlbum = $mysqli->query($datosAlbum))) {
		        echo "<p>Error al ejecutar la sentencia <b>$datosAlbumes</b>: " . $mysqli->error;
		        echo "</p>";
		        exit;
		    }
		    while($filaAlbum = $resultadoAlbum->fetch_object()){
		    	  echo "<h2>$filaAlbum->Titulo</h2>";
		    	  $descripcionAlbum =$filaAlbum->Descripcion;
		    	  //echo "<p><b>Descripción: </b>$descripcionAlbum</p>";
		    }

			//Muestro las fotos, los países y las fechas
			$contenidoAlbum = 'SELECT * FROM pibd.fotos, pibd.albumes where fotos.album=albumes.IdAlbum and albumes.IdAlbum='.$id;
		    if(!($resultadoContenido = $mysqli->query($contenidoAlbum))) {
		        echo "<p>Error al ejecutar la sentencia <b>$contenidoAlbum</b>: " . $mysqli->error;
		        echo '</p>';
		        exit;
		    }
		    echo "<figure>";
		  	while($filaContenido = $resultadoContenido->fetch_object()){
echo <<< hearDOC
		                <a href="foto-id.php?id=$filaContenido->IdFoto">
		                    <img src=$filaContenido->Fichero alt="$filaContenido->Alternativo" height="200" width="200">
		                </a>
hearDOC;
	           	$NombresPaises = "SELECT paises.* FROM pibd.paises where $filaContenido->Pais = paises.IdPais";
	            if(!($resultadoNomPais = $mysqli->query($NombresPaises))) {
	                echo "<p>Error al ejecutar la sentencia <b>$NombresPaises</b>: " . $mysqli->error;
	                echo '</p>';
	                exit;
	            }
	            while($filaPaises = $resultadoNomPais->fetch_object()){
	           	//Me guardo el nombre de todos los países de las fotos
	            $paises[] = $filaPaises->NomPais;
	        	}
        	}
        	echo "<figcaption>";
            echo "<p><b>Descripción: </b>$descripcionAlbum</p>";
			echo "<p><b>Países: </b>";
			for($i=0; $i<count($paises); $i++){
				echo "$paises[$i] ";
			}
			echo "<br>";
		  	

		  	$FechaAntigua = "SELECT * FROM pibd.fotos, pibd.albumes where fotos.album=albumes.IdAlbum and albumes.IdAlbum=$id ORDER BY fotos.Fecha limit 1";
		  	if(!($resultadoFechaAntigua = $mysqli->query($FechaAntigua))) {
	            echo "<p>Error al ejecutar la sentencia <b>FechaAntigua</b>: " . $mysqli->error;
	            echo '</p>';
	            exit;
	        }
	        while($filaFAntigua = $resultadoFechaAntigua->fetch_object()){
	        	$fechaFotoAntigua = date_create($filaFAntigua->Fecha);
	        	echo "<p><b>Foto más antigua:</b> <time datetime='$filaFAntigua->Fecha'>";
	        	echo date_format($fechaFotoAntigua, 'd/m/Y') . "</time></p>";
	        }

	    	$FechaNueva = "SELECT * FROM pibd.fotos, pibd.albumes where fotos.album=albumes.IdAlbum and albumes.IdAlbum=$id ORDER BY fotos.Fecha DESC limit 1";
		   	if(!($resultadoFechaNueva = $mysqli->query($FechaNueva))) {
	            echo "<p>Error al ejecutar la sentencia <b>FechaNueva</b>: " . $mysqli->error;
	            echo '</p>';
	            exit;
	        }
	        while($filaFNueva = $resultadoFechaNueva->fetch_object()){
	        	$fechaFotoNueva = date_create($filaFNueva->Fecha);
	        	echo "<p><b>Foto más nueva:</b> <time datetime='$filaFNueva->Fecha'>";
	        	echo date_format($fechaFotoNueva, 'd/m/Y') . "</time></p>";
	        }

		  	if(isset($resultadoAlbum)){
		  		$resultadoAlbum->close();
		  	}
		   	if(isset($resultadoContenido)){
		  		$resultadoContenido->close();
		  	}
		  	if(isset($resultadoNomPais)){
		  		$resultadoNomPais->close();
		  	}
		  	if(isset($resultadoFechaAntigua)){
		  		$resultadoFechaAntigua->close();
		  	}
		  	if(isset($resultadoFechaNueva)){
		  		$resultadoFechaNueva->close();
		  	}
		  }
		$resultadoIdMax->close();
    	$resultadoIdMin->close();
		?>

			</figcaption>
		</figure>
	</section>
</main>
<?php
    require_once("footer.inc.php");
?>