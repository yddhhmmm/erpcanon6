<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('m_pengeluaran');
        $this->load->library('form_validation');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu Penjualan';
        $data['pengeluaran'] = $this->m_pengeluaran->tampil_data();
        $this->load->view('admin/templates2/header',$topik);
        $this->load->view('admin/penjualan/index',$data);
        $this->load->view('admin/templates2/footer');
    }
    public function tambah2(){
        $data['judul'] = 'Form Tambah Data Penjualan';

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('uraian','Uraian','required');
        $this->form_validation->set_rules('reff','Reff','required');
        $this->form_validation->set_rules('batasan','Batasan','required');
        $this->form_validation->set_rules('jumlah','Jumlah','required');
        $this->form_validation->set_rules('no_akun','No_akun','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates2/header',$data);
            $this->load->view('admin/penjualan/tambah');
        }else {
            echo "Selamat, kamu berhasil";
        }
        
    }
    public function tambah(){
        $data['judul'] = 'Form Tambah Data Penjualan';

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('uraian','Uraian','required');
        $this->form_validation->set_rules('reff','Reff','required');
        $this->form_validation->set_rules('batasan','Batasan','required');
        $this->form_validation->set_rules('jumlah','Jumlah','required');
        $this->form_validation->set_rules('no_akun','No_akun','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates2/header',$data);
            $this->load->view('admin/pengeluaran/tambah');
        }else {
            $this->m_pengeluaran->tambahDataPengeluaran();
            $this->session->set_flashdata('flash','Ditambahkan');
            redirect('admin/pengeluaran');
        }
        
    }
    // public function detail($id){
    //     $topik['judul'] = 'Detail Data Karyawan';
    //     $data['pengeluaran'] = $this->m_pengeluaran->getPengirimanById($id);
    //     $this->load->view('templates2/header',$topik);
    //     $this->load->view('pengeluaran/detail',$data);
    // }
    public function hapus($id){
        $this->m_pengeluaran->hapusDataPengeluaran($id);
        $this->session->set_flashdata('flash2','Dihapus');
        redirect('admin/pengeluaran');
    }
    public function edit($id){
        $topik['judul'] = 'Edit Data Penjualan';
        $data['pengeluaran'] = $this->m_pengeluaran->getPengeluaranById($id);
        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

        $this->form_validation->set_rules('tgl','Tgl','required');
        $this->form_validation->set_rules('uraian','Uraian','required');
        $this->form_validation->set_rules('reff','Reff','required');
        $this->form_validation->set_rules('batasan','Batasan','required');
        $this->form_validation->set_rules('jumlah','Jumlah','required');
        $this->form_validation->set_rules('no_akun','No_akun','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates2/header',$topik);
            $this->load->view('pengeluaran/edit',$data);
        }else {
            $this->m_pengeluaran->ubahDataPengeluaran();
            $this->session->set_flashdata('flash','Diubah');
            redirect('admin/pengeluaran');
        }
}
}