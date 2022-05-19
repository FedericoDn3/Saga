<?php
class Users extends Controller{

	protected function register(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->register(), true);
	}

	protected function registerCliente(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->registerCliente(), true);
	}
	
	protected function registerAutor(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->registerAutor(), true);
	}


	protected function listaFav(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->listaFav(), true);
	}

	protected function perfil(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->perfil(), true);
	}

	protected function login(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->login(), true);
	}

	protected function logout(){
		unset($_SESSION['is_logged_in']);
		unset($_SESSION['user_data']);
		session_destroy();
		// Redirect
		header('Location: '.ROOT_URL);
	}
}