 
        <?php if(isset($_SESSION['is_logged_in'])) : ?>
                     <!-- Si esta log -->
            <?php if(isset($_SESSION["autor_data"])) : ?>

				<h1><?php echo "Solo los usuarios pueden tener listas de Favoritos.<br>"; ?></h1>
                <h5><?php echo "Si esta viendo esto es un error"; ?></h5>
                <a href="<?php echo ROOT_URL; ?>">
                <button type="button" class="btn btn-outline-info"  >Regresar</button>

            <?php else : ?>
<?php foreach($viewmodel as $item) : ?>
		<div class="well">
        <h3><?php echo $item['NomRec']; ?></h3>
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($item['ImgR']).'"/>'; ?><br />
			<small><?php echo $item['Tipo']; ?></small>
			<hr />
			<p><?php echo $item['Descrip']; ?></p>
			<a class="btn btn-light" href="<?php echo ROOT_PATH; ?>shares/removevmt/<?php echo $item['IdRec']; ?>" role="button">Eliminar</a>
			<hr />
		</div>
	<?php endforeach; ?>


            <?php endif; ?>                                          
         <?php else : ?>
                    <!-- Si no esta log -->
					<h1><?php echo "Porfavor iniciar sesion.<br>"; ?></h1>
                <h5><?php echo "Si aun no cuentas con una"; ?></h5>
                <a href="<?php echo ROOT_URL; ?>users/register">
                <button type="button" class="btn btn-outline-info"  >Registrate</button>
         <?php endif; ?>


