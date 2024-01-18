<?php

/*
 * Sign_in Controller
 */

class Wordapp extends CI_Controller
{

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
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }

        // Retrieve sign in user
        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

        $data['title'] = "Word App";

        $data['user_posts'] = $this->wordapp_model->get_post_by_user_id($data['account']->id, 0, 30);
        $data['user_emails'] = $this->emailing_model->get_email_by_user_id($data['account']->id, 0, 30);
        // echo "<pre>"; print_r($data['user_emails']);
        // exit();
        $data['email_pertners'] = $this->emailing_model->get_pertner_list_by_id($data['account']->id);

//        $data['new_email_check_for_user'] = $this->emailing_model->check_new_mail_for_specific_user($this->session->userdata('account_id'));
//
//        if (!empty($data['new_email_check_for_user'])) {
//            $all_settlement_result = $this->wordapp_model->get_settlement_data_by_id($data['new_email_check_for_user']['settlement_id'], '');
//            if (!empty($all_settlement_result)) {
//                $data['email_subject'] = $all_settlement_result['settlement_title'];
//                $data['settlement_id'] = $all_settlement_result['settlement_id'];
//
//            } else {
//                $data['email_subject'] = '';
//                $data['settlement_id'] = '';
//
//            }
//        } else {
//            $data['email_subject'] = '';
//            $data['settlement_id'] = '';
//        }
//        echo "<pre>";
//        print_r($data['new_email_check_for_user']);
//        exit();
        $this->load->view('wordapp', isset($data) ? $data : NULL);
    }

    public function save()
    {
        // $sql = "INSERT INTO `post`(`post_title`, `post_details`, `created_by`, `created_at`, `updated_at`) VALUES ('".$this->input->post('post_title')."','".$this->input->post('post_details')."',24,'".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";
        // echo $sql;
        // exit();
        // Enable SSL?

        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }

        // Retrieve sign in user
        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

        $data['title'] = "Word App";

        // Setup form validation
        $this->form_validation->set_error_delimiters('<div class="field_error">', '</div>');
        $this->form_validation->set_rules(
            array(
                array(
                    'field' => 'post_title',
                    'label' => 'Title',
                    'rules' => 'trim'),
                array(
                    'field' => 'post_details',
                    'label' => 'Post Details',
                    'rules' => 'trim|required')
            ));

        $message = "";
        // Run form validation
        if ($this->form_validation->run()) {
            $post_id = $this->input->post('post_id', TRUE);
            $post_title = $this->get_title($this->input->post('post_details'));
            if ($post_id != "") {
                $post_data = array(
                    'post_title' => $post_title,
                    'post_details' => $this->input->post('post_details'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $this->wordapp_model->_table_name = 'post';
                $this->wordapp_model->_primary_key = 'post_id';
                $post_id = $this->wordapp_model->save($post_data, $post_id);
                if ($post_id) {
                    $data['post_id'] = $post_id;
                    $data['message'] = "success";
                } else {
                    $data['post_id'] = $post_id;
                    $data['message'] = "error3";
                }
            } else {
                $post_data = array(
                    'post_title' => $post_title,
                    'post_details' => $this->input->post('post_details', TRUE),
                    'created_by' => $data['account']->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $this->wordapp_model->_table_name = 'post';
                $this->wordapp_model->_primary_key = 'post_id';
                $post_id = $this->wordapp_model->save($post_data);
                if ($post_id) {
                    $data['post_id'] = $post_id;
                    $data['message'] = "success";
                } else {
                    $data['post_id'] = $post_id;
                    $data['message'] = "error2";
                }
            }
            // echo $this->db->last_query();
        } else {
            $data['post_id'] = 0;
            $data['message'] = "error1";
        }
        // echo $this->db->last_query();
        echo json_encode($data);
    }


    public function get_user_post()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        $user_id = $this->input->post('login_user_id');
        $start_from = $this->input->post('start_from');
        $list_limit = 30;

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }

        // Retrieve sign in user
        $data['total_user_post'] = $this->wordapp_model->get_total_user_post($user_id);
        // echo $data['total_user_post'];
        // echo $this->db->last_query();
        // exit();
        $data['user_posts'] = $this->wordapp_model->get_post_by_user_id($user_id, $start_from, $list_limit);
        $data['start_from'] = $start_from;
        $data['list_limit'] = $list_limit;
//                echo "<pre>"; print_r($data['user_posts']);
//                exit();
        // echo $data['start_from'];
        // exit();
        $this->load->view('components/table_of_post', isset($data) ? $data : NULL);
    }

    public function get_post_by_id()
    {
        $post_id = $this->input->post('post_id');
        if ($post_id && ($this->input->server('REQUEST_METHOD') == 'POST')) {

            $data['post_details'] = $this->wordapp_model->get_post_by_id($post_id);

            echo json_encode($data['post_details']);
        }

    }

    public function delete_post()
    {
        $post_id = $this->input->post('post_id');
        if ($post_id) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $post = $this->wordapp_model->get_post_by_id($post_id);
                if (!empty($post)) {
                    $this->wordapp_model->delete_post_by_id($post_id);
                    echo "success";
                } else {
                    echo "error3";
                }
            } else {
                echo "error2";
            }
        } else {
            echo "error1";
        }

    }

    function get_title($txt)
    {
        $re = array(" ", "　", "&nbsp;", "\n", "\r");
        $txt = str_replace($re, '', $txt);
        $txt = str_replace("<p></p>", '', $txt);
        $parts = explode("</p>", $txt);
        if (count($parts) > 0) {
            for ($i = 0; $i < count($parts); $i++) {
                if (strip_tags($parts[$i]) != "") {
                    $result = strip_tags($parts[$i]);
                    // return $result;
                    return mb_substr($result, 0, 15, 'UTF-8');
                    // return substr($result, 0, 10);
                }
            }
        } else {
            return "";
        }
    }

    function view_settlement_form($settlement_id = 0, $share_this_settlement_id = 0, $back_one_step = '')
    {
        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }
        $created_by = $this->session->userdata('account_id');

        if ($settlement_id > 0) {
            // fetch library data and set inthe specific fields. This will happen in case of edit.
            $details_info = $this->wordapp_model->get_settlement_data_by_id($settlement_id, $created_by, $share_this_settlement_id);
            $settlement_title = $details_info['settlement_title'];
            $settlement_title = stripslashes($settlement_title);
            $data['settlement_title'] = $settlement_title;
            $data['deployment_name'] = $details_info['deployment_name'];
            $data['name_printing'] = $details_info['name_printing'];
            $data['conclusion'] = $details_info['conclusion'];
            $data['reason'] = $details_info['reason'];
            $data['case_study'] = $details_info['case_study'];
            $data['others'] = $details_info['others'];
            $data['document_name'] = $details_info['document_name'];
            $data['document_encrypted_name'] = $details_info['document_encrypted_name'];
            $data['created_date'] = $details_info['created_date'];
            $data['created_by'] = $details_info['created_by'];
            $data['is_deleted'] = $details_info['is_deleted'];
            $data['is_share'] = $details_info['is_share'];
            $data['settlement_id'] = $settlement_id;
            $data['president_seal_id'] = $details_info['president_seal_id'];
            $data['examination1_seal_id'] = $details_info['examination1_seal_id'];
            $data['examination2_seal_id'] = $details_info['examination2_seal_id'];
            $data['examination3_seal_id'] = $details_info['examination3_seal_id'];
            $data['examination4_seal_id'] = $details_info['examination4_seal_id'];
            $data['name_printing_seal_id'] = $details_info['name_printing_seal_id'];

            if ($details_info['president_seal_id'] != 0) {
                $data['president_seal_img'] = $this->wordapp_model->get_only_seal_image_id_wise($data['president_seal_id']);
//                echo "<pre>";
//        print_r($seal_image);
//        exit();
//                $link_to_show = base_url() . 'resource/img/seal_images/' . $seal_image;
//
//                $image_file = "<img height='50' src=\"$link_to_show\" />";
//                $data['image_file'] = $image_file;
            }

            if ($details_info['examination1_seal_id'] != 0) {
                $data['examination1_seal_img'] = $this->wordapp_model->get_only_seal_image_id_wise($data['examination1_seal_id']);
            }
            if ($details_info['examination2_seal_id'] != 0) {
                $data['examination2_seal_img'] = $this->wordapp_model->get_only_seal_image_id_wise($data['examination2_seal_id']);
            }
            if ($details_info['examination3_seal_id'] != 0) {
                $data['examination3_seal_img'] = $this->wordapp_model->get_only_seal_image_id_wise($data['examination3_seal_id']);
            }
            if ($details_info['examination4_seal_id'] != 0) {
                $data['examination4_seal_img'] = $this->wordapp_model->get_only_seal_image_id_wise($data['examination4_seal_id']);
            }
            if ($details_info['name_printing_seal_id'] != 0) {
                $data['name_printing_seal_img'] = $this->wordapp_model->get_only_seal_image_id_wise($data['name_printing_seal_id']);
            }

        } else {
            $data['document_name'] = '';
            $data['document_encrypted_name'] = '';
        }
        $data['share_this_settlement_id'] = $share_this_settlement_id;
        $data['back_one_step'] = $back_one_step;

//        echo "<pre>";
//        print_r($data['image_file']);
//        exit();
        $this->load->view('components/settlement_letter_mail', isset($data) ? $data : NULL);
    }

    function save_settlement_letter_form()
    {
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }
//        echo "<pre>";
//        print_r($_POST);
//        exit();
//        echo $_POST['settlement_title'];exit();
        $save_settlement_form_for_emailing = $_POST['save_settlement_form_for_emailing']; // 1 for save settlement while email sharing; 0 for only save settlement
        $deployment_name = $_POST['deployment_name'];
        $name_printing = $_POST['name_printing'];
        $settlement_title = $_POST['settlement_title'];
        $conclusion = $_POST['conclusion'];
        $reason = $_POST['reason'];
        $case_study = $_POST['case_study'];
        $others = $_POST['others'];
        $settlement_id = $_POST['settlement_id'];
        $get_created_by = $_POST['created_by'];
        $get_is_deleted = $_POST['is_deleted'];
        $share_this_settlement_id = $_POST['is_share'];
//        die();
        $president_seal_id = $_POST['president_seal_id'];
        $examination1_seal_id = $_POST['examination1_seal_id'];
        $examination2_seal_id = $_POST['examination2_seal_id'];
        $examination3_seal_id = $_POST['examination3_seal_id'];
        $examination4_seal_id = $_POST['examination4_seal_id'];
        $name_printing_seal_id = $_POST['name_printing_seal_id'];

        $document_encrypted_name = '';
        $document_name = '';
        $document_type = '';
//        echo $_FILES['files']['name'];die();
        $check_if_document_exist1 = 0;

//        $check_if_document_exist = $this->wordapp_model->check_if_document_exist($settlement_id);
//
//        if (empty($check_if_document_exist)) {
//
//        }

        if ($settlement_id > 0 && $_FILES['files']['name'] == '') {
            $check_if_document_exist1 = 2;
        }
        if (!empty($_FILES['files']['name'])) {
            $check_if_document_exist1 = 1;

            if ($settlement_id > 0) {
                $check_if_document_exist = $this->wordapp_model->check_if_document_exist($settlement_id);
                if (empty($check_if_document_exist)) {
//                    $check_if_document_exist1=11;
                    $config['upload_path'] = './resource/img/decision_documents/';
                    $config['allowed_types'] = '*'; //doc|gif|jpg|png
                    // $config['max_size']             = 100;
                    // $config['max_width']            = 1024;
                    // $config['max_height']           = 768;
                    $config['encrypt_name'] = TRUE;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('files')) {
                        $data = array('error' => $this->upload->display_errors());

                    } else {

                        $data = array('upload_data' => $this->upload->data());
                        $document_encrypted_name = $data['upload_data']['file_name'];
                        $document_name = $data['upload_data']['orig_name'];
                        $document_type = $data['upload_data']['file_type'];

                    }
                } else {
//                    $check_if_document_exist1=22;
                    $document_encrypted_name = $check_if_document_exist['document_encrypted_name'];
                    $document_name = $check_if_document_exist['document_name'];
                    $document_type = $check_if_document_exist['document_type'];
                }
            } else {
//                $check_if_document_exist1=33;
                $config['upload_path'] = './resource/img/decision_documents/';
                $config['allowed_types'] = '*'; //doc|gif|jpg|png
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('files')) {
                    $data = array('error' => $this->upload->display_errors());

                } else {

                    $data = array('upload_data' => $this->upload->data());
                    $document_encrypted_name = $data['upload_data']['file_name'];
                    $document_name = $data['upload_data']['orig_name'];
                    $document_type = $data['upload_data']['file_type'];

                }
            }


        } else {
            $check_if_document_exist = $this->wordapp_model->check_if_document_exist($settlement_id);
            if (!empty($check_if_document_exist)) {
                $check_if_document_exist1 = 2;
                $document_encrypted_name = $check_if_document_exist['document_encrypted_name'];
                $document_name = $check_if_document_exist['document_name'];
                $document_type = $check_if_document_exist['document_type'];
            } else {
                $document_encrypted_name = '';
                $document_name = '';
                $document_type = '';
                $check_if_document_exist1 = 2;
            }

        }

//        echo "<pre>"; print_r($data);
//                exit();


//        echo "<pre>"; print_r($data);
//                exit();

        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));

        if ($settlement_id == 0) {
            $date = 'created_date';
            $created_by = $data['account']->id;
            $is_deleted = 0;
        } else {
            $date = 'modified_date';
            $is_deleted = $get_is_deleted;
            if ($share_this_settlement_id == 1) {
                $created_by = $get_created_by;
            } else {
                $created_by = $data['account']->id;
            }
        }
        $data = array(
            'president_seal_id' => $president_seal_id,
            'examination1_seal_id' => $examination1_seal_id,
            'examination2_seal_id' => $examination2_seal_id,
            'examination3_seal_id' => $examination3_seal_id,
            'examination4_seal_id' => $examination4_seal_id,
            'created_by' => $created_by,
            'deployment_name' => $deployment_name,
            'name_printing' => $name_printing,
            'name_printing_seal_id' => $name_printing_seal_id,
            'settlement_title' => $settlement_title,
            'conclusion' => $conclusion,
            'reason' => $reason,
            'case_study' => $case_study,
            'others' => $others,
            'document_name' => $document_name,
            'document_encrypted_name' => $document_encrypted_name,
            'document_type' => $document_type,
            'is_deleted' => $is_deleted,
            'is_share' => $share_this_settlement_id,
            $date => date('Y-m-d H:i:s')
        );
        $seal_type = '';
        if ($settlement_id > 0) {
//            $check_if_document_exist1=2;
            if ($president_seal_id != 0) {
                $seal_type = 'president_seal_id';
            } else if ($examination1_seal_id != 0) {
                $seal_type = 'examination1_seal_id';
            } else if ($examination2_seal_id != 0) {
                $seal_type = 'examination2_seal_id';
            } else if ($examination3_seal_id != 0) {
                $seal_type = 'examination3_seal_id';
            } else if ($examination4_seal_id != 0) {
                $seal_type = 'examination4_seal_id';
            }
            if ($seal_type != '') {
                $get_settlement_data_seal_wise = $this->wordapp_model->get_settlement_data_seal_wise($settlement_id, $seal_type);

                if ($get_settlement_data_seal_wise == 0) {
                    $save_email_info_specific_settlement_id_wise = $this->wordapp_model->save_email_info_specific_settlement_id_wise($settlement_id, $this->session->userdata('account_id'));
//                    echo print_r($save_email_info_specific_settlement_id_wise);die();
                }
            }


//                echo "<pre>";
//                print_r($save_email_info_specific_settlement_id_wise);
//                exit();

            //edit form
            $affected_rows = $this->wordapp_model->save_settlement_letter_form($data, $settlement_id);
            if ($affected_rows) {
                $res = 0;
                echo $res . '######' . $check_if_document_exist1;
//                $message = 'データが更新済みです。';
            }
        } else {
            $check_if_document_exist1 = 1;
            //add form
            $val = $this->wordapp_model->save_settlement_letter_form($data, $settlement_id);
            if ($val) {
                echo $val . '######' . $check_if_document_exist1;
//                $message = 'データが保存しました。';
            }
        }
//        echo "<script>alert('" . $message . "');window.close();</script>";
        if ($save_settlement_form_for_emailing == 1) {
            echo $val;
        } else {

        }
//        else if ($settlement_id > 0){
////            echo "<script>window.close();</script>";
//            echo "<script> window.location = '" . base_url() . "index.php/wordapp/view_settlement_form/" . $settlement_id . "'</script>";
//        }
//        else{
////            echo "<script>window.close();</script>";
//            echo "<script> window.location = '" . base_url() . "index.php/wordapp/view_settlement_form/" . $val . "'</script>";
//        }

    }

    public function get_all_settlement_data()
    {
//        error_reporting(0);
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        $user_id = $this->input->post('login_user_id');
        $start_from = $this->input->post('start_from');
        $view_type = $this->input->post('view_type');
        $is_share = $this->input->post('is_share');
        $created_by = $this->input->post('created_by');
        $list_limit = 30;

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }


        // Retrieve sign in user

        $total_shared_settlement_id = 0;
        $user_settlement_data = $this->wordapp_model->get_settlement_data_by_user_id($user_id, $start_from, $list_limit, $view_type);

//        $total_shared_settlement_id = $this->wordapp_model->get_total_shared_settlement($user_id, $view_type);

        $user_shared_settlement_data = $this->wordapp_model->get_shared_settlement_data_by_user_id($user_id, $view_type);

//        $total_settlement_data = $this->wordapp_model->get_total_user_settlement_data($user_id, $view_type);

        if (!empty($user_shared_settlement_data)) {

            $user_all_settlement_data1 = array_merge($user_settlement_data, $user_shared_settlement_data);

            $user_all_settlement_data = array();

            foreach ($user_all_settlement_data1 as $current) {
                if (!in_array($current, $user_all_settlement_data)) {
                    $user_all_settlement_data[] = $current;
                }
            }
            $data['total_settlement_data'] = count($user_all_settlement_data);
//            print_r($user_all_settlement_data);die();
        } else {
            $user_all_settlement_data = $user_settlement_data;
            $data['total_settlement_data'] = count($user_all_settlement_data);
        }
//            print_r($user_all_settlement_data);die();
        $data['user_settlement_data'] = $user_all_settlement_data;


//        $data['total_settlement_data'] = $total_settlement_data + $total_shared_settlement_id;

//

//        $data['user_settlement_data'] = $user_settlement_data;
        $data['start_from'] = $start_from;
        $data['list_limit'] = $list_limit;
        $data['list_limit1'] = 55;
//                echo "<pre>"; print_r($data['user_posts']);
//                exit();
        // echo $data['start_from'];
        // exit();
        $this->load->view('components/table_of_settlement', isset($data) ? $data : NULL);
    }

    public function get_seal_image_password_wise()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }

        $password = $_POST['password'];
        $seal_image_type = $_POST['seal_image_type'];
        $created_by = $this->session->userdata('account_id');

        // get seal image password wise
        $seal_image_with_id = $this->wordapp_model->get_seal_image_password_wise($password, $seal_image_type, $created_by);
        if (!empty($seal_image_with_id)) {
            $seal_image_with_id_array = explode('#####', $seal_image_with_id);

            $seal_image = $seal_image_with_id_array[0];
            if (!empty($seal_image_with_id_array[1]))
                $seal_id = $seal_image_with_id_array[1];

            $link_to_show = base_url() . 'resource/img/seal_images/' . $seal_image;
            if ($seal_image_type == 6) // name printing seal image
                $image_file = "<img style='margin-left:30px;' height='50' src=\"$link_to_show\" />";
            else
                $image_file = "<img height='50' src=\"$link_to_show\" />";
        }

//        echo $seal_image_with_id_array;die();
        if (!empty($seal_image_with_id)) {
            echo $image_file . '#####' . $seal_image_type . '#####' . $seal_id;
        } else {
            echo -1;
        }

//        $data['image_link'] = $image_name;
//        $data['link_to_show'] = $link_to_show;
//        $data['image_file'] = $image_file;
    }


    public function change_seal_image_password()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }

        $new_password = $_POST['password'];
        $seal_image_type = $_POST['seal_image_type'];
        $created_by = $this->session->userdata('account_id');

        $result = $this->wordapp_model->change_seal_image_password($new_password, $seal_image_type, $created_by);
//echo $result;die();
        if ($result) {
            echo 1; // success
        } else {
            echo 0; // same password
        }
    }

    public
    function delete_documents()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }

        $document_encrypted_name = $_POST['document_encrypted_name'];
        $settlement_id = $_POST['settlement_id'];

        unlink("resource/img/decision_documents/" . $document_encrypted_name);

        $result = $this->wordapp_model->delete_documents($settlement_id);


        if ($result) {
            echo 1; // success
        } else {
            echo 0; // same password
        }
    }

    public function email_check_for_user()
    {
        $new_email_check_for_user = $this->emailing_model->check_new_mail_for_specific_user($this->session->userdata('account_id'));
        if (!empty($new_email_check_for_user)) {
            echo $new_email_check_for_user['settlement_id'] . '######' . $new_email_check_for_user['email_id'];
        } else {
            echo 0;
        }

    }

    public function update_notification_shown()
    {
//        echo 11111;die();
        $email_id = $_POST['email_id'];

        $get_create_date = $this->emailing_model->get_email_create_date($email_id);

        if (!empty($get_create_date))
            $created_at = $get_create_date['created_at'];
        else
            $created_at = '';
        $result = $this->emailing_model->update_notification_shown($email_id);
        echo $created_at;
    }


    public function insert_new_seal_image_password()
    {
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }
        $add_password = $_POST['add_password'];
        $seal_image_type = $_POST['seal_image_type'];

        if (isset($_POST['check_pass']))
            $check_pass = $_POST['check_pass'];
        else
            $check_pass = 0;

        if (isset($_FILES['userfile']['name']))
            $seal_img = $_FILES['userfile']['name'];

        $result = $this->wordapp_model->check_if_password_exist($add_password);

        if ($check_pass == 1) {
            if ($result > 0) {
                echo 2;
//            die();
            } else {

            }
        } else {
            if ($result > 0) {
                echo 2;
//            die();
            } else {
                //         echo $_FILES['userfile']['name'] ;die();
                if (isset($_FILES['userfile']['name'])) {
                    $config['upload_path'] = './resource/img/seal_images/';
                    $config['allowed_types'] = 'gif|jpg|png'; //doc|gif|jpg|png
                    // $config['max_size']             = 100;
                    // $config['max_width']            = 1024;
                    // $config['max_height']           = 768;
                    $config['encrypt_name'] = false;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('userfile')) {
                        $data = array('error' => $this->upload->display_errors());

                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $document_encrypted_name = $data['upload_data']['file_name'];
                        $document_name = $data['upload_data']['orig_name'];
                        $document_type = $data['upload_data']['file_type'];
                    }
                } else {
                    $document_encrypted_name = '';
                    $document_name = '';
                    $document_type = '';
                }
//        echo "<pre>"; print_r($data);
//                exit();

                $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
                $data = array(
                    'seal_password' => $add_password,
                    'seal_img' => $seal_img,
                    'seal_img_type' => $seal_image_type,
                    'created_by' => $data['account']->id,
                    'created_date' => date('Y-m-d H:i:s')
                );
//        echo "<pre>"; print_r($data);
//                exit();

                //add form
                $val = $this->wordapp_model->insert_new_seal_image_password($data);
                if ($val) {
                    echo 1;
                }
            }
        }

    }

    public function delete_settlement()
    {
        $settlement_id = $this->input->post('settlement_id');
        if ($settlement_id) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
//                $post = $this->wordapp_model->get_post_by_id($settlement_id);
                if (!empty($settlement_id)) {
                    $this->wordapp_model->delete_settlement_by_id($settlement_id);
                    echo "success";
                } else {
                    echo "error3";
                }
            } else {
                echo "error2";
            }
        } else {
            echo "error1";
        }
    }

    public function check_if_password_exist()
    {

    }


//    public function get_settlement_data_by_id()
//    {
//        $settlement_id = $this->input->post('settlement_id');
//        if ($settlement_id && ($this->input->server('REQUEST_METHOD') == 'POST')) {
//
//            $data['post_details'] = $this->wordapp_model->get_post_by_id($settlement_id);
//
//            echo json_encode($data['post_details']);
//        }
//
//    }

}


/* End of file sign_in.php */
/* Location: ./application/account/controllers/sign_in.php */