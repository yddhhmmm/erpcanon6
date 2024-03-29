<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Win2_Manager extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('m_manager');
        $this->load->library('form_validation');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu Manager Lain';
        $data['manager'] = $this->m_manager->tampil_data();
        $this->load->view('admin/templates/header',$topik);
        $this->load->view('admin/win2manager/index',$data);
        $this->load->view('admin/templates/footer');
    }
    public function tambah(){
        $data['judul'] = 'Form Tambah Data Manager Lain';

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('no_faktur','No_Faktur','required');
        $this->form_validation->set_rules('transaksi','Transaksi','required');
        $this->form_validation->set_rules('jumlah','Jumlah','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header',$data);
            $this->load->view('admin/win2manager/tambah');
        }else {
            $this->m_manager->tambahDataManager();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('admin/manager');
        }
        
    }
    // public function detail($id){
    //     $topik['judul'] = 'Detail Data Karyawan';
    //     $data['manager'] = $this->m_manager->getPengirimanById($id);
    //     $this->load->view('templates/header',$topik);
    //     $this->load->view('manager/detail',$data);
    // }
    public function hapus($id){
        $this->m_manager->hapusDataManager($id);
        $this->session->set_flashdata('flash2','Dihapus');
        redirect('admin/manager');
    }
    public function edit($id){
        $topik['judul'] = 'Edit Data Manager Lain';
        $data['manager'] = $this->m_manager->getManagerById($id);
        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('no_faktur','No_Faktur','required');
        $this->form_validation->set_rules('transaksi','Transaksi','required');
        $this->form_validation->set_rules('jumlah','Jumlah','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header',$topik);
            $this->load->view('admin/manager/edit',$data);
        }else {
            $this->m_manager->ubahDataManager();
            $this->session->set_flashdata('flash','Diubah');
            redirect('manager');
        }
}
}