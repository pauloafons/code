<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * checagem para verificar dw BASEPATH está definida. se não estiver, o script será interrompido
 * exibindo a mensagem acima
 */
class Home extends CI_Controller{
	
	public function _construct(){
		parent::_construct();
	}
	
	public function index()
	{
		$data['categorias'] = $this->db->get('categorias')->result();
		
		$this->db->order_by('id_receita', 'random');
		
		$data2['chamadas'] = $this->db->get('receitas', 4)->result();
		
		$this->load->view('html_header');
		$this->load->view('cabecalho');
		$this->load->view('menu_categorias', $data);
		$this->load->view('conteudo', $data2);
		$this->load->view('rodape');
		$this->load->view('html_footer');
	}
}
