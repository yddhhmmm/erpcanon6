<?php

class Users extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_user');
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu User';
        $data['tbl_user'] = $this->M_user->tampil_data();
        $this->load->view('admin/templates/header',$topik);
        $this->load->view('admin/user/index',$data);
        $this->load->view('admin/templates/footer');
    }
    public function tambah(){
        $data['judul'] = 'Form Tambah Data User';

        $this->form_validation->set_rules('firstname','Nama depan','required');
        $this->form_validation->set_rules('lastname','Nama belakang','required');
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('kode_id','Kode Id','required');
		$this->form_validation->set_rules('id_role','Id_role','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header',$data);
            $this->load->view('admin/user/tambah');
        }else {
            $this->M_user->tambahDataUser();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('users');
        }
        
    }
    public function hapus($id){
        $this->M_user->hapusDataUser($id);
        $this->session->set_flashdata('flash','Dihapus');
        redirect('users');
    }
    // public function hakakses($id){
    //     $this->M_user->hapusData($id);
    //     $this->session->set_flashdata('flash2','Dihapus');
    //     redirect('users');
    // }
    
    public function changePassword() {
        $topik['judul'] = 'Halaman Ubah Password';
		$data['users'] = $this->db->get_where('users',['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('current_password','Current Password','required|trim');
		$this->form_validation->set_rules('new_password1','New Password','required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2','Confirm New Password','required|trim|min_length[3]|matches[new_password1]');
		
		if ($this->form_validation->run() == false) {
            $this->load->view('admin/templates/header',$topik);
			$this->load->view('admin/user/changepassword',$data);
			$this->load->view('admin/templates/footer');

		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if (!password_verify($current_password, $data['users']['password'])) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong Current Password!</div>');
				redirect('users/changepassword');
			} else {
				if ($current_password == $new_password) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">New Password Cannot be the same as current password!</div>');
				redirect('users/changepassword');
    			} else {
    				// Password sudah ok
    				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
    
    				$this->db->set('password',$password_hash);
    				$this->db->where('email',$this->session->userdata('email'));
    				$this->db->update('users');
    
    				$this->session->set_flashdata('message','<div class="alert alert-succes" role="alert">Password Changed!</div>');
    				redirect('users/changepassword');
    			}
    		}
    	}
    }
    
    public function aktivasiUser($kode_id) {
        $data = $this->M_user->aktivasiUser($kode_id);
        if( $data[1] === 0 ) {
            $this->session->set_flashdata('non-active', $data[0]);
        } else {
            $this->session->set_flashdata('active', $data[0]);
        }
        redirect('admin/users');
    }
}
