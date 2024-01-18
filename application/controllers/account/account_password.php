<?php

/*
 * Account_password Controller
 */

class Account_password extends CI_Controller
{

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // Load the necessary stuff...
        $this->load->config('account/account');
        $this->load->helper(array('date', 'language', 'account/ssl', 'url'));
        $this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
        $this->load->model(array('account/account_model'));
        $this->load->language(array('general', 'account/account_password'));

        $language = $this->session->userdata('site_lang');
        if (!$language) {
            $this->lang->load('general', 'english');
            $this->lang->load('menu', 'english');
            $this->lang->load('site', 'english');
            $this->lang->load('doctor', 'english');
        } else {
            $this->lang->load('general', $language);
            $this->lang->load('menu', $language);
            $this->lang->load('site', $language);
            $this->lang->load('doctor', $language);
        }
    }

    /**
     * Account password
     */
    function index()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in/?continue=' . urlencode(base_url() . 'account/account_password'));
        }

        // Retrieve sign in user
        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        $data['title'] = lang('password_page_name');
        // No access to users without a password
        if (!$data['account']->password) redirect('');

        ### Setup form validation
        $this->form_validation->set_error_delimiters('<span class="field_error">', '</span>');
        $this->form_validation->set_rules(array(array('field' => 'password_new_password', 'label' => 'lang:password_new_password', 'rules' => 'trim|required|min_length[6]'), array('field' => 'password_retype_new_password', 'label' => 'lang:password_retype_new_password', 'rules' => 'trim|required|matches[password_new_password]')));

        ### Run form validation
        if ($this->form_validation->run()) {
            // Change user's password
            $this->account_model->update_password($data['account']->id, $this->input->post('password_new_password', TRUE));
            $this->session->set_flashdata('password_info', lang('password_password_has_been_changed'));
            redirect('account/account_password');
        }

        $this->load->view('account/account_password', $data);
    }

    function user_change_password()
    {
        $user_new_password = $_POST['user_new_password'];
        $user_current_password = $_POST['user_current_password'];
        $username = $_POST['username'];

//        $get_sign_in_username_email = $this->account_model->get_username_by_id($this->session->userdata('account_id'));
//        $login_menu_type = $get_sign_in_username_email->login_menu_type;

        $sign_up_username = mb_convert_kana($this->input->post('username', TRUE), 'a', 'UTF-8');
        if ($this->username_check($sign_up_username) === TRUE) {
            $sign_in_username_email = mb_convert_kana($this->input->post('username', TRUE), 'a', 'UTF-8');
            $user = $this->account_model->get_by_username_email($sign_in_username_email);
//            echo "<pre>";
//            print_r($user);
//            exit();
            if (!$this->authentication->check_password($user->password, $this->input->post('user_current_password', TRUE))) {
                echo 2; // current password doesn't match error msg
            } else {
                $account_id = $this->account_model->get_by_username($this->input->post('username', TRUE));
                $this->account_model->update_password($account_id->id, $this->input->post('user_new_password', TRUE));
                echo 3;
//                $this->session->set_flashdata('password_info', lang('password_password_has_been_changed'));

            }

        } else {
            echo 1; // user is not registered error msg
        }
    }

    function username_check($username)
    {
        return $this->account_model->get_by_username($username) ? TRUE : FALSE;
    }

    function user_forgot_password()
    {
        //$user_forgot_new_password = $_POST['user_forgot_new_password'];
        $user_phone_number = $this->input->post('user_phone_number', TRUE);
        $sign_up_username = mb_convert_kana($this->input->post('user_phone_number', TRUE), 'a', 'UTF-8');
        if ($this->username_check($sign_up_username) === TRUE) {

            $account_id = $this->account_model->get_by_username($this->input->post('user_phone_number', TRUE));
            $user_email = $account_id->email;
            $name = $account_id->name;
            $user_id = base64_encode($account_id->id);
            $base_url = base_url();
            $token = random_string('alnum', 16);
            if ($user_email == '') {
                echo 3;
            } else {
                // Load email library
                $config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'smtp.jacos.co.jp',
                    'smtp_port' => 587,
                    'smtp_user' => 'no-reply@jacos.co.jp',
                    'smtp_pass' => 'hm&wKy7q',
                    'mailtype' => 'html',
                    'charset' => 'UTF-8'
                );
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");

                $this->email->from("no-reply@jacos.co.jp", "株式会社ジャコス");
                $this->email->to($user_email);
                $this->email->subject('ワープロのパスワード再設定');
                $this->email->message($name.'様, <br> お世話になっております。<br> ジャコス事務所でございます。 <br> パスワードの変更を受け付けました。<br><br> ここを押してください。<br> <p style="font-size: 32px; margin: 0; color: black;"> ↓　　 ↓</p>' . anchor(base_url().'index.php/account/account_password/reset_password/' . $token, "パスワード再設定", 'title="押してください", style="display: inline-block;padding: 10px 12px 13px 12px; vertical-align: middle; background: #007bff; text-align: center;  border-radius: 5px; color: white; font-size:22px; font-weight:400; text-decoration:none;margin-top:10px;"').'<br><p><a target="_blank" href="'.base_url().'index.php/account/sign_in"><img src="https://jafa.dev.jacos.jp/resource/img/jafa-logo2.png"></a></p>');
                //$this->email->message($mail_message);
                if (!$this->email->send()) {
                    $email_errors = $this->email->print_debugger();
                    $data['email_errors'] = $email_errors;
                } else {
                    $data['email_errors'] = array();
                }
                $this->account_model->update_token($account_id->id, $token);
                $this->session->set_userdata('last_timeout_pass', time());
                // echo json_encode($data);
                // exit();
                echo 2; // successfully mail sent to reset password
            }
        } else {
            echo 1; // user is not registered error msg
        }
    }

    function reset_password()
    {
        $token = $this->uri->segment(4);

        $data['reset_password_token'] = $token;
        $data['title'] = "パスワードを設定します";

        // Load  view

        $this->load->view('account/reset_password_by_email', isset($data) ? $data : NULL);
    }

    function user_update_password()
    {
        $user_new_password = $_POST['user_new_password'];
        $token = $_POST['token'];

            $this->account_model->update_password_by_token($token, $user_new_password);
            // echo $this->db->last_query();
            echo 2; // successfully reset password

    }


}


/* End of file account_password.php */
/* Location: ./application/account/controllers/account_password.php */