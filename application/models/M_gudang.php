<?php

class M_gudang extends CI_Model
{
    public $kode;

    public function tampil_data()
    {
        return $this->db->get('gudang')->result_array();
    }
    public function get_keyword($keyword)
    {
        $this->db->select('*');
        $this->db->from('gudang');
        $this->db->like('nama', $keyword);
        $this->db->or_like('alamat', $keyword);
        return $this->db->get()->result();
    }
    public function cariDataGudang()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('kode', $keyword);
        $this->db->or_like('nama', $keyword);
        $this->db->or_like('alamat', $keyword);
        return $this->db->get('gudang')->result_Array();
    }
    public function get_product_keyword($keyword)
    {
        $this->db->select('*');
        $this->db->from('gudang');
        $this->db->like('kode', $keyword);
        $this->db->or_like('nama', $keyword);
        return $this->db->get()->result();
    }

    // public function cariDataJurusan(){
    //     $keyword = $this->input->post('keyword',true);
    //     $this->db->like('kode_prodi',$keyword);
    //     $this->db->or_like('prodi',$keyword);
    //     $this->db->or_like('pimpinan',$keyword);
    //     $this->db->or_like('NIP',$keyword);
    //     return $this->db->get('jurusan')->result_Array();
    // }

    public function cekkodegudang()
    {
        $query = $this->db->query("SELECT MAX(kode) as kode from gudang");
        $hasil = $query->row();
        return $hasil->kode;
    }

    public function tambahDataGudang()
    {
        $data = [
            "kode" => $this->input->post('kode', true),
            "nama" => $this->input->post('nama', true),
            "alamat" => $this->input->post('alamat', true)
        ];
        $this->db->insert('gudang', $data);
    }
    public function hitungJumlahAsset()
    {

        $query = $this->db->get('gudang');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    public function getGudangById($id)
    {
        return $this->db->get_where('gudang', ['id' => $id])->row_array();
    }
    public function hapusDataGudang($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('gudang');
    }
    public function ubahDataGudang()
    {
        $data = [
            "kode" => $this->input->post('kode', true),
            "nama" => $this->input->post('nama', true),
            "alamat" => $this->input->post('alamat', true)

        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('gudang', $data);
    }
}
