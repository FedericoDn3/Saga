



<?php if(isset($_SESSION['is_logged_in'])) : ?>
                     <!-- Si esta log -->
            <?php if(isset($_SESSION["cliente_data"])) : ?>

              
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  <div class="mb-3">
    <label for="inputCalificar" class="form-label">Calificación (entre 1 al 5)</label>
    <input type="number" class="form-control" name="inputCalificar" id="inputCalificar" min="1" max="5">
  </div>
  <div class="mb-3">
    <label for="inputComentario" class="form-label">Comentario</label>
    <input type="text" name="inputComentario">
  </div>

    <input class="btn btn-primary" name="submit" type="submit" value="Evaluar" />

  
  <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>shares">Cancelar</a>
</form>

            <?php else : ?>
              <h1><?php echo "Solo Clientes pueden evaluar recursos.<br>"; ?></h1>
                <h5><?php echo "si estas viendo esto es un error"; ?></h5>
                <a href="<?php echo ROOT_URL; ?>">
                <button type="button" class="btn btn-outline-info"  >Regresar</button>


            <?php endif; ?>                                          
         <?php else : ?>
                    <!-- Si no esta log -->
                    <h1><?php echo "Porfavor iniciar sesion.<br>"; ?></h1>
                <h5><?php echo "Si aun no cuentas con una"; ?></h5>
                <a href="<?php echo ROOT_URL; ?>users/register">
                <button type="button" class="btn btn-outline-info"  >Registrate</button>                     
         <?php endif; ?>