<?php

class Mahasiswa extends Api_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // get data mahasiswa
    function list() {
        $mahasiswa = $this->db->get('mahasiswa')->result();

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($mahasiswa));
    }

    // view data mahasiswa
    function detail($nim) {
        $mahasiswa = $this->db->where('nim', $nim)->get('mahasiswa')->row();

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($mahasiswa));
    }

    // insert new data to mahasiswa
    function store() {
        $data = array(
                    'nim'           => $this->input->post('nim'),
                    'nama'          => $this->input->post('nama'),
                    'id_jurusan'    => $this->input->post('id_jurusan'),
                    'alamat'        => $this->input->post('alamat'));
        $insert = $this->db->insert('mahasiswa', $data);
        if ($insert) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('status' => 'fail')), 502);
        }
    }

    // update data mahasiswa
    function update() {
        $nim = $this->input->post('nim');
        $data = array(
                    'nim'       => $this->input->post('nim'),
                    'nama'      => $this->input->post('nama'),
                    'id_jurusan'=> $this->input->post('id_jurusan'),
                    'alamat'    => $this->input->post('alamat'));
        $this->db->where('nim', $nim);
        $update = $this->db->update('mahasiswa', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete mahasiswa
    function delete() {
        $nim = $this->input->post('nim');
        $this->db->where('nim', $nim);
        $delete = $this->db->delete('mahasiswa');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}