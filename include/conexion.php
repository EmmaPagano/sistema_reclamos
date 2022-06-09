<?php 

/* CONEXION A LA BASE DE DATOS */
try{
    $conexion = new PDO('mysql:host=localhost;dbname=sistema_reclamos', "root", "");
}
catch (PDOException $e){
    echo "Error: ". $e->getMessage();
}

?>