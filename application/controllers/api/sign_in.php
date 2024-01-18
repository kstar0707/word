<?php
/*
 * Sign_in Controller
 */
class Sign_in extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
		// Load the necessary stuff...
		// $this->load->config('account/account');
		date_default_timezone_set('Asia/Tokyo');
		$this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
		$this->load->model('account/account_model');
	}

	/**
	 * Account sign in
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		$get_login_json = file_get_contents('php://input');
		$login_data = json_decode($get_login_json);
		if (!empty($login_data)) {
			if ((trim($login_data->user_name) != "") && (trim($login_data->password) != ""))
			{
				// Firebase Token for Email Notifications
				$firebase_token = NULL;
				if ( isset($login_data->firebase_token) && $login_data->firebase_token != "") 
				{
					$firebase_token = $login_data->firebase_token;
				}
//                $get_sign_in_username_email = $this->account_model->get_username_by_id($this->session->userdata('account_id'));
//                $login_menu_type = $get_sign_in_username_email->login_menu_type;

                // Get user by username / email
				if ( ! $user = $this->account_model->get_by_username_email(base64_decode($login_data->user_name)))
				{
					//echo base64_decode($this->input->post('user_name', TRUE));
					$response["success"] = 0;
					$response["message"] = "電話番号登録がありません。";
					$response['account'] = NULL;
					$response['api_key'] = NULL;
					echo json_encode($response);
				}
				else
				{
					if ( ! $this->authentication->check_password($user->password, base64_decode($login_data->password)))
					{					
						$response["success"] = 0;
						$response["message"] = "電話番号登録がありません。";
						$response['account'] = NULL;
						$response['api_key'] = NULL;
						echo json_encode($response);					
					}
					else
					{
						$this->account_model->update_last_signed_in_datetime($user->id, $firebase_token);
						$response["success"] = 1;
						$response['message'] = "success";
						$response['account'] = $this->account_model->get_by_id($user->id);
						$response['api_key'] = $this->config->item("api_key");
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

}


/* End of file sign_in.php */
/* Location: ./application/account/controllers/sign_in.php */
?>