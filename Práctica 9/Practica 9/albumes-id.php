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
				echo "<p>Error al ejecutar la sentencia <b>$SeIdMax</b>: " . $mysqli->error . "</p>";
			    exit;
			}
			while($filaIdMax = $resultadoIdMax->fetch_object()){
		        $IdMax = $filaIdMax->IdAlbum;
		        //echo $IdMax;
		    }
		    //ID mínimo para las comprobaciones de url
		    $SeIdMin = 'SELECT * FROM pibd.albumes ORDER BY albumes.IdAlbum limit 1';
			if(!($resultadoIdMin = $mysqli->query($SeIdMin))){
				echo "<p>Error al ejecutar la sentencia <b>$SeIdMin</b>: " . $mysqli->error . "</p>";
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
		    } else{
				$paises = array();
				$paisesID = array();
				//Datos del álbum (muestro el titulo y me guardo la descripción)
				$idValida = $mysqli->real_escape_string($id);
				$datosAlbum = "SELECT * FROM pibd.albumes where albumes.IdAlbum='$idValida'";
				if(!($resultadoAlbum = $mysqli->query($datosAlbum))) {
			        echo "<p>Error al ejecutar la sentencia <b>$datosAlbumes</b>: " . $mysqli->error;
			        echo "</p>";
			        exit;
			    }
			    while($filaAlbum = $resultadoAlbum->fetch_object()){
					echo "<h2>Álbum: $filaAlbum->Titulo</h2>";
					$descAlbum = $filaAlbum->Descripcion;
					//echo "<p><b>Descripción del álbum: </b>$filaAlbum->Descripcion</p><br>";
					$idAlbumActual = $filaAlbum->IdAlbum;
					$idUsu = $filaAlbum->Usuario;
			    }

				//Muestro las fotos, los países y las fechas
				$contenidoAlbum = "SELECT * FROM pibd.fotos where fotos.Album='$idValida'";
			    if(!($resultadoContenido = $mysqli->query($contenidoAlbum))) {
			        echo "<p>Error al ejecutar la sentencia <b>$contenidoAlbum</b>: " . $mysqli->error;
			        echo '</p>';
			        exit;
			    }
			    $hayFotos = false;
			    echo "<div>";
			  	while($filaContenido = $resultadoContenido->fetch_object()){
			  		$hayFotos = true;
			  		$fechaFoto = date_create($filaContenido->Fecha);
					echo <<< hearDOC
		                <figure>
			                <a href="foto-id.php?id=$filaContenido->IdFoto">
			                    <img src=$filaContenido->Fichero alt="$filaContenido->Alternativo" height="200" width="200">
			                </a>
			                <figcaption>
			                    <p>
			                        <b>Título:</b> <a href="foto-id.php?id=$filaContenido->IdFoto">$filaContenido->Titulo</a> <br>
			                        <b>Fecha:</b> <time datetime="$filaContenido->Fecha">
hearDOC;
	                echo date_format($fechaFoto, 'd/m/Y') . "</time> <br>";
	                $NombresPaises = "SELECT paises.* FROM pibd.paises where $filaContenido->Pais = paises.IdPais";
	                if(!($resultadoNomPais = $mysqli->query($NombresPaises))) {
	                    echo "<p>Error al ejecutar la sentencia <b>$NombresPaises</b>: " . $mysqli->error . "</p>";
	                    exit;
	                }
	                while($filaFotos2 = $resultadoNomPais->fetch_object()){
	                    echo <<<hearDOC
                                	<b>País:</b> $filaFotos2->NomPais
			                    </p>
			                </figcaption>
		                </figure>
hearDOC;
		            }
		            $resultadoNomPais->close();
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
	        	echo "</div>";
	        	if(!$hayFotos){
			    	echo "<p><b>Descripción del álbum: </b>$descAlbum</br></p>";
			    	echo "<p class='error'><b>NO HAY FOTOS EN ESTE ÁLBUM</b></p>";
	        	}
	        	else{
	        		echo "<p><b>Descripción del álbum: </b>$descAlbum</br></br>";
					echo "<b>Países donde se tomaron las fotos: </b><br>";
					for($i=0; $i<count($paises); $i++){
						echo " - $paises[$i]<br>";
					}
					echo "</br>";

				  	$FechaAntigua = "SELECT * FROM pibd.fotos, pibd.albumes where fotos.album=albumes.IdAlbum and albumes.IdAlbum='$idValida' ORDER BY fotos.Fecha limit 1";
				  	if(!($resultadoFechaAntigua = $mysqli->query($FechaAntigua))) {
			            echo "<p>Error al ejecutar la sentencia <b>FechaAntigua</b>: " . $mysqli->error . "</p>";
			            exit;
			        }
			        while($filaFAntigua = $resultadoFechaAntigua->fetch_object()){
			        	$fechaFotoAntigua = date_create($filaFAntigua->Fecha);
			        	echo "<b>Foto más antigua:</b> <time datetime='$filaFAntigua->Fecha'>";
			        	echo date_format($fechaFotoAntigua, 'd/m/Y') . "</time></br></br>";
			        }

			    	$FechaNueva = "SELECT * FROM pibd.fotos, pibd.albumes where fotos.album=albumes.IdAlbum and albumes.IdAlbum='$idValida' ORDER BY fotos.Fecha DESC limit 1";
				   	if(!($resultadoFechaNueva = $mysqli->query($FechaNueva))) {
			            echo "<p>Error al ejecutar la sentencia <b>FechaNueva</b>: " . $mysqli->error. "</p>";
			            exit;
			        }
			        while($filaFNueva = $resultadoFechaNueva->fetch_object()){
			        	$fechaFotoNueva = date_create($filaFNueva->Fecha);
			        	echo "<b>Foto más nueva:</b> <time datetime='$filaFNueva->Fecha'>";
			        	echo date_format($fechaFotoNueva, 'd/m/Y') . "</time></br></br>";
			        }

			        $usuariosRegistrados = "SELECT * FROM pibd.usuarios where usuarios.IdUsuario='$idUsu'";
			        if(!($resultadoUsuarios = $mysqli->query($usuariosRegistrados))) {
			            echo "<p>Error al ejecutar la sentencia <b>$usuariosRegistrados</b>: " . $mysqli->error . "</p>";
			            exit;
			        }
			        while($filaUsu = $resultadoUsuarios->fetch_object()){
			        	echo "<b>Usuario:</b> $filaUsu->NomUsuario</br></p>";
			        	break;
			        }
			        $resultadoUsuarios->close();

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
			}
			if(isset($resultadoIdMax)){
				$resultadoIdMax->close();
		  	}
		  	if(isset($resultadoIdMin)){
		  		$resultadoIdMin->close();
		  	}
		?>
	</section>
</main>
<?php
    require_once("footer.inc.php");
?>