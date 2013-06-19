<?php if(! defined('BASEPATH')) exit('No direct script acess allowed');
class Receitas extends CI_Controller{
	public function _construct(){
		parent::_construct();
	}
	
	public function categoria($slug_categoria){
		//Recebendo os dados das categorias
		$data['categorias'] = $this->db->get('categorias')->result();
		
		//criando querys SQL com JOIN usando Active Record
		$this->db->select('r.id_receita, r.nome, r.slug_receita,r.foto,c.categoria');
		$this->db->from('receitas r');
		$this->db->join('categorias c', 'c.id_categoria = r.categoria', 'inner');
		$this->db->where('c.slug_categoria',$slug_categoria);
		$this->db->order_by('r.nome', 'ASC');
		
		$data2['receitas'] = $this->db->get()->result();
		
		//carregando as views
		$this->load->view('html_header');
		$this->load->view('cabecalho');
		$this->load->view('menu_categorias', $data);
		$this->load->view('categoria', $data2);
		$this->load->view('rodape');
		$this->load->view('html_footer');
	}
}
