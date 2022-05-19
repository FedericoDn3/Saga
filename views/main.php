<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Saga!</title>






    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Rock+Salt|Source+Code+Pro:300,400,600" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400|Roboto:300,400,700">


    <style>
    .dropdown{
    color: orange;
    position: absolute;
        top: 15px;
        right: 10px;
    }

    .x{
      width: 70%;
    }

    </style>  

</head>

<body>
<Body background="<?php echo ROOT_PATH; ?>assets/img/Bg.jpg" >
    <header>

        <nav class="navbar navbar-light navbar-expand-md bg-white navbar-fixed-top navigation-clean-button">
            <div class="container-fluid">
                    <?php if(isset($_SESSION['is_logged_in'])) : ?>
                    <!-- Si esta log -->
                    <?php if(isset($_SESSION["autor_data"])) : ?><!-- Si es autor -->
                <div>
                  <a class="navbar-brand" href="#"><span><img class="img-fluid" src="<?php echo ROOT_PATH; ?>assets/img/LogoSagaMiniHead.png" width="70px" height="35px"></span> </a>
                </div>
                <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
              <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav nav-right">
                        <li class="nav-item"><a class="nav-link active" href="<?php echo ROOT_URL; ?>">Saga</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>shares">Recursos</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>home/categorias">Categorias</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>shares/add">Publicar</a></li>
                      </ul>
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <form method="post" action="<?php echo ROOT_URL; ?>home/buscar">
                    <div class="input-group">
                      <input type="text" class="form-control" id="buscar" name="Buscar" placeholder="Su busqueda aqui....">
                      <span class="input-group-btn">
                        <input class="btn btn-warning" name="submit" type="submit" value="Buscar" />
                      </span>
                    </div>
                  </form>
                </div>
                <div class="dropdown ">
                    <?php echo $_SESSION['autor_data']['name']; ?>                    
                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" style="background: #e78200;"> <img class="dropdown-image" src="<?php echo ROOT_PATH; ?>assets/img/avatar.jpg?"></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="<?php echo ROOT_URL; ?>users/perfil">Perfil</a>
                      <a class="dropdown-item" href="<?php echo ROOT_URL; ?>users/logout">Logout </a>
                    </div>
                </div> 

                    <?php else : ?>  <!-- Si es cliente -->
                <div><a class="navbar-brand" href="#"><span><img class="img-fluid" src="<?php echo ROOT_PATH; ?>assets/img/LogoSagaMiniHead.png" width="70px" height="35px"></span> </a>
                </div>
                <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav nav-right">
                        <li class="nav-item"><a class="nav-link active" href="<?php echo ROOT_URL; ?>">Saga</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>shares">Recursos</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>home/categorias">Categorias</a></li>
                        <?php if($_SESSION['cliente_data']['suscrito'] ==0):?><!-- Si no esta suscrito -->
                        <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>home/suscripcion">Suscribirse</a></li>
                  			<?php endif; ?>	      
                      </ul>
                      <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <form method="post" action="<?php echo ROOT_URL; ?>home/buscar">
                    <div class="input-group">
                      <input type="text" class="form-control" id="buscar" name="Buscar" placeholder="Su busqueda aqui....">
                      <span class="input-group-btn">
                        <input class="btn btn-warning" name="submit" type="submit" value="Buscar" />
                      </span>
                    </div>
                  </form>
                </div>
                <div class="dropdown">
                    <?php echo $_SESSION['cliente_data']['name']; ?></a>                    
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" style="background: #e78200;"> <img class="dropdown-image" src="<?php echo ROOT_PATH; ?>assets/img/avatar.jpg?"></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="<?php echo ROOT_URL; ?>users/perfil">Perfil</a>
                          <a class="dropdown-item" href="<?php echo ROOT_URL; ?>users/logout">Logout </a>
                        </div>
                    </div> 
                    <?php endif; ?>                       
                    <?php else : ?>
                    <!-- Si no esta log -->
                    <div><a class="navbar-brand" href="#"><span><img class="img-fluid" src="<?php echo ROOT_PATH; ?>assets/img/LogoSagaMiniHead.png" width="70px" height="35px"></span> </a></div><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav nav-right">
                        <li class="nav-item"><a class="nav-link active" href="<?php echo ROOT_URL; ?>">Saga</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>shares">Recursos</a></li>
                      </ul>                 
                    <p class="ml-auto navbar-text actions"><a class="text-black-50 login" href="<?php echo ROOT_URL; ?>users/login">Login</a> 
                    <a class="btn btn-primary btn-sm action-button" role="button" href="<?php echo ROOT_URL; ?>users/register" style="background: #e78200;">Registro</a></p>
                    <?php endif; ?>
            </div>
            </div>
        </nav>
    </header>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js'></script>
    <script  src="<?php echo ROOT_PATH; ?>assets/js/script.js"></script>
    <div class="container">


    <div class"=row">
      <?php Messages::display(); ?>
     	<?php require($view); ?>
     </div>

    </div><!-- /.container -->


</body>

</html>