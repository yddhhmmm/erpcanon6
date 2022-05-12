<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_mitra extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('M_daftar');
        $this->load->library('form_validation');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu Daftar Mitra';
        $data['daftarmitra'] = $this->M_daftar->tampil_data();
        if ($this->input->post('keyword')) {
            $data['daftar_mitra'] = $this->M_daftar->cariDataSupplier();
        }
        $this->load->view('templates/header',$topik);
        $this->load->view('daftarmitra/index',$data);
        $this->load->view('templates/footer');
    }
    public function tambah(){
        $data2['judul'] = 'Form Tambah Data Daftar Mitra';

        $this->form_validation->set_rules('kode','Kode','required');
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('tgl_lahir','Tgl_lahir','required');
        $this->form_validation->set_rules('jabatan','Jabatan','required');
        $this->form_validation->set_rules('promoter','Promoter','required');
        $this->form_validation->set_rules('thn_gabung','Thn_gabung','required');
        $this->form_validation->set_rules('gudang','Gudang','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
        $this->form_validation->set_rules('kota','Kota','required');
        $this->form_validation->set_rules('telepon','Telepon','required');
        $this->form_validation->set_rules('email','email','required');

        if ($this->form_validation->run() == FALSE) {
            $dariDB = $this->M_daftar->cekkodedaftar_mitra();
            // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
            $nourut = substr($dariDB, 5, 4);
            $kodeMitraSekarang = $nourut + 1;
            $data = array("kode" => $kodeMitraSekarang);
            $data['jabatan'] = $this->M_daftar->tampil_jabatan();
            $data['gudang'] = $this->M_daftar->tampil_gudang();
            
            // $data['jabatan'] = ['Vice President','Divisional Manager','Branch Manager','Tenant Manager','Assistant Manager','Win-win Manager','Top Leader','Leader'];
            $this->load->view('templates/header',$data2);
            $this->load->view('daftarmitra/tambah',$data);
            $this->load->view('templates/footer');
        }else {
            $this->M_daftar->tambahDataMitra();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('daftar_mitra');
        }
        
    }
    public function hapus($id){
        $this->M_supplier->hapusDataSupplier($id);
        $this->session->set_flashdata('flash2','Dihapus');
        redirect('supplier');
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
            $this->load->view('templates/header',$topik);
            $this->load->view('supplier/edit',$data);
        }else {
            $this->M_supplier->ubahDataSupplier();
            $this->session->set_flashdata('flash','Diubah');
            redirect('supplier');
        }
}
}