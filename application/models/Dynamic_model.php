<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dynamic_model extends CI_Model
{
    public function getDataProv()
    {
        return $this->db->get('wilayah_provinsi')->result_array();
    }

    public function getDataKabupaten($idprov)
    {
        return $this->db->get_where('wilayah_kabupaten', ['provinsi_id' => $idprov])->result_array();
    }
    public function getDataKecamatan($idkab)
    {
        return $this->db->get_where('wilayah_kecamatan', ['kabupaten_id' => $idkab])->result_array();
    }
    public function getDataDesa($idkec)
    {
        return $this->db->get_where('wilayah_desa', ['kecamatan_id' => $idkec])->result_array();
    }

    public function create($input)
    {
        $this->db->insert('m_customer', $input);
        return $this->db->affected_rows();
    }

    public function getDataCustomer()
    {

        $this->db->select('a.id, a.nama as customer, a.alamat, b.nama as provinsi, c.nama as kabupaten, d.nama as kecamatan, e.nama as desa');
        $this->db->from('m_customer as a');
        $this->db->join('wilayah_provinsi as b', 'a.provinsi_id=b.id');
        $this->db->join('wilayah_kabupaten as c', 'a.kabupaten_id=c.id');
        $this->db->join('wilayah_kecamatan as d', 'a.kecamatan_id=d.id');
        $this->db->join('wilayah_desa as e', 'a.desa_id=e.id');
        return $this->db->get()->result_array();
    }

    public function getByIdCustomer($id)
    {

        return $this->db->get_where('m_customer', ['id' => $id])->row_array();
    }

    public function update($where, $input)
    {
        $this->db->update('m_customer', $input, $where);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->delete('m_customer', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
