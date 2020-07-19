<?php
    $last_visit = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : "Primera vez";
    $current_visit = date("c");
    setcookie("last_visit", $current_visit, (time() + 60*60*24*30));
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Una prueba de cookie</title>
</head>

<body>
<?php
echo <<<hereDOC
    <p>Última visita: $last_visit</p>
    <p>Visita actual: $current_visit</p>
    <p>\$_COOKIE:
hereDOC;
    if(isset($_COOKIE['last_visit'])){
        echo " " . $_COOKIE['last_visit'];
    } else {
        echo " Primera vez";
    }
?>
</body>
</html>