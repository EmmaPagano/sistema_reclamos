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
        $estructura .= '<div class="sub" data-idmotivo="'.$motivo['idSubcategoria'].'" onclick="seleccionMotivo(this)">'. $motivo['subcategoria'] .'</div>';
    }
}

echo $estructura;

?>