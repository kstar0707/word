<?php
/*
 * Sign_in Controller
 */
class Balance_sheet extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Tokyo');
		// Load the necessary stuff...
		// $this->load->config('account/account');
		$this->load->helper(array('language', 'account/ssl', 'url', 'text'));
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));

		$this->load->model(array('account/account_model', 'wordapp_model', 'emailing_model'));
	}

	/**
	 * Account sign in
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		// Redirect unauthenticated users to signin page
		if ( ! $this->authentication->is_signed_in())
		{
			redirect('account/sign_in');
		}

		// Retrieve sign in user
		$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

		$data['title'] = "Balance Sheet";

		$this->load->view('balance_sheet', isset($data) ? $data : NULL);
	}
}


/* End of file sign_in.php */
/* Location: ./application/account/controllers/sign_in.php */