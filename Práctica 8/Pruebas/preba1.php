<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8" />
   <title>Prueba de SELECT y mysqli procedural</title>
</head>

<body>
   <?php
      print_r(parse_ini_file("configuracion.ini"));
      echo '<br><br>';

      // Conecta con el servidor de MySQL
      $link = @mysqli_connect(
         'localhost',   // El servidor
         'wwwdata',    // El usuario
         '',          // La contraseña
         'biblioteca'); // La base de datos

      //Para que se lean bien los caracteres especiales que se recogen de la bdd
      mysqli_set_charset($link, "utf8");

      if(!$link) {
         echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
         echo '</p>';
         exit;
      }

      // Ejecuta una sentencia SQL
      $sentencia = 'SELECT * FROM libros';
      if(!($resultado = @mysqli_query($link, $sentencia))) {
         echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link);
         echo '</p>';
         exit;
      }

      echo '<table><tr>';
      echo '<th>IdLibro</th><th>Título</th><th>Resumen</th>';
      echo '<th>Autor</th><th>Categoría</th><th>Editorial</th><th>Anyo</th>';
      echo '</tr>';
      // Recorre el resultado y lo muestra en forma de tabla HTML
      while($fila = mysqli_fetch_assoc($resultado)) {
         echo '<tr>';
         echo '<td>' . $fila['IdLibro'] . '</td>';
         echo '<td>' . $fila['Titulo'] . '</td>';
         echo '<td>' . $fila['Resumen'] . '</td>';
         echo '<td>' . $fila['Autor'] . '</td>';
         echo '<td>' . $fila['Categoria'] . '</td>';
         echo '<td>' . $fila['Editorial'] . '</td>';
         echo '<td>' . $fila['Anyo'] . '</td>';
         echo '</tr>';
      }
      echo '</table>';

      // Libera la memoria ocupada por el resultado
      mysqli_free_result($resultado);
      // Cierra la conexión
      mysqli_close($link);
   ?>
</body>
</html>