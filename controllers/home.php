<?php
class Home extends Controller{

	protected function index(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function categorias(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->categorias(), true);
	}

	protected function suscripcion(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->suscripcion(), false);
	}

	protected function adds(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->adds(), false);
	}

	protected function buscar(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->buscar(), true);
	}////Fin addvmt

}