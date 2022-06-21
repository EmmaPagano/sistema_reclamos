<?php 
session_start();
$title = 'panel';

if(!isset($_SESSION['idUser'])){
    header('location:../login-adm.php');
}
include('../../include/conexion.php');
$cmd = $conexion->prepare('SELECT * FROM categorias ORDER BY categoria');
$cmd->execute();
$categorias = $cmd->fetchAll();

if(isset($_GET['id'])){
    $idSubcategoria = $_GET['id'];
    $cmd = $conexion->prepare('SELECT * FROM subcategorias WHERE idSubcategoria = :id');
    $cmd->execute(array(':id'=>$idSubcategoria));
    $subcategoria = $cmd->fetch();
    $subcategoriaNombre = $subcategoria['subcategoria'];
    $descripcion = $subcategoria['descripcionSub'];
    $idCategoriaPadre = $subcategoria['idCategoriaPadre'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $subcategoria = $_POST["subcategoria"];
    $descripcion = $_POST["descripcion-subcategoria"];
    $idCategoria = $_POST["id-categoria"];
    $idSubcategoria = $_POST['idSubcategoria'];

    if (empty($subcategoria) || empty($descripcion) || empty($idCategoria) || empty($idSubcategoria)){
        $notificacion = "Error: No pueden haber campos vacíos";
    }else{
    
    
        $cmd = $conexion->prepare('UPDATE subcategorias SET subcategoria= :subcategoria,descripcionSub= :descripcion,idCategoriaPadre= :idCategoria WHERE idSubcategoria = :idSubcategoria ');
        

        $resultado = $cmd->execute(array(':subcategoria' => $subcategoria,':descripcion' => $descripcion, ':idCategoria' => $idCategoria, ':idSubcategoria' => $idSubcategoria ));
        
        if($resultado){
          header('location:listar-subcategoria.php');
        }else{
            $notificacion = "Ha ocurrido un error al tratar de modificar la subcategoría";
        }
    
    }

}



?>

<?php include('../../include/header-adm.php'); ?>

<section class="seccion-alta py-5">
    <div class="container">
        <h2 class="titulo-seccion text-center">Alta de subcategoría</h2>
        <div class="row">
            <?php
            if(isset($notificacion)){
                echo '<p class="bg-dark text-white text-center py-3">'.$notificacion.'</p>';
            }
            ?>
            <form action="modificar-subcategoria.php" method="POST" class="col-md-6 mx-auto" enctype="multipart/form-data">
                <input type="hidden" name="idSubcategoria" value="<?php echo $idSubcategoria;?>">
                <div class="mb-3">
                    <label for="inputCategoria" class="form-label">Nombre de la subcategoría</label>
                    <input type="text" class="form-control" id="inputCategoria" name="subcategoria" placeholder="Ej: Hospital Municipal" value="<?php echo $subcategoriaNombre;?>">
                </div>
                <div class="mb-3">
                    <label for="inputDescripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion-subcategoria" id="descripcionsubCategoria" class="form-control"><?php echo $descripcion;?></textarea>
                </div>
                <div class="mb-3">
                    <label for="categoriaPadre" >Categoría padre</label>
                    <select name="id-categoria" id="categoriaPadre" class="form-select">
                        <?php 
                            foreach ($categorias as $fila) {
                                if($fila['idCategoria']==$idCategoriaPadre){
                                    echo '
                                    <option value="'.$fila['idCategoria'].'" selected>'.$fila['categoria'].' </option>
                                    ';
                                }else{
                                    echo '
                                    <option value="'.$fila['idCategoria'].'">'.$fila['categoria'].' </option>
                                    ';
                                }

                            }

                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">
                    Enviar
                </button>  
            </form>
        </div>
    </div>
    
</section>



<?php include('../../include/footer-adm.php'); ?>