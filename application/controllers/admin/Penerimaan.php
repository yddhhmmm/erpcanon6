<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('m_penerimaan');
        $this->load->library('form_validation');
    }
    public function index(){
        $topik['judul'] = 'Halaman Menu Penerimaan Barang';
		$x['data3'] = $this->m_penerimaan->tampil_total_qty();
		$x['data4'] = $this->m_penerimaan->tampil_total_harga();
        $x['data1'] = $this->m_penerimaan->tampil_data();
		$x['data'] = $this->m_penerimaan->tampil_supplier();
		$x['data2'] = $this->m_penerimaan->tampil_barang();
		$x['kode1'] = $this->m_penerimaan->kode1();
        $this->load->view('admin/templates/header',$topik);
        $this->load->view('admin/penerimaan/index',$x);
        $this->load->view('admin/templates/footer');
    }
	
	 public function index_tampil(){
        $topik['judul'] = 'Halaman Menu Penerimaan Barang';
		 $x['data3'] = $this->m_penerimaan->tampil_data_akun();
        $x['data1'] = $this->m_penerimaan->tampil();
		$x['data'] = $this->m_penerimaan->tampil_supplier();
		$x['data2'] = $this->m_penerimaan->tampil_barang();
		$x['kode1'] = $this->m_penerimaan->kode1();
		$x['get_category'] = $this->m_penerimaan->get_option();
        $this->load->view('admin/templates/header',$topik);
        $this->load->view('admin/penerimaan/tampil',$x);
        $this->load->view('admin/templates/footer');
    }
	
	public function index_tampil_print(){
        $topik['judul'] = 'Halaman Menu Penerimaan Barang';
		 $x['data3'] = $this->m_penerimaan->tampil_data_akun();
        $x['data1'] = $this->m_penerimaan->tampil();
		$x['data'] = $this->m_penerimaan->tampil_supplier();
		$x['data2'] = $this->m_penerimaan->tampil_barang();
		$x['kode1'] = $this->m_penerimaan->kode1();
		$x['get_category'] = $this->m_penerimaan->get_option();
        $this->load->view('admin/templates/header',$topik);
        $this->load->view('admin/penerimaan/tampil_print',$x);
        $this->load->view('admin/templates/footer');
    }
	
	public function cetak_faktur(){
		ob_start();
     $data['penerimaan'] = $this->m_penerimaan->tampil_cetak();
	$this->load->view('penerimaan/print',$data);
	$html = ob_get_contents();
        ob_end_clean();
        require_once('./asset/html2pdf/html2pdf.class.php');
		$pdf = new HTML2PDF('P','A4','en');
		$pdf->WriteHTML($html);
		$pdf->Output('Data Penerimaan.pdf', 'D');
		
	}
	
	public function getNoLPB() {
		echo json_encode($this->m_penerimaan->kode1(), true);
	}

	public function index_show(){
        $topik['judul'] = 'Halaman Menu Penerimaan Barang';
        $x['data1'] = $this->m_penerimaan->tampil_data();
		$x['data'] = $this->m_penerimaan->tampil_supplier();
		$x['kode1'] = $this->m_penerimaan->kode1();
        $this->load->view('admin/templates/header',$topik);
        $this->load->view('admin/penerimaan/index_show',$x);
        $this->load->view('admin/templates/footer');
    }
	
    public function tambah($print = NULL) {
        $data['judul'] = 'Tambah Data Penerimaan Barang';
		
        $x['data1'] = $this->m_penerimaan->tampil_data();
		$x['data'] = $this->m_penerimaan->tampil_supplier();
		$x['data2'] = $this->m_penerimaan->tampil_barang();

        $this->load->view('admin/templates/header',$data);
        $this->load->view('admin/penerimaan/tambah',$x);
		$this->load->view('admin/templates/footer');
    }

    public function tambahDataPenerimaan($print = NULL) {
    	$this->form_validation->set_rules('kode','Kode','required');
        $this->form_validation->set_rules('nama','Nama','required');
        $this->form_validation->set_rules('qty','Qty','required');
        $this->form_validation->set_rules('isi_karton','Isi Karton','required');
        $this->form_validation->set_rules('harga','Harga','required');
        $this->form_validation->set_rules('total_harga','Total Harga','required');
        $this->form_validation->set_rules('tanggal','Tanggal','required');
        // $this->form_validation->set_rules('no_sj','No Surat Jalan','required');
        // $this->form_validation->set_rules('no_lpb','No LPB','required');
        // $this->form_validation->set_rules('no_po','No PO','required');
		// $this->form_validation->set_rules('no_kontiner','No Kontiner','required');
        // $this->form_validation->set_rules('no_polisi','No Polisi','required');
        // $this->form_validation->set_rules('nama_supir','Nama Supir','required');
        // $this->form_validation->set_rules('no_segel','No Segel','required');
		// $this->form_validation->set_rules('supplier','Supplier','required');

		$dataPenerimaan = [
			"kode" => $this->input->post('kode',true),
			"nama" => $this->input->post('nama',true),
			"gudang" => "Head Office",
			"qty" => $this->input->post('qty',true),
			"isi_karton" => $this->input->post('isi_karton',true),
			"total_qty" => $this->input->post('total_qty',true),
			"harga" => $this->input->post('harga',true),
			"total_harga" => $this->input->post('total_harga',true),
			"no_sj" => $this->input->post('no_sj',true),
			"tanggal" => $this->input->post('tanggal',true),
			"no_lpb" => $this->input->post('no_lpb',true),
			"no_po" => $this->input->post('no_po',true),
			"no_kontiner" => $this->input->post('no_kontiner',true),
			"no_polisi" => $this->input->post('no_polisi',true),
			"nama_supir" => $this->input->post('nama_supir',true),
			"no_segel" => $this->input->post('no_segel',true),
			"supplier" => $this->input->post('supplier',true)
		];


		if ($this->form_validation->run() == FALSE) {
			echo json_encode(['errors' => validation_errors()], true);
		} else {
			$this->m_penerimaan->tambahDataPenerimaan($dataPenerimaan);
			if ($print == 'print') {
				$this->session->set_userdata('penerimaan', $dataPenerimaan);
				echo json_encode('print');
			} else {
				echo json_encode('ok');
			}
		}

    }

    public function print() {
    	$d['data'] = $this->session->userdata('penerimaan');
    	$this->load->view('admin/penerimaan/print2', $d);
    }

	function tambah_aksi(){
		$id_akun_pembayaran = $this->input->post('id_akun_pembayaran');
		$total_pembelian = $this->input->post('total_pembelian');
		$diskon = $this->input->post('diskon');
		$ppn = $this->input->post('ppn');
	    $bayar_diskon = $this->input->post('bayar_diskon');
		$bayar_ppn = $this->input->post('bayar_ppn');
		$total_bayar = $this->input->post('total_bayar');
		$tanggal = $this->input->post('tanggal');
		
		$data = array(
			'id_akun_pembayaran' => $id_akun_pembayaran,
			'total_pembelian' => $total_pembelian,
			'diskon' => $diskon,
			'ppn' => $ppn,
			'bayar_diskon' => $bayar_diskon,
			'bayar_ppn' => $bayar_ppn,
			'total_bayar' => $total_bayar,
			'tanggal' => $tanggal
			);
		  $this->m_penerimaan->input_data($data,'pembayaran');
		   $this->session->set_flashdata('flash','Ditambahkan');
		   redirect('admin/penerimaan/index_tampil_print');		
	}
	
	
	function tambah_aksi_akun(){
		$akun_pembayaran = $this->input->post('akun_pembayaran');

		$data = array(
			'akun_pembayaran' => $akun_pembayaran
			);
		  $this->m_penerimaan->input_data_akun($data,'akun_pembayaran');
		   $this->session->set_flashdata('flash','Ditambahkan');
		   redirect('admin/penerimaan/index_tampil_print');	
	}
	
	
	 public function index_tampil_akun(){
        $topik['judul'] = 'Halaman Menu Penerimaan Barang';
         $x['data3'] = $this->m_penerimaan->tampil_data_akun();
	
        $this->load->view('admin/templates/header',$topik);
        $this->load->view('admin/penerimaan/tampil',$x);
        $this->load->view('admin/templates/footer');
    }
	

    function hapus_akun($id){
		$where = array('id_akun_pembayaran' => $id);
		$this->session->set_flashdata('flash2','Dihapus');
		$this->m_penerimaan->hapus_data($where,'akun_pembayaran');
		redirect('admin/penerimaan/index_tampil');
	}
	
	
    public function hapus($id){
        $this->m_penerimaan->hapusDataPenerimaan($id);
        $this->session->set_flashdata('flash','Dihapus');
        redirect('admin/penerimaan');
    }

    public function edit($id = NULL) {
        $topik['judul'] = 'Edit Data Penerimaan Barang';
		$x['data1'] = $this->m_penerimaan->tampil_data();
		$x['data'] = $this->m_penerimaan->tampil_supplier();
		$x['data2'] = $this->m_penerimaan->tampil_barang();
		$x['kode1'] = $this->m_penerimaan->kode1();

        $this->form_validation->set_rules('kode','Kode','required');
        $this->form_validation->set_rules('nama','Nama','required');
        $this->form_validation->set_rules('qty','Qty','required');
        $this->form_validation->set_rules('isi_karton','Isi Karton','required');
        $this->form_validation->set_rules('harga','Harga','required');
        $this->form_validation->set_rules('total_harga','Total Harga','required');
        $this->form_validation->set_rules('tanggal','Tanggal','required');
        $this->form_validation->set_rules('no_lpb','No LPB','required');
		$this->form_validation->set_rules('gudang','Gudang','required');
		$this->form_validation->set_rules('supplier','Supplier','required');
        // $this->form_validation->set_rules('no_sj','No Surat Jalan','required');
        // $this->form_validation->set_rules('no_po','No PO','required');
		// $this->form_validation->set_rules('no_kontiner','No Kontiner','required');
        // $this->form_validation->set_rules('no_polisi','No Polisi','required');
        // $this->form_validation->set_rules('nama_supir','Nama Supir','required');
        // $this->form_validation->set_rules('no_segel','No Segel','required');

        if ($this->form_validation->run() == FALSE) {
            $x['penerimaan'] = $this->m_penerimaan->getPenerimaanById($id);
            $this->load->view('admin/templates/header',$topik);
            $this->load->view('admin/penerimaan/edit',$x);
			$this->load->view('admin/templates/footer');
        } else {
            $this->m_penerimaan->ubahDataPenerimaan();
            $this->session->set_flashdata('flash','Diubah');
            redirect('admin/penerimaan');
        }
	}
		
		public function edit_koreksi($id){
        $topik['judul'] = 'Edit Data Penerimaan Barang';
		$x['data1'] = $this->m_penerimaan->tampil_data();
		$x['data'] = $this->m_penerimaan->tampil_supplier();
		$x['data2'] = $this->m_penerimaan->tampil_barang();
		$x['kode1'] = $this->m_penerimaan->kode1();

		
        $x['penerimaan'] = $this->m_penerimaan->getPenerimaanById($id);
        // $data['program'] = ['Teknik Informatika','Teknik Elektro','Bahasa Indonesia','Bahasa Inggris','Matematika','PKN'];

         $this->form_validation->set_rules('kode_id','Kode_id','required');
        $this->form_validation->set_rules('nama','Nama','required');
        $this->form_validation->set_rules('qty','Qty','required');
        $this->form_validation->set_rules('isi_karton','Isi Karton','required');
        $this->form_validation->set_rules('harga','Harga','required');
        $this->form_validation->set_rules('no_sj','No Surat Jalan','required');
        $this->form_validation->set_rules('tanggal','Tanggal','required');
        $this->form_validation->set_rules('no_lpb','No LPB','required');
        $this->form_validation->set_rules('no_po','No PO','required');
		 $this->form_validation->set_rules('no_kontiner','No Kontiner','required');
        $this->form_validation->set_rules('no_polisi','No Polisi','required');
        $this->form_validation->set_rules('nama_supir','Nama Supir','required');
        $this->form_validation->set_rules('no_segel','No Segel','required');
		$this->form_validation->set_rules('gudang','Gudang','required');
		$this->form_validation->set_rules('supplier','Supplier','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/templates/header',$topik);
            $this->load->view('admin/penerimaan/edit_koreksi',$x);
			$this->load->view('admin/templates/footer');
        }else {
            $this->m_penerimaan->ubahDataPenerimaan();
            $this->session->set_flashdata('flash','Diubah');
            redirect('admin/penerimaan/index_tampil_print');
        }

		
		}
}