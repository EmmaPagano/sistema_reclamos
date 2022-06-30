<?php
$idCategoria = $_REQUEST['idCat'];


if(!empty($idCategoria)){
    include("../include/conexion.php");
    //Carga de subcategorías base de datos
    $cmd = $conexion->prepare('SELECT * FROM subcategorias WHERE idCategoriaPadre = :idCategoria ORDER BY subcategoria');
    $cmd->execute(array(':idCategoria'=> $idCategoria));
    $subcategorias = $cmd->fetchAll();

    $estructura = '';

    foreach ($subcategorias as $motivo) {
        $estructura .= '<option value="'.$motivo['idSubcategoria'].'">'.$motivo['subcategoria'].'</option>';
    }
}

echo $estructura;

?>