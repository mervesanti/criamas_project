<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller {

	public function __construct() {
		parent:: __construct();

		$this->load->helper('url');
	}

	public function index() {
		$this->load->view('email/contact');
	}

	function send() {
		$this->load->config('email');
		$this->load->library('email');

		$from = $this->config->item('smtp_user');
		$newline = $this->config->item('newline');

		$to = $this->input->post('email');
		$message = $this->input->post('message');


		$this->email->set_newline($newline);
		$this->email->from($from);
		$this->email->to($to);
		$this->email->message($message);

		if ($this->email->send()) {
			echo 'Your Email has successfully been sent.';
		} else {
			show_error($this->email->print_debugger());
		}
	}
}