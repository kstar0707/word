<?php

/*
 * Sign_up Controller
 */

class Sign_up extends CI_Controller
{

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->config('account/account');
        $this->load->helper(array('language', 'account/ssl', 'url'));
        $this->load->library(array('account/authentication', 'account/authorization', 'account/recaptcha', 'form_validation'));
        $this->load->model(array('account/account_model', 'account/account_details_model'));

    }

    /**
     * Account sign up
     *
     * @access public
     * @return void
     */
    function index()
    {
        $user_account_id = $_POST['user_id'];
        $user_type = $_POST['user_type'];

        if ($user_type == 1) // 1 for company, 2 for user under company
            // Redirect signed in users to homepage
            if ($this->authentication->is_signed_in()) redirect('');

        $username = mb_convert_kana($this->input->post('username', TRUE), 'a', 'UTF-8');
        
        // Setup form validation
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
        $this->form_validation->set_rules(array(
            array(
                'field' => 'username', 
                'label' => 'lang:sign_up_username', 
                'rules' => 'trim|required|min_length[2]|max_length[24]'),
            array(
                'field' => 'email', 
                'label' => 'lang:sign_up_email', 
                'rules' => 'trim|required|valid_email'), 
            array(
                'field' => 'sign_up_name', 
                'label' => 'lang:sign_up_name', 
                'rules' => 'trim|required|min_length[1]|max_length[24]'), 
            array(
                'field' => 'company_name', 
                'label' => 'lang:company_name',
                'rules' => 'trim|required|min_length[2]|max_length[24]'), 
            array(
                'field' => 'sign_up_password', 
                'label' => 'lang:sign_up_password', 
                'rules' => 'trim|required|min_length[4]|matches[passconf]'),
            array(
                'field' => 'passconf',
                'label' => 'パスワードを認証する', 
                'rules' => 'trim|required|min_length[4]'),
        ));

        // Run form validation
        $data[] = "";
        if (($this->form_validation->run() === TRUE)) {
            // Check if user name is taken

            if ($this->username_check($username, '', $user_account_id) === TRUE) {
                $data['message'] = "usernameexist";
            }elseif ($this->email_check($this->input->post('email', TRUE)) === TRUE) {
                $data['message'] = "emailexist";
            } else {
                if ($user_type == 1)
                    $company_id = 0;
                else
                    $company_id = $_POST['company_id'];
                // Create user
                $user_id = $this->account_model->create($username, $this->input->post('email', TRUE), $this->input->post('sign_up_password', TRUE), $this->input->post('sign_up_name', TRUE), $user_type, $company_id, $user_account_id, $this->input->post('company_name', TRUE));


                // Add user details (auto detected country, language, timezone)
                if ($user_id) {
                    $data['message'] = "success";
                } else {
                    $data['message'] = "error";
                }
            }
        } else {
            $data['message'] = validation_errors();
        }
        echo json_encode($data);
    }

    /**
     * Check if a username exist
     *
     * @access public
     * @param string
     * @return bool
     */
    function username_check($username, $receiver_name = '', $user_account_id = 0)
    {
        return $this->account_model->get_by_username($username, $receiver_name = '', $user_account_id) ? TRUE : FALSE;
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
