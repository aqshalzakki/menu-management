<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    // video games article
    public function videogames()
    {
        // get user information
        $data['user'] = $this->Auth_model->getUserByEmail($this->session->userdata('email'));
        $data['title'] = 'Video Games';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('article/video-games', $data);
        $this->load->view('templates/footer');
    }

}