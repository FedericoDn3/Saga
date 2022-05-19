<?php
class HomeModel extends Model{

	public function index(){
		return;
	}

	public function categorias(){
		$this->query('SELECT * FROM categoria');
		$rows = $this->resultSet();
		
		return $rows;
	}

	public function suscripcion(){
		return;
	}

	public function adds(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($post['submit'])){
		
			$Susc =1;
			if(isset($_SESSION["cliente_data"])){
			// Insert into MySQL
			$this->query('UPDATE cliente SET Suscrito = :Susc WHERE cliente.IdCli = :IdCli;');
			$this->bind(':Susc',$Susc);
			$this->bind(':IdCli', $_SESSION['cliente_data']['id']);
			$this->execute();	
			unset($_SESSION['is_logged_in']);
			unset($_SESSION['user_data']);
			session_destroy();
			// Redirect
			header('Location: '.ROOT_URL);

			}	
		header('Location: '.ROOT_URL);
		}

		return;
	}//Fin adds

	public function buscar(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if(isset($post['submit'])){
			if($post['Buscar'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;	
			}
			$Nom= $post['Buscar'];	
			$this->query("SELECT * FROM recurso WHERE NomRec LIKE '%$Nom%' ");
			$this->bind(':Nom',$Nom);		
			$rows = $this->resultSet();
			return $rows;
		}	
	}/////Fin Buscar

}