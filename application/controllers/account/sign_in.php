<?php

/*
 * Sign_in Controller
 */

class Sign_in extends CI_Controller
{

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
    function index()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect signed in users to homepage
        if ($this->authentication->is_signed_in()) redirect('');

        // Setup form validation
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
        $data['title'] = "Sign In";
        $this->form_validation->set_rules(array(
            array(
                'field' => 'sign_in_username_email',
                'label' => '電話番号',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'モバイルフィールドは必須です。',
                ),
            ),
            array(
                'field' => 'sign_in_password',
                'label' => 'パスワード',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'パスワード欄は必須です',
                ),
            )
        ));
//        $get_login_menu_type = $this->account_model->get_login_menu_type($this->input->post('sign_in_username_email'));
//        $login_menu_type = $get_login_menu_type->login_menu_type;
        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            // Get user by username / email
            $sign_in_username_email = mb_convert_kana($this->input->post('sign_in_username_email', TRUE), 'a', 'UTF-8');
            if (!$user = $this->account_model->get_by_username_email($sign_in_username_email)) {
                // Username / email doesn't exist
                $data['sign_in_username_email_error'] = "電話番号登録がありません。";
            } else {
                // Either don't need to pass recaptcha or just passed recaptcha
                if (!($recaptcha_pass === TRUE || $recaptcha_result === TRUE) && $this->config->item("sign_in_recaptcha_enabled") === TRUE) {
                    $data['sign_in_recaptcha_error'] = $this->input->post('recaptcha_response_field') ? lang('sign_in_recaptcha_incorrect') : lang('sign_in_recaptcha_required');
                } else {
                    // Check password
                    if (!$this->authentication->check_password($user->password, $this->input->post('sign_in_password', TRUE))) {
                        // Increment sign in failed attempts
                        $this->session->set_userdata('sign_in_failed_attempts', (int)$this->session->userdata('sign_in_failed_attempts') + 1);

                        $data['sign_in_error'] = lang('sign_in_combination_incorrect');
                        $data['message'] = "電話番号登録がありません。";
                    } else {
                        // Clear sign in fail counter
                        $this->session->unset_userdata('sign_in_failed_attempts');
                        // Run sign in routine
                        $this->authentication->sign_in($user->id, $this->input->post('sign_in_remember', TRUE));
                        $data['message'] = 'success';
                        redirect(base_url());

                    }
                }
            }
        }

        // Load recaptcha code
        if ($this->config->item("sign_in_recaptcha_enabled") === TRUE)
            if ($this->config->item('sign_in_recaptcha_offset') <= $this->session->userdata('sign_in_failed_attempts'))
                $data['recaptcha'] = $this->recaptcha->load($recaptcha_result, $this->config->item("ssl_enabled"));

        // Load sign in view

        $this->load->view('account/sign_in', isset($data) ? $data : NULL);
    }

    public function ajax_login()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));
//echo $this->input->post('sign_in_password');die();
        // Setup form validation
        $data['message'] = "";
        $this->form_validation->set_rules(array(
            array(
                'field' => 'sign_in_username_email',
                'label' => '電話番号',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'モバイルフィールドは必須です。',
                ),
            ),
            array(
                'field' => 'sign_in_password',
                'label' => 'パスワード',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'パスワード欄は必須です',
                ),
            )
        ));

        // Run form validation
        if ($this->form_validation->run() === TRUE) {
            // Get user by username / email
            $sign_in_username_email = mb_convert_kana($this->input->post('sign_in_username_email', TRUE), 'a', 'UTF-8');
            if (!$user = $this->account_model->get_by_username_email($this->input->post('sign_in_username_email'))) {
                // Username / email doesn't exist
                $data['message'] = "電話番号登録がありません。";
            } else {
                // Check password
                if (!$this->authentication->check_password($user->password, $this->input->post('sign_in_password', TRUE))) {
                    // Increment sign in failed attempts
                    $data['message'] = "パスワードが正しくありません。";
                } else {
                    // Clear sign in fail counter
                    $this->session->unset_userdata('sign_in_failed_attempts');
//                    $this->session->set_userdata('account_id', $user->id);
                    // Run sign in routine
                    $this->authentication->sign_in($user->id, $this->input->post('sign_in_remember', TRUE));

//                    $result_user_send_email = $this->emailing_model->check_if_this_user_send_email($this->session->userdata('account_id'), $user->username, $user->email);
//                    $result_user_recieve_email = $this->emailing_model->check_if_this_user_receive_email($this->session->userdata('account_id'), $user->username, $user->email);
//                    print_r($result_user_recieve_email);exit();

                    $data['message'] = 'success';
//                    redirect(base_url());
                }


            }

        } else {
            $data['message'] = "error";
        }


        echo json_encode($data);
    }

    public function userAuthorization()
    {
        maintain_ssl($this->config->item("ssl_enabled"));
        $username = mb_convert_kana($this->input->post('sign_in_username_email'), 'a', 'UTF-8');

//        $get_login_menu_type = $this->account_model->get_login_menu_type($this->input->post('sign_in_username_email'));
//        if (!$get_login_menu_type) {
//            // Username / email doesn't exist
//            $data['message'] = "電話番号登録がありません。";
//        } else {
//            $login_menu_type_from_db = $get_login_menu_type->login_menu_type;
//            if ($login_menu_type_from_db == 0) {
//                $login_menu_type = 0;
//            } else {
//                $login_menu_type = $_POST['login_menu_type'];
//            }
            $user = $this->account_model->get_by_username_email($this->input->post('sign_in_username_email'));

            if (!$user) {
                // Username / email doesn't exist
                $data['message'] = "電話番号登録がありません。";
            } else {
                // Check password
                if (!$this->authentication->check_password($user->password, $this->input->post('sign_in_password', TRUE))) {
                    // Increment sign in failed attempts
                    $data['message'] = "パスワードが正しくありません。";
                } else {
                    // Clear sign in fail counter
//                $this->session->unset_userdata('sign_in_failed_attempts');
                    $this->session->set_userdata('account_id', $user->id);

                    $this->account_model->update_last_signed_in_datetime($user->id);
                    // Run sign in routine
//                $this->authentication->sign_in($user->id, $this->input->post('sign_in_remember', TRUE));

                    $data['message'] = 'success';
                }
            }
//        }

//        $this->session->set_userdata('account_id', $user->id);
//        echo $this->session->userdata('account_id');
//        die();
        echo json_encode($data);
        //echo "Login Success";


    }

    public function testAuthorization()
    {
        maintain_ssl($this->config->item("ssl_enabled"));
//                echo md5($this->input->post('sign_in_password'));
//        die();

        $username = mb_convert_kana($this->input->post('sign_in_username_email'), 'a', 'UTF-8');
        $user = $this->account_model->check_password($this->input->post('sign_in_username_email'), $this->input->post('sign_in_password'));
//        print_r($user);
        if ($user) {
            $this->session->set_userdata('account_id', $user[0]->id);

            $this->account_model->update_last_signed_in_datetime($user[0]->id);
            // Run sign in routine
//                $this->authentication->sign_in($user->id, $this->input->post('sign_in_remember', TRUE));

            $data['message'] = 'success';
            // Username / email doesn't exist

        } else {

            $data['message'] = "ユーザー名かパスワードが無効";

        }
//        $this->session->set_userdata('account_id', $user->id);
//        echo $this->session->userdata('account_id');
//        die();
        echo json_encode($data);
        //echo "Login Success";


    }


}


/* End of file sign_in.php */
/* Location: ./application/account/controllers/sign_in.php */