<?php

class Jurusan extends Api_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index() {
            
        $jurusan = $this->db->get('jurusan')->result();

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($jurusan));
    }
}