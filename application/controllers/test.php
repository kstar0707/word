<?php
/*
 * Sign_in Controller
 */
class Test extends CI_Controller {

	/**
	 * Constructor
	 */
	function __construct()
	{
        parent::__construct();
        // Load the necessary stuff...
        // $this->load->config('account/account');
        date_default_timezone_set('Asia/Tokyo');
        $this->load->helper(array('language', 'account/ssl', 'url'));
        $this->load->library(array('account/authentication', 'account/authorization', 'account/recaptcha', 'form_validation'));
        $this->load->model('account/account_model');
        $this->load->model('emailing_model');
	}

	/**
	 * Account sign in
	 *
	 * @access public
	 * @return void
	 */
    public function userAuthorication(){
        maintain_ssl($this->config->item("ssl_enabled"));

//        $username= mb_convert_kana( $this->input->post('sign_in_username_email'), 'a', 'UTF-8');
//        $password= mb_convert_kana( $this->input->post('sign_in_password'), 'a', 'UTF-8');

        //query the database using given username & passord
//        $result = $this->account_model->login($username, $password);

//        if($result){


//            $sess_array = array(
//                'id_user' => $result[0]->id_user,
//                'username' => $result[0]->username,
//                'name' => $result[0]->name
//            );
            $this->session->set_userdata('account_id', 113);
//        echo $this->session->userdata('account_id');
//        die();
//            $_SESSION['user']=$username;
//            $_SESSION['pass']=$password;
        $data['message'] = 'success';
        echo json_encode($data);
            //echo "Login Success";
//        }




    }
}


/* End of file sign_in.php */
/* Location: ./application/account/controllers/sign_in.php */