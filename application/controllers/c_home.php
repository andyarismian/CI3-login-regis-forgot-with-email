<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata['email']) {
            redirect('c_log');
        }
    }

    public function index()
    {
        if ($this->session->userdata['level'] == 0) {
            $this->load->view('dashboard/welcome_message_admin');
        }

        if ($this->session->userdata['level'] == 1) {
            $this->load->view('dashboard/welcome_message_user');
        }
    }
}
