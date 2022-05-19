<div>
	<?php foreach($viewmodel as $item) : ?>
		<div class="well mt-5">
			<hr>
			 
			<?php if($item ['Suscrip']==1) : ?>

				<?php if(isset($_SESSION["cliente_data"])) : ?>	

					<?php if($_SESSION["cliente_data"]["suscrito"] == 1) : ?>
						<h3><a href="<?php echo ROOT_PATH; ?>shares/mostrarRecurso/<?php echo $item['IdRec']; ?>"><?php echo $item['NomRec']; ?></a></h3>
						<a class="btn btn-light" href="<?php echo ROOT_PATH; ?>shares/addvmt/<?php echo $item['IdRec']; ?>" role="button">Ver Mas Tarde</a>
						<br />
						<?php if(isset($_POST[$item['IdRec']])){
							echo("Añadido a Lista");
						}?>
						<br />			
						<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($item['ImgR']).'"/>'; ?><br />
						<small><?php echo $item['Tipo']; ?></small>
						<br />
						<br />
						<p><?php echo $item['Descrip']; ?></p>

					<?php else : ?>
					<h3><?php echo $item['NomRec']; ?></h3>
					<?php echo "Este Recurso esta disponible solo para usuarios con suscripcion.<br><br>";?> 
					<?php endif; ?> 

				<?php else : ?>
					<h3><?php echo $item['NomRec']; ?></h3>
      	    		<?php echo "Este Recurso esta disponible solo para usuarios con suscripcion.<br><br>";?> 
										
           		<?php endif; ?> 


            <?php elseif(isset($_SESSION["cliente_data"])) : ?>
				<h3><a href="<?php echo ROOT_PATH; ?>shares/mostrarRecurso/<?php echo $item['IdRec']; ?>"><?php echo $item['NomRec']; ?></a></h3>
				<a class="btn btn-light" href="<?php echo ROOT_PATH; ?>shares/addvmt/<?php echo $item['IdRec']; ?>" role="button">Ver Mas Tarde</a>
				<br />
				<?php if(isset($_POST[$item['IdRec']])){
					echo("Añadido a Lista");
				}?>
				<br />
				<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($item['ImgR']).'"/>'; ?><br />
				<small><?php echo $item['Tipo']; ?></small>
				<br />
				<br />
				<p><?php echo $item['Descrip']; ?></p>

			<?php elseif(isset($_SESSION["autor_data"])) : ?>
				<h3><a href="<?php echo ROOT_PATH; ?>shares/mostrarRecurso/<?php echo $item['IdRec']; ?>"><?php echo $item['NomRec']; ?></a></h3>
				<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($item['ImgR']).'"/>'; ?><br />
				<small><?php echo $item['Tipo']; ?></small>
				<br />
				<br />
				<p><?php echo $item['Descrip']; ?></p>
			<?php else : ?> <!-- Aqui printea para los que no estan logeados -->
				<h3><?php echo $item['NomRec']; ?></h3>
				<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($item['ImgR']).'"/>'; ?><br />
				<small><?php echo $item['Tipo']; ?></small>
				<br />
				<br />
				<p><?php echo $item['Descrip']; ?></p>
			<?php endif; ?>
				
		</div>
	<?php endforeach; ?>
</div>		
             