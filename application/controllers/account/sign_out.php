<?php
/*
 * Sign_out Controller
 */
class Sign_out extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		date_default_timezone_set('Asia/Tokyo');
		$this->load->helper(array('language', 'url'));
		$this->load->config('account/account');
		$this->load->library(array('account/authentication', 'account/authorization'));
	}

	// --------------------------------------------------------------------

	/**
	 * Account sign out
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		// Redirect signed out users to homepage
		if ( ! $this->authentication->is_signed_in()) redirect('');

		// Run sign out routine
		$this->authentication->sign_out();

		// Redirect to homepage
		if ( ! $this->config->item("sign_out_view_enabled")) redirect('');
		redirect(base_url('index.php/account/sign_in'));
		// redirect('index.php/account/sign_in');
		// Load sign out view
		//$this->load->view('sign_out');
	}

}


/* End of file sign_out.php */
/* Location: ./application/account/controllers/sign_out.php */