<?php

class Emailing extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // Load the necessary stuff...
        date_default_timezone_set('Asia/Tokyo');
        $this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
        $this->load->model(array('account/account_model', 'emailing_model', 'push_notifications', 'wordapp_model'));
    }

    public function index()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);

        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {
                // Retrieve user last updated 30 files
                $user_id = base64_decode($user_data->user_id);
                $response["success"] = 1;
                $response['user_emails'] = $this->emailing_model->get_email_by_user_id($user_id, 0, 30);

                $response["message"] = "success";
                echo json_encode($response);
            } else {
                $response["success"] = 0;
                $response['user_emails'] = array();
                $response["message"] = "API key is wrong";
                echo json_encode($response);
            }
        }
    }

    public function draft_email()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);

        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {
                // Retrieve user last updated 30 files
                $user_id = base64_decode($user_data->user_id);
                $response["success"] = 1;
                $response['user_emails'] = $this->emailing_model->get_draft_email_by_user_id($user_id, 0, 30);

                $response["message"] = "success";
                echo json_encode($response);
            } else {
                $response["success"] = 0;
                $response['user_emails'] = array();
                $response["message"] = "API key is wrong";
                echo json_encode($response);
            }
        }
    }

    public function send()
    {

        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);

        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {

                if (($user_data->user_id != "") && (($user_data->subject != "" || $user_data->content))) {//
                    $user_id = base64_decode($user_data->user_id);

                    // Retrieve sign in user
                    $receiver_user_info = $this->account_model->get_by_username($user_data->receiver_mobile, $user_data->receiver_name);
//                    print_r($receiver_user_info);die();
                    if (empty($receiver_user_info)) {
                        $response['message'] = 'invalid partner';
                    } else {
                        $sender_user_info = $this->account_model->get_by_id($user_id);
                        $receiver_id = NULL;
                        $sender_mobile = NULL;
                        $sender_name = NULL;
                        if (!empty($receiver_user_info)) {
                            $receiver_id = $receiver_user_info->id;
                        }
                        if (!empty($sender_user_info)) {
                            if ($sender_user_info->name != '') {
                                $sender_name = $sender_user_info->name;
                            } else {
                                $sender_name = $sender_user_info->username;
                            }
                            $get_sender_mobile_no_from_partner_table = $this->emailing_model->get_sender_mobile_no_from_partner_table($user_id, $sender_user_info->username);

                            if (!empty($get_sender_mobile_no_from_partner_table))
                                $sender_mobile = $get_sender_mobile_no_from_partner_table->partner_mobile;


                        }

                        $parent_email_id = NULL;
                        $email_id = $user_data->email_id;
                        $emmail_data = array(
                            'receiver_id' => $receiver_id,
                            'receiver_name' => $user_data->receiver_name,
                            'sender_name' => $sender_name,
                            'receiver_mobile' => $user_data->receiver_mobile,
                            'sender_mobile' => $sender_mobile,
                            'parent_email_id' => $parent_email_id,
                            'subject' => $user_data->subject,
                            'content' => $user_data->content,
                            'drft' => $user_data->drft,
                            'created_by' => $user_id,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        // Save this contact as my partner
                        if ($user_data->drft != 1) {
                            $this->add_number_in_partner($user_id, $user_data->receiver_mobile);
                            $existing_partner_info = $this->emailing_model->get_by_partner_mobile($user_data->receiver_mobile, $user_id);
                            if (empty($existing_partner_info) && $user_data->receiver_name != "" && $user_data->receiver_mobile != "") {
                                $partner_data = array(
                                    'user_id' => $user_id,
                                    'partner_id' => $receiver_id,
                                    'partner_name' => $user_data->receiver_name,
                                    'company' => NULL,
                                    'partner_mobile' => $user_data->receiver_mobile,
                                    'created_at' => date('Y-m-d H:i:s')
                                );
                                $this->emailing_model->_table_name = 'email_partner';
                                $this->emailing_model->_primary_key = 'id';
                                $partner_id = $this->emailing_model->save($partner_data);
                            }
                        }
                        if ($email_id != "") {
                            $this->emailing_model->_table_name = 'email';
                            $this->emailing_model->_primary_key = 'email_id';
                            $email_id = $this->emailing_model->save($emmail_data, $email_id);
                            if (!empty($receiver_user_info)) {
                                // Send Mobiel Notifications
                                if ($receiver_user_info->firebase_token != NULL) {

                                    $email_details = $this->emailing_model->get_email_by_id($email_id);
                                    $this->push_notifications->send_notification_mobile($receiver_user_info->firebase_token, $email_details);
                                }
                            }

                        } else {
                            $this->emailing_model->_table_name = 'email';
                            $this->emailing_model->_primary_key = 'email_id';
                            $email_id = $this->emailing_model->save($emmail_data);
                            if (!empty($receiver_user_info)) {
                                // Send Mobiel Notifications
                                if ($receiver_user_info->firebase_token != NULL) {

                                    $email_details = $this->emailing_model->get_email_by_id($email_id);
                                    $this->push_notifications->send_notification_mobile($receiver_user_info->firebase_token, $email_details);
                                }
                            }
                        }

                        $response['success'] = 1;
                        $response['email_id'] = $email_id;
                        $response['message'] = "success";
                    }

                } else {
                    $response["success"] = 0;
                    $response["email_id"] = 0;
                    $response["message"] = "Requerd field is empty";
                }

            } else {
                $response["success"] = 0;
                $response["post_id"] = 0;
                $response["message"] = "API key is wrong";
            }
            echo json_encode($response);
        }///
    }

    function add_number_in_partner($user_id, $receiver_mobile)
    {
        $my_partner_info = $this->emailing_model->get_by_partner_mobile($receiver_mobile, $user_id);

        if ($my_partner_info) {
            // Update Sender Transection
            $this->emailing_model->add_uses_partner($user_id, $my_partner_info->partner_id);
            // Update Receiver Transection
            $this->emailing_model->add_uses_partner($my_partner_info->partner_id, $user_id);
        }

    }

    public function email_details()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {


                if (($user_data->user_id != "") && ($user_data->email_id != "")) {

                    $user_id = base64_decode($user_data->user_id);
                    // Retrieve sign in user
                    $email_details = $this->emailing_model->get_email_by_id($user_data->email_id);

                    // get settlement id
                    $settlement_result = $this->emailing_model->get_settlement_id($user_data->email_id);
                    $share_this_settlement_id = 1; // this settlement id is sharing with partners
                    $all_settlement_result = $this->wordapp_model->get_settlement_data_by_id($settlement_result['settlement_id'], '', $share_this_settlement_id);
//print_r($all_settlement_result['settlement_title']);die();

                    $japan_date = "";
                    $response["success"] = 1;

                    $response["message"] = "success";

                    if (!empty($all_settlement_result)) {
                        $response['settlement_title'] = $all_settlement_result['settlement_title'];
                    } else {
                        $response['settlement_title'] = '';
                    }
                    $response['email_details'] = $email_details;
                    if ($settlement_result['settlement_id'] != 0) {
                        $share_this_settlement_id = 1; // this settlement id is sharing with partners
                        $response['settlement_id'] = '<a onclick="view_settlement_form(this.id);" id="settlement_id" style="color: black;" href="index.php/wordapp/view_settlement_form_2/' . $settlement_result['settlement_id'] . '/' . $share_this_settlement_id . '">' . '<strong>決　裁　書 : ' . $settlement_result['settlement_id'] . '</strong></a>';
                        $response['only_settlement_id'] = $settlement_result['settlement_id'];
                    } else {
                        $response['settlement_id'] = '';
                        $response['only_settlement_id'] = '';
                    }
                    $response['japan_date'] = $this->emailing_model->get_japanese_format_date($email_details->created_at);
                    $response['seen'] = 0;

                    if ($response['email_details']) {
                        if ($response['email_details']->receiver_id == $user_id) {
                            $response['seen'] = 1;
                            $emmail_data = array('seen' => 1);
                            $this->emailing_model->_table_name = 'email';
                            $this->emailing_model->_primary_key = 'email_id';
                            $this->emailing_model->save($emmail_data, $user_data->email_id);
                        }
                    }
                } else {
                    $response["success"] = 0;
                    $response["message"] = "Requerd field is empty";
                    $response['email_details'] = NULL;
                    $response['japan_date'] = "";
                    $response['seen'] = 0;
                    $response['settlement_id'] = 0;
                    $response['only_settlement_id'] = '';
                    $response['settlement_title'] = '';
                }

            } else {
                $response["success"] = 0;
                $response["message"] = "API key is wrong";
                $response['email_details'] = NULL;
                $response['japan_date'] = "";
                $response['seen'] = 0;
                $response['settlement_id'] = 0;
                $response['settlement_title'] = '';
            }
            echo json_encode($response);
        }
    }

    public function delete_email()
    {
        $get_user_json = file_get_contents('php://input');

        $user_data = json_decode($get_user_json);

        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {
                $user_id = base64_decode($user_data->user_id);
                $number_of_ids = count($user_data->email_ids);

                for ($i = 0; $i < $number_of_ids; $i++) {

                    // echo $number_of_ids;
                    $email_delete_array = array(
                        "email_id" => $user_data->email_ids[$i],
                        "user_id" => $user_id
                    );
                    $this->emailing_model->_table_name = 'email_deleted';
                    $this->emailing_model->_primary_key = 'delete_id';
                    $this->emailing_model->save($email_delete_array);
                }

                $response["success"] = 1;

                $response["message"] = "success";
            } else {
                $response["success"] = 0;

                $response["message"] = "API key is wrong";
            }
            echo json_encode($response);
        }
    }

    public function delete()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {
                if ((base64_decode($user_data->user_id) != "") && ($user_data->email_id != "")) {
                    if ($this->emailing_model->delete_email_by_id($user_data->email_id)) {
                        $response["success"] = 1;
                        $response["message"] = "success";
                        echo json_encode($response);
                    } else {
                        $response["success"] = 0;
                        $response["message"] = "email already deleted";
                        echo json_encode($response);
                    }

                } else {
                    $response["success"] = 0;
                    $response["message"] = "user_id is empty";
                    echo json_encode($response);
                }

            } else {
                $response["success"] = 0;
                $response["message"] = "API key is wrong";
                echo json_encode($response);
            }
        }
    }

    public function save_partner()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
//        print_r($user_data);die();

        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {

                if (($user_data->user_id != "") && ($user_data->partner_name != "") && ($user_data->partner_mobile != "")) {
                    $user_id = base64_decode($user_data->user_id);
                    $partner_type = $user_data->partner_type; //partner create from: 0 for normal email form; 1 for requisition form

                    // Retrieve sign in user
//                    $partner_user_info = $this->account_model->get_by_username($user_data->partner_mobile);
//                    $partner_user_info = $this->account_model->get_by_username($user_data->partner_name);
                    $partner_user_info_mobile_nowise = $this->account_model->get_by_mobile_no($user_data->partner_mobile);
//                    echo $user_data->partner_name;
//                    print_r($partner_user_info);die();
                    $user_info = $this->account_model->get_by_id($user_id);
                    $check_email_partners_president = $this->emailing_model->check_if_user_add_president_as_partner($user_id, $partner_type);

                    // if (!empty($partner_user_info)) {

//                    echo "<pre>";
//                    print_r($partner_user_info);
//                    exit();
                    if (!empty($partner_user_info_mobile_nowise)) {
//                        $partner_id = (!empty($partner_user_info)) ? $partner_user_info->id : NULL;
                        if (!empty($partner_user_info_mobile_nowise)) {
                            $partner_id = $partner_user_info_mobile_nowise->id;
                        } else {
                            $partner_id = NULL;
                        }
                        if ($user_info->username != $user_data->partner_mobile) {
                            $existing_partner_info = $this->emailing_model->get_by_partner_mobile($user_data->partner_mobile, $user_id, $partner_type);
                            if (empty($existing_partner_info)) {
                                $partner_data = array(
                                    'user_id' => $user_id,
                                    'partner_id' => $partner_id,
                                    'partner_name' => $user_data->partner_name,
                                    'company' => $user_data->company != "" ? $user_data->company : NULL,
                                    'partner_mobile' => $user_data->partner_mobile,
                                    'partner_type' => $partner_type,
                                    'created_at' => date('Y-m-d H:i:s')
                                );
                                $this->emailing_model->_table_name = 'email_partner';
                                $this->emailing_model->_primary_key = 'id';
                                $partner_id = $this->emailing_model->save($partner_data);
                                if ($partner_id) {
                                    if ($check_email_partners_president == 0) {
                                        $response['check_email_partners_president'] = 0;
                                    } else {
                                        $response['check_email_partners_president'] = 1;
                                    }
                                    $response['success'] = 1;
                                    $response['partner_id'] = $partner_id;
                                    $response['message'] = "success";

                                } else {
                                    $response['success'] = 0;
                                    $response['partner_id'] = 0;
                                    $response['message'] = "unknown error";
                                    $response['check_email_partners_president'] = -1;
                                }
                            } else {
                                $response['success'] = 0;
                                $response['partner_id'] = 0;
                                $response['message'] = "ユーザー名既に存在します。";
                                $response['check_email_partners_president'] = -1;
                            }

                        } else {
                            $response['success'] = 0;
                            $response['partner_id'] = 0;
                            $response['message'] = "this is your phone number";
                            $response['check_email_partners_president'] = -1;
                        }
                    } else {
                        $response['success'] = 0;
                        $response['partner_id'] = 0;
                        $response['message'] = "invalid partner";
                        $response['check_email_partners_president'] = -1;
                    }

                    // }else{
                    // 	$response["success"] = 0;
                    // 	$response["partner_id"] = 0;
                    // 	$response["message"] = "mobile No. is invalide";
                    // }

                } else {
                    $response["success"] = 0;
                    $response["partner_id"] = 0;
                    $response["message"] = "Requerd field is empty";
                }

            } else {
                $response["success"] = 0;
                $response["partner_id"] = 0;
                $response["message"] = "API key is wrong";
            }

            echo json_encode($response);
        }
    }

    public function save_edit_partner()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);

        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {

                if (($user_data->user_id != "") && ($user_data->partner_name != "") && ($user_data->partner_mobile != "")) {
                    $user_id = base64_decode($user_data->user_id);
                    $partner_type = $user_data->partner_type; //partner create from: 0 for normal email form; 1 for requisition form

                    // Retrieve sign in user

//                    $partner_user_info = $this->account_model->get_by_username($user_data->partner_name);
                    $partner_user_info_mobile_nowise = $this->account_model->get_by_mobile_no($user_data->partner_mobile);


                    if (!empty($partner_user_info_mobile_nowise)) {
                        $user_info = $this->account_model->get_by_id($user_id);
                        $partner_id = $user_data->partner_id;
                        if ($user_info->username != $user_data->partner_mobile) {
                            $existing_partner_info = $this->emailing_model->get_exist_by_partner_mobile($user_data->partner_mobile, $user_id, $partner_id, $partner_type);
                            if (empty($existing_partner_info)) {
                                $partner_data = array(
                                    'partner_name' => $user_data->partner_name,
                                    'company' => $user_data->company != "" ? $user_data->company : NULL,
                                    'partner_mobile' => $user_data->partner_mobile
                                );
                                $this->emailing_model->_table_name = 'email_partner';
                                $this->emailing_model->_primary_key = 'id';
                                $this->emailing_model->save($partner_data, $partner_id);

                                $response['success'] = 1;
                                $response['partner_id'] = $partner_id;
                                $response['message'] = "success";


                            } else {
                                $response['success'] = 0;
                                $response['partner_id'] = 0;
                                $response['message'] = "ユーザー名既に存在します。";
                            }

                        } else {
                            $response['success'] = 0;
                            $response['partner_id'] = 0;
                            $response['message'] = "this is your phone number";
                        }
                    } else {
                        $response['success'] = 0;
                        $response['partner_id'] = 0;
                        $response['message'] = "invalid partner";
                    }
                } else {
                    $response["success"] = 0;
                    $response["partner_id"] = 0;
                    $response["message"] = "Requerd field is empty";
                }

            } else {
                $response["success"] = 0;
                $response["partner_id"] = 0;
                $response["message"] = "API key is wrong";
            }
            echo json_encode($response);
        }
    }

    public function partner()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {
                // Retrieve user last updated 30 files
                $user_id = base64_decode($user_data->user_id);
                $response["success"] = 1;
                $response['email_pertners'] = $this->emailing_model->get_pertner_list_by_id($user_id, 0);

                $response["message"] = "success";
                echo json_encode($response);
            } else {
                $response["success"] = 0;
                $response['email_pertners'] = array();
                $response["message"] = "API key is wrong";
                echo json_encode($response);
            }
        }
    }

    public function show_last_email_details()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {
                $user_id = base64_decode($user_data->user_id);
                $user_last_email = $this->emailing_model->get_user_last_mail($user_id);
//                echo "<pre>";
//                print_r($user_last_email);
//                exit();
                // get settlement id
                $settlement_result = $this->emailing_model->get_settlement_id($user_data->email_id);

                $share_this_settlement_id = 1; // this settlement id is sharing with partners
                if (!empty($settlement_result))
                    $all_settlement_result = $this->wordapp_model->get_settlement_data_by_id($settlement_result['settlement_id'], '', $share_this_settlement_id);
//print_r($all_settlement_result['settlement_title']);die();

                if (!empty($all_settlement_result)) {
                    $response['settlement_title'] = $all_settlement_result['settlement_title'];
                } else {
                    $response['settlement_title'] = '';
                }

                if ($settlement_result['settlement_id'] != 0) {
                    $share_this_settlement_id = 1; // this settlement id is sharing with partners
                    $response['settlement_id'] = '<a onclick="view_settlement_form(this.id);" id="settlement_id" style="color: black;" href="index.php/wordapp/view_settlement_form_2/' . $settlement_result['settlement_id'] . '/' . $share_this_settlement_id . '">' . '<strong>決　裁　書 : ' . $settlement_result['settlement_id'] . '</strong></a>';
                    $response['only_settlement_id'] = $settlement_result['settlement_id'];
                } else {
                    $response['settlement_id'] = '';
                    $response['only_settlement_id'] = '';
                }

                $japan_date = "";
                if (!empty($user_last_email)) {
                    $japan_date = $this->emailing_model->get_japanese_format_date($user_last_email->created_at);
                }

                $response["success"] = 1;
                $response['japan_date'] = $japan_date;
                $response['last_email'] = $user_last_email;
                $response["message"] = "success";
            } else {
                $response["success"] = 0;
                $response['japan_date'] = "";
                $response['last_email'] = array();
                $response['settlement_title'] = '';
                $response['only_settlement_id'] = '';
                $response['settlement_id'] = '';
                $response["message"] = "API key is wrong";
            }
            echo json_encode($response);
        }
    }

    public function get_user_last_settlement_list_sent_received()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
//        echo $user_data->email_id;die();
        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {
                $user_id = base64_decode($user_data->user_id);
                $sign_in_username_email = $this->account_model->get_username_by_id($user_id);
//                $get_sign_in_username_email = $this->account_model->get_username_by_id($user_id);
//                $sign_in_username_email = $get_sign_in_username_email->username;
//                $login_menu_type = $get_sign_in_username_email->login_menu_type;

                $user_last_email = $this->emailing_model->get_user_last_mail($user_id, $sign_in_username_email);
//                echo "<pre>";
//                print_r($user_last_email);
//                exit();
                // get settlement id
                $settlement_result = $this->emailing_model->get_settlement_id($user_last_email->email_id);

                $share_this_settlement_id = 1; // this settlement id is sharing with partners
                if (!empty($settlement_result))
                    $all_settlement_result = $this->wordapp_model->get_settlement_data_by_id($settlement_result['settlement_id'], '', $share_this_settlement_id);
//print_r($all_settlement_result['settlement_title']);die();

                if (!empty($all_settlement_result)) {
                    $response['settlement_title'] = $all_settlement_result['settlement_title'];
                } else {
                    $response['settlement_title'] = '';
                }

                if ($settlement_result['settlement_id'] != 0) {
                    $share_this_settlement_id = 1; // this settlement id is sharing with partners
                    $response['settlement_id'] = '<a onclick="view_settlement_form(this.id);" id="settlement_id" style="color: black;" href="index.php/wordapp/view_settlement_form_2/' . $settlement_result['settlement_id'] . '/' . $share_this_settlement_id . '">' . '<strong>決　裁　書 : ' . $settlement_result['settlement_id'] . '</strong></a>';
                    $response['only_settlement_id'] = $settlement_result['settlement_id'];
                } else {
                    $response['settlement_id'] = '';
                    $response['only_settlement_id'] = '';
                }

                $japan_date = "";
                if (!empty($user_last_email)) {
                    $japan_date = $this->emailing_model->get_japanese_format_date($user_last_email->created_at);
                }

                $response["success"] = 1;
                $response['japan_date'] = $japan_date;
                $response['last_email'] = $user_last_email;
                $response["message"] = "success";
            } else {
                $response["success"] = 0;
                $response['japan_date'] = "";
                $response['last_email'] = array();
                $response['settlement_title'] = '';
                $response['only_settlement_id'] = '';
                $response['settlement_id'] = '';
                $response["message"] = "API key is wrong";
            }
            echo json_encode($response);
        }
    }

    public function show_last_draft_email_details()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {
                $user_id = base64_decode($user_data->user_id);
                $user_last_email = $this->emailing_model->get_user_last_draft_mail($user_id);
                $japan_date = "";
                if (!empty($user_last_email)) {
                    $japan_date = $this->emailing_model->get_japanese_format_date($user_last_email->created_at);
                }

                $response["success"] = 1;
                $response['japan_date'] = $japan_date;
                $response['last_email'] = $user_last_email;
                $response["message"] = "success";
            } else {
                $response["success"] = 0;
                $response['japan_date'] = "";
                $response['last_email'] = array();
                $response["message"] = "API key is wrong";
            }
            echo json_encode($response);
        }
    }

    function save_introducer_referee()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);

        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {

                if (($user_data->user_id != "") && ($user_data->referee_number != "")) {
                    $user_id = base64_decode($user_data->user_id);
                    $exist_referee = $this->emailing_model->get_introducer_by_id_mobile($user_id, $user_data->referee_number);
                    if (empty($exist_referee)) {
                        $referee_data = array(
                            "introducer_id" => $user_id,
                            "referee_name" => $user_data->referee_name == "" ? NULL : $user_data->referee_name,
                            "referee_number" => $user_data->referee_number,
                            "introducer_name" => $user_data->introducer_name,
                            "introducer_number" => $user_data->introducer_number,
                            "created_at" => date('Y-m-d H:i:s')
                        );
                        $this->emailing_model->_table_name = 'introducer_referee';
                        $this->emailing_model->_primary_key = 'refree_id';
                        $this->emailing_model->save($referee_data);
                        $response["success"] = 1;
                        $response["message"] = "success";
                    } else {
                        $response["success"] = 2;
                        $response["message"] = "exist";
                    }

                } else {
                    $response["success"] = 0;
                    $response["message"] = "Requerd field is empty";
                }

            } else {
                $response["success"] = 0;
                $response["message"] = "API key is wrong";
            }
            echo json_encode($response);
        }
    }

    function get_introducer_referee()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
        if (!empty($user_data)) {
            if ($this->config->item("api_key") === base64_decode($user_data->api_key)) {

                if (($user_data->user_id != "")) {
                    $user_id = base64_decode($user_data->user_id);
                    $introducer_referee = $this->emailing_model->get_introducer_by_id_mobile($user_id);

                    $response["success"] = 1;
                    $response["introducer_referee"] = $introducer_referee;
                    $response["message"] = "success";


                } else {
                    $response["success"] = 0;
                    $response["introducer_referee"] = array();
                    $response["message"] = "Requerd field is empty";
                }

            } else {
                $response["success"] = 0;
                $response["introducer_referee"] = array();
                $response["message"] = "API key is wrong";
            }
            echo json_encode($response);
        }
    }

    function test_header()
    {
        // $get_user_json = file_get_contents('php://input');
        // $user_data = json_decode($get_user_json);

        $headers = array();
        foreach (getallheaders() as $name => $value) {
            $headers[$name] = $value;
        }

        print_r($headers);

        // $entityBody = file_get_contents('php://input', 'r');
        // parse_str($entityBody , $post_data);


        // $this->response($entityBody, 200);
    }

    function delete_partner()
    {
        $partner_id = $_POST['partner_id'];
        $val = $this->emailing_model->deletePartner($partner_id);
        echo $val;
    }

}// END Class

?>