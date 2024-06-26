<?php

require 'config/config.php';
require 'config/basededatos.php';
$db = new BasedeDatos();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;


$lista_carrito = array();

if($productos != null){
    foreach($productos as $clave => $cantidad){


        $sql = $con->prepare("SELECT id, nombre, precio, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);

    }
} else {
    header("Location: index.php");
    exit;
}

//session_destroy();


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
      </div>
    </div>
  </div>
</header>

<main>
    <div class="container">

    <div class="row">
        <div class="col-6">
            <h4>Detalles de pago</h4>
            <div id="paypal-button-container"></div>
        </div>
        
        <div class="col-6">

       <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Productos</th>
                        <th>Subtotal</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lista_carrito == null){
                        echo'<tr><td colpan="5" class="text-center><b>Lista vacia</b></td></tr>';
                    } else {

                         $total = 0;
                         foreach($lista_carrito as $producto){
                             $_id = $producto['id'];
                             $nombre = $producto['nombre'];
                             $precio = $producto['precio'];
                             $cantidad = $producto['cantidad'];
                             $subtotal = $cantidad * $precio;
                             $total += $subtotal;


                    ?>
                    <tr>
                        <td> <?php echo $nombre; ?> </td>
                        <td>
                            <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"> <?php echo MONEDA . $subtotal; ?> </div>
                        </td>
                    </tr>
                    <?php } ?>
                         
                    <tr>
                        <td colspan="2">
                            <p class="h3 text-end" id="total"><?php echo MONEDA . $total; ?> </p>
                        </td>
                    </tr>
                       
                </tbody>
                <?php } ?>
            </table>
       </div>
        </div>
    </div>
    </div>    
</main>    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>

<script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY; ?>"></script>

<script>
        paypal.Buttons({
            style:{
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php echo $total; ?>
                        }
                    }]
                });
            },

            onApprove: function(data,actions){
               actions.order.capture().then(function (detalles){
                window.location.href="completado.html"
               });
            },

            onCancel: function(data){
                alert("Pago Cancelado");
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>

</body>
</html>