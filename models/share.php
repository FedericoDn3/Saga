<?php
class ShareModel extends Model{

	public function index(){
		$this->query('SELECT * FROM recurso ORDER BY tipo DESC');
		$rows = $this->resultSet();
		return $rows;
	}////Fin Index


	public function add(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		///// Carga la lista 
		$this->query('SELECT * FROM categoria');
		$rows = $this->resultSet();
		/////	

		if(isset($post['submit'])){ 

			if(isset($post['submit'])){
				$IdCat= $post['Cats'];	
			}else{
				echo 'NOO esta seteada idcat';
			}


			#$dir = '../../Recursos/';
			# $recursopath = $dir.basename($_FILES['Recurso']['name']); //Guarda el archivo con el nombre usar despues de la coma en  file get content.
			$Filename = pathinfo($_FILES['Recurso']['name'],PATHINFO_FILENAME);
			$RecNom= str_replace($Filename,$post['Nombre'] , basename($_FILES["Recurso"]["name"]));
			
			$img = file_get_contents($_FILES['Imagen']['tmp_name']);
			$ED = "../../Recursos/".$RecNom;
			if($post['Nombre'] == '' || $post['Suscrip'] == '' || $post['Descarg'] == ''|| $post['Tipo'] == ''  || $_FILES['Imagen'] == ''|| $post['Descrip'] == '' ){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;	
			}
            move_uploaded_file($_FILES['Recurso']['tmp_name'],"./Recursos/".$RecNom);
			// Insert into MySQL
			$this->query('INSERT INTO recurso (NomRec, Suscrip, Descarg, Tipo, ImgR, Descrip, Enlace, IdAut) VALUES(:Nombre, :Suscrip, :Descarg, :Tipo, :ImgR, :Descrip, :Enlace, :IdAut)');
			$this->bind(':Nombre', $post['Nombre']);
			$this->bind(':Suscrip', $post['Suscrip']);
			$this->bind(':Descarg', $post['Descarg']);
			$this->bind(':Tipo', $post['Tipo']);
			$this->bind(':ImgR', $img);
			$this->bind(':Descrip', $post['Descrip']);
			$this->bind(':Enlace', $ED);
			$this->bind(':IdAut', $_SESSION['autor_data']['id']);

			$this->execute();
			$IdR = $this->lastInsertId();


			//header('Location: '.ROOT_URL.'shares/addcatr/');

 			foreach ($IdCat as $item){

            	$this->query('INSERT INTO recursocategoria (IdRec,IdCat) VALUES (:IdR ,:IdC )');            
            	$this->bind(':IdC',$item);
				$this->bind('IdR',$IdR);
				$this->execute();
			}
			// Verify
			/*if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'shares');
			}*/
		}
		return $rows;
	}//Fin add


	public function evaluar(){

		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if(isset($_SESSION['idrecurso'])){
        	//$_SESSION['IdRec'] = $_GET['IdRec']; //obtengo parametro pasado por href y lo seteo en una sesion
        	$IdRec= $_SESSION['idrecurso'];
			
    	}else{
			echo 'NOO esta seteada idrec';
		}
		
		

		if(isset($post['submit'])){ 
			if($post['inputCalificar'] == '' || $post['inputComentario'] == ''){
				Messages::setMsg('Completa todos los campos', 'error');
				return;	
			}
			$fechaHoy = date("Y-m-d");

			$this->query('SELECT * FROM evaluacion WHERE IdRec = :IdRec AND IdCli = :IdCli  '  );
			$this->bind(':IdRec',$IdRec);
			$this->bind(':IdCli', $_SESSION['cliente_data']['id']);
			$rows = $this->resultSet(); 
			$nr = count($rows);
			if ($nr == 0) {
			// Insert into MySQL
			
			$this->query('INSERT INTO evaluacion (Calif, FechaEva, ComEva, IdCli, IdRec) VALUES(:Calif, :FechaEva, :Comentario, :IdCli, :IdRec)');
			$this->bind(':Calif', $post['inputCalificar']);
			$this->bind(':FechaEva', $fechaHoy);
			$this->bind(':Comentario', $post['inputComentario']);
			$this->bind(':IdCli', $_SESSION['cliente_data']['id']);
			$this->bind(':IdRec', $IdRec);
			$this->execute();
			header('Location: '.ROOT_URL.'shares');
			} 
			else {
				foreach($rows as $rowsi){
					$IdEva = $rowsi['idEva'];
					$this->query('UPDATE evaluacion  SET Calif = :Calif , FechaEva = :FechaEva , ComEva = :Comentario WHERE IdEva = :IdEva');
					$this->bind(':Calif', $post['inputCalificar']);
					$this->bind(':FechaEva', $fechaHoy);
					$this->bind(':Comentario', $post['inputComentario']);
					$this->bind(':IdEva', $IdEva);
					$this->execute();
					header('Location: '.ROOT_URL.'shares');
      		    }
			}
		}
	return;
	}///Fin evaluar



	public function addvmt(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($_SESSION['idrecurso'])){
        	//$_SESSION['IdRec'] = $_GET['IdRec']; //obtengo parametro pasado por href y lo seteo en una sesion
        	$IdRec= $_SESSION['idrecurso'];	
    	}else{
			echo 'NOO esta seteada idrec';
		}
			if(isset($_SESSION["cliente_data"])){
			// Insert into MySQL
			$Publico =0;
			
			$this->query('INSERT INTO vertarde (Publico, IdCli, IdRec) VALUES(:Publico, :IdCli, :IdRec)');
			$this->bind(':Publico',$Publico);
			$this->bind(':IdCli', $_SESSION['cliente_data']['id']);
			$this->bind(':IdRec', $IdRec);
			$this->execute();	
			header("Location: http://".$_SERVER['HTTP_HOST'].'/Saga');
			}		
		return;
	}////Fin addvmt



	public function recursocat(){


		if(isset($_SESSION['idcategoria'])){
        	$IdCat= $_SESSION['idcategoria'];	
    	}else{
			echo 'NOO esta seteada idcat';
		}
		if(isset($_SESSION['is_logged_in'])){
			
		$this->query('SELECT IdRec FROM recursocategoria WHERE IdCat = :Id');
        $this->bind(':Id',$IdCat);
		$rows = $this->resultSet();
		
        $dataArray = array();
        	foreach ($rows as $key => $item){
            	$this->query('SELECT * FROM recurso WHERE IdRec = :Id');            
            	$this->bind(':Id',$item['IdRec']);
		    	$qry = $this->single();
            	$dataArray[$key] =$qry;
			}		
		}	
	return $dataArray;
	}////Fin recurso


	public function removevmt(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($_SESSION['idrecurso'])){
        	//$_SESSION['IdRec'] = $_GET['IdRec']; //obtengo parametro pasado por href y lo seteo en una sesion
        	$IdRec= $_SESSION['idrecurso'];	
    	}else{
			echo 'NOO esta seteada idrec';
		}
			if(isset($_SESSION["cliente_data"])){
			// Insert into MySQL
			$this->query('DELETE FROM vertarde WHERE IdCli = :IdCli AND IdRec = :IdRec');
			$this->bind(':IdCli', $_SESSION['cliente_data']['id']);
			$this->bind(':IdRec', $IdRec);
			$this->execute();	
			header("Location: http://".$_SERVER['HTTP_HOST'].'/Saga');
			}		
		return;
	}////Fin removevmt

	public function descarga(){



		$fileName = $_GET['file'];
		$path = './Recurso/';
		$file = $path.$fileName;
		
		if (!file_exists($file)) {
			http_response_code(404);
			die();
		}
		if(pathinfo($file,PATHINFO_EXTENSION) == "pdf"){
			header("Cache-Control: private");
			header('Content-Type: application/pdf');
			header("Content-Transfer-Encoding: binary");
			header("Content-Disposition: attachment; filename=".$fileName);
			//So the browser can display the download progress
			header("Content-Length: ".filesize($file));
		
			readfile($file);
		}elseif(pathinfo($file,PATHINFO_EXTENSION) == "mp3"){
			header("Cache-Control: private");
			header("Content-type: audio/mpeg3");
			header("Content-Transfer-Encoding: binary");
			header("Content-Disposition: attachment; filename=".$fileName);
			//So the browser can display the download progress
			header("Content-Length: ".filesize($file));
			
			readfile($file);

		}else{
			http_response_code(404);
			die();
		}

		
		return;
	}////Fin descarga

	public function mostrarRecurso(){
			// Sanitize POST
			$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($_SESSION['idrecurso'])){
				//$_SESSION['IdRec'] = $_GET['IdRec']; //obtengo parametro pasado por href y lo seteo en una sesion
				$IdRec= $_SESSION['idrecurso'];	
		}else{
				echo 'NOO esta seteada idrec';
		}
			if(isset($_SESSION['is_logged_in'])){
	
				$this->query('SELECT * FROM recurso WHERE IdRec = :Id');
				$this->bind(':Id',$IdRec);
				$rows = $this->resultSet();
				
				$this->query('SELECT * FROM evaluacion WHERE IdRec = :Id ');
				$this->bind(':Id',$IdRec);
				$rows2 = $this->resultSet();

				$array = array($rows, $rows2);
			}		
		return $array;
	}////Fin mostrarRecurso


}/////Fin
