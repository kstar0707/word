<?php

/*
 * Sign_in Controller
 */

class Emailing extends CI_Controller
{

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Tokyo');
        $this->load->helper(array('language', 'account/ssl', 'form', 'url', 'text'));
        $this->load->library(array('account/authentication', 'account/authorization', 'form_validation'));
        $this->load->model(array('account/account_model', 'emailing_model', 'wordapp_model'));
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

        $data['title'] = "Word App - Email";

        // $data['user_emails'] = $this->emailing_model->get_email_by_user_id($data['account']->id, 0, 30);
        // $data['email_pertners'] = $this->emailing_model->get_pertner_list_by_id($data['account']->id);

        $this->load->view('emailing', isset($data) ? $data : NULL);
    }

    public function get_japanise_day($day)
    {
        $jaDay = "";
        switch ($day) {
            case "Mon":
                $jaDay = "月";
                break;
            case "Tue":
                $jaDay = "火";
                break;
            case 'Wed':
                $jaDay = "水";
                break;
            case "Thu":
                $jaDay = "木";
                break;
            case "Fri":
                $jaDay = "金";
                break;
            case "Sat":
                $jaDay = "土";
                break;
            default:
                $jaDay = "日";
        }
        return $jaDay;
    }

    function get_user_email()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
        if (!empty($user_data)) {
            $user_id = base64_decode($user_data->user_id);
            $user_emails = $this->emailing_model->get_email_by_user_id($user_id, 0, 30);
//            print_r($user_emails);
//            exit();
            // echo json_encode($user_emails);
            // exit();
            $html_data = "";
            $latest_settlement_id = -9999999; //will hold max val

            foreach ($user_emails as $user_email) {
                if ($user_email->settlement_id != 0) {
                    if ($user_email->created_at > $latest_settlement_id) {
                        $latest_settlement_id = $user_email->settlement_id;
                    }
                }


                $email_sender = $user_email->sender_mobile;
                $sender_info = $this->emailing_model->get_by_partner_mobile($user_email->sender_mobile, $user_id);
//                $new_email_check_for_user = $this->emailing_model->check_new_mail_for_specific_user($this->session->userdata('account_id'));
//                if (!empty($new_email_check_for_user)) {
//                    $show_notification_for_new_email = 1;
//                }else{
//                    $show_notification_for_new_email = 0;
//                }
                if (!empty($sender_info)) {
                    $email_sender = $sender_info->partner_name;
                }

                if ($user_email->subject != '') {
//                    $email_subject = $user_email->subject;
                    $get_email_subject = mb_strlen($user_email->subject, 'UTF-8');
                    if ($get_email_subject >= 10) {
                        $email_subject = mb_substr($user_email->subject, 0, 10) . '...';
                    } else {
                        $email_subject = mb_substr($user_email->subject, 0, 10);
                    }
                } else {
                    $email_subject = '';
//                    $share_this_settlement_id = 1; // this settlement id is sharing with partners
//                    $all_settlement_result = $this->wordapp_model->get_settlement_data_by_id($user_email->settlement_id, '', $share_this_settlement_id);
//                    if (!empty($all_settlement_result)) {
//                        $get_email_subject = mb_strlen($all_settlement_result['settlement_title'], 'UTF-8');
//                        if ($get_email_subject >= 10) {
//                            $email_subject = mb_substr($all_settlement_result['settlement_title'], 0, 10) . '...';
//                        } else {
//                            $email_subject = mb_substr($all_settlement_result['settlement_title'], 0, 10);
//                        }
//                    } else {
//                        $email_subject = '';
//                    }

                }

                $sender_receiver = $user_email->created_by == $user_id ? '送 ' . $user_email->receiver_name : '受 ' . $user_email->sender_name;

                $seen_icon = $user_email->seen == 1 ? "fa fa-check-circle" : "fa fa-check-circle-o";
                $seen_color = $user_email->seen == 1 ? '#e38d13' : '';
                $seen_unseen_class = $user_email->seen == 1 ? "seen" : "unseen";

                $html_data .= '<tr href="" style="height:30px !important;" class="success">';
                $html_data .= '<a href="#email_details"' >
                    $month = date('m', strtotime($user_email->created_at));
                $email_date = date('d', strtotime($user_email->created_at));
                $email_day = date('D', strtotime($user_email->created_at));
                $email_time = date('h:i', strtotime($user_email->created_at));
                $email_event = date('A', strtotime($user_email->created_at));
                $am_pm = "";
                if ($email_event == "PM") {
                    $am_pm = "午後";
                } else {
                    $am_pm = "午前";
                }
                $html_data .= '<td width="6%">
						
						<input type="checkbox" id="" class="email_select" value="' . $user_email->email_id . '">
						         
					 </td>';
                $html_data .= '<td width="25%" href="' . $user_email->email_id . '" style="cursor:pointer;" id="email_list_data" class="show_email_details ' . $seen_unseen_class . '">' . $month . '月' . $email_date . '日(' . $this->get_japanise_day($email_day) . ')' . $email_time . $am_pm . '</td>';
                $html_data .= '<td width="26%" href="' . $user_email->email_id . '" style="cursor:pointer;" id="email_list_data" class="show_email_details ' . $seen_unseen_class . '">' . $sender_receiver . '</td>';
                $html_data .= '<td width="27%" href="' . $user_email->email_id . '" style="cursor:pointer;" id="email_list_data" class="show_email_details ' . $seen_unseen_class . '">' . $email_subject . '</td>';
                $html_data .= '<td width="7%"><i class="' . $seen_icon . '" style="color: ' . $seen_color . '"></i></td>';
                if ($user_email->star == 1) {
                    $html_data .= '<td width="6%"><i class="fa fa-star" style="color:#e38d13"></i></td>';
                } else {
                    $html_data .= '<td width="6%"><i class="fa fa-star-o"></i></td>';
                }

                $html_data .= '</a></tr>';
            }

            echo $html_data . '######' . $latest_settlement_id;
            // print_r($user_emails);
        }
    }

    function get_settlement_list_sent_received()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
        if (!empty($user_data)) {
            $user_id = base64_decode($user_data->user_id);
//            $get_sign_in_username_email = $this->account_model->get_username_by_id($user_id);
//            $sign_in_username_email = $get_sign_in_username_email->username;
//            $login_menu_type = $get_sign_in_username_email->login_menu_type;

            $sign_in_username_email = $this->account_model->get_username_by_id($user_id);
            $user_emails = $this->emailing_model->get_email_by_user_id($user_id, 0, 30, $sign_in_username_email);
//            print_r($user_emails);
//            exit();
            // echo json_encode($user_emails);
            // exit();
            $html_data = "";
            $latest_settlement_id = -9999999; //will hold max val

            foreach ($user_emails as $user_email) {
                if ($user_email->settlement_id != 0) {
                    if ($user_email->created_at > $latest_settlement_id) {
                        $latest_settlement_id = $user_email->settlement_id;
                    }
                }


                $email_sender = $user_email->sender_mobile;
                $sender_info = $this->emailing_model->get_by_partner_mobile($user_email->sender_mobile, $user_id);
//                $new_email_check_for_user = $this->emailing_model->check_new_mail_for_specific_user($this->session->userdata('account_id'));
//                if (!empty($new_email_check_for_user)) {
//                    $show_notification_for_new_email = 1;
//                }else{
//                    $show_notification_for_new_email = 0;
//                }
                if (!empty($sender_info)) {
                    $email_sender = $sender_info->partner_name;
                }

                if ($user_email->subject != '') {
//                    $email_subject = $user_email->subject;
                    $get_email_subject = mb_strlen($user_email->subject, 'UTF-8');
                    if ($get_email_subject >= 10) {
                        $email_subject = mb_substr($user_email->subject, 0, 10) . '...';
                    } else {
                        $email_subject = mb_substr($user_email->subject, 0, 10);
                    }
                } else {
                    $share_this_settlement_id = 1; // this settlement id is sharing with partners
                    $all_settlement_result = $this->wordapp_model->get_settlement_data_by_id($user_email->settlement_id, '', $share_this_settlement_id);
                    if (!empty($all_settlement_result)) {
                        $get_email_subject = mb_strlen($all_settlement_result['settlement_title'], 'UTF-8');
                        if ($get_email_subject >= 10) {
                            $email_subject = mb_substr($all_settlement_result['settlement_title'], 0, 10) . '...';
                        } else {
                            $email_subject = mb_substr($all_settlement_result['settlement_title'], 0, 10);
                        }
                    } else {
                        $email_subject = '';
                    }

                }

                $sender_receiver = $user_email->created_by == $user_id ? '送 ' . $user_email->receiver_name : '受 ' . $user_email->sender_name;

                $seen_icon = $user_email->seen == 1 ? "fa fa-check-circle" : "fa fa-check-circle-o";
                $seen_color = $user_email->seen == 1 ? '#e38d13' : '';
                $seen_unseen_class = $user_email->seen == 1 ? "seen" : "unseen";
                if($user_email->receiver_id==$user_id && $user_email->seen == 0){
                    $unread_class='background-color:white;';
                }else{
                    $unread_class='';
                }

                $html_data .= '<tr id="email_details_row" href="" style="height:30px !important; ' . $unread_class . '" class="">';
                $html_data .= '<a href="#email_details"' >
                    $month = date('m', strtotime($user_email->created_at));
                $email_date = date('d', strtotime($user_email->created_at));
                $email_day = date('D', strtotime($user_email->created_at));
                $email_time = date('h:i', strtotime($user_email->created_at));
                $email_event = date('A', strtotime($user_email->created_at));
                $am_pm = "";
                if ($email_event == "PM") {
                    $am_pm = "午後";
                } else {
                    $am_pm = "午前";
                }
//                $html_data .= '<td width="6%">
//
//						<input type="checkbox" id="" class="email_select" value="' . $user_email->email_id . '">
//
//					 </td>';
                $html_data .= '<td width="25%" href="' . $user_email->email_id . '" style="cursor:pointer;" id="email_list_data" class="show_email_details ' . $seen_unseen_class . '">' . $month . '月' . $email_date . '日(' . $this->get_japanise_day($email_day) . ')' . $email_time . $am_pm . '</td>';
                $html_data .= '<td width="26%" href="' . $user_email->email_id . '" style="cursor:pointer;" id="email_list_data" class="show_email_details ' . $seen_unseen_class . '">' . $sender_receiver . '</td>';
                $html_data .= '<td width="27%" href="' . $user_email->email_id . '" style="cursor:pointer;" id="email_list_data" class="show_email_details ' . $seen_unseen_class . '">' . $email_subject . '</td>';
                $html_data .= '<td width="7%"><i class="' . $seen_icon . '" style="color: ' . $seen_color . '"></i></td>';
                if ($user_email->star == 1) {
                    $html_data .= '<td width="6%"><i class="fa fa-star" style="color:#e38d13"></i></td>';
                } else {
                    $html_data .= '<td width="6%"><i class="fa fa-star-o"></i></td>';
                }

                $html_data .= '</a></tr>';
            }

            echo $html_data . '######' . $latest_settlement_id;
            // print_r($user_emails);
        }
    }

    function get_partner_wise_email()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
        if (!empty($user_data)) {
            $user_id = base64_decode($user_data->user_id);
            $partner_list = $this->emailing_model->most_uses_partner_list($user_id, 0, 30);
            // print_r($partner_list);
            // exit();
            $email_data = array();
            $email_printed_data = array();
            foreach ($partner_list as $key => $partner) {
                $email_data['user_id'] = $partner->user_id;
                $email_data['partner_id'] = $partner->partner_id;
                $email_data['partner_name'] = $partner->partner_name;
                $email_data['partner_mobile'] = $partner->partner_mobile;
                $email_data['uses'] = $partner->uses;
                $email_data['sending_emails'] = array();
                $email_data['sending_emails'] = $this->emailing_model->get_partner_send_items($partner->user_id, $partner->partner_id);


                $email_data['user_receiving_mail'] = $this->emailing_model->get_partner_received_items($partner->user_id, $partner->partner_id);
                $email_data['user_emails'] = array_merge($email_data['user_receiving_mail'], $email_data['sending_emails']);
                $email_printed_data[] = $email_data;
            }
            // print_r($email_printed_data[0]['user_emails']);
            // exit();

            // Most uses emails
            for ($i = 0; $i < count($email_printed_data); $i++) {
                if (!empty($email_printed_data[$i]['user_emails'])) {
                    $html_data = "";
                    foreach ($email_printed_data[$i]['user_emails'] as $key => $user_email) {
                        $email_sender = $user_email->sender_mobile;
                        $sender_info = $this->emailing_model->get_by_partner_mobile($user_email->sender_mobile, $user_id);
                        if (!empty($sender_info)) {
                            $email_sender = $sender_info->partner_name;
                        }

                        if ($user_email->subject != '') {
                            $email_subject = $user_email->subject;
                        } else {
                            $share_this_settlement_id = 1; // this settlement id is sharing with partners
                            $all_settlement_result = $this->wordapp_model->get_settlement_data_by_id($user_email->settlement_id, '', $share_this_settlement_id);
                            if (!empty($all_settlement_result))
                                $email_subject = $all_settlement_result['settlement_title'];
                            else
                                $email_subject = '';
                        }

                        $sender_receiver = $user_email->created_by == $user_id ? '送 ' . $user_email->receiver_name : '受 ' . $user_email->sender_name;

                        $seen_icon = $user_email->seen == 1 ? "fa fa-check-circle" : "fa fa-check-circle-o";
                        $seen_color = $user_email->seen == 1 ? '#e38d13' : '';
                        $seen_unseen_class = $user_email->seen == 1 ? "seen" : "unseen";
                        $html_data .= '<tr style="height:30px !important;" class="warning">';

                        $month = date('m', strtotime($user_email->created_at));
                        $email_date = date('d', strtotime($user_email->created_at));
                        $email_day = date('D', strtotime($user_email->created_at));
                        $email_time = date('h:i', strtotime($user_email->created_at));
                        $email_event = date('A', strtotime($user_email->created_at));
                        $am_pm = "";
                        if ($email_event == "PM") {
                            $am_pm = "午後";
                        } else {
                            $am_pm = "午前";
                        }
                        $html_data .= '<td width="6%">
								
								<input type="checkbox" id="" class="email_select" value="' . $user_email->email_id . '">
								         
							 </td>';
                        $html_data .= '<td width="25%" href="' . $user_email->email_id . '" style="cursor:pointer;" id="email_list_data" class="show_email_details ' . $seen_unseen_class . '">' . $month . '月' . $email_date . '日(' . $this->get_japanise_day($email_day) . ')' . $email_time . $am_pm . '</td>';
                        $html_data .= '<td width="26%" href="' . $user_email->email_id . '" style="cursor:pointer;" id="email_list_data" class="show_email_details ' . $seen_unseen_class . '">' . $sender_receiver . '</td>';
                        $html_data .= '<td width="27%" href="' . $user_email->email_id . '" style="cursor:pointer;" id="email_list_data" class="show_email_details ' . $seen_unseen_class . '">' . substr($email_subject, 0, 20) . '</td>';
                        $html_data .= '<td width="7%"><i class="' . $seen_icon . '" style="color: ' . $seen_color . '"></i></td>';
                        if ($user_email->star == 1) {
                            $html_data .= '<td width="6%"><i class="fa fa-star" style="color:#e38d13"></i></td>';
                        } else {
                            $html_data .= '<td width="6%"><i class="fa fa-star-o"></i></td>';
                        }

                        $html_data .= '</tr>';

                    }
                    echo $html_data;
                }
            }
            // echo json_encode($email_printed_data[0]['user_emails']);
        }
    }


    public function get_most_partner_last_email()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);

        $user_id = base64_decode($user_data->user_id);

        $partner_list = $this->emailing_model->most_uses_partner_list($user_id, 0, 1);

//        $partner_receiving_mail = $this->emailing_model->get_partner_single_email($partner_list[0]->user_id, $partner_list[0]->partner_id);
        $user_receiving_mail = $this->emailing_model->get_partner_single_email($partner_list[0]->user_id, $partner_list[0]->partner_id);



        $user_sending_mail = $this->emailing_model->get_partner_single_sending_items($partner_list[0]->user_id, $partner_list[0]->partner_id);
//        $partner_receiving_mail = array_merge($user_receiving_mail, $user_sending_mail);
        $partner_receiving_mail = (object) array_merge((array) $user_receiving_mail, (array) $user_sending_mail);
//        $partner_receiving_mail = new stdClass();
//        foreach ( $user_receiving_mail as $key => $value ) {
//            $partner_receiving_mail->$key = $value;
//        }
//
//        foreach ( $user_sending_mail as $key => $value ) {
//            $partner_receiving_mail->$key = $value;
//        }

//if($user_id==129)
//        echo "<pre>";print_r($partner_receiving_mail);
//die();
        $email_sender = $partner_receiving_mail->sender_mobile;
        $sender_info = $this->emailing_model->get_by_partner_mobile($partner_receiving_mail->sender_mobile, $user_id);

        if (!empty($sender_info)) {
            $email_sender = $sender_info->partner_name;
        }
        $response['email_id'] = $partner_receiving_mail->email_id;
        $response['receiver_id'] = $partner_receiving_mail->receiver_id;
        $response['receiver_name'] = $partner_receiving_mail->receiver_name;
        $response['sender_name'] = $email_sender;
        $response['receiver_mobile'] = $partner_receiving_mail->receiver_mobile;
        $response['sender_mobile'] = $partner_receiving_mail->sender_mobile;
        $response['parent_email_id'] = $partner_receiving_mail->parent_email_id;
        $response['subject'] = $partner_receiving_mail->subject;
        $response['content'] = $partner_receiving_mail->content;
        $response['created_by'] = $partner_receiving_mail->created_by;
        $response['created_at'] = $this->emailing_model->get_japanese_format_date($partner_receiving_mail->created_at);
        $response['username'] = $partner_receiving_mail->username;
        $response['success'] = 1;

        echo json_encode((object)$response);
    }

    function array_test_function()
    {
        $tickets = array(
            array(
                'id' => 13,
                'owner' => 'jachim',
                'time' => '2009-09-25 10:39:42.011612',
                'project' => 'jachim.be',
                'title' => 'Some random ticket'
            ),
            array(
                'id' => 31,
                'owner' => 'jachim',
                'time' => '2009-09-24 14:38:47.945020',
                'project' => 'joggink.be',
                'title' => 'Some other random ticket'
            ),
            array(
                'id' => 22,
                'owner' => 'root',
                'time' => '2009-09-24 10:58:02.904198',
                'project' => 'joggink.be',
                'title' => 'A specific ticket'
            )
        );
        $partners_emails = $this->emailing_model->get_email_by_user_id_transection(24, 0, 30);
    }

    function msort($array, $key, $sort_flags = SORT_REGULAR)
    {
        if (is_array($array) && count($array) > 0) {
            if (!empty($key)) {
                $mapping = array();
                foreach ($array as $k => $v) {
                    $sort_key = '';
                    if (!is_array($key)) {
                        $sort_key = $v->$key;
                    } else {
                        // @TODO This should be fixed, now it will be sorted as string
                        foreach ($key as $key_key) {
                            $sort_key .= $v->$key_key;
                        }
                        $sort_flags = SORT_STRING;
                    }
                    $mapping[$k] = $sort_key;
                }

                rsort($mapping, $sort_flags);

                $sorted = array();
                foreach ($mapping as $k => $v) {

                    $sorted[] = $array[$k];
                }
                return $sorted;
            }
        }
        return $array;
    }

    function msortss($array, $key, $sort_flags = SORT_REGULAR)
    {
        if (is_array($array) && count($array) > 0) {
            if (!empty($key)) {
                $mapping = array();
                foreach ($array as $k => $v) {
                    $sort_key = '';
                    if (!is_array($key)) {
                        $sort_key = $v->created_at;
                    }
                    $mapping[$k] = $sort_key;
                }
                // return $mapping;
                // exit();
                rsort($mapping, "created_at");
                // return count($mapping);
                $sorted = array();
                $ddd = array();
                for ($i = 0; $i < count($mapping); $i++) {
                    $sorted[] = $mapping[$i];
                }
                // foreach ($mapping as $k => $v) {
                //     $sorted[] = $array[$k];
                //     // return $sorted;
                //     // exit();
                // }
                return $sorted;
            }
        }
        // return $array;
    }


    function get_user_draft_email()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
        if (!empty($user_data)) {
            $user_id = base64_decode($user_data->user_id);
            $user_emails = $this->emailing_model->get_draft_email_by_user_id($user_id, 0, 30);

            $html_data = "";

            foreach ($user_emails as $user_email) {
                $sender_receiver = $user_email->created_by == $user_id ? '下書 ' . $user_email->receiver_name : '受 ' . $user_email->username;

                $seen_icon = $user_email->seen == 1 ? "fa fa-check-circle" : "fa fa-check-circle-o";
                $seen_color = $user_email->seen == 1 ? '#e38d13' : '';
                $html_data .= '<tr id="email_list_data" class="info">';
                $month = date('m', strtotime($user_email->created_at));
                $email_date = date('d', strtotime($user_email->created_at));
                $email_day = date('D', strtotime($user_email->created_at));
                $email_time = date('h:i', strtotime($user_email->created_at));
                $email_event = date('A', strtotime($user_email->created_at));
                $am_pm = "";
                if ($email_event == "PM") {
                    $am_pm = "午後";
                } else {
                    $am_pm = "午前";
                }
                $html_data .= '<td>
						<input type="checkbox" id="" class="draft_email_select" value="' . $user_email->email_id . '">						            
					 </td>';
                $html_data .= '<td id="show_email_details" class="show_email_details" href="' . $user_email->email_id . '" style="cursor:pointer;">' . $month . '月' . $email_date . '日(' . $this->get_japanise_day($email_day) . ')' . $email_time . $am_pm . '</td>';
                $html_data .= '<td id="show_email_details" class="show_email_details" href="' . $user_email->email_id . '" style="cursor:pointer;">' . $sender_receiver . '</td>';
                $html_data .= '<td id="show_email_details" class="show_email_details" href="' . $user_email->email_id . '" style="cursor:pointer;">' . substr($user_email->subject, 0, 20) . '...</td>';
                $html_data .= '<td><i class="' . $seen_icon . '" style="color: ' . $seen_color . '"></i></td>';
                $html_data .= '<td><i class="fa fa-star-o"></i></td>';
                $html_data .= '</tr>';
            }
            echo $html_data;
            // print_r($user_emails);
        }
    }


    public function get_user_partners()
    {
        $get_user_json = file_get_contents('php://input');
        $user_data = json_decode($get_user_json);
        if (!empty($user_data)) {
            $user_id = base64_decode($user_data->user_id);
            $partner_type = $user_data->partner_type; //partner create from: 0 for normal email form; 1 for requisition form

            $sign_in_username_email = $this->account_model->get_username_by_id($user_id);
//            $sign_in_username_email = $get_sign_in_username_email->username;
//            $login_menu_type = $get_sign_in_username_email->login_menu_type;
//            echo $sign_in_username_email;die();
            $user = $this->account_model->get_by_username_email($sign_in_username_email);
            $result_user_send_email = $this->emailing_model->check_if_this_user_send_email($this->session->userdata('account_id'), $user->username, $user->email, $partner_type);
            $result_user_recieve_email = $this->emailing_model->check_if_this_user_receive_email($this->session->userdata('account_id'), $user->username, $user->email, $partner_type);
//                    print_r($result_user_send_email);
//                    print_r($result_user_recieve_email);
//                    exit();


            // $data['email_pertners'] = $this->emailing_model->get_pertner_list_by_id($user_id);
            $email_pertners = $this->emailing_model->get_pertner_list_by_id($user_id, $partner_type);
            // exit();
            $total_partner = count($email_pertners);
            $html_data = "";
            $html_data .= '<div class="col-lg-6 col-md6 col-sm6 col-xs-6">
					
                    <table width="50%" class="table table-bordered share_mail" id="table_of_partner" style="font-size: 18px; color: #000;">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="width:40%">電話番号</th>
                                <th style="width:30%">&nbsp;</th>
                                <th>氏名</th>
                            </tr>
                        </thead>
                        <tbody id="load_table_of_partner">';
            for ($i = 0; $i < 10; $i++) {
                $sl = $i + 1;


                $html_data .= '<tr id="partnerr_row">';

                $html_data .= '<td style="padding: 5px;">' . $sl . '</td>';
                if (!empty($email_pertners[$i])) {
                    if($email_pertners[$i]->partner_id=='174'){ //20
                        $display_president_seal_final='display: block;';
                    }else{
                        $display_president_seal_final='display: none;';
                    }

                    $html_data .= '<input type="hidden" class="partner_id" name="partner_id" value="' . $email_pertners[$i]->id . '">';
                    $html_data .= '<input type="hidden" class="share_partner_name" name="share_partner_name" value="' . $email_pertners[$i]->partner_name . '">';
                    $html_data .= '<td colspan="2"><input type="tel" style="ime-mode:inactive;width:50%; margin-right: 1%;" value="' . $email_pertners[$i]->partner_mobile . '" class="form-control input-sm  pull-left input_partner_mobile hide" name="input_partner_mobile" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }"><span style="width:60%" class="show_partner_mobile  pull-left show">' . $email_pertners[$i]->partner_mobile . '</span> <span id="president_seal_final" style="'.$display_president_seal_final.'; text-align:right; margin-right:3%;"><img src="'.base_url().'resource/img/president_seal_final.jpg"></span></td>';
                    $html_data .= '<td><input style="ime-mode:active" type="text" value="' . $email_pertners[$i]->partner_name . '" class="form-control input-sm input_partner_name hide" name="" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }"><span class="show_partner_name show">' . $email_pertners[$i]->partner_name . '</span> </td>';
                } elseif ($total_partner == $i) {
                    $html_data .= '<form id="email_partner_form" action="" method="POST">
                
			                <td colspan="2" style="padding: 5px;"></td>
            						<td style="padding: 5px;" width="35%"></td>     
			            </form>';

//                    $html_data .= '<form id="email_partner_form" action="" method="POST">
//
//			                <td style="padding: 5px;">
//			                	<div class="form-group" style="margin-bottom: 0">
//				                    <input onblur="setTimeout(function () { showUsersName(); }, 2000);" type="tel" class="form-control input-sm  pull-left" style="ime-mode:inactive; width: 50%; margin-right:1%;" name="partner_mobile" id="partner_mobile" placeholder="電話番号" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }">
//				                    <input type="text" style="width: 45%; ime-mode:active" class="form-control input-sm" name="pertner_company" id="company" placeholder="会社名" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }">
//				                </div>
//			                </td>
//			                <td style="padding: 5px; ime-mode:inactive" width="35%">
//			                	<div class="form-group" style="margin-bottom: 0">
//			                    	<input type="text" style="ime-mode:active" name="pertner_name" class="form-control input-sm has-error" id="partner_name" placeholder="氏名" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }">
//			                    </div>
//			                </td>
//			            </form>';
                } else {
                    $html_data .= '<td colspan="2" style="padding: 5px;"></td>
            						<td style="padding: 5px;" width="35%"></td>';
                }

                $html_data .= '</tr>';
            }
            $html_data .= '</tbody>
                                            
                    </table>
                </div>';

            $html_data .= '<div class="col-lg-6 col-md6 col-sm6 col-xs-6">
                    <table width="50%" class="table table-bordered share_mail" id="table_of_partner" style="font-size: 18px; color: #000;">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="width:40%">電話番号</th>
                                <th style="width:30%">&nbsp;</th>
                                <th>氏名</th>
                            </tr>
                        </thead>
                        <tbody>';
            for ($i = 10; $i < 20; $i++) {
                $sl = $i + 1;
                $html_data .= '<tr id="partnerr_row">';

                $html_data .= '<td style="padding: 5px;">' . $sl . '</td>';
                if (!empty($email_pertners[$i])) {
                    if($email_pertners[$i]->partner_id=='174'){ //20
                        $display_president_seal_final='display: block;';
                    }else{
                        $display_president_seal_final='display: none;';
                    }

                    $html_data .= '<input type="hidden" class="partner_id" name="partner_id" value="' . $email_pertners[$i]->id . '">';
                    $html_data .= '<input type="hidden" class="share_partner_name" name="share_partner_name" value="' . $email_pertners[$i]->partner_name . '">';
                    $html_data .= '<td colspan="2"><input type="tel" style="ime-mode:inactive; width:50%; margin-right: 1%;" value="' . $email_pertners[$i]->partner_mobile . '" class="form-control input-sm  pull-left input_partner_mobile hide" name="input_partner_mobile" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }"><span style="width:60%" class="show_partner_mobile  pull-left show">' . $email_pertners[$i]->partner_mobile . '</span> <span id="president_seal_final" style="'.$display_president_seal_final.'; text-align:right; margin-right:3%;"><img src="'.base_url().'resource/img/president_seal_final.jpg"></span></td>';
                    $html_data .= '<td><input style="ime-mode:active" type="text" value="' . $email_pertners[$i]->partner_name . '" class="form-control input-sm input_partner_name hide" name="" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }"><span class="show_partner_name show">' . $email_pertners[$i]->partner_name . '</span> </td>';
                } elseif ($total_partner == $i) {
                    $html_data .= '<form id="email_partner_form" action="" method="POST">
                
			                <td colspan="2" style="padding: 5px;"></td>
            						<td style="padding: 5px;" width="35%"></td>                
			            </form>';
//                    $html_data .= '<form id="email_partner_form" action="" method="POST">
//
//			                <td style="padding: 5px;">
//			                	<div class="form-group" style="margin-bottom: 0">
//				                    <input type="tel" style="width: 50%; margin-right:1%; ime-mode:inactive" class="form-control input-sm pull-left " name="partner_mobile" id="partner_mobile" placeholder="電話番号">
//				                    <input type="text" style="width: 49%; ime-mode:active" class="form-control input-sm" name="pertner_company" id="company" placeholder="会社名">
//				                </div>
//			                </td>
//			                <td style="padding: 5px; ime-mode:inactive" width="35%">
//			                	<div class="form-group" style="margin-bottom: 0"><input type="text" style="ime-mode:active" name="pertner_name" class="form-control input-sm has-error" id="partner_name" placeholder="氏名">
//
//			                    </div>
//			                </td>
//			            </form>';
                } else {
                    $html_data .= '<td colspan="2" style="padding: 5px;"></td>
            						<td style="padding: 5px;" width="35%"></td>';
                }

                $html_data .= '</tr>';
            }
            $html_data .= '</tbody>
                                            
                    </table>
                </div>';
            echo $html_data;


            // $this->load->view('components/table_of_partner', isset($data) ? $data : NULL);
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

    public function partner_auto_sugg()
    {
        $partner_name = $this->input->post("partner_name");

        $user_id = $this->input->post("user_id");
        $partner_list = $this->emailing_model->partner_search($user_id, $partner_name);
        // echo $this->db->last_query();
        // // print_r($partner_list);
        // exit();
        $html_string = '<ul id="country-list">';

        foreach ($partner_list as $partner) {

            $html_string .= '<li data="' . $partner->partner_name . '" id="' . $partner->partner_mobile . '" class="partner_auto_click">' . $partner->partner_name . '(' . $partner->partner_mobile . ')</li>';
        }
        $html_string .= '</ul>';
        echo $html_string;
    }

    public function partner_mobile_auto_sugg()
    {
        $partner_mobile = $this->input->post("partner_mobile");

        $user_id = $this->input->post("user_id");
        $partner_list = $this->emailing_model->partner_search($user_id, NULL, $partner_mobile);
        // echo $this->db->last_query();
        // // print_r($partner_list);
        // exit();
        $html_string = '<ul id="country-list">';

        foreach ($partner_list as $partner) {

            $html_string .= '<li data="' . $partner->partner_name . '" id="' . $partner->partner_mobile . '" class="partner_mobile_auto_click">' . $partner->partner_mobile . '(' . $partner->partner_name . ')</li>';
        }
        $html_string .= '</ul>';
        echo $html_string;
    }

    function email_image_upload()
    {
        // echo $_FILES['userfile']['name'] ;
        // exit();
        if ($_FILES['userfile']['name'] != "") {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            // $config['max_size']             = 100;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $data['error'] = array();
            $data['upload_data'] = array();
            if (!$this->upload->do_upload('userfile')) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $data['upload_data'] = $this->upload->data();
            }
            echo json_encode($data);
        }
    }

    public function share_email_to_multiple_partner()
    {
        $get_user_json = file_get_contents('php://input');

        $user_data = json_decode($get_user_json);

        foreach ($user_data->partners as $key => $receiver_id) {
            $this->send_emails($receiver_id, $user_data->sender_id, $user_data->email_id, $user_data->settlement_id);//, $user_data->settlement_title, $user_data->conclusion, $user_data->reason, $user_data->case_study, $user_data->others
        }

    }

    public function send_emails($receiver_id, $sender_id, $email_id, $settlement_id)
    {
        $email_details = $this->emailing_model->get_email_by_id($email_id);

        $receiver_user_info = $this->emailing_model->get_partner_details_by_user_id($receiver_id);
        if ($receiver_user_info->partner_id != '') {
            $partner_id = $receiver_user_info->partner_id;
        } else {
            $partner_user_info = $this->account_model->get_by_username($receiver_user_info->partner_name);
            $partner_id = $partner_user_info->id;
        }
//        print_r($receiver_user_info);die();
        $sender_user_info = $this->account_model->get_by_id($sender_id);
        if($sender_user_info->name!=''){
            $sender_name=$sender_user_info->name;
        }else{
            $sender_name=$sender_user_info->username;
        }
        $get_sender_mobile_no_from_partner_table = $this->emailing_model->get_sender_mobile_no_from_partner_table($sender_user_info->id, $sender_user_info->username);

        $this->emailing_model->settlement_id_is_share_enable($settlement_id);

        $emmail_data = array(
            'settlement_id' => $settlement_id,
            'receiver_id' => $partner_id,
            'receiver_name' => $receiver_user_info->partner_name,
            'sender_name' => $sender_name,
            'receiver_mobile' => $receiver_user_info->partner_mobile,
            'sender_mobile' => $get_sender_mobile_no_from_partner_table->partner_mobile,
            'parent_email_id' => NULL,
            'subject' => $email_details->subject,
            'content' => $email_details->content,
            'drft' => 0,
            'created_by' => $sender_user_info->id,
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->emailing_model->_table_name = 'email';
        $this->emailing_model->_primary_key = 'email_id';
        $email_id = $this->emailing_model->save($emmail_data);

        if ($email_id) {
            $this->add_number_in_partner($sender_user_info->id, $receiver_user_info->partner_mobile);
        }
    }

    function add_number_in_partner($user_id, $receiver_mobile)
    {
        $my_partner_info = $this->emailing_model->get_by_partner_mobile($receiver_mobile, $user_id);

        if ($my_partner_info) {
            if ($my_partner_info->partner_id != '') {
                $partner_id = $my_partner_info->partner_id;
            } else {
                $partner_user_info = $this->account_model->get_by_username($my_partner_info->partner_name);
                $partner_id = $partner_user_info->id;
            }
            // Update Sender Transection
            $this->emailing_model->add_uses_partner($user_id, $partner_id);
            // Update Receiver Transection
            $this->emailing_model->add_uses_partner($partner_id, $user_id);
        }

    }

    function view_email_screen()
    {
        // Redirect unauthenticated users to signin page
        if (!$this->authentication->is_signed_in()) {
            redirect('account/sign_in');
        }
        $data['title'] = "Email";
        $data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
        $data['user_emails'] = $this->emailing_model->get_email_by_user_id($data['account']->id, 0, 30);
        // echo "<pre>"; print_r($data['user_emails']);
        // exit();
        $data['email_pertners'] = $this->emailing_model->get_pertner_list_by_id($data['account']->id, 0);
        $this->load->view('components/email_screen', isset($data) ? $data : NULL);
    }

}


/* End of file sign_in.php */
/* Location: ./application/account/controllers/sign_in.php */