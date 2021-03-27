<?php defined('BASEPATH') or exit();

class Api_Controller extends CI_Controller
{
    
    
    public function __construct()
    {
        parent::__construct();

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: OPTIONS, GET, PUT, POST, DELETE');
    }
    
    
    function get_body_json()
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}