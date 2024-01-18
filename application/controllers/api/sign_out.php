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
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
		$this->load->model(array('account/account_model'));
		
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
		// Run sign out routine
		$get_signin_json = file_get_contents('php://input');
		$signin_data = json_decode($get_signin_json);
		if (!empty($signin_data)) {
			if ($this->config->item("api_key") === base64_decode($signin_data->api_key)) {
				$user_id = base64_decode($signin_data->user_id);
				$user_info = $this->account_model->get_by_id($user_id);
				
				if ($user_info->firebase_token == $signin_data->firebase_token) {
					$this->account_model->update_firebase_token($user_id);
				}
				
				$response["success"] = 1;
				$response["message"] = "You are sign out";
			}else{
				$response["success"] = 0;
				$response["message"] = "API key is wrong";
			}
			
		}else{
			$response["success"] = 0;
			$response["message"] = "Requerd field is empty";
		}
		echo json_encode($response);
	}

}


/* End of file sign_out.php */
/* Location: ./application/account/controllers/sign_out.php */