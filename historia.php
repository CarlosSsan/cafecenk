<?php

require 'config/config.php';
require 'config/basededatos.php';

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

<style>
        .container2 {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f4f4;
        }
        .container2 {
            text-align: center;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        img {
            max-width: 20%;
            height: 20%;
            border-radius: 10px;
            margin-left: 500px;
        }
    </style>

    <div class="container2">
        <h1>Café de Puebla</h1>
        <p>El café de Puebla es conocido por su calidad excepcional y su sabor único. 
            Cultivado en las fértiles tierras de las montañas de Puebla, este café se destaca por sus notas dulces y afrutadas, 
            combinadas con una acidez brillante y un cuerpo medio. Los caficultores de la región utilizan métodos tradicionales 
            y sostenibles para producir un café que no solo es delicioso, sino también amigable con el medio ambiente.</p>
        <img src="img/productos/1/producto1.jpg" >
    </div>

</body>
</html>