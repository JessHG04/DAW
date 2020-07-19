<?php
class ConexionBD{ //Sigue patron Singleton que hemos dado en DSM
    static private $instance;

    private function __construct() {
        //No se puede llamar desde fuera de la clase
    }

    static public function getInstance() {
        if(!ConexionBD::$instance) {
            ConexionBD::$instance = new ConexionBD();
        }
        return ConexionBD::$instance;
    }

    public function sql($sql) {
        return "Resultado de la consulta $sql";
    }
}

class Libros {
    private $IdLibro, $Titulo, $Resumen, $Autor, $Categoria, $Editorial, $Anyo;

    public function __construct(string $Titulo = NULL, string $Resumen = NULL, string $Autor = NULL, $Categoria = NULL, $Editorial = NULL, $Anyo = NULL) {
        echo "Constructor\n";
        $this->Titulo = $Titulo;
        $this->Resumen = $Resumen;
        $this->Autor = $Autor;
        $this->Categoria = $Categoria;
        $this->Editorial = $Editorial;
        $this->Anyo = $Anyo;
    }

    public function ficha() {
        if(!$this->Titulo && !$this->Autor){
            return "<h1>ERROR: no hay libro</h1>";
        } else{
            return <<<hereDOC
            <h1>{$this->Titulo}</h1>
            <p><strong>{$this->Autor}</strong></p>
            <p>{$this->Resumen}</p>
hereDOC;
        }
    }

    public function __destruct() {
        echo "Destructor\n";
    }
}
?>