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
//        session_start();
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
            redirect('index.php/account/sign_in');
        }
//        $this->session->unset_userdata('account_id');
        // Retrieve sign in user
        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        $data['company_name'] = $this->account_model->get_by_id($data['account']->company_id);

        $data['title'] = "Word App";

        $data['user_posts'] = $this->wordapp_model->get_post_by_user_id($data['account']->id, 0, 30);
        $data['user_emails'] = $this->emailing_model->get_email_by_user_id($data['account']->id, 0, 30);
        // echo "<pre>"; print_r($data['user_emails']);
        // exit();
        $data['email_pertners'] = $this->emailing_model->get_pertner_list_by_id($data['account']->id, 0);

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
                    'post_details' => mb_convert_encoding($this->input->post('post_details'), 'UTF-8', 'UTF-8'),
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
                    'post_details' => mb_convert_encoding($this->input->post('post_details'), 'UTF-8', 'UTF-8'),
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
        $user_id = $this->input->post('login_user_id');
        $start_from = $this->input->post('start_from');
        $list_limit = 30;

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }

        // Retrieve sign in user
        $data['total_user_post'] = $this->wordapp_model->get_total_user_post($user_id);
        $data['start_from'] = $start_from;
        $data['list_limit'] = $list_limit;
        $data['user_posts'] = $this->wordapp_model->get_post_by_user_id($user_id, $start_from, $list_limit);
        echo json_encode($data);
        
        // $this->load->view('components/table_of_post', isset($data) ? $data : NULL);
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

    function view_settlement_form($settlement_id = 0, $share_this_settlement_id = 0, $back_one_step = '', $settlement_mail_screen = 0)
    {
//        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }
        $created_by = $this->session->userdata('account_id');
        $data['seal_image_exist'] = $this->wordapp_model->get_latest_seal_password_userwise($created_by);

        if ($settlement_id > 0) {
            // fetch library data and set inthe specific fields. This will happen in case of edit.
            $details_info = $this->wordapp_model->get_settlement_data_by_id($settlement_id, $created_by, $share_this_settlement_id);
            $settlement_documents_info = $this->wordapp_model->get_settlement_documents_info($settlement_id);
            $data['settlement_documents_info'] = $settlement_documents_info;
            $settlement_title = $details_info['settlement_title'];
            $settlement_title = stripslashes($settlement_title);
            $data['settlement_title'] = $settlement_title;
            $data['deployment_name'] = $details_info['deployment_name'];
            $data['name_printing'] = $details_info['name_printing'];
            $data['conclusion'] = $details_info['conclusion'];
            $data['reason'] = $details_info['reason'];
            $data['case_study'] = $details_info['case_study'];
            $data['others'] = $details_info['others'];
            $data['on_hold'] = $details_info['on_hold'];
//            $document_name = $details_info['document_name'];
//            $document_name_array = explode('|', $document_name);
//            $data['document_name_array'] = $document_name_array;
//            $data['document_name'] = $document_name;
//            $document_encrypted_name = $details_info['document_encrypted_name'];
//            $document_encrypted_name_array = explode('|', $document_encrypted_name);
//            $data['document_encrypted_name_array'] = $document_encrypted_name_array;
//            $data['document_encrypted_name'] = $document_encrypted_name;
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
            $settlement_documents_info = array();
            $data['settlement_documents_info'] = $settlement_documents_info;
        }
        $data['share_this_settlement_id'] = $share_this_settlement_id;
        $data['back_one_step'] = $back_one_step;
        $data['settlement_mail_screen'] = $settlement_mail_screen;
        $data['login_user_id'] = $created_by;


//        echo "<pre>";
//        print_r($data['image_file']);
//        exit();
        $this->load->view('components/settlement_letter_mail', isset($data) ? $data : NULL);
    }

    function view_settlement_form_2($settlement_id = 0, $share_this_settlement_id = 0, $back_one_step = '')
    {
        /// Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }
        $created_by = $this->session->userdata('account_id');
        $data['seal_image_exist'] = $this->wordapp_model->get_latest_seal_password_userwise($created_by);

        if ($settlement_id > 0) {
            // fetch library data and set inthe specific fields. This will happen in case of edit.
            $details_info = $this->wordapp_model->get_settlement_data_by_id($settlement_id, $created_by, $share_this_settlement_id);
            $settlement_documents_info = $this->wordapp_model->get_settlement_documents_info($settlement_id);
            $data['settlement_documents_info'] = $settlement_documents_info;
            $settlement_title = $details_info['settlement_title'];
            $settlement_title = stripslashes($settlement_title);
            $data['settlement_title'] = $settlement_title;
            $data['deployment_name'] = $details_info['deployment_name'];
            $data['name_printing'] = $details_info['name_printing'];
            $data['conclusion'] = $details_info['conclusion'];
            $data['reason'] = $details_info['reason'];
            $data['case_study'] = $details_info['case_study'];
            $data['others'] = $details_info['others'];
            $data['on_hold'] = $details_info['on_hold'];
//            $document_name = $details_info['document_name'];
//            $document_name_array = explode('|', $document_name);
//            $data['document_name_array'] = $document_name_array;
//            $data['document_name'] = $document_name;
//            $document_encrypted_name = $details_info['document_encrypted_name'];
//            $document_encrypted_name_array = explode('|', $document_encrypted_name);
//            $data['document_encrypted_name_array'] = $document_encrypted_name_array;
//            $data['document_encrypted_name'] = $document_encrypted_name;
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
            $data['settlement_documents_info'] = '';
        }
        $data['share_this_settlement_id'] = $share_this_settlement_id;
        $data['back_one_step'] = $back_one_step;
        $data['login_user_id'] = $created_by;

//        echo "<pre>";
//        print_r($data['image_file']);
//        exit();
//        $this->load->view('components/settlement_letter_mail', isset($data) ? $data : NULL);
        $this->load->view('components/settlement_letter_mail_2', isset($data) ? $data : NULL);
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
//        $_SESSION["name_printing"] = $name_printing;

        $settlement_title = $_POST['settlement_title'];
        $conclusion = $_POST['conclusion'];
        $reason = $_POST['reason'];
        $case_study = $_POST['case_study'];
        $others = $_POST['others'];
        $settlement_id = $_POST['settlement_id'];
        $get_created_by = $_POST['created_by'];
        $get_is_deleted = $_POST['is_deleted'];
        $share_this_settlement_id = $_POST['is_share'];

        $president_seal_id = $_POST['president_seal_id'];
        $examination1_seal_id = $_POST['examination1_seal_id'];
        $examination2_seal_id = $_POST['examination2_seal_id'];
        $examination3_seal_id = $_POST['examination3_seal_id'];
        $examination4_seal_id = $_POST['examination4_seal_id'];
        $name_printing_seal_id = $_POST['name_printing_seal_id'];

        $document_encrypted_name = '';
        $document_name = '';
        $document_type = '';
//        echo $_FILES['files']['name'][0];die();
        $check_if_document_exist1 = 0;

//        $check_if_document_exist = $this->wordapp_model->check_if_document_exist($settlement_id);
//
//        if (empty($check_if_document_exist)) {
//
//        }


        if ($settlement_id > 0 && $_FILES['files']['name'][0] == '') {
            $check_if_document_exist1 = 2;
        } else {
            $check_if_document_exist1 = 1;
        }

        //        echo "<pre>"; print_r($data);


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
            'document_name' => $_FILES['files']['name'][0],
            'document_encrypted_name' => '',
            'document_type' => '',
            'is_deleted' => $is_deleted,
            'is_share' => $share_this_settlement_id,
            $date => date('Y-m-d H:i:s')
        );
        $seal_type = '';
        if ($settlement_id > 0) {
            if ($president_seal_id != 0) {
                $seal_type = 'president_seal_id';
            }
//            else if ($examination1_seal_id != 0) {
//                $seal_type = 'examination1_seal_id';
//            } else if ($examination2_seal_id != 0) {
//                $seal_type = 'examination2_seal_id';
//            } else if ($examination3_seal_id != 0) {
//                $seal_type = 'examination3_seal_id';
//            } else if ($examination4_seal_id != 0) {
//                $seal_type = 'examination4_seal_id';
//            }
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
                $return_val = $res . '######' . $check_if_document_exist1;
            }
            $decision_document_settlement_id = $settlement_id;
        } else {
            $check_if_document_exist1 = 1;
            //add form
            $val = $this->wordapp_model->save_settlement_letter_form($data, $settlement_id);
            if ($val) {
                $decision_document_settlement_id = $val;
                $return_val = $val . '######' . $check_if_document_exist1;
            }
        }

        if ($_FILES['files']['name'][0] != '') {
            $check_if_document_exist1 = 1;

//            if ($settlement_id > 0) {
//                    $check_if_document_exist1=11;
            $config['upload_path'] = './resource/img/decision_documents/';
            $config['allowed_types'] = '*';
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);


            $filesCount = count($_FILES['files']['name']);
            $files = array();
            foreach ($_FILES['files']['name'] as $key => $image) {
                $_FILES['files[]']['name'] = $_FILES['files']['name'][$key];
                $_FILES['files[]']['type'] = $_FILES['files']['type'][$key];
                $_FILES['files[]']['tmp_name'] = $_FILES['files']['tmp_name'][$key];
                $_FILES['files[]']['error'] = $_FILES['files']['error'][$key];
                $_FILES['files[]']['size'] = $_FILES['files']['size'][$key];

                $fileName = $image;

                $files[] = $fileName;

//                $config['file_name'] = $fileName;


                if (!$this->upload->do_upload('files[]')) {
                    $data = array('error' => $this->upload->display_errors());

                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $document_encrypted_name = $data['upload_data']['file_name'];
                    $document_name = $data['upload_data']['orig_name'];
                    $document_type = $data['upload_data']['file_type'];
                }

                $this->wordapp_model->insert_decision_documents($decision_document_settlement_id, $document_encrypted_name, $document_name, $document_type);
            }
        } else {
            $check_if_document_exist1 = 2;
        }

        echo $return_val;
//        echo "<script>alert('" . $message . "');window.close();</script>";
//        if ($save_settlement_form_for_emailing == 1) {
//            echo $val;
//        } else {
//
//        }
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
        $name = '';
        $get_receiver_list_from_email_by_sender_name = array();

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }
//echo $view_type;die();
        if ($view_type == 10) {
            $is_deleted = 1;
            $view_type = 4;
        } else {
            $is_deleted = 0;
        }


        // Retrieve all decision documents
        $all_decision_documents = $this->wordapp_model->get_all_decision_documents();

        // Retrieve sign in user
        $all_result = $this->account_model->get_username_by_id($user_id, 1);
        if ($all_result->name != '')
            $name = $all_result->name;
        else
            $name = $all_result->username;
        $total_shared_settlement_id = 0;
        $user_settlement_data = $this->wordapp_model->get_settlement_data_by_user_id($user_id, $start_from, $list_limit, $view_type, $is_deleted);

        $user_shared_settlement_data = $this->wordapp_model->get_shared_settlement_data_by_user_id($user_id, $view_type, $all_result->username, $all_result->name, $is_deleted);

        if ($view_type == 4 || $view_type == 10) {
            $merge_user_shared_settlement_data_not_approved = array_merge($user_settlement_data, $user_shared_settlement_data);
            usort($merge_user_shared_settlement_data_not_approved, function ($a, $b) {
                $t1 = strtotime($a->created_at);
                $t2 = strtotime($b->created_at);
                return $t2 - $t1;
//                    return $a->created_at > $b->created_at ? -1 : +1; // array in descending order by modified_date

            });
            $user_settlement_data_approved = $this->wordapp_model->get_settlement_data_by_user_id_approved($user_id, $start_from, $list_limit, $view_type, $is_deleted);
            $user_shared_settlement_data_approved = $this->wordapp_model->get_shared_settlement_data_by_user_id_approved($user_id, $view_type, $is_deleted);

            $merge_user_all_settlement_data_approved = array_merge($user_settlement_data_approved, $user_shared_settlement_data_approved);
            usort($merge_user_all_settlement_data_approved, function ($a1, $b1) {
                $t11 = strtotime($a1->created_at);
                $t21 = strtotime($b1->created_at);
                return $t21 - $t11;
//                    return $a->created_at > $b->created_at ? -1 : +1; // array in descending order by modified_date

            });


//            if (!empty($merge_user_all_settlement_data_approved))
            $merge_user_all_settlement_data_approved_not_approved = array_merge($merge_user_shared_settlement_data_not_approved, $merge_user_all_settlement_data_approved);
//            else
//                $merge_user_all_settlement_data_approved_not_approved = $merge_user_shared_settlement_data_not_approved;
        }
//        $total_shared_settlement_id = $this->wordapp_model->get_total_shared_settlement($user_id, $view_type);


//        $total_settlement_data = $this->wordapp_model->get_total_user_settlement_data($user_id, $view_type);

        if (!empty($user_shared_settlement_data)) {

            if ($view_type == 4 || $view_type == 10) {

                $get_receiver_list_from_email_by_sender_name = $this->wordapp_model->get_receiver_list_from_email_by_sender_name($user_id, $all_result->name, $all_result->username);

                function cmp($a, $b)
                {
                    if ($a['receiver_id'] == 20 || $a['receiver_name'] == "1010" || $a['receiver_name'] == "社長") {
                        return 1;
                    }
                    else {
                        return -1;
                    }

                    return strcmp($a, $b);// or any other sort you want
                }
                usort($get_receiver_list_from_email_by_sender_name, "cmp");

                //                echo "<pre>";
//                print_r($get_receiver_list_from_email_by_sender_name);
                $user_all_settlement_data1 = $merge_user_all_settlement_data_approved_not_approved;
//                $user_all_settlement_data1 = array_merge($user_all_settlement_data4, $user_shared_settlement_data);
            } else {
                $user_all_settlement_data1 = array_merge($user_settlement_data, $user_shared_settlement_data);
            }


            $user_all_settlement_data = array();
//            $all_decision_documents = array();

            foreach ($user_all_settlement_data1 as $current) {
//                $all_decision_document = $this->wordapp_model->get_all_decision_documents($current->settlement_id);
//                foreach ($all_decision_document as $current1) {
//                    if (!in_array($current1, $all_decision_documents)) {
//
//
//                        $all_decision_documents[] = $current1;
//                    }
//                }
                if (!in_array($current, $user_all_settlement_data)) {


                    $user_all_settlement_data[] = $current;
                }
            }

//                    echo "<pre>";
//                    print_r($current);

//            die();
            if ($view_type == 4 || $view_type == 10) { // history view list

//                usort($user_all_settlement_data, function ($a, $b) {
//                    $t1 = strtotime($a->created_at);
//                    $t2 = strtotime($b->created_at);
//                    return $t1 - $t2;
////                    return $a->created_at > $b->created_at ? -1 : +1; // array in descending order by modified_date
//
//                });
            } else if ($view_type == 5 || $view_type == 7) { //approved view list
                usort($user_all_settlement_data, function ($a, $b) {
                    return $a->settlement_id > $b->settlement_id ? -1 : +1; // array in descending order by settlement_id
                });
            }


            $data['total_settlement_data'] = count($user_all_settlement_data);
//            print_r($user_all_settlement_data);die();
        } else {
            $user_all_unshared_settlement_data = array_merge($user_settlement_data, $user_settlement_data_approved);
            $user_all_settlement_data = $user_all_unshared_settlement_data;
            $data['total_settlement_data'] = count($user_all_settlement_data);
        }

        //            print_r($user_all_settlement_data);die();
        $data['user_settlement_data'] = $user_all_settlement_data;
        $data['receiver_list_from_email_by_sender_name'] = $get_receiver_list_from_email_by_sender_name;

//        $data['total_settlement_data'] = $total_settlement_data + $total_shared_settlement_id;

//

//        $data['user_settlement_data'] = $user_settlement_data;
        $data['all_decision_documents'] = $all_decision_documents;
        $data['name'] = $name;
        $data['view_type'] = $view_type;
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

        $seal_image_with_id = $this->wordapp_model->get_seal_image_password_wise($password, $seal_image_type, $created_by);

        if (!empty($seal_image_with_id)) {
            $seal_image_with_id_array = explode('#####', $seal_image_with_id);

            $seal_image = $seal_image_with_id_array[0];
            if (!empty($seal_image_with_id_array[1]))
                $seal_id = $seal_image_with_id_array[1];

            $link_to_show = base_url() . 'resource/img/seal_images/' . $seal_image;
            if ($seal_image_type == 6) // name printing seal image
                $image_file = "<img class='seal_iamge_brightness' style='margin-left:30px;' height='50' src=\"$link_to_show\" />";
            else
                $image_file = "<img class='seal_iamge_brightness' height='50' src=\"$link_to_show\" />";
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
//        print_r($_POST);die();
        $current_password = $_POST['current_password'];
        $new_password = $_POST['password'];
        $seal_image_type = $_POST['seal_image_type'];
        if (isset($_POST['change_seal_image_step_2'])) {
            $change_seal_image_step_2 = $_POST['change_seal_image_step_2'];
        } else {
            $change_seal_image_step_2 = 0;

        }

        $created_by = $this->session->userdata('account_id');

        $check_if_current_password_correct = $this->wordapp_model->check_if_password_exist($current_password, $created_by);
        if ($check_if_current_password_correct > 0) {
            $check_if_new_password_already_exist = $this->wordapp_model->check_if_password_exist($new_password, '');

            if ($check_if_new_password_already_exist > 0) {
                echo 2; // password exist
            } else {
                if ($change_seal_image_step_2 == 1) {
                    echo 1;
                } else {
                    $result = $this->wordapp_model->change_seal_image_password($current_password, $new_password, $seal_image_type, $created_by);
//echo $result;die();
                    if ($result) {
                        echo 1; // success
                    } else {
                        echo 0; // same password
                    }
                }

            }
        } else {
            echo 3; // incorrect password
        }
    }

    public function forgot_seal_image_password()
    {
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }
//        print_r($_POST);die();
        $forgot_password = $_POST['seal_image_forgot_password'];
        $user_login_password = $_POST['user_login_password'];
        $created_by = $this->session->userdata('account_id');

        $check_if_login_password_already_exist = $this->wordapp_model->check_if_password_exist($user_login_password, $created_by);

        if ($check_if_login_password_already_exist > 0) {
            $check_if_new_password_already_exist = $this->wordapp_model->check_if_password_exist($forgot_password, '');

            if ($check_if_new_password_already_exist == 0) {
                $result = $this->wordapp_model->change_seal_image_password($user_login_password, $forgot_password, 0, $created_by);
                if ($result) {
                    echo 1; // success
                } else {
                    echo 0; // same password
                }
            } else {
                echo 0; // same password
            }

        } else {
            echo 3; // incorrect password
        }
    }

    public
    function delete_decode_base64image_from_folder_for_ie()
    {
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }

        $seal_image_name = $_POST['crop_image_name'];

        unlink("resource/img/seal_images/" . $seal_image_name);
        echo 1;
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
        $document_id = $_POST['document_id'];


        unlink("resource/img/decision_documents/" . $document_encrypted_name);

        $settlement_id = $_POST['settlement_id'];


        $result = $this->wordapp_model->delete_documents($document_id, $settlement_id);


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
            if ($new_email_check_for_user['settlement_id'] != 0) {
                $president_seal_id = 1;
                $check_president_seal_id = $this->wordapp_model->get_settlement_data_by_id($new_email_check_for_user['settlement_id'], '', 1);
                echo $new_email_check_for_user['settlement_id'] . '######' . $new_email_check_for_user['email_id'] . '######' . $check_president_seal_id['president_seal_id'];
            } else {
                echo $new_email_check_for_user['settlement_id'] . '######' . $new_email_check_for_user['email_id'];
            }

        } else {
            echo 0;
        }

    }

    public function update_notification_shown()
    {
//        echo 11111;die();
        $email_id = $_POST['email_id'];
        $receiver_id = $this->session->userdata('account_id');

        $get_create_date = $this->emailing_model->get_email_create_date($email_id);
        $total_unread_email = $this->emailing_model->get_total_unread_email($receiver_id);

        if (!empty($get_create_date)) {
            $created_at = $get_create_date['created_at'];
            $sender_name = $get_create_date['sender_name'];

        } else {
            $created_at = '';
            $sender_name = '';

        }
        $result = $this->emailing_model->update_notification_shown($email_id);
        echo $created_at . '#####' . $sender_name . '#####' . $total_unread_email;
    }


    public function decode_base64image_for_ie()
    {
        $crop_image_name = $_POST['crop_image_name'];

        if ($crop_image_name != 'undefined') {
            list($type, $crop_image_name) = explode(';', $crop_image_name);
            list(, $crop_image_name) = explode(',', $crop_image_name);

            $final_crop_image_name = base64_decode($crop_image_name);
            $seal_img = md5(uniqid(mt_rand())) . '.png';
            if ($crop_image_name != 'undefined') {
                file_put_contents('resource/img/seal_images/' . $seal_img, $final_crop_image_name);
                echo $seal_img;
            }

        }
    }

    public function insert_new_seal_image_password()
    {
        maintain_ssl($this->config->item("ssl_enabled"));
//        print_r($_POST);
//        die();
        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }
        $created_by = $this->session->userdata('account_id');
        $add_password = $_POST['add_password'];

        if ($_POST['seal_image_type'] == '') {
            $seal_image_type = 0;
        } else {
            $seal_image_type = $_POST['seal_image_type'];
        }
        $crop_image_name = $_POST['crop_image_name'];

        if ($crop_image_name != 'undefined') {
            list($type, $crop_image_name) = explode(';', $crop_image_name);
            list(, $crop_image_name) = explode(',', $crop_image_name);

            $final_crop_image_name = base64_decode($crop_image_name);
            $seal_img = md5(uniqid(mt_rand())) . '.png';
        }

        if (isset($_POST['check_pass']))
            $check_pass = $_POST['check_pass'];
        else
            $check_pass = 0;

//        if (isset($_FILES['userfile']['name']))
//            $seal_img = $_FILES['userfile']['name'];


//        $result = $this->wordapp_model->check_if_password_exist($add_password,$created_by);
        $result = 0;
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
//                if (isset($_FILES['userfile']['name']) || $crop_image_name != 'undefined') {
////                   echo $seal_img; die();
//                    $config['upload_path'] = './resource/img/seal_images/';
//                    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
//                    // $config['max_size']             = 100;
//                    // $config['max_width']            = 1024;
//                    // $config['max_height']           = 768;
//                    $config['encrypt_name'] = false;
//
//                    $this->load->library('upload', $config);
//
//                    if (!$this->upload->do_upload('userfile')) {
//                        $data = array('error' => $this->upload->display_errors());
//
//                    } else {
//                        $data = array('upload_data' => $this->upload->data());
//                        $document_encrypted_name = $data['upload_data']['file_name'];
//                        $document_name = $data['upload_data']['orig_name'];
//                        $document_type = $data['upload_data']['file_type'];
//                    }
//                } else {
//                    $document_encrypted_name = '';
//                    $document_name = '';
//                    $document_type = '';
//                }
//        echo "<pre>"; print_r($data);
//                exit();

//                $account = $this->account_model->get_by_id($this->session->userdata('account_id'));
//                $add_password = $account->password;
                $check_if_seal_image_password_exist = $this->wordapp_model->check_if_password_exist($add_password, $created_by);

                if ($check_if_seal_image_password_exist > 0) { // already exist password then update image and delete previous image from folder
                    $seal_image_with_id = $this->wordapp_model->get_seal_image_password_wise($add_password, $seal_image_type, $created_by);
                    $seal_image_with_id_array = explode('#####', $seal_image_with_id);
                    $previous_seal_image = $seal_image_with_id_array[0];
                    unlink("resource/img/seal_images/" . $previous_seal_image);
                    $update = $this->wordapp_model->update_seal_image_password_wise($add_password, $seal_img);
                    file_put_contents('resource/img/seal_images/' . $seal_img, $final_crop_image_name);
                    echo $update;
                } else {
                    $data = array(
                        'seal_password' => $add_password,
                        'seal_img' => $seal_img,
                        'seal_img_type' => $seal_image_type,
                        'created_by' => $created_by,
                        'created_date' => date('Y-m-d H:i:s')
                    );
//        echo "<pre>"; print_r($data);
//                exit();

                    //add form
                    $val = $this->wordapp_model->insert_new_seal_image_password($data);
                    if ($crop_image_name != 'undefined' && $val) {
                        file_put_contents('resource/img/seal_images/' . $seal_img, $final_crop_image_name);
                    }
                    if ($val) {
                        echo 1;
                    }
                }
            }
        }

    }

    public
    function delete_settlement()
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

//    public
//    function check_if_password_exist()
//    {
//
//    }

    public function load_settlement_list_sent_received_page()
    {
        $this->load->view('components/settlement_list_sent_received');
    }

    public function update_document_name_settlement_table()
    {
        $this->wordapp_model->update_document_name_settlement_table();
    }

    public function get_latest_seal_password_userwise()
    {
        maintain_ssl($this->config->item("ssl_enabled"));
//        print_r($_POST);
//        die();
        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }
        $created_by = $this->session->userdata('account_id');
        $result = $this->wordapp_model->get_latest_seal_password_userwise($created_by);
        $seal_password = $result['seal_password'];
        echo $seal_password;
    }

    /**
     * @return mixed
     */
    public function get_users_name()
    {
        $partner_mobile = $_POST['partner_mobile'];

        $result = $this->account_model->get_by_username($partner_mobile, $receiver_name = '');
        if (!empty($result)) {
            echo $result->name;
        } else {
            echo 'user not registered';
        }

    }

    public function get_userlist_for_admin()
    {
//        error_reporting(0);
        // Enable SSL?
        maintain_ssl($this->config->item("ssl_enabled"));

        $user_id = $this->input->post('login_user_id');
        $start_from = $this->input->post('start_from');
        $view_type = $this->input->post('view_type');
        $is_share = $this->input->post('is_share');
        $created_by = $this->session->userdata('account_id');
        $list_limit = 30;

        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }

        // Retrieve sign in user
        $user_settlement_data_self = $this->wordapp_model->get_user_list_from_settlement($created_by, $start_from, $list_limit, $view_type, 1);

        $user_settlement_data = $this->wordapp_model->get_user_list_from_settlement($user_id, $start_from, $list_limit, $view_type, 0);

        $merge_user_settlement_data = array_merge($user_settlement_data_self, $user_settlement_data);

//        echo "<pre>";
//        print_r($merge_user_settlement_data);
//        die();

        $user_all_settlement_data = $merge_user_settlement_data;
        $data['total_settlement_data'] = count($user_all_settlement_data);
        $data['user_settlement_data'] = $user_all_settlement_data;


        $data['created_by'] = $created_by;
        $data['view_type'] = $view_type;
        $data['start_from'] = $start_from;
        $data['list_limit'] = $list_limit;
        $data['list_limit1'] = 55;
        $this->load->view('components/table_of_user_list', isset($data) ? $data : NULL);
    }

    public function get_user_name()
    {
        $user_id = $this->input->post('user_id');
        $from = 1;//from settlement page

        $result = $this->account_model->get_username_by_id($user_id, $from);
        echo $result->name . '#####' . $result->username;

    }

    public function update_hold_status_settlement()
    {
        $settlement_id = $this->input->post('settlement_id');

        $result = $this->wordapp_model->update_hold_status_settlement($settlement_id);
        echo $result;
    }

    public function get_user_trash_post()
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
        $data['total_user_post'] = $this->wordapp_model->get_total_user_post($user_id, $deleted = 1);
        $data['start_from'] = $start_from;
        $data['list_limit'] = $list_limit;
        $data['user_posts'] = $this->wordapp_model->get_post_by_user_id($user_id, $start_from, $list_limit, $deleted = 1);
        
        echo json_encode($data);
//                echo "<pre>"; print_r($data['user_posts']);
//                exit();
        // echo $data['start_from'];
        // exit();
        // $this->load->view('components/table_of_post', isset($data) ? $data : NULL);
    }

    public function restore_post_files()
    {

        $get_user_json = file_get_contents('php://input');

        $user_data = json_decode($get_user_json);

        foreach ($user_data->post_ids as $key => $post_id) {
            $this->restore_posts($post_id);
        }

    }

    public function permanent_delete_post_files()
    {
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }
        $get_user_post_json = file_get_contents('php://input');
        $posts = json_decode($get_user_post_json);
        $result = $this->wordapp_model->permanent_delete($posts->post_ids);

    }

    public function restore_posts($post_id)
    {
        $result = $this->wordapp_model->restore_posts($post_id);
    }

    public function restore_settlement_from_trash()
    {
        $settlement_id = $this->input->post('settlement_id');

        $result = $this->wordapp_model->restore_settlement_from_trash($settlement_id);
        echo $result;
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

    public function get_kanji_candidates()
    {
        $xml = file_get_contents("http://jlp.yahooapis.jp/JIMService/V1/conversion?appid=dj00aiZpPUEwdXljWWprY0sxYiZzPWNvbnN1bWVyc2VjcmV0Jng9NmM-&sentence={$_REQUEST['sentence']}");
        $ref = json_encode(simplexml_load_string($xml));

        header('application/x-javascript; charset=utf-8');
        echo "if(typeof(temp_YahooAPI_VJE)=='undefined') temp_YahooAPI_VJE = {};\n";
        echo "temp_YahooAPI_VJE.data = $ref";
        //echo "$callback($ref);";
        echo "\n";
        echo "if(typeof(temp_YahooAPI_VJE.onload)=='function') temp_YahooAPI_VJE.onload(temp_YahooAPI_VJE.data);";
    }

    public function xmlToArray($xml, $options = array()) {
        $defaults = array(
            'namespaceSeparator' => ':',//you may want this to be something other than a colon
            'attributePrefix' => '@',   //to distinguish between attributes and nodes with the same name
            'alwaysArray' => array(),   //array of xml tag names which should always become arrays
            'autoArray' => true,        //only create arrays for tags which appear more than once
            'textContent' => '$',       //key used for the text content of elements
            'autoText' => true,         //skip textContent key if node has no attributes or child nodes
            'keySearch' => false,       //optional search and replace on tag and attribute names
            'keyReplace' => false       //replace values for above search values (as passed to str_replace())
        );
        $options = array_merge($defaults, $options);
        $namespaces = $xml->getDocNamespaces();
        $namespaces[''] = null; //add base (empty) namespace
    
        //get attributes from all namespaces
        $attributesArray = array();
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
                //replace characters in attribute name
                if ($options['keySearch']) $attributeName =
                        str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
                $attributeKey = $options['attributePrefix']
                        . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
                        . $attributeName;
                $attributesArray[$attributeKey] = (string)$attribute;
            }
        }
    
        //get child nodes from all namespaces
        $tagsArray = array();
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->children($namespace) as $childXml) {
                //recurse into child nodes
                $childArray = xmlToArray($childXml, $options);
                list($childTagName, $childProperties) = each($childArray);
    
                //replace characters in tag name
                if ($options['keySearch']) $childTagName =
                        str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
                //add namespace prefix, if any
                if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;
    
                if (!isset($tagsArray[$childTagName])) {
                    //only entry with this key
                    //test if tags of this type should always be arrays, no matter the element count
                    $tagsArray[$childTagName] =
                            in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
                            ? array($childProperties) : $childProperties;
                } elseif (
                    is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
                    === range(0, count($tagsArray[$childTagName]) - 1)
                ) {
                    //key already exists and is integer indexed array
                    $tagsArray[$childTagName][] = $childProperties;
                } else {
                    //key exists so convert to integer indexed array with previous value in position 0
                    $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
                }
            }
        }
    
        //get text content of node
        $textContentArray = array();
        $plainText = trim((string)$xml);
        if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;
    
        //stick it all together
        $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
                ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;
    
        //return node as array
        return array(
            $xml->getName() => $propertiesArray
        );
    }

    public function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1000;
        $config['encrypt_name'] = TRUE;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
        }
        else
        {
            $picture = $this->upload->data();
            if ($picture['image_width']>680) {
                $orinal_name = explode(".", $picture['file_name']);
                $newfilename = md5(time()) . '.' . end($orinal_name);
                // Create picture thumbnail - http://codeigniter.com/user_guide/libraries/image_lib.html
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = FCPATH.'/uploads/'.$picture['file_name'];
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = TRUE;
                $config['height'] = "400";
                $config['width'] = "670";
                $config['new_image'] = FCPATH.'/uploads/'.$newfilename;
                $this->image_lib->initialize($config);

                // Try resizing the picture
                if ( ! $this->image_lib->resize())
                {
                    $data['profile_picture_error'] = $this->image_lib->display_errors();
                    $data['location'] = 'uploads/'.$picture['file_name'];
                    $data['file_name'] = $picture['file_name'];
                    // Delete original uploaded file
                    echo json_encode($data);
                }
                else
                {
                    $data['location'] = 'uploads/'.$newfilename;
                    $data['file_name'] = $newfilename;
                    // Delete original uploaded file
                    unlink(FCPATH.'/uploads/'.$picture['file_name']);
                    echo json_encode($data);
                }
                
            }else{
                $data['location'] = 'uploads/'.$picture['file_name'];
                $data['file_name'] = $picture['file_name'];
                echo json_encode($data);
            }
            
        }
    }

    public function tiny_image_upload()
    {
        /*********************************************
           * Change this line to set the upload folder *
           *********************************************/
          $imageFolder = "uploads/";

          reset ($_FILES);
          $temp = current($_FILES);
          if (is_uploaded_file($temp['tmp_name'])){
           
            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }

            // Change File Name
            $orinal_name = explode(".", $temp['name']);
            $newfilename = round(microtime(true)) . '.' . end($orinal_name);
            $filetowrite = $imageFolder . $newfilename;

            // Upload the server
            move_uploaded_file($temp['tmp_name'], $filetowrite);
            echo json_encode(array('location' => $filetowrite));
            // echo json_encode(array('location' => "/uploads/AhasanYounusSir2.jpg"));
          } else {
            // Notify editor that the upload failed
            header("HTTP/1.1 500 Server Error");
          }
    }

}




/* End of file sign_in.php */
/* Location: ./application/account/controllers/sign_in.php */