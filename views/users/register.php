<?php if(isset($_SESSION['is_logged_in'])) : ?>
	<h1><?php echo "Usted ya se encuentra registrado.<br>"; ?></h1>
                <h5><?php echo "Si esta viendo esto es un error"; ?></h5>
                <a href="<?php echo ROOT_URL; ?>">
                <button type="button" class="btn btn-outline-info"  >Regresar</button>
<?php else : ?>

<div class="container mt-3">
      <div class="card text-center">
        <div class="card-header">
          <h3 class="card-title">Te registrarás como:</h3>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
    
            <div class="card-body">
              <h5 class="card-title">Autor</h5>
    
              <a href="<?php echo ROOT_URL; ?>users/registerAutor" class="btn btn-outline-primary">Registrarse</a>
            </div>
          </div>
          <div class="col-4">
            <div class="card-body">
              <h5 class="card-title">Cliente</h5>
    
              <a href="<?php echo ROOT_URL; ?>users/registerCliente" class="btn btn-outline-primary">Registrarse</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?> 