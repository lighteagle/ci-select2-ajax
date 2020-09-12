<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Select extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dynamic_model');
    }
    public function index()
    {
        $data['title'] = 'Data Customer';
        $data['customers'] = $this->Dynamic_model->getDataCustomer();
        $this->load->view('dynamicselect/index', $data);
    }

    public function getKabupaten()
    {
        $kabupatenId = $this->input->post('kabupaten');
        $idprov = $this->input->post('id');
        $data = $this->Dynamic_model->getDataKabupaten($idprov);
        $output = '<option value="">-- Pilih Kabupaten --</option>';
        foreach ($data as $row) {
            if ($kabupatenId) {
                if ($kabupatenId == $row["id"]) {
                    $output .= '<option value="' . $row["id"] . '" selected>' . $row["nama"] . '</option>';
                } else {
                    $output .= '<option value="' . $row["id"] . '" >' . $row["nama"] . '</option>';
                }
            } else {
                $output .= '<option value="' . $row["id"] . '">' . $row["nama"] . '</option>';
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }


    public function getKecamatan()
    {
        $kecamatanId = $this->input->post('kecamatan');
        $idkab = $this->input->post('id');
        $data = $this->Dynamic_model->getDataKecamatan($idkab);

        $output = '<option value="">-- Pilih Kecamatan --</option>';
        foreach ($data as $row) {
            if ($kecamatanId) {
                if ($kecamatanId == $row["id"]) {
                    $output .= '<option value="' . $row["id"] . '" selected>' . $row["nama"] . '</option>';
                } else {
                    $output .= '<option value="' . $row["id"] . '" >' . $row["nama"] . '</option>';
                }
            } else {
                $output .= '<option value="' . $row["id"] . '">' . $row["nama"] . '</option>';
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function getDesa()
    {
        $desaId = $this->input->post('desa');
        $idkec = $this->input->post('id');
        $data = $this->Dynamic_model->getDataDesa($idkec);
        $output = '<option value="">-- Pilih Desa --</option>';
        foreach ($data as $row) {
            if ($desaId) {
                if ($desaId == $row["id"]) {
                    $output .= '<option value="' . $row["id"] . '" selected>' . $row["nama"] . '</option>';
                } else {
                    $output .= '<option value="' . $row["id"] . '" >' . $row["nama"] . '</option>';
                }
            } else {
                $output .= '<option value="' . $row["id"] . '">' . $row["nama"] . '</option>';
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Customer';
        $data['provinsi'] = $this->Dynamic_model->getDataProv();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('dynamicselect/getData', $data);
        } else {
            $input = [
                'nama' => htmlspecialchars($this->input->post('nama'), true),
                'alamat' => htmlspecialchars($this->input->post('alamat'), true),
                'provinsi_id' => $this->input->post('provinsi'),
                'kabupaten_id' => $this->input->post('kabupaten'),
                'kecamatan_id' => $this->input->post('kecamatan'),
                'desa_id' => $this->input->post('desa'),
                'date_created' => time(),
                'date_modified' => time(),
            ];

            if ($this->Dynamic_model->create($input) > 0) {
                $this->session->set_flashdata('status', 'Data Berhasil di simpan');
                redirect('select');
            } else {
                $this->session->set_flashdata('status', 'Server gangguan');
                redirect('select');
            }
        }
    }

    public function getById($id = null, $type = null)
    {
        if ($id && $type) {
            $data['title'] = 'Edit Data Customer';
            $data['provinsi'] = $this->Dynamic_model->getDataProv();
            $dataCustomer = $this->Dynamic_model->getByIdCustomer($id);

            if ($dataCustomer) {

                if ($type == 'edit') {
                    $data['byId'] = $dataCustomer;

                    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');
                    $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'trim|required');


                    if ($this->form_validation->run() == FALSE) {
                        $this->load->view('dynamicselect/edit', $data);
                    } else {
                        $input = [
                            'nama' => htmlspecialchars($this->input->post('nama'), true),
                            'alamat' => htmlspecialchars($this->input->post('alamat'), true),
                            'provinsi_id' => $this->input->post('provinsi'),
                            'kabupaten_id' => $this->input->post('kabupaten'),
                            'kecamatan_id' => $this->input->post('kecamatan'),
                            'desa_id' => $this->input->post('desa'),
                            'date_modified' => time(),
                        ];

                        if ($this->Dynamic_model->update(array('id' => $this->input->post('customerId')), $input) > 0) {
                            $this->session->set_flashdata('status', 'Data Berhasil di update');
                            redirect('select');
                        } else {
                            $this->session->set_flashdata('status', 'Server gangguan');
                            redirect('select');
                        }
                    }
                } elseif ($type == 'delete') {
                    if ($this->Dynamic_model->delete($id) > 0) {
                        $this->session->set_flashdata('status', 'Data Berhasil di hapus');
                        redirect('select');
                    } else {
                        $this->session->set_flashdata('status', 'Server gangguan');
                        redirect('select');
                    }
                } elseif ($type == 'delete') {
                    // json
                    $this->output->set_content_type('application/json')->set_output(json_encode($dataCustomer));
                } else {
                    // Salah paremeter kedua
                    echo "parameter kedua salah";
                }
            } else {
                // Salah id
                echo "Id Customer tidak ditemukan";
            }
        } else {
            //Jika parameter kurang
            echo "parameter kurang";
        }
    }


    public function autocomplete()
    {
        $data['title'] = 'Tambah Data - Auto Complete';

        $this->load->view('autocomplete/adddata', $data, FALSE);
    }
}
