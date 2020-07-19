<?php
declare(strict_types = 1);


$fichero = "libro.php";

if(!file_exists($fichero)){
    echo "<p>Lo sentimos, ahora no te podemos proporcionar la información</p>";
    //Me puedo enviar un correo electrónico
    //Escribir el error en un fichero de log
    exit;
}

include_once $fichero;
echo "<p>Se ejecuta</p><br>";


//$s = new Singleton();
$con = ConexionBD::getInstance();
echo $con->sql("Select * from....");

echo "<br><br><hr>";
$libro = new Libros();
$libro1 = new Libros("El Quijote", "La gran novela espanola", "Miguel de Cervantes");
$libro2 = new Libros("1984", "Una novela distópica", "George Orwell");

$misLibros = [$libro, $libro1, $libro2];

$misLibros[] = $libro1;
$misLibros[] = $libro2;

/*
//1a forma de impresion por pantalla
var_dump($libro);
var_dump($libro1);
var_dump($libro2);


//2a forma de impresion por pantalla
echo $libro->ficha();
echo "<br>";

echo $libro1->ficha();
echo "<br>";

echo $libro2->ficha();
echo "<br>";
*/

//3a forma de impresion por pantalla
echo "<hr />";
foreach($misLibros as $l){
    $ficha = $l->ficha();
    echo<<<hereDOC
    $ficha
    <hr />
hereDOC;
}
?>