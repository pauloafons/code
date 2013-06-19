<?php if(! defined('BASEPATH')) exit('No direct script acess allowed');
class Ola extends CI_Controller{
	
	public function index(){
		$this -> load -> view('welcome_message');
	}
	function olamundo(){
		$this -> load ->view('ola_mundo.html');
	}
	
	function testeReescritaServidor(){
		phpinfo();
		exit();
		$this -> load -> view('olá_mundo.html');
	}
}
