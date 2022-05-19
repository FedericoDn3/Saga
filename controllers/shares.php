<?php
class Shares extends Controller{
	protected function index(){
		$viewmodel = new ShareModel();
		$this->returnView($viewmodel->index(), true);
	}

	protected function add(){
		if(!isset($_SESSION['is_logged_in'])){
		header('Location: '.ROOT_URL.'shares');
		}
		$viewmodel = new ShareModel();
		$this->returnView($viewmodel->add(), true);
	}///Fin Add

	protected function evaluar(){

        $idrecurso = $_GET["id"];
		$_SESSION['idrecurso'] = $idrecurso; 
		$viewmodel = new ShareModel();
		$this->returnView($viewmodel->evaluar(), true);

	}////Fin evaluar

	protected function addvmt(){
		$idrecurso = $_GET["id"];
		$_SESSION['idrecurso'] = $idrecurso; 
		$viewmodel = new ShareModel();
		$this->returnView($viewmodel->addvmt(), true);
	}////Fin addvmt

	protected function recursocat(){
		$idcategoria = $_GET["id"];
		$_SESSION['idcategoria'] = $idcategoria; 
		$viewmodel = new ShareModel();
		$this->returnView($viewmodel->recursocat(), true);
	}////Fin recurso

	protected function removevmt(){
		$idrecurso = $_GET["id"];
		$_SESSION['idrecurso'] = $idrecurso; 
		$viewmodel = new ShareModel();
		$this->returnView($viewmodel->removevmt(), true);
	}////Fin removevmt

	protected function descarga(){
		$viewmodel = new ShareModel();
		$this->returnView($viewmodel->descarga(), true);
	}////Fin Descarga

	protected function mostrarRecurso(){
		$idrecurso = $_GET["id"];
		$_SESSION['idrecurso'] = $idrecurso; 
		$viewmodel = new ShareModel();
		$this->returnView($viewmodel->mostrarRecurso(), true);
	}////Fin mostrarRecurso


}////Fin 

