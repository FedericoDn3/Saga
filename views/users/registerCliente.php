
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
	<h1><?php echo "Usted ya se encuentra registrado.<br>"; ?></h1>
                <h5><?php echo "Si esta viendo esto es un error"; ?></h5>
                <a href="<?php echo ROOT_URL; ?>">
                <button type="button" class="btn btn-outline-info"  >Regresar</button>
<?php else : ?>
	<?php
	$_SESSION['es_cliente'] = true;
	?> 

	<div class="container p-4 w-50">
		<div class="row">
			<div class="col mx-auto">
				<div class="card text-center">
					<div class="card-header bg-light text-center">
						<h3>Registrarse</h3>
					</div>
					<div class="card-body p-4">
						<form method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
							<div class="row">
								<div class="form-group">
									<input type="text" name="name" class="form-control" required placeholder="Nombre" />
								</div>
								<div class="form-group">
									<input type="text" name="apellido" class="form-control" required
										placeholder="Apellido" />
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<input type="text" name="nick" class="form-control" required
										placeholder="Nickname" />
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control" required
										placeholder="Password" />
								</div>
							</div>
							<div class="row">
								<div class="form-group mt-2">
									<input type="email" name="email" class="form-control" required
										placeholder="Email" />
								</div>
								<div class="form-group mt-2">
									<div class="row ">
										<div class="col-4">
											<label for="sexo">Fecha nacimiento:</label>
										</div>
										<div class="col-8">
											<input type="date" name="fechaNac" class="form-control" required
												placeholder="Fecha de nacimiento" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group mt-2">
									<div class="row ">
										<div class="col">
											<label for="sexo">Sexo:</label>
										</div>

										<div class="col">
											<label for="sexo">Femenino</label>
											<input type="radio" id="femenino" name="sexo" value="Femenino">
										</div>
										<div class="col">
											<label for="sexo">Masculino</label>
											<input type="radio" id="masculino" name="sexo" value="Masculino">
										</div>
									</div>
								</div>
								<div class="form-group mt-2">
									<input type="file" name="imagen" class="form-control" onchange="previewFile(this);"/>
									</p><img id="previewImg" src=" " alt="" height="100px"><p>
								</div>
							</div>
							<div class="d-grid gap-2 mt-4">
								<input id="submit" name="submit" type="submit" value="Registrarse"
									class='btn btn-outline-success btn-block'>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?> 

