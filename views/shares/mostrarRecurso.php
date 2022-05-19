<div>
<?php foreach($viewmodel[0] as $item) : ?>
	<div class="well mt-5">
	
	<?php if(isset($_SESSION["cliente_data"])) : ?>
		<hr>
		<h3><?php echo $item['NomRec']; ?></h3>
		<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($item['ImgR']).'"/>'; ?><br />
		<small><?php echo $item['Tipo']; ?></small>
		<br />
		<br />
		<p><?php echo $item['Descrip']; ?></p>
		<?php if($item['Tipo'] == "Libro" || $item['Tipo'] == "Revista" || $item['Tipo'] == "Documento" ) : ?>
			<embed src="<?php echo $item['Enlace'];?>#toolbar=0" width="500" height="375" controls controlsList="nodownload">
		<?php elseif($item['Tipo'] == "Audiolibro" ||$item['Tipo'] == "Podcast") : ?>	
			<audio controls controlsList="nodownload"><source src="<?php echo $item['Enlace'];?>" type="audio/mpeg"></audio>
		<?php endif; ?>	
		<br />
		<?php if($item ['Descarg']==1):?>
			<a class="btn btn-default" href="<?php echo $item['Enlace']; ?>" target="_blank">Descargame!</a>
		<?php endif; ?>	
		<br />
		<a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>shares/evaluar/<?php echo $item['IdRec']; ?>" role="button">Evaluar</a>
		<h5>Comentarios</h5>
		<?php foreach($viewmodel[1] as $item2) : ?>
			<?php if($item2 ['IdRec'] == $item ['IdRec']) : ?>
				<div class="card text-center" style="width: 18rem;">
					<div class="card-body">
						<p class="card-text"><?php echo $item2['ComEva']; ?></p>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
		<h5>Calificación</h5>
		<?php 
			$promedio = 0;
			$calif = 0;
			$cantEvaluadores = 0;
		?>
		<?php 
			foreach($viewmodel[1] as $item3) : 
				if($item3 ['IdRec'] == $item ['IdRec']) { 
					$cantEvaluadores = $cantEvaluadores + 1;
					$calif = $calif + $item3['Calif'] ;
				}  
			endforeach; 
				if($cantEvaluadores > 0){
					$promedio = $calif / $cantEvaluadores;
					
				}
		?>	
		<div class="card text-center" style="width: 18rem;">
			<div class="card-body">
				<p class="card-text"><?php echo $promedio; ?></p>
			</div>
			</div>
	<?php elseif(isset($_SESSION["autor_data"])) : ?>
		<hr>
		<h3><?php echo $item['NomRec']; ?></h3>
		<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($item['ImgR']).'"/>'; ?><br />
		<small><?php echo $item['Tipo']; ?></small>
		<br />
		<br />
		<p><?php echo $item['Descrip']; ?></p>
		<?php if($item['Tipo'] == "Libro" || $item['Tipo'] == "Revista" || $item['Tipo'] == "Documento" ) : ?>
			<embed src="<?php echo $item['Enlace'];?>#toolbar=0" width="500" height="375" controls controlsList="nodownload">
		<?php elseif($item['Tipo'] == "Audiolibro" ||$item['Tipo'] == "Podcast") : ?>	
			<audio controls controlsList="nodownload"><source src="<?php echo $item['Enlace'];?>" type="audio/mpeg"></audio>
		<?php endif; ?>
	<?php endif; ?>
	</div>
<?php endforeach; ?>
</div>		


