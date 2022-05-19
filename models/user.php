<?php
//session_start();
class UserModel extends Model{

	public function register(){
        // Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($post['password'])){
			$password = md5($post['password']);	
		}
    }    

	public function registerCliente(){
        
        
        // Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($post['password'])){
			$password = md5($post['password']);	
		}
			
        
        if(isset($post['submit'])){
            

            //si es cliente chequea campos requeridos para cliente
            if($_SESSION['es_cliente']){
                if($post['name'] == '' || $post['apellido'] == '' || $post["sexo"] == '' || $post['nick'] == '' || $post['password'] == '' || $post['email'] == '' || $post['fechaNac'] == null ){
                    Messages::setMsg('Please Fill In All Fields', 'error');
                    return;
                }

                //chequea que no esté registrado
                $this->query('SELECT * FROM cliente WHERE EmailCli = :email AND PassCli = :password');
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);
                $row = $this->single();

                $this->query('SELECT * FROM autor WHERE EmailAut = :email AND PassAut = :password');
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);
                $row2 = $this->single();

                if($row || $row2){
                    Messages::setMsg('El usuario ya existe', 'error');
                }
                
                else {

                    // chequea si subió una imagen
                    if (count($_FILES) > 0) {
                        if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
                            $imgContenido = file_get_contents($_FILES['imagen']['tmp_name']); // este es el blob
                        }
                    }
                    else{
                        // no subió ninguna imagen
                        $imgContenido = null;
                    } 
                    
                    // Insert into MySQL
                    $this->query('INSERT INTO cliente (PassCli, NomCli, ApellidoCli, EmailCli, SexoCli, NicknameCli, FNCli, ImgCli) VALUES( :password, :name, :apellido, :email, :sexo, :nick, :fechaNac, :imagen)');
                    $this->bind(':password', $password);  // $password hasheado
                    $this->bind(':name', $post['name']);
                    $this->bind(':apellido', $post['apellido']);
                    $this->bind(':email', $post['email']);
                    $this->bind(':sexo', $post['sexo']);
                    $this->bind(':nick', $post['nick']);
                    $this->bind(':fechaNac', $post['fechaNac']);
                    $this->bind(':imagen', $imgContenido );
                    
                    $this->execute(); 
                    
                    // se trae al usuario recien creado para setear sus datos en la sesion
                    $this->query('SELECT * FROM cliente WHERE EmailCli = :email AND PassCli = :password');
                    $this->bind(':email', $post['email']);
                    $this->bind(':password', $password);

                    $row = $this->single();
                
                    $_SESSION['cliente_data'] = array(
                        "id"	=> $row['IdCli'],
                        "password"	=> $row['PassCli'],
                        "name"	=> $row['NomCli'],
                        "apellido"	=> $row['ApellidoCli'],
                        "email"	=> $row['EmailCli'],
                        "sexo"	=> $row['SexoCli'],
                        "nick"	=> $row['NicknameCli'],
                        "fechaNac"	=> $row['FNCli'],
                        "imagen"	=> $row['ImgCli'],
                        "suscrito"	=> $row['Suscrito']
                    

                    );

                    header('Location: '.ROOT_URL.'home');
                }
            } 
            }
            return;
    }////////////Fin Register Cliente


	public function registerAutor(){
        // Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($post['password'])){
			$password = md5($post['password']);	
		}
			
	
	if(isset($post['submit'])){
        if($_SESSION['es_autor']){

            // chequea si subió una imagen
            if (count($_FILES) > 0) {
                if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
                    $imgContenido = file_get_contents($_FILES['imagen']['tmp_name']); // este es el blob
                }
            }
            else{
                // no subió ninguna imagen
                $imgContenido = null;
            } 

            if($post['name'] == '' || $post['apellido'] == '' || $post["sexo"] == '' || $post['nick'] == '' || $post['password'] == '' || $post['email'] == '' || $post['fechaNac'] == null  || $imgContenido == null  || $post['biografia'] == ''){
                Messages::setMsg('Please Fill In All Fields', 'error');
                return;
            }
            //chequea que no esté registrado
            $this->query('SELECT * FROM autor WHERE EmailAut = :email AND PassAut = :password');
            $this->bind(':email', $post['email']);
            $this->bind(':password', $password);
            $row = $this->single();

            $this->query('SELECT * FROM cliente WHERE EmailCli = :email AND PassCli = :password');
            $this->bind(':email', $post['email']);
            $this->bind(':password', $password);
            $row2 = $this->single();

            if($row || $row2){
                Messages::setMsg('El usuario ya existe', 'error');
                
            }
            else {
                
                // Insert into MySQL
                $this->query('INSERT INTO autor (PassAut, NomAut, ApellidoAut, EmailAut, SexoAut, NicknameAut, FNAut, ImgAut, BiografiaAut) VALUES(:password, :name, :apellido, :email, :sexo, :nick, :fechaNac, :imagen, :biografia)');
                $this->bind(':password', $password);  // $password hasheado
                $this->bind(':name', $post['name']);
                $this->bind(':apellido', $post['apellido']);
                $this->bind(':email', $post['email']);
                $this->bind(':sexo', $post['sexo']);
                $this->bind(':nick', $post['nick']);
                $this->bind(':fechaNac', $post['fechaNac']);
                $this->bind(':imagen', $imgContenido);
                $this->bind(':biografia', $post['biografia']);
                
                
                $this->execute(); 
                
                // se trae al usuario recien creado para setear sus datos en la sesion
                $this->query('SELECT * FROM autor WHERE EmailAut = :email AND PassAut = :password');
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);

                $row = $this->single();

                // setea los datos del usuario traidos de la bd a una variable de sesion
                $_SESSION['autor_data'] = array(
                "id"	=> $row['IdAut'],
                "name"	=> $row['NomAut'],
                "apellido"	=> $row['ApellidoAut'],
                "email"	=> $row['EmailAut'],
                "sexo"	=> $row['SexoAut'],
                "nick"	=> $row['NicknameAut'],
                "fechaNac"	=> $row['FNAut'],
                "imagen"	=> $row['ImgAut'],
                "biografia" => $post['BiografiaAut'],
                "password"	=> $row['PassAut']
                );

                header('Location: '.ROOT_URL.'home');
            }
        }
        }
        return;
    }/////////////Fin RegisterAut



    public function listaFav(){
		$this->query('SELECT DISTINCT IdRec FROM vertarde WHERE IdCli = :Id');
        $this->bind(':Id',$_SESSION['cliente_data']['id']);
		$rows = $this->resultSet();
		
        $dataArray = array();
        foreach ($rows as $key => $item){
            $this->query('SELECT * FROM recurso WHERE IdRec = :Id');            
            $this->bind(':Id',$item['IdRec']);
		    $qry = $this->single();
            $dataArray[$key] =$qry;
            
        }
    return $dataArray;
    }////Fin ListaFav

    public function perfil(){

        if(isset($_SESSION['is_logged_in'])) {

            if(isset($_SESSION["autor_data"])){

            $this->query('SELECT * FROM autor WHERE IdAut = :Id');
            $this->bind(':Id',$_SESSION['autor_data']['id']);
            $rows = $this->resultSet();
           
            }elseif(isset($_SESSION["cliente_data"])){

            $this->query('SELECT * FROM cliente WHERE IdCli = :Id');
            $this->bind(':Id',$_SESSION['cliente_data']['id']);
            $rows = $this->resultSet();
            }  
        }else{
            $rows=null; 
        }    
    return $rows;
    }////Fin perfil


	public function login(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if(isset($post['password'])){
		$password = md5($post['password']);	
		}
		

		if(isset($post['submit'])){
			// Compare Login
			$this->query('SELECT * FROM autor WHERE EmailAut = :email AND PassAut = :password');
			$this->bind(':email', $post['email']);
			$this->bind(':password', $password);
			
			$row = $this->single();

			if($row){
				$_SESSION['is_logged_in'] = true;
				$_SESSION['autor_data'] = array(
					"id"	=> $row['IdAut'],
					"name"	=> $row['NomAut'],
					"apellido"	=> $row['ApellidoAut'],
					"email"	=> $row['EmailAut'],
					"sexo"	=> $row['SexoAut'],
					"nick"	=> $row['NicknameAut'],
					"fechaNac"	=> $row['FNAut'],
					"imagen"	=> $row['ImgAut'],
					"biografia" => $post['BiografiaAut'],
					"password"	=> $row['PassAut']
					);  
				
				header('Location: '.ROOT_URL.'shares');

			} 
		 elseif($post['submit']){
		
			$this->query('SELECT * FROM cliente WHERE EmailCli = :email AND PassCli = :password');
			$this->bind(':email', $post['email']);
			$this->bind(':password', $password);
			
			$row = $this->single();
	
			if($row){
				$_SESSION['is_logged_in'] = true;
				$_SESSION['cliente_data'] = array(
					"id"	=> $row['IdCli'],
					"password"	=> $row['PassCli'],
					"name"	=> $row['NomCli'],
					"apellido"	=> $row['ApellidoCli'],
					"email"	=> $row['EmailCli'],
					"sexo"	=> $row['SexoCli'],
					"nick"	=> $row['NicknameCli'],
					"fechaNac"	=> $row['FNCli'],
					"imagen"	=> $row['ImgCli'],
                    "suscrito"	=> $row['Suscrito']
				);
				
				header('Location: '.ROOT_URL.'shares');
	
			} 
		}else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		return;
	}

}