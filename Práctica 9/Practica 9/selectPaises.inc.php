<?php
    echo '<option selected value="Seleccione...">Seleccione...</option>';

    /*AMERICA*/
    $datosAmerica = "SELECT * FROM pibd.paises where paises.Continente = 'América'";
    if(!($resultadoAmerica = $mysqli->query($datosAmerica))) {
        echo "<p>Error al ejecutar la sentencia <b>$datosAmerica</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }
    echo '<optgroup label="América">';
    while($filaAmerica = $resultadoAmerica->fetch_object()) {
        if(isset($paisUsuReg) && ($paisUsuReg == $filaAmerica->NomPais)){
            echo "<option id='$filaAmerica->IdPais' selected>$filaAmerica->NomPais</option>";
        } else{
            echo "<option id='$filaAmerica->IdPais'>$filaAmerica->NomPais</option>";
        }
    }
    echo '</optgroup>';

    /*EUROPA*/
    $datosEuropa = "SELECT * FROM pibd.paises where paises.Continente = 'Europa'";
    if(!($resultadoEuropa = $mysqli->query($datosEuropa))) {
        echo "<p>Error al ejecutar la sentencia <b>$datosEuropa</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }
    echo '<optgroup label="Europa">';
    while($filaEuropa = $resultadoEuropa->fetch_object()) {
        if(isset($paisUsuReg) && ($paisUsuReg == $filaEuropa->NomPais)){
            echo "<option id='$filaEuropa->IdPais' selected>$filaEuropa->NomPais</option>";
        } else{
            echo "<option id='$filaEuropa->IdPais'>$filaEuropa->NomPais</option>";
        }
    }
    echo '</optgroup>';

    /*ASIA*/
    $datosAsia = "SELECT * FROM pibd.paises where paises.Continente = 'Asia'";
    if(!($resultadoAsia = $mysqli->query($datosAsia))) {
        echo "<p>Error al ejecutar la sentencia <b>$datosAsia</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }
    echo '<optgroup label="Asia">';
    while($filaAsia = $resultadoAsia->fetch_object()) {
        if(isset($paisUsuReg) && ($paisUsuReg == $filaAsia->NomPais)){
            echo "<option id='$filaAsia->IdPais' selected>$filaAsia->NomPais</option>";
        } else{
            echo "<option id='$filaAsia->IdPais'>$filaAsia->NomPais</option>";
        }
    }
    echo '</optgroup>';

    /*EUROASIA*/
    $datosEuroasia = "SELECT * FROM pibd.paises where paises.Continente = 'Euroasia'";
    if(!($resultadoEuroasia = $mysqli->query($datosEuroasia))) {
        echo "<p>Error al ejecutar la sentencia <b>$datosEuroasia</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }
    echo '<optgroup label="Euroasia">';
    while($filaEuroasia = $resultadoEuroasia->fetch_object()) {
        if(isset($paisUsuReg) && ($paisUsuReg == $filaEuroasia->NomPais)){
            echo "<option id='$filaEuroasia->IdPais' selected>$filaEuroasia->NomPais</option>";
        } else{
            echo "<option id='$filaEuroasia->IdPais'>$filaEuroasia->NomPais</option>";
        }
    }
    echo '</optgroup>';

    /*ÁFRICA*/
    $datosAfrica = "SELECT * FROM pibd.paises where paises.Continente = 'África'";
    if(!($resultadoAfrica = $mysqli->query($datosAfrica))) {
        echo "<p>Error al ejecutar la sentencia <b>$datosAfrica</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }
    echo '<optgroup label="África">';
    while($filaAfrica = $resultadoAfrica->fetch_object()) {
        if(isset($paisUsuReg) && ($paisUsuReg == $filaAfrica->NomPais)){
            echo "<option id='$filaAfrica->IdPais' selected>$filaAfrica->NomPais</option>";
        } else{
            echo "<option id='$filaAfrica->IdPais'>$filaAfrica->NomPais</option>";
        }
    }
    echo '</optgroup>';

    /*OCEANÍA*/
    $datosOceania = "SELECT * FROM pibd.paises where paises.Continente = 'Oceanía'";
    if(!($resultadoOceania = $mysqli->query($datosOceania))) {
        echo "<p>Error al ejecutar la sentencia <b>$datosOceania</b>: " . $mysqli->error;
        echo '</p>';
        exit;
    }
    echo '<optgroup label="Oceanía">';
    while($filaOceania = $resultadoOceania->fetch_object()) {
        if(isset($paisUsuReg) && ($paisUsuReg == $filaOceania->NomPais)){
            echo "<option id='$filaOceania->IdPais' selected>$filaOceania->NomPais</option>";
        } else{
            echo "<option id='$filaOceania->IdPais'>$filaOceania->NomPais</option>";
        }
    }
    echo '</optgroup>';


    $resultadoAmerica->close();
    $resultadoEuropa->close();
    $resultadoAsia->close();
    $resultadoEuroasia->close();
    $resultadoAfrica->close();
    $resultadoOceania->close();
?>