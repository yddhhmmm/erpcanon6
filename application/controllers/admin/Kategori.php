<?php

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kategori');
    }
    public function index()
    {
        $topik['judul'] = 'Halaman Menu Kategori';
        $data['kategori'] = $this->M_kategori->tampil_data();
        $this->load->view('admin/templates/header', $topik);
        $this->load->view('admin/kategori/index', $data);
        $this->load->view('admin/templates/footer');
    }
    public function tambah()
    {
        $data['judul'] = 'Form Tambah Data Kategori';
        $data['kode'] = $this->M_kategori->cekKodeKategori();
        $kode = substr($data['kode'], 4) + 1;

        $this->form_validation->set_rules('kode', 'Kode', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/kategori/tambah');
        } else {
            $this->M_kategori->tambahDataKategori();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('admin/kategori');
        }
    }
    public function hapus($id)
    {
        $this->M_kategori->hapusDataKategori($id);
        $this->session->set_flashdata('flash2', 'Dihapus');
        redirect('admin/kategori');
    }
    public function edit($id)
    {
        $topik['judul'] = 'Edit Data Dosen';
        $data['kategori'] = $this->M_kategori->getKategoriById($id);
        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

        $this->form_validation->set_rules('kode', 'Kode', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header', $topik);
            $this->load->view('admin/kategori/edit', $data);
        } else {
            $this->M_kategori->ubahDataKategori();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('admin/kategori');
        }
    }
}
