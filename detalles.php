<?php

require 'config/config.php';
require 'config/basededatos.php';
$db = new BasedeDatos();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id']: '';
$token = isset($_GET['token']) ? $_GET['token']: '';

if($id == '' || $token == ''){
    echo 'Error algo ta maaaaalll';
    exit;
} else {
    $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
    $sql->execute([$id]);
    if($sql->fetchColumn() > 0) {
          
            $sql = $con->prepare("SELECT nombre, descripcion, precio FROM productos WHERE id=? AND activo=1
            LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $dir_img = 'img/productos/' .$id. '/';
            
            $rutaimg = $dir_img . 'producto1.jpg';
            
        }

        } 


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Cafe</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>

<header>
  
  <div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="index.php" class="navbar-brand">
      <strong>Café CENK</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
      data-bs-target="#navbarHeader" aria-controls="navbarHeader" 
      aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
             <li class="nav-item">
                <a href="index.php" class="nav-link active">Productos</a>
             </li>

             <li class="nav-item">
                <a href="historia.php" class="nav-link">Historia</a>
             </li>

          </ul>

          <a href="carrito_fin.php" class="btn btn-primary">
            Carrito <span id="num_cart" class="badge bg-secondary"> <?php echo $num_cart; ?> </span>
          </a>
      </div>
    </div>
  </div>
</header>

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-1">
                <img src="<?php echo $rutaimg; ?>" width="500">
            </div>
            <div class="col-md-6 order-md-2">
                <h2><?php echo $nombre; ?></h2>
                <h2><?php echo MONEDA . $precio; ?></h2>
                <p class="lead">
                    <?php echo $descripcion; ?>
                </p>

                <div class="d-grid gap-3 col-10 mx-auto">
                    <a href="carrito_fin.php" class="btn btn-primary" type="button" >Comprar ahora</a>
                    <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo 
                    $id; ?>, '<?php echo $token; ?>')">Agregar al Carrito</button>

                </div>
            </div>
        </div>
    </div>    
</main>    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>

<script>
    function addProducto(id, token){
        let url = 'clases/carrito.php';
        let formData = new FormData()
        formData.append('id', id)
        formData.append('token', token)

        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data => {
            if(data.ok){
                let elemento = document.getElementById("num_cart")
                elemento.innerHTML = data.numero
            }
        } )
    }
</script>


</body>
</html>