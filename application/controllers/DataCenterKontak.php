<?php
require_once 'needLogin.php';
defined('BASEPATH') OR exit('No direct script access allowed');
 
class DataCenterKontak extends needLogin {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('DataCenterKontakModel');
		$this->load->helper('url');
        $this->load->library('session');
	}
 
	public function index(){

		if ($this->input->get('search') == true){
			$searchParams = $this->input->get();
			
			$model = $this->DataCenterKontakModel->search($searchParams);
		}else{

			$model = $this->DataCenterKontakModel->all();
		}

		$this->load->view('header');
		$this->load->view($this->router->fetch_class().'/index', [
			'model' => $model,
		]);
		$this->load->view('footer');

	}

	public function pdf(){

		$this->load->library('html2pdf_lib');

		if ($this->input->get('search') == true){
			$searchParams = $this->input->get();
			
			$model = $this->DataCenterKontakModel->search($searchParams);
		}else{

			$model = $this->DataCenterKontakModel->all();
		}

		ob_start();
		    $this->load->view($this->router->fetch_class().'/pdf', [
			'model' => $model,
			
			]);

		    $html = ob_get_contents();
        ob_end_clean();
        
        require_once(APPPATH.'libraries/html2pdf/html2pdf.class.php');
	    $pdf = new HTML2PDF('P','A4','en');
	    $pdf->WriteHTML($html);
	    $pdf->Output('Data_Center_Kontak.pdf', 'D');

	}

	public function add(){
		needLogin();

		if ($this->input->post('simpan') == 'simpan'){

			$data = [
				'nama' => $this->input->post('nama'),
				'no_telepon' => $this->input->post('no_telepon'),
			];
			//JIKA SUBMIT DATA
			if ($this->DataCenterKontakModel->save($data)){
				redirect($this->router->fetch_class().'/view/'.$this->db->insert_id()); 
			}
			else{
				$alert ="Input Data Gagal";
			} 
		}
		//JIKA TIDAK SUBMIT DATA
		$this->load->view('header');
		$this->load->view($this->router->fetch_class().'/add');
		$this->load->view('footer');
	}

	public function edit($id){
		needLogin();

		$model=$this->DataCenterKontakModel->get($id);
		$alert = '';

		if ($this->input->post('simpan') == 'simpan'){
			//JIKA SUBMIT DATA
			$model = [
				'id' => $id,
				'nama' => $this->input->post('nama'),
				'no_telepon' => $this->input->post('no_telepon'),
			];
			
			if ($this->DataCenterKontakModel->update($model)){
				redirect($this->router->fetch_class().'/index'); 
			}
			else{
				$alert ="input data gagal";
			} 
		}
		//JIKA TIDAK SUBMIT DATA
		$this->load->view('header');
		$this->load->view($this->router->fetch_class().'/edit',[
			'model' => $model,
			'alert' => $alert
		]);
		$this->load->view('footer');
	}

	public function view($id){
		$data['model']=$this->DataCenterKontakModel->get($id);
		$data['another'] = 'ifi';

		$this->load->view('header');
		$this->load->view($this->router->fetch_class().'/view', $data);
		$this->load->view('footer');
	}

	public function delete($id){
		if ($this->DataCenterKontakModel->delete($id)) {
			redirect($this->router->fetch_class().'/index'); 
		}else{
			echo "SOMETHING WRONG WHEN DELETING";
		}
	}
 
}