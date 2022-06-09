<?php
include("include/conexion.php");
$cmd = $conexion->prepare('SELECT * FROM categorias ORDER BY categoria');
$cmd->execute();
$categorias = $cmd->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--GOOGLE FONTS-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!--CSS PERSONALIZADO -->
    <link rel="stylesheet" href="css/style.css">
    <title>Sistema de Reclamos</title>
    
</head>
<body>
    <!--SECCION BIENVENIDA -->
<section class="seccion-bienvenida">
    <img class="logo" src="img/logo.png" alt="">
    <div class="container d-flex flex-column justify-content-center h-100 align-items-center">
        <div class="contenedor-titular">
            <h1 class="bienvenida-titular text-white text-center">Sistema de reclamos y consultas</h1>
            <p class="bienvenida-subtitulo text-white text-center">Para canalizar y agilizar inquietudes de los vecinos de Alberti</p>
        </div>
    </div>
</section>    
    <!--FIN SECCION BIENVENIDA -->
<main>
    <section class="seccion-reclamo py-4">
        <div class="container">
            <h2 class="titulo text-center">Elija una categoría</h2>
            <p class="subtitulo text-center">Su reclamo o consulta será redirigida al área correspondiente. <br> Nos contactaremos a la brevedad.</p>
            <div class="categorias mt-5">
                <div class="my-3 row">
                    <?php
                    foreach ($categorias as $categoria) {
                        echo '<div class="col-md-4 categoria text-center">
                                <img src="img/'.$categoria["imgCategoria"].'" class="img-fluid categoria-icono" alt="">
                                <p class="categoria-titulo mt-3">'.$categoria["categoria"].'</p>
                                </div>'
                        ;
                    } 
                    ?>
                </div>
            </div>
        </div>
    </section>
<!--SECCION SUBCATEGORIAS -->
    <section class="seccion-subcategorias">
        <div class="container">
            <h2 class="titulo text-center">Elija un motivo</h2>
            <div class="subcategorias">
                <div class="sub">
                    Cable suelto
                </div>
                <div class="sub">
                    Columna caída o por caerse
                </div>
                <div class="sub">
                    Reparación de luminaria
                </div>
                <div class="sub">
                    Cable suelto
                </div>
                <div class="sub">
                    Columna caída o por caerse
                </div>
                <div class="sub">
                    Reparación de luminaria
                </div>
                <div class="sub">
                    Cable suelto
                </div>
                <div class="sub">
                    Columna caída o por caerse
                </div>
                <div class="sub">
                    Reparación de luminaria
                </div>
            </div> 
        </div>
    </section>
<!--SECCION CONTACTO -->
    <section class="seccion-contacto mt-5">
        <div class="container">
            <h2 class="titulo text-center mb-3">Información de contacto</h2>
            <form class="col-md-6 mx-auto" action="" method="post">
                <div class="mb-3">
                    <label for="inputNombre" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="inputNombre">
                </div>
                <div class="mb-3">
                    <label for="inputDNI" class="form-label">DNI (sin puntos)</label>
                    <input type="number" class="form-control" id="inputDNI">
                </div>
                <div class="mb-3">
                    <label for="inputTelefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="inputTelefono">
                </div>
                <div class="mb-3">
                    <label for="inputCorreo" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="inputCorreo">
                </div>
                <div class="mb-3">
                    <label for="selectCalles" class="form-label">Seleccione su calle</label>
                    <select class="form-select" id="selectCalles" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inputAltura" class="form-label">Altura</label>
                    <input type="number" class="form-control" id="inputAltura">
                </div>
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Adjunte fotos de la consulta si lo desea</label>
                    <input class="form-control" type="file" id="formFileMultiple" multiple>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Escriba los detalles de su solicitud. Recuerde incorporar datos relevantes.</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">
                    Enviar
                </button>   
            </form>    
        </div>
    </section>
</main>
<!--FOOTER -->
<footer>
    <div class="container">
        <ul class="redes">
            <li class="red-social"><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
            <li class="red-social"><a href=""><i class="fa-brands fa-twitter"></i></a></li>
            <li class="red-social"><a href=""><i class="fa-brands fa-instagram"></i></a></li>
            <li class="red-social"><a href=""><i class="fa-brands fa-youtube"></i></a></li>
        </ul>
    </div>
</footer>

<!--JS BOOTSTRAP-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>