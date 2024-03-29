<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('M_supplier');
        $this->load->library('form_validation');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu Supplier';
        $data['supplier'] = $this->M_supplier->tampil_data();
        if ($this->input->post('keyword')) {
            $data['supplier'] = $this->M_supplier->cariDataSupplier();
        }
        $this->load->view('admin/templates/header',$topik);
        $this->load->view('admin/supplier/index',$data);
        $this->load->view('admin/templates/footer');
    }

    public function getAllSupplier() {
        echo json_encode($this->M_supplier->getAllSupplier());
    }

    public function tambah(){
        $data2['judul'] = 'Form Tambah Data Supplier';

        $this->form_validation->set_rules('kode','Kode','required');
        $this->form_validation->set_rules('nama','Nama','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
        $this->form_validation->set_rules('telepon','Telepon','required');

        if ($this->form_validation->run() == FALSE) {
            $dariDB = $this->M_supplier->cekkodesupplier();
            // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
            $nourut = substr($dariDB, 5, 4);
            $kodeSupplierSekarang = $nourut + 1;
            $data = array("kode" => $kodeSupplierSekarang);
            $this->load->view('admin/templates/header',$data2);
            $this->load->view('admin/supplier/tambah',$data);
            $this->load->view('admin/templates/footer');
        }else {
            $this->M_supplier->tambahDataSupplier();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('admin/supplier');
        }   
    }
    
    public function hapus($id){
        $this->M_supplier->hapusDataSupplier($id);
        $this->session->set_flashdata('flash2','Dihapus');
        redirect('admin/supplier');
    }
    public function edit($id){
        $topik['judul'] = 'Edit Data Supplier';
        $data['supplier'] = $this->M_supplier->getSupplierById($id);
        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

        $this->form_validation->set_rules('kode','Kode','required');
        $this->form_validation->set_rules('nama','Nama','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
        $this->form_validation->set_rules('telepon','Telepon','required');
        

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header',$topik);
            $this->load->view('admin/supplier/edit',$data);
            $this->load->view('admin/templates/footer');
        }else {
            $this->M_supplier->ubahDataSupplier();
            $this->session->set_flashdata('flash','Diubah');
            redirect('admin/supplier');
        }
}
}