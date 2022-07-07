<?php
include("include/conexion.php");
$cmd = $conexion->prepare('SELECT * FROM categorias ORDER BY categoria');
$cmd->execute();
$categorias = $cmd->fetchAll();

$cmd = $conexion->prepare('SELECT * FROM calles ORDER BY calle');
$cmd->execute();
$calles = $cmd->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fechaActual = date("Y-m-d");
    $idCategoria = $_POST["idCategoria"];
    $idMotivo = $_POST["idMotivo"];
    $nombre = $_POST["nombre"];
    $dni = $_POST["dni"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $calle = $_POST["calle"];
    $altura = $_POST["altura"];
    $comentario = $_POST["comentario"];

    if (empty($idCategoria) || empty($idMotivo) || empty($nombre) || empty($dni) || empty($telefono) || empty($correo) || empty($calle) || empty($altura) || empty($comentario)){
        $notificacion = "Error: No pueden haber campos vacíos";
    } else {
        $cmd = $conexion->prepare("INSERT INTO reclamos(idSubcategoria, fechaReclamo, nombreVecino, dni, idCalle, altura, telefonoVecino, correoVecino, idEstado, comentario) VALUES (:idSub, :fecha, :nombre, :dni, :calle, :altura, :telefono, :correo, '1', :comentario)");
        $resultado = $cmd->execute(array(':idSub' => $idMotivo,':fecha' => $fechaActual, ':nombre' => $nombre, ':dni' => $dni, ':calle' => $calle, ':altura' => $altura, ':telefono' => $telefono, ':correo' => $correo, ':comentario' => $comentario,));
        
        if($resultado){

            if(!empty($_FILES['fotos'])){
                $longitud = (count($_FILES['fotos']['name']) > 3) ? 3 : count($_FILES['fotos']['name']) ;
                for ($i=0; $i < $longitud ; $i++) { 
                    $archivo_destino='img/fotos_reclamos/'.$_FILES['fotos']['name'][$i];
                    move_uploaded_file($_FILES['fotos']['tmp_name'][$i],$archivo_destino);

                    $cmd = $conexion->prepare('SELECT * FROM reclamos ORDER BY idReclamo DESC LIMIT 0,1');
                    $cmd->execute();
                    $ultimoReclamo = $cmd->fetch();
                    $idReclamo = $ultimoReclamo['idReclamo'];

                    $cmd = $conexion->prepare('INSERT INTO fotos_reclamos(urlFoto, idReclamo) VALUES (:url,:idReclamo)');
                    $cmd->execute(array(':url' => $_FILES['fotos']['name'][$i],':idReclamo' => $idReclamo));
                }
            }

            $notificacion = "El reclamo ha sido dada de alta con éxito";
        }else{
            $notificacion = "Ha ocurrido un error al dar de alta el reclamo";
        }
    }

}



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
                                <img src="img/'.$categoria["imgCategoria"].'" class="img-fluid categoria-icono" alt="" data-id="'.$categoria['idCategoria'].'">
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
    <section class="seccion-subcategorias" id="seccionMotivos">
        <div class="container">
            <h2 class="titulo text-center">Elija un motivo</h2>
            <div class="subcategorias" id="contenedorMotivos">
              

            </div> 
        </div>
    </section>
<!--SECCION CONTACTO -->
    <section class="seccion-contacto mt-5" id="seccionForm">
        <div class="container">
            <h2 class="titulo text-center mb-3">Información de contacto</h2>
            <form class="col-md-6 mx-auto" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" value="" id="inputCategoria" name="idCategoria">
                <input type="hidden" value="" id="inputMotivo" name="idMotivo">
                <div class="mb-3">
                    <label for="inputNombre" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="inputNombre" name="nombre">
                </div>
                <div class="mb-3">
                    <label for="inputDNI" class="form-label">DNI (sin puntos)</label>
                    <input type="number" class="form-control" id="inputDNI" name="dni">
                </div>
                <div class="mb-3">
                    <label for="inputTelefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="inputTelefono" name="telefono">
                </div>
                <div class="mb-3">
                    <label for="inputCorreo" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="inputCorreo" name="correo">
                </div>
                <div class="mb-3">
                    <label for="selectCalles" class="form-label">Seleccione su calle</label>
                    <select class="form-select" id="selectCalles" name="calle" aria-label="Default select example" required>
                        <option selected>Seleccione la calle</option>
                        <?php 
                            foreach ($calles as $fila) {
                                echo '
                                <option value="'.$fila['idCalle'].'">'.$fila['calle'].' </option>
                                ';
                            }

                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inputAltura" class="form-label">Altura</label>
                    <input type="number" class="form-control" id="inputAltura" name="altura">
                </div>
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Adjunte fotos de la consulta si lo desea (máximo 3 fotos)</label>
                    <input class="form-control" type="file" id="formFileMultiple" name="fotos[]" accept="image/*" multiple>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Escriba los detalles de su solicitud. Recuerde incorporar datos relevantes.</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="comentario" rows="3"></textarea>
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
<script>
let seccionMotivos = document.querySelector("#seccionMotivos");
let contenedorMotivos = document.querySelector("#contenedorMotivos");
let idIcono = 0;
let idCategoria = 0;
let inputCategoria = document.querySelector("#inputCategoria");
let inputMotivo = document.querySelector("#inputMotivo");
let idMotivo = 0;
let seccionForm = document.querySelector('#seccionForm') ;
let btnIconos = document.querySelectorAll(".categoria-icono");
btnIconos.forEach(icono => {
        icono.addEventListener('click', function(){
        idCategoria = icono.dataset.id;
        inputCategoria.value = idCategoria;
            
        
        var xhttp = new XMLHttpRequest();

        /* POST*/
        // 1º -> tres parametros: TIPO DE PETICION, URL A LA CUAL VAMOS A REALIZAR DICHA PETICION, TRUE -> INDICA QUE ES UN PETICION DE TIPO ASICRONA
        xhttp.open("POST", "ajax/listar-motivos-index.php", true);

        // SE UTILIZA SIEMPRE QUE UTILIZAMOS EL METODO POST
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // ENVIAMOS LA PETICION, Y PASAMOS POR PARAMETRO LOS DATOS
        xhttp.send("idCat="+idCategoria); 

            /* RESPUESTA RECIBIDA  */
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

           /* let respuesta = JSON.parse(this.responseText); */
            let respuesta = this.responseText;

            contenedorMotivos.innerHTML = respuesta;

            }
        };
        seccionMotivos.style.display = "block";
        seccionForm.style.display = "none";
        inputMotivo.value = "";
        window.scrollTo(0, document.body.scrollHeight);

    });
});


function seleccionMotivo(elemento) {
    idMotivo = elemento.dataset.idmotivo;
    seccionForm.style.display = "block";
    //alert(document.body.scrollHeight-200);
    //window.scrollTo(0, document.body.scrollHeight-1000);
    window.location.href = '#seccionForm';
    inputMotivo.value = idMotivo;
}

</script>
</body>
</html>