<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	/*
		@author: Dário Ribeiro de Lima
		@description: Função index do controlador principal. 
		Aqui devem ir toda a lógica default deste controlador. 
	*/
	public function index(){

		$this->load->view('default/top');
		//$this->load->view(''); Aqui deve ser carregado a view desejada
		$this->load->view('default/bot');
		
	}

}
