<?php
/*
 * Sign_up Controller
 */
class Sign_up extends CI_Controller {

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

	/**
	 * Account sign up
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		$get_signin_json = file_get_contents('php://input');
		$signin_data = json_decode($get_signin_json);
		if (!empty($signin_data)) {
			if ((trim($signin_data->user_name) != "") && (trim($signin_data->password) != ""))
			{
				// Check if user name is taken
				if ($this->username_check(base64_decode($signin_data->user_name)) === TRUE)
				{
					$response["success"] = 0;
					$response["message"] = "この電話番号は既に登録しました。";
					$response['account'] = NULL;
					$response['api_key'] = NULL;
					echo json_encode($response);
				}			
				else
				{
					// Firebase_token for email notifications
					$firebase_token = NULL;
					if ( isset($signin_data->firebase_token) && $signin_data->firebase_token != "") 
					{
						$firebase_token = $signin_data->firebase_token;
					}
					// Create user
					$user_id = $this->account_model->create(base64_decode($signin_data->user_name), base64_decode($signin_data->user_name).'@domain.com', base64_decode($signin_data->password));
					if ($user_id) 
					{
						$this->account_model->update_last_signed_in_datetime($user_id, $firebase_token);
						$response["success"] = 1;
						$response['message'] = "success";
						$response['account'] = $this->account_model->get_by_id($user_id);
						$response['api_key'] = $this->config->item("api_key");
						echo json_encode($response);
						
					}
					else
					{
						$response["success"] = 0;
						$response["message"] = "An unknown error occurred";
						$response['account'] = NULL;
						$response['api_key'] = NULL;
						echo json_encode($response);
					}
					
				}
			}else{
				$response["success"] = 0;
				$response["message"] = "Requerd field is empty";
				$response['account'] = NULL;
				$response['api_key'] = NULL;
				echo json_encode($response);
			}			
		}		
	}

	/**
	 * Check if a username exist
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	function username_check($username)
	{
		return $this->account_model->get_by_username($username) ? TRUE : FALSE;
	}

	/**
	 * Check if an email exist
	 *
	 * @access public
	 * @param string
	 * @return bool
	 */
	function email_check($email)
	{
		return $this->account_model->get_by_email($email) ? TRUE : FALSE;
	}

}


/* End of file sign_up.php */
/* Location: ./application/controllers/account/sign_up.php */
