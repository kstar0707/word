<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Emailing_model extends MY_Model
{

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_email_by_user_id($user_id = NULL, $start = NULL, $limit = NULL, $sign_in_username_email = '')
    {
        $this->db->select('email.*, a3m_account.username');
        $this->db->from('email');

        $this->db->join('a3m_account', 'email.created_by = a3m_account.id', 'left');
        $this->db->join('email_deleted', 'email.email_id = email_deleted.email_id', 'left');
        if ($user_id) {
            if ($sign_in_username_email != '')
                $this->db->where("(email.settlement_id !=0)");
            else
                $this->db->where("(email.settlement_id =0)");
            $this->db->where(array('email.drft' => 0));
            // $deleted_email = $this->deleted_email_list($user_id);
            if ($sign_in_username_email == '')
                $this->db->where("(email.created_by LIKE '$user_id' OR email.receiver_id LIKE '$user_id')");
            else
                $this->db->where("(email.sender_name = '$sign_in_username_email' OR email.receiver_id LIKE '$user_id')");
            $this->db->where("email.email_id NOT IN (select email_deleted.email_id from email_deleted where user_id = $user_id AND trash=1)");

        }

        if ($limit) {
            $this->db->limit($limit, $start);
        }

        $this->db->order_by('email.created_at', 'desc');

        $query = $this->db->get();
//        echo 'Query1  =  ' . $this->db->last_query();
//        die();
        return $query->result();
    }

    function deleted_email_list($user_id)
    {
        $this->db->select('email_id');
        $this->db->where("user_id", $user_id);
        $query = $this->db->get("email_deleted");
        return $query->result();
    }

    public function get_draft_email_by_user_id($user_id = NULL, $start = NULL, $limit = NULL)
    {
        $this->db->select('email.*, a3m_account.username');
        $this->db->from('email');
        $this->db->join('a3m_account', 'email.created_by = a3m_account.id', 'left');
        if ($user_id) {
            $this->db->where(array('email.drft' => 1, 'email.created_by' => $user_id));

        }

        if ($limit) {
            $this->db->limit($limit, $start);
        }

        $this->db->order_by('created_at', 'desc');

        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }

    function get_email_by_id($email_id)
    {
        $this->db->select('email.*, email_partner.partner_name as sender, a3m_account.username');
        $this->db->from('email');
        $this->db->join('email_partner', 'email.sender_mobile = email_partner.partner_mobile', 'left');

        $this->db->join('a3m_account', 'email.created_by = a3m_account.id', 'left');

        $this->db->where('email.email_id', $email_id);
        $query = $this->db->get();
//        echo 'Query1  =  '.$this->db->last_query();
        return $query->row();
        // $this->db->where('email_id', $email_id);
        // $query = $this->db->get('email');
        // return $query->row();
    }

    function delete_email_by_id($email_id)
    {
        if ($this->db->delete('email', array('email_id' => $email_id))) {
            return true;
        } else {
            return false;
        }
    }

    function get_pertner_list_by_id($user_id, $partner_type)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('is_deleted', 0);
        $this->db->where('partner_type', $partner_type);//partner create from: 0 for normal email form; 1 for requisition form
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('email_partner');
//        echo 'Query1  =  '.$this->db->last_query();
        return $query->result();
    }

    function get_by_partner_mobile($partner_mobile, $user_id = NULL, $partner_type = 0)
    {
        if ($user_id != NULL) {
            $this->db->where(array('partner_mobile' => $partner_mobile, 'user_id' => $user_id, 'is_deleted' => 0, 'partner_type' => $partner_type));
        } else {
            $this->db->where(array('partner_mobile' => $partner_mobile, 'is_deleted' => 0, 'partner_type' => $partner_type));
        }
        return $this->db->get('email_partner')->row();
    }

    function get_exist_by_partner_mobile($partner_mobile, $user_id = NULL, $id, $partner_type = 0)
    {
        $this->db->where(array('partner_mobile' => $partner_mobile, 'user_id' => $user_id, 'partner_type' => $partner_type, 'is_deleted' => 0, 'id !=' => $id));

        return $this->db->get('email_partner')->row();
    }

    function add_uses_partner($user_id, $partner_id)
    {
        $this->db->where(array('user_id' => $user_id, 'partner_id' => $partner_id));

        $partner_info = $this->db->get('email_partner')->row();
        if (!empty($partner_info)) {
            $partner_uses = $partner_info->uses + 1;
            $data = array(
                'uses' => $partner_uses
            );
            $this->db->where(array('user_id' => $user_id, 'partner_id' => $partner_id));
            $this->db->update('email_partner', $data);
            return true;
        }
        return false;
    }

    function get_user_last_mail($user_id, $sign_in_username_email = '')
    {
        $this->db->select('email.*, email_partner.partner_name as sender');
        $this->db->from('email');
        $this->db->join('email_partner', 'email.sender_mobile = email_partner.partner_mobile', 'left');

        $this->db->join('a3m_account', 'email.created_by = a3m_account.id', 'left');
        $this->db->join('email_deleted', 'email.email_id = email_deleted.email_id', 'left');
        if ($user_id) {
            if ($sign_in_username_email != '')
                $this->db->where("(email.settlement_id !=0)");
            else
                $this->db->where("(email.settlement_id =0)");
            $this->db->where(array('email.drft' => 0));
            // $deleted_email = $this->deleted_email_list($user_id);
            if ($sign_in_username_email == '')
                $this->db->where("(email.created_by LIKE '$user_id' OR email.receiver_id LIKE '$user_id')");
            else
                $this->db->where("(email.sender_name = '$sign_in_username_email' OR email.receiver_id LIKE '$user_id')");
            $this->db->where("email.email_id NOT IN (select email_deleted.email_id from email_deleted where user_id = $user_id AND trash=1)");
        }

        $this->db->order_by('email.created_at', 'desc');

        $query = $this->db->get();

        return $query->row();
    }

    function get_user_last_draft_mail($user_id)
    {
        $this->db->select('email.*, a3m_account.username');
        $this->db->from('email');
        $this->db->join('a3m_account', 'email.created_by = a3m_account.id', 'left');
        if ($user_id) {
            $this->db->where(array('email.drft' => 1, 'email.created_by' => $user_id));

        }

        $this->db->order_by('created_at', 'desc');

        $query = $this->db->get();
        return $query->row();
    }

    function get_japanese_format_date($date_time)
    {
        $month = date('m', strtotime($date_time));
        $email_date = date('d', strtotime($date_time));
        $email_day = date('D', strtotime($date_time));
        $email_time = date('h:i', strtotime($date_time));
        $email_event = date('A', strtotime($date_time));
        $am_pm = "";
        if ($email_event == "PM") {
            $am_pm = "午後";
        } else {
            $am_pm = "午前";
        }

        $jaDay = "";

        switch ($email_day) {
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

        $japan_date = $month . '月' . $email_date . '日(' . $jaDay . ')' . $email_time . $am_pm;
        return $japan_date;
    }

    function partner_search($user_id, $name = NULL, $mobile = NULL)
    {
        $this->db->where('user_id', $user_id);
        if ($name != NULL) {
            $this->db->like('partner_name', $name, 'both');
        }

        if ($mobile != NULL) {
            $this->db->like('partner_mobile', $mobile, 'both');
        }

        $this->db->limit(10);
        // $this->db->order_by('id', 'desc');
        $query = $this->db->get('email_partner');
        return $query->result();
    }

    function get_introducer_by_id_mobile($user_id, $mobile = NULL)
    {
        if (!empty($mobile)) {
            $this->db->where(array('introducer_id' => $user_id, 'referee_number' => $mobile));
            $query = $this->db->get('introducer_referee');
            return $query->row();
        } else {
            $this->db->where(array('introducer_id' => $user_id));
            $this->db->order_by("refree_id", "desc");
            $query = $this->db->get('introducer_referee');
            return $query->result();
        }
    }

    public function most_uses_partner_list($user_id = NULL, $start = NULL, $limit = NULL)
    {
        // $this->db->select('email.*, a3m_account.username');
        $this->db->from('email_partner');
        $this->db->where("email_partner.user_id", $user_id);
        $this->db->order_by('uses', 'desc');
        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();
//        echo $this->db->last_query();
        $partner_list = $query->result();
        return $partner_list;

    }


    function get_partner_send_items($user_id, $partner_id)
    {
        $this->db->select('email.*, a3m_account.username');
        $this->db->from('email');

        $this->db->join('a3m_account', 'email.created_by = a3m_account.id', 'left');
        $this->db->join('email_deleted', 'email.email_id = email_deleted.email_id', 'left');
        if ($user_id) {
            $this->db->where(array('email.drft' => 0, 'email.created_by' => $user_id, 'email.receiver_id' => $partner_id, 'email.settlement_id' => 0));

            $this->db->where("email.email_id NOT IN (select email_deleted.email_id from email_deleted where user_id = $user_id AND trash=1)");
        }

        $this->db->order_by('email.created_at', 'desc');

        $query = $this->db->get();

        return $query->result();
    }

    function get_partner_received_items($user_id, $partner_id)
    {
        $this->db->select('email.*, a3m_account.username');
        $this->db->from('email');

        $this->db->join('a3m_account', 'email.created_by = a3m_account.id', 'left');
        $this->db->join('email_deleted', 'email.email_id = email_deleted.email_id', 'left');
        if ($user_id) {
            $this->db->where(array('email.drft' => 0, 'email.receiver_id' => $user_id, 'email.created_by' => $partner_id, 'email.settlement_id' => 0));

            $this->db->where("email.email_id NOT IN (select email_deleted.email_id from email_deleted where user_id = $user_id AND trash=1)");
        }

        $this->db->order_by('email.created_at', 'desc');

        $query = $this->db->get();

        return $query->result();
    }

    public function get_partner_single_email($user_id, $partner_id)
    {
        $this->db->select('email.*, a3m_account.username');
        $this->db->from('email');

        $this->db->join('a3m_account', 'email.created_by = a3m_account.id', 'left');
        $this->db->join('email_deleted', 'email.email_id = email_deleted.email_id', 'left');
        if ($user_id) {
            $this->db->where(array('email.drft' => 0, 'email.receiver_id' => $user_id, 'email.created_by' => $partner_id, 'email.settlement_id' => 0));

            $this->db->where("email.email_id NOT IN (select email_deleted.email_id from email_deleted where user_id = $user_id AND trash=1)");
        }

        $this->db->order_by('email.created_at', 'desc');
        $this->db->limit(1, 0);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->row();
    }

    function get_partner_single_sending_items($user_id, $partner_id)
    {
        $this->db->select('email.*, a3m_account.username');
        $this->db->from('email');

        $this->db->join('a3m_account', 'email.created_by = a3m_account.id', 'left');
        $this->db->join('email_deleted', 'email.email_id = email_deleted.email_id', 'left');
        if ($user_id) {
            $this->db->where(array('email.drft' => 0, 'email.created_by' => $user_id, 'email.receiver_id' => $partner_id, 'email.settlement_id' => 0));

            $this->db->where("email.email_id NOT IN (select email_deleted.email_id from email_deleted where user_id = $user_id AND trash=1)");
        }

        $this->db->order_by('email.created_at', 'desc');
        $this->db->limit(1, 0);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_partner_details_by_user_id($id)
    {
        $this->db->select('*');
        $this->db->from('email_partner');
        $this->db->where('id', $id);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->row();

        // $this->db->join('email_partner', 'email.sender_mobile = email_partner.partner_mobile', 'left');

        // $this->db->join('a3m_account', 'email.created_by = a3m_account.id', 'left');
        // $this->db->join('email_deleted', 'email.email_id = email_deleted.email_id', 'left');
    }

    public function get_settlement_id($id)
    {
        $this->db->select('email_id,settlement_id');
        $this->db->from('email');
        $this->db->where('email_id', $id);
        $query = $this->db->get();
        return $query->row_array();
//        echo $this->db->last_query();
    }

    function deletePartner($partner_id)
    {
        $this->db->set('is_deleted', 1);
        $this->db->where('id', $partner_id);
        $this->db->update('email_partner');
        //echo $this->db->last_query();die;
        if ($this->db->affected_rows() > 0)
            $val = 1;
        else
            $val = 0;
        return $val;

//        $where = array('id' => $partner_id);
//        $val = $this->db->delete('email_partner', $where);
////         echo $this->db->last_query();
//        return $val;
    }

    function check_new_mail_for_specific_user($user_id)
    {
        $this->db->distinct('receiver_id');
        $this->db->select('email_id,receiver_id,seen,settlement_id');
        $this->db->from('email');
        $this->db->where('receiver_id', $user_id);
        $this->db->where('seen', 0);
//        $this->db->where('settlement_id !=', 0);
        $this->db->where('notification_shown', 0);
        $this->db->like('created_at', date('Y-m-d'));
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->row_array();
    }

    function get_total_unread_email($receiver_id)
    {
        $this->db->select('seen');
        $this->db->from('email');
        $this->db->where('receiver_id', $receiver_id);
        $this->db->where('seen', 0);
        $this->db->like('created_at', date('Y-m-d'));
//        $this->db->where('settlement_id !=', 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    function get_email_create_date($email_id)
    {
        $this->db->select('receiver_id,created_at,email_id,sender_name,seen');
        $this->db->from('email');
        $this->db->where('email_id', $email_id);
//        $this->db->where('settlement_id !=', 0);
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->row_array();
    }

    function update_notification_shown($email_id)
    {
        $this->db->set('notification_shown', 1);
        $this->db->where('email_id', $email_id);
        $this->db->update('email');
        //echo $this->db->last_query();die;
        if ($this->db->affected_rows() > 0)
            $val = 1;
        else
            $val = 0;
        return $val;
    }

    function check_if_this_user_send_email($user_id, $username, $email, $partner_type)
    {
        $this->db->distinct('receiver_id,receiver_name,receiver_mobile');
        $this->db->select('receiver_id,receiver_name,receiver_mobile');
        $this->db->from('email');
        $this->db->where('receiver_id !=', '');
        $this->db->where('sender_name', $username);
        $this->db->or_where('sender_name', $email);
        $query = $this->db->get();
//        echo $this->db->last_query();die();
        if ($query->num_rows() > 0) {
            $this->load->model('account/account_model');
            $all_info_array = $query->result_array();
//            print_r($all_info_array);
            foreach ($all_info_array as $info_array) {
                $receiver_id = $info_array['receiver_id'];
                $receiver_name = $info_array['receiver_name'];
                $receiver_mobile = $info_array['receiver_mobile'];

                $user_all_info = $this->account_model->get_username_by_id($receiver_id,1);
//                echo "<pre>";
//                print_r($user_all_info);
                if (!empty($user_all_info)) {
                    $sender_username = $user_all_info->username;
                    $sender_email = $user_all_info->email;
                    if ($user_all_info->name != '')
                        $sender_reg_name = $user_all_info->name;
                    else
                        $sender_reg_name = '';


                    $check_if_user_exist = $this->account_model->check_if_user_exist($receiver_id, $sender_username);

                    if (!empty($check_if_user_exist) && $receiver_id == $check_if_user_exist['id'] && ($sender_username == $check_if_user_exist['username'] || $sender_email == $check_if_user_exist['email'])) {

                        $check_if_receiver_exist_as_partner = $this->check_if_receiver_exist_as_partner($user_id, $receiver_id, $sender_reg_name, $sender_username);
//                    print_r($check_if_receiver_exist_as_partner);
                        if ($check_if_receiver_exist_as_partner > 0) {

                        } else {
                            $this->db->insert('email_partner', array('user_id' => $user_id, 'partner_id' => $receiver_id, 'partner_name' => $sender_reg_name, 'company' => NULL, 'partner_mobile' => $sender_username, 'partner_type' => $partner_type, 'created_at' => date('Y-m-d H:i:s')));
//no data=データなし
                            $this->db->insert_id();
                        }
                    }
                }
            }
        } else {
//            return 0;
        }


//        echo $this->db->last_query();
//        return $query->result_array();
    }

    function check_if_this_user_receive_email($user_id, $username, $email, $partner_type)
    {
//       error_reporting(0);
        $this->db->distinct('sender_name,sender_mobile,created_by');
        $this->db->select('sender_name,sender_mobile,created_by');
        $this->db->from('email');
        $this->db->where('receiver_id', $user_id);
        $this->db->where('receiver_id !=', '');
        $this->db->where('receiver_name', $username);
        $this->db->or_where('receiver_mobile', $username);
        $query = $this->db->get();
//        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $this->load->model('account/account_model');
            $all_info_array = $query->result_array();
//            print_r($all_info_array);
            foreach ($all_info_array as $info_array) {
                $created_by = $info_array['created_by'];
                $sender_name = $info_array['sender_name'];
                $sender_mobile = $info_array['sender_mobile'];
                $user_all_info = $this->account_model->get_username_by_id($created_by,1);
//                echo "<pre>";
//                print_r($user_all_info);
                if (!empty($user_all_info)) {
                    $sender_id = $user_all_info->id;
                    $sender_username = $user_all_info->username;
                    $sender_email = $user_all_info->email;
                    if ($user_all_info->name != '')
                        $sender_reg_name = $user_all_info->name;
                    else
                        $sender_reg_name = '';
                    $check_if_user_exist = $this->account_model->check_if_user_exist($sender_id, $sender_username);
//                    print_r($check_if_user_exist);
                    if (!empty($check_if_user_exist) && $sender_id == $check_if_user_exist['id'] && ($sender_username == $check_if_user_exist['username'] || $sender_email == $check_if_user_exist['email'])) {
                        $check_if_receiver_exist_as_partner = $this->check_if_receiver_exist_as_partner($user_id, $sender_id, $sender_name, $sender_mobile);
//                print_r($check_if_receiver_exist_as_partner);
                        if ($check_if_receiver_exist_as_partner > 0) {

                        } else {

                            $this->db->insert('email_partner', array('user_id' => $user_id, 'partner_id' => $sender_id, 'partner_name' => $sender_reg_name, 'company' => NULL, 'partner_mobile' => $sender_username, 'partner_type' => $partner_type, 'created_at' => date('Y-m-d H:i:s')));
//no data=データなし
                            $this->db->insert_id();

                        }
                    }
                }
            }
        } else {
//            return 0;
        }


//        echo $this->db->last_query();
//        return $query->result_array();
    }

    function check_if_receiver_exist_as_partner($user_id, $receiver_id, $receiver_name, $receiver_mobile)
    {
        $result = array();
        $this->db->distinct('partner_id,partner_name');
        $this->db->select('partner_id,partner_name');
        $this->db->from('email_partner');
        $this->db->where('user_id', $user_id);
        $this->db->where('partner_id !=', '');
//        $this->db->where("(`partner_name` = '$receiver_name' OR `partner_mobile`='$receiver_mobile')");
        $this->db->where('partner_id', $receiver_id);
        $this->db->where("(`is_deleted` = 0 OR `is_deleted` = 1)");
//        $this->db->where('partner_name', $receiver_name);
//        $this->db->or_where('partner_mobile', $receiver_mobile);
//        $this->db->where('partner_id', $receiver_id);
//        $this->db->where('is_deleted', 1);
//        $this->db->or_where('is_deleted', 0);
        $query = $this->db->get();
//        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->row_array();

            return 1;
        } else {
            return 0;
        }
    }

    function settlement_id_is_share_enable($settlement_id)
    {
        $this->db->set('is_share', 1);
        $this->db->where('settlement_id', $settlement_id);
        $this->db->update('settlement_form_tbl');
        $this->db->affected_rows();
//        echo $this->db->last_query();
//        if ($this->db->affected_rows() > 0)
//            $val = 1;
//        else
//            $val = 0;
//
//        return $val;
    }

    function get_sender_mobile_no_from_partner_table($user_id, $sender_name)
    {
        $this->db->where(array('partner_name' => $sender_name, 'partner_id' => $user_id, 'partner_mobile !=' => '', 'user_id !=' => 0, 'is_deleted' => 0));
        $this->db->order_by('uses', 'desc');

        return $this->db->get('email_partner')->row();
//        echo 'Query1  =  '.$this->db->last_query();
    }

    function check_if_user_add_president_as_partner($user_id, $partner_type)
    {
        $this->db->where('user_id', $user_id);
//        $this->db->where('partner_id', 20);
        $this->db->where('partner_id', 174);
        $this->db->where('is_deleted', 0);
        $this->db->where('partner_type', $partner_type);//partner create from: 0 for normal email form; 1 for requisition form
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('email_partner');
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
//        echo 'Query1  =  '.$this->db->last_query();
//        return $query->result();
    }


}

/* End of file account_details_model.php */
/* Location: ./application/account/models/account_details_model.php */