



		<script>
			function previewFile(input){
				var file = $("input[type=file]").get(0).files[0];
		
				if(file){
					var reader = new FileReader();
		
					reader.onload = function(){
						$("#previewImg").attr("src", reader.result);
					}
		
					reader.readAsDataURL(file);
				}
			}
		</script>


<?php if(isset($_SESSION['is_logged_in'])) : ?>
                     <!-- Si esta log -->
        <?php if(isset($_SESSION["autor_data"])) : ?>
<div>
  <div>
    <h3>Agregar Recurso</h3>
  </div>
  <div>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    	<div class="form-group">
    		<label>Nombre</label>
    		<input type="text" name="Nombre" class="form-control" />
    	</div>
 		<div class="form-group">
		<p>El Recurso sera descargable por los usuarios?</p>	
		<small><label for="NDescarg">No Descargable</label></small>		
		<input type="radio" id="NDescarg" name="Descarg" value="0 "><br>
		<small><label for="Descarg">Descargable</label></small>
  		<input type="radio" id="Descarg" name="Descarg" value="1"><br>
		<hr>	
    	</div>
		<div class="form-group">
		<p>Su Recurso sera para todo publico?</p>
		<small><label for="NSuscrip">Contenido Gratis</label></small>		
		<input type="radio" id="NSuscrip" name="Suscrip" value="0 "><br>
		<small><label for="Suscrip">Usuarios Premium</label></small>
  		<input type="radio" id="Suscrip" name="Suscrip" value="1"><br>
		<hr>
    	</div>
		<div class="form-group">
		<p>Elija el Tipo de Recurso</p>
		<small><label for="Libro">Libro</label></small>
  		<input type="radio" id="Libro" name="Tipo" value="Libro "><br>
  		<small><label for="AudioLibro">Audiolibro</label></small>
  		<input type="radio" id="Audiolibro" name="Tipo" value="Audiolibro"><br>
  		<small><label for="Revista">Revista</label></small>
  		<input type="radio" id="Revista" name="Tipo" value="Revista"><br>
  		<small><label for="Podcast">Podcast</label></small>
		<input type="radio" id="Podcast" name="Tipo" value="Podcast"><br>
		<small><label for="Documento">Documento</label></small>
		<input type="radio" id="Documento" name="Tipo" value="Documento"><br>
		<label>Recurso</label>
		<input type="file" name="Recurso" class="form-control">
		<hr>
		</div>
    	<div class="form-group">
		<label>Imagen</label>
		<input type="file" name="Imagen" class="form-control" onchange="previewFile(this);" >
		<!--</p><img id="previewImg" src=" " alt=""><p>--> 
    	</div>

	 	<div class="form-group">
		 <label>Descripción</label>
		<textarea name="Descrip" class="form-control" required placeholder="Una Descripción de su Recurso ..." ></textarea>
		</div>
		<!--<input type="hidden" name="filename">--> 
		<div>
        	<div>
           		<label>Categorias?</label>
            	<!-- Multiselect -->
            	<select multiple name="Cats[]" class="selectpicker w-100" required>
			
				<?php print_list($viewmodel);?>

        	    </select><!-- End -->
    	    </div>
	    </div>
		<br>


    
    	<input class="btn btn-primary" name="submit" type="submit" value="Submit" />
        <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>shares">Cancel</a>
    </form>
  </div>
</div>
        <?php elseif(isset($_SESSION["cliente_data"])) : ?>
			<h1><?php echo "Solo Autores pueden publicar.<br>"; ?></h1>
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



	<?php function print_list($viewmodel, $parent=0) {
    	print "<ul>";
   		foreach ($viewmodel as $row) {
        	if ($row['IdPad'] == $parent) {
            print "<option "; 
			print "value=";
			print $row['IdCat'];
			print ">"; 
			if ($row['IdPad'] == 0){
			print "●"; 	
			}else{
			print "&nbsp &nbsp ◦";
			}
           	//print $row['IdCat']; ///tengo que ver
            print $row['NomCat'];
            print_list($viewmodel, $row['IdCat']);  #recursividad        
            print "</option>";
	        }
    	}
    	print "</ul>";
	}?>
