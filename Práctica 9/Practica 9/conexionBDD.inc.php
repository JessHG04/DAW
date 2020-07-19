<?php
   /*
   print_r(parse_ini_file("configuracion.ini"));
   echo '<br><br>';
   */
   parse_ini_file("configuracion.ini");

   // Conecta con el servidor de MySQL
   $mysqli = @new mysqli(
      'localhost',   // El servidor
      'wwwdata',    // El usuario
      '',          // La contraseña
      'pibd'); // La base de datos

   //Para que se lean bien los caracteres especiales que se recogen de la bdd
   mysqli_set_charset($mysqli, "utf8");

   if($mysqli->connect_errno) {
      echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
      echo '</p>';
      exit;
   }

   /*
   // Ejemplo escapa caracteres maliciosos de la sentencia
   $idValida = $mysqli->real_escape_string($id);
   $datosAlbumes = "SELECT * FROM pibd.albumes where albumes.usuario='$idValida'";

   // Ejecuta una sentencia SQL
   $sentencia = 'SELECT * FROM libros';
   if(!($resultado = $mysqli->query($sentencia))) {
      echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error;
      echo '</p>';
      exit;
   }

   echo '<table><tr>';
   echo '<th>IdLibro</th><th>Título</th><th>Resumen</th>';
   echo '<th>Autor</th><th>Categoría</th><th>Editorial</th><th>Anyo</th>';
   echo '</tr>';
   // Recorre el resultado y lo muestra en forma de tabla HTML
   while($fila = $resultado->fetch_object()) {
      echo "<tr>";
      echo "<td>$fila->IdLibro</td>";
      echo "<td>$fila->Titulo</td>";
      echo "<td>$fila->Resumen</td>";
      echo "<td>$fila->Autor</td>";
      echo "<td>$fila->Categoria</td>";
      echo "<td>$fila->Editorial</td>";
      echo "<td>$fila->Anyo</td>";
      echo "</tr>";
   }
   echo '</table>';

   // Libera la memoria ocupada por el resultado
   $resultado->close();
   // Cierra la conexión
   $mysqli->close();
   */

?>